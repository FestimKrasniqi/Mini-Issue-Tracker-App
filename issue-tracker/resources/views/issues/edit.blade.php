@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Issue</h1>

    <form method="POST" action="{{ route('issues.update', $issue->id) }}">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $issue->title) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description', $issue->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="open" {{ $issue->status == 'open' ? 'selected' : '' }}>Open</option>
                <option value="in_progress" {{ $issue->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="closed" {{ $issue->status == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Priority</label>
            <select name="priority" class="form-control">
                <option value="low" {{ $issue->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $issue->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $issue->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date', $issue->due_date) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Project Name</label>
            <input type="text" name="name" value="{{ old('name', $issue->project->name ?? '') }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('issues.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
