<?php

namespace App\Http\Controllers;

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
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
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
        $data['status'] = 'approved';
        $data['user_id'] = Auth::user()->id;
        if ($request->hasFile('book_cover')) {
            $data['book_cover'] = $request->file('book_cover')->store('book_covers','public');
        }

        if ($request->hasFile('book_files')) {
            $data['book_files'] = $request->file('book_files')->store('book_files','public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
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

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
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
    public function borrowRequest(Book $book)
    {
        // Assuming authenticated user is requesting to borrow the book
        $user = Auth::user();

        // Check if the user has already requested to borrow this book
        if ($user->requests()->where('book_id', $book->id)->exists()) {
            return redirect()->back()->with('error', 'You have already requested to borrow this book.');
        }

        // Create a new request in book_requests table
        $request = BookRequest::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'pending',
        ])->get();

        // Notify admin about the borrow request
        $admins = User::role('admin')->get(); // Assuming 'admin' role exists
        // Notification::send($admins, new BookBorrowRequestNotification($request));

        return redirect()->back()->with('success', 'Your borrow request has been sent for approval.');
    }

    public function borrowApprove(BookRequest $request)
    {
        // Update status of the book borrow request
        $request->update(['status' => 'approved']);
        // Notify the user that their borrow request has been approved
        // $request->user->notify(new BookBorrowApprovedNotification($request->book));

        return redirect()->back()->with('success', 'Borrow request approved.');
    }
    public function borrowApproval()
    {
        // Fetch all book requests
        $bookRequests = BookRequest::all();

        return view('books.borrow-approve', compact('bookRequests'));
    }
    public function approve(Book $book)
    {
        // Update status of the book borrow request
        $book->update(['status' => 'approved']);
        // Notify the user that their borrow request has been approved
        // $request->user->notify(new BookBorrowApprovedNotification($request->book));

        return redirect()->back()->with('success', 'Borrow request approved.');
    }
    public function disapprove(Book $book)
    {
        // Update status of the book borrow request
        $book->update(['status' => 'rejected']);
        // Notify the user that their borrow request has been approved
        // $request->user->notify(new BookBorrowApprovedNotification($request->book));

        return redirect()->back()->with('success', 'Borrow request approved.');
    }

    public function bookmark(Book $book)
{
    $user = Auth::user();

    if ($user->bookmarks()->where('book_id', $book->id)->exists()) {
        return redirect()->back()->with('error', 'You have already bookmarked this book.');
    }

    $user->bookmarks()->attach($book->id);

    return redirect()->back()->with('success', 'Book bookmarked successfully.');
}

public function unbookmark(Book $book)
{
    $user = Auth::user();

    if (!$user->bookmarks()->where('book_id', $book->id)->exists()) {
        return redirect()->back()->with('error', 'You have not bookmarked this book.');
    }

    $user->bookmarks()->detach($book->id);

    return redirect()->back()->with('success', 'Book unbookmarked successfully.');
}
public function bookmarks()
{
    $user = Auth::user();
    $books = $user->bookmarks;

    return view('bookmarks', compact('books'));
}

}
