<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; // Import DB facade

session_start();

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['customer', 'product'])
        ->orderBy('created_at', 'desc') // Sắp xếp theo thời gian tạo mới nhất
        ->paginate(5);    
    
        // Check if customer information exists in session
        $customer_id = Session::get('customer_id');
        $customer = null;
        if ($customer_id) {
            $customer = Customer::find($customer_id);
        }
    
        return view('admin.comments.index', compact('comments', 'customer'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:tbl_product,product_id',
            'content' => 'required|max:500',
        ]);

        // Get customer_id from session
        $customer_id = Session::get('customer_id');

        // Create the comment
        Comment::create([
            'product_id' => $validatedData['product_id'],
            'content' => $validatedData['content'],
            'approved' => false,
            'customer_id' => $customer_id, // Save the customer_id in the comments table
        ]);

        return redirect()->back()->with('success', 'Comment submitted successfully. It will be visible after approval.');
    }

    public function approveComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['approved' => true]);
        return redirect()->back()->with('success', 'Comment approved successfully.');
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
