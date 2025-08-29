<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after:start_date'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'deadline' => $request->deadline
        ]);

      

        return redirect()->route('projects.index')->with('success','Project created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('issues')->findOrFail($id);
        if(!$project) {
            return redirect()->route('projects.index')->with('error','Project not found');
        }
        
        return view('projects.show',compact('project'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        if(!$project) {
            return redirect()->route('projects.index')->with('error','Project not found');
        }

        return view('projects.edit',compact('project'));
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'start_date' => 'sometimes|date',
            'deadline' => 'sometimes|date|after:start_date'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $project = Project::findOrFail($id);

        if(!$project) {
            return redirect()->route('projects.index')->with('error','Project not found');
        }

        $project->update([
            'name' => $request->name ?? $project->name,
            'description' => $request->description ?? $project->description,
            'start_date' => $request->start_date ?? $project->start_date,
            'deadline' => $request->deadline ?? $project->deadline
        ]);

      

        return redirect()->route('projects.index')->with('success','Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        if(!$project) {
            return redirect()->route('projects.index')->with('error','Project not found');
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success','Project deleted successfully');
    }
}
