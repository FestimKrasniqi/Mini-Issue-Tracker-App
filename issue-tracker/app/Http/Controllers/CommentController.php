<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;
use App\Models\Issue;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($issueId)
    {
        $issue = Issue::find($issueId);
        if(!$issue) {
            return response()->json(['error'=> 'Issue not found'],404);
        }
        $comments = $issue->comments()->latest()->paginate(10);

        return response()->json($comments);
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$issueId)
    {

        $validator = Validator::make($request->all(),[
            'author_name' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()],422);
        }


        $issue = Issue::findOrFail($issueId);

        if(!$issue) {
            return response()->json(['error'=> 'Issue not found'],404);
        }

        $comment = $issue->comments()->create([
            'author_name' => $request->author_name,
            'body' => $request->body
        ]);

       

        return response()->json(['message' => 'Comment added successfully',
        'comment'=> $comment],
        201);
        
    }

  
}
