@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Issue</h1>

    <form method="POST" action="{{ route('issues.store') }}">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="open">Open</option>
                <option value="in_progress">In Progress</option>
                <option value="closed">Closed</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Priority</label>
            <select name="priority" class="form-control">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Project Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('issues.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    
</div>

@endsection
