<?php

namespace App\Http\Controllers\Office;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $collection = Comment::paginate(10);
            return view('pages.app.comment.list',compact('collection'));
        }
        return view('pages.app.comment.main');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Comment $comment)
    {
        return view('pages.app.comment.input', ['data' => $comment]);
    }

    public function edit(Comment $comment)
    {
        //
    }

    public function update(Request $request, Comment $comment)
    {
        if ($request->is_active !== null) {
            $comment->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $comment->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
