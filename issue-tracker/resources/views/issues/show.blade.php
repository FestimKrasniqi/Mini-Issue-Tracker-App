@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $issue->title }}</h1>
    <p><strong>Status:</strong> {{ ucfirst($issue->status) }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($issue->priority) }}</p>
    <p><strong>Due Date:</strong> {{ $issue->due_date }}</p>
    <p><strong>Project:</strong> {{ $issue->project->name ?? 'N/A' }}</p>

    {{-- Tags Section --}}
    <h4>Tags</h4>
    <div id="issue-tags">
        @foreach($issue->tags as $tag)
            <span class="badge bg-info me-1">{{ $tag->name }}</span>
        @endforeach
    </div>
    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#tagModal">
        Manage Tags
    </button>

    <div class="modal fade" id="tagModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attach/Detach Tags</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @foreach($tags as $tag)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input toggle-tag"
                                data-tag-id="{{ $tag->id }}"
                                {{ $issue->tags->contains($tag->id) ? 'checked' : '' }}>
                            <label>{{ $tag->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Members Section --}}
    <h4 class="mt-4">Assigned Members</h4>
    <div id="issue-members">
        @foreach($issue->members as $user)
            <span class="badge bg-success me-1">{{ $user->name }}</span>
        @endforeach
    </div>
    <button class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#membersModal">
        Manage Members
    </button>

    <div class="modal fade" id="membersModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attach/Detach Members</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @foreach($users as $user)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input toggle-member"
                                data-user-id="{{ $user->id }}"
                                {{ $issue->members->contains($user->id) ? 'checked' : '' }}>
                            <label>{{ $user->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Comments Section --}}
    <h4 class="mt-3">Comments</h4>
    <div id="comments-list"></div>

    <form id="comment-form" data-issue-id="{{ $issue->id }}" class="mt-3">
        @csrf
        <div class="mb-2">
            <input type="text" name="author_name" class="form-control" placeholder="Your name" required>
        </div>
        <div class="mb-2">
            <textarea name="body" class="form-control" placeholder="Write a comment..." required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add Comment</button>
    </form>

    <a href="{{ route('issues.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const issueId = "{{ $issue->id }}";

    // --- Tags ---
    document.querySelectorAll('.toggle-tag').forEach(el => {
        el.addEventListener('change', function() {
            const tagId = this.dataset.tagId;
            fetch("{{ route('issues.tags.toggle') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ issue_id: issueId, tag_id: tagId })
            })
            .then(res => res.json())
            .then(data => {
                const tagsDiv = document.getElementById('issue-tags');
                tagsDiv.innerHTML = '';
                data.tags.forEach(tag => {
                    tagsDiv.innerHTML += `<span class="badge bg-info me-1">${tag}</span>`;
                });
                this.checked = (data.status === 'attached');
            })
            .catch(err => console.error(err));
        });
    });

    // --- Members ---
    document.querySelectorAll('.toggle-member').forEach(el => {
        el.addEventListener('change', function() {
            const userId = this.dataset.userId;
            fetch("{{ route('issues.members.toggle') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ issue_id: issueId, user_id: userId })
            })
            .then(res => res.json())
            .then(data => {
                const membersDiv = document.getElementById('issue-members');
                membersDiv.innerHTML = '';
                data.members.forEach(user => {
                    membersDiv.innerHTML += `<span class="badge bg-success me-1">${user}</span>`;
                });
                this.checked = (data.status === 'attached');
            })
            .catch(err => console.error(err));
        });
    });

    // --- Comments (unchanged) ---
    function loadComments(page = 1) {
        fetch(`/issues/${issueId}/comments?page=${page}`)
            .then(res => res.json())
            .then(data => {
                const commentsDiv = document.getElementById('comments-list');
                commentsDiv.innerHTML = '';

                if (data.data.length === 0) {
                    commentsDiv.innerHTML = '<p>No comments yet.</p>';
                } else {
                    data.data.forEach(comment => {
                        const createdAt = new Date(comment.created_at);
                        const formattedDate = createdAt.toLocaleString('en-GB', { 
                            day: '2-digit', month: 'short', year: 'numeric',
                            hour: '2-digit', minute: '2-digit' 
                        });

                        commentsDiv.innerHTML += `
                            <div class="card mb-2">
                                <div class="card-body">
                                    ${comment.body}
                                    <div class="text-muted small">
                                        By ${comment.author_name ?? 'Anonymous'} on ${formattedDate}
                                    </div>
                                </div>
                            </div>`;
                    });
                }
            });
    }
    loadComments();

    document.getElementById('comment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch(`/issues/${issueId}/comments`, {
            method: "POST",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (!data.errors) {
                const createdAt = new Date(data.comment.created_at);
                const formattedDate = createdAt.toLocaleString('en-GB', { 
                    day: '2-digit', month: 'short', year: 'numeric',
                    hour: '2-digit', minute: '2-digit' 
                });
                const commentsDiv = document.getElementById('comments-list');
                const newComment = `
                    <div class="card mb-2">
                        <div class="card-body">
                            ${data.comment.body}
                            <div class="text-muted small">
                                By ${data.comment.author_name ?? 'Anonymous'} on ${formattedDate}
                            </div>
                        </div>
                    </div>`;
                commentsDiv.insertAdjacentHTML('afterbegin', newComment);
                this.reset();
            }
        })
        .catch(err => console.error(err));
    });
});
</script>
@endsection
