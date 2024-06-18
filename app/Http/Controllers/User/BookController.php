<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\BookRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BookBorrowApprovedNotification;
use App\Notifications\BookBorrowRequestNotification;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('user_id','=',Auth::user()->id)->get();
        return view('publish.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('publish.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'book_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'penerbit' => 'required|string|max:255',
            'shelf' => 'required|string|max:255',
            'row' => 'required|integer',
            'stok' => 'required|integer',
            'book_files' => 'nullable|mimes:pdf,doc,docx,txt|max:2048',
        ]);

        $data = $request->all();
        $data['status'] = 'pending';
        $data['user_id'] = Auth::user()->id;
        if ($request->hasFile('book_cover')) {
            $data['book_cover'] = $request->file('book_cover')->store('book_covers','public');
        }

        if ($request->hasFile('book_files')) {
            $data['book_files'] = $request->file('book_files')->store('book_files','public');
        }

        Book::create($data);

        return redirect()->route('publish.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('publish.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('publish.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'book_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'penerbit' => 'required|string|max:255',
            'shelf' => 'required|string|max:255',
            'row' => 'required|integer',
            'stok' => 'required|integer',
            'book_files' => 'nullable|mimes:pdf,doc,docx,txt|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('book_cover')) {
            if ($book->book_cover) {
                Storage::delete($book->book_cover);
            }
            $data['book_cover'] = $request->file('book_cover')->store('book_covers','public');
        }

        if ($request->hasFile('book_files')) {
            if ($book->book_files) {
                Storage::delete($book->book_files);
            }
            $data['book_files'] = $request->file('book_files')->store('book_files','public');
        }

        $book->update($data);

        return redirect()->route('publish.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        if ($book->book_cover) {
            Storage::delete($book->book_cover);
        }
        if ($book->book_files) {
            Storage::delete($book->book_files);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
