@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $issue->title }}</h1>
    <p><strong>Status:</strong> {{ ucfirst($issue->status) }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($issue->priority) }}</p>
    <p><strong>Due Date:</strong> {{ $issue->due_date }}</p>
    <p><strong>Project:</strong> {{ $issue->project->name ?? 'N/A' }}</p>

    <h4>Tags</h4>
    @foreach($issue->tags as $tag)
        <span class="badge bg-info">{{ $tag->name }}</span>
    @endforeach

    <h4 class="mt-3">Comments</h4>
    @forelse($issue->comments as $comment)
        <div class="card mb-2">
            <div class="card-body">
                {{ $comment->body }}
                <div class="text-muted small">By {{ $comment->author_name ?? 'Anonymous' }} on {{ $comment->created_at }}</div>
            </div>
        </div>
    @empty
        <p>No comments yet.</p>
    @endforelse

    <a href="{{ route('issues.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
