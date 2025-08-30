@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $issue->title }}</h1>
    <p><strong>Status:</strong> {{ ucfirst($issue->status) }}</p>
    <p><strong>Priority:</strong> {{ ucfirst($issue->priority) }}</p>
    <p><strong>Due Date:</strong> {{ $issue->due_date }}</p>
    <p><strong>Project:</strong> {{ $issue->project->name ?? 'N/A' }}</p>

    <h4>Tags</h4>
    <div id="issue-tags">
    @foreach($issue->tags as $tag)
        <span class="badge bg-info me-1">{{ $tag->name }}</span>
    @endforeach
</div>

    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#tagModal">
        Manage Tags
    </button>

    <!-- Modal -->
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

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const issueId = "{{ $issue->id }}";

    document.querySelectorAll('.toggle-tag').forEach(el => {
        el.addEventListener('change', function() {
            const tagId = this.dataset.tagId;
            console.log('Checkbox changed:', tagId, 'Checked?', this.checked);

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
                console.log('Server response:', data);

                const tagsDiv = document.getElementById('issue-tags');
                tagsDiv.innerHTML = '';
                data.tags.forEach(tag => {
                    tagsDiv.innerHTML += `<span class="badge bg-info me-1">${tag}</span>`;
                });

                // Update checkbox state in case something went wrong
                this.checked = (data.status === 'attached');
            })
            .catch(err => console.error('Fetch error:', err));
        });
    });
});

</script>
@endsection
