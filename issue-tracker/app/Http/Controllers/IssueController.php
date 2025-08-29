<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Tag;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = Issue::query()->with('project', 'tags');

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('priority')) {
        $query->where('priority', $request->priority);
    }

    if ($request->filled('tag_id')) {
        $query->whereHas('tags', function ($q) use ($request) {
            $q->where('tag.id', $request->tag_id);
        });
    }

    $issues = $query->paginate(10);
    $tags = Tag::all();

    return view('issues.index', compact('issues', 'tags'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('issues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:open,in_progress,closed',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date|after_or_equal:today',
            'name' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $project = Project::where('name',$request->name)->first();

        if(!$project) {
            return redirect()->back()->with('error','Project not found')->withInput();
        }

        $issue = Issue::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date
        ]);
        
        $issue->project()->associate($project);
        $issue->save();

        return redirect()->route('issues.index')->with('success','Issue created successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(Issue $issue)
    {
        $issue = Issue::with('tags','comments')->findOrFail($issue->id);
        if(!$issue) {
            return redirect()->route('issues.index')->with('error','Issue not found');
        }

        return view('issues.show',compact('issue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        $issue = Issue::with('project')->findOrFail($issue->id);
        if(!$issue) {
            return redirect()->route('issues.index')->with('error','Issue not found');
        }

        return view('issues.edit',compact('issue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Issue $issue)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'status' => 'sometimes|in:open,in_progress,closed',
            'priority' => 'sometimes|in:low,medium,high',
            'due_date' => 'nullable|date|after_or_equal:today',
            'name' => 'sometimes|string|max:255'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $issue = Issue::findOrFail($issue->id);

        if(!$issue) {
            return redirect()->route('issues.index')->with('error','Issue not found');
        }

        $issue->update([
            'title' => $request->title ?? $issue->title,
            'description' => $request->description ?? $issue->description,
            'status' => $request->status ?? $issue->status,
            'priority' => $request->priority ?? $issue->priority,
            'due_date' => $request->due_date ?? $issue->due_date
        ]);

        if($request->has('name')) {
            $project = Project::where('name',$request->name)->first();
            if(!$project) {
                return redirect()->back()->with('error','Project not found')->withInput();
            }
            $issue->project()->associate($project);
            $issue->save();
        }

        return redirect()->route('issues.index')->with('success','Issue updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        $issue = Issue::findOrFail($issue->id);
        if(!$issue) {
            return redirect()->route('issues.index')->with('error','Issue not found');
        }

        $issue->delete();
        return redirect()->route('issues.index')->with('success','Issue deleted successfully');
    }
}
