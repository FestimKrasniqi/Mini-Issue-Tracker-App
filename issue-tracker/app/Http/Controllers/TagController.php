<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Issue;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255|unique:tag,name',
            'color' => 'nullable|string|max:7'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tag = Tag::create([
            'name' => $request->name,
            'color' => $request->color
        ]);

        return redirect()->route('tags.index')->with('success','Tag created successfully');
    }

    
  public function toggleTag(Request $request)
{
    $issue = Issue::findOrFail($request->issue_id);
    $tagId = $request->tag_id;

   
    if ($issue->tags->contains($tagId)) {
        $issue->tags()->detach($tagId); 
        $status = 'detached';
    } else {
        $issue->tags()->attach($tagId); 
        $status = 'attached';
    }

    $issue->load('tags'); 

    return response()->json([
        'status' => $status,
        'tags' => $issue->tags->pluck('name') 
    ]);
}


}
