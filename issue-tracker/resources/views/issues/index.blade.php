@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Issues</h1>

    {{-- Search Input --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="search-input" class="form-control" placeholder="Search issues...">
        </div>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('issues.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">-- Filter by Status --</option>
                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="priority" class="form-control">
                    <option value="">-- Filter by Priority --</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="tag_id" class="form-control">
                    <option value="">-- Filter by Tag --</option>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}" {{ request('tag_id') == $tag->id ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </div>
        </div>
    </form>

    <a href="{{ route('issues.create') }}" class="btn btn-success mb-3">+ New Issue</a>

    {{-- Issues Table --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Project</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="issues-table-body">
            @forelse($issues as $issue)
                <tr>
                    <td>{{ $issue->title }}</td>
                    <td>{{ ucfirst($issue->status) }}</td>
                    <td>{{ ucfirst($issue->priority) }}</td>
                    <td>{{ $issue->project->name ?? 'N/A' }}</td>
                    <td>
                        @foreach($issue->tags as $tag)
                            <span class="badge bg-info">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('issues.show', $issue->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('issues.destroy', $issue->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this issue?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No issues found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $issues->links() }}
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const issuesTableBody = document.getElementById('issues-table-body');
    let timeout = null;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            const query = searchInput.value.trim();

            fetch("/issues/search?query=" + encodeURIComponent(query))
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    issuesTableBody.innerHTML = '';

                    if (data.length === 0) {
                        issuesTableBody.innerHTML = `<tr><td colspan="6">No issues found.</td></tr>`;
                        return;
                    }

                    data.forEach(issue => {
                        let tagsHtml = '';
                        issue.tags.forEach(tag => {
                            tagsHtml += `<span class="badge bg-info">${tag.name}</span> `;
                        });

                        issuesTableBody.innerHTML += `
                            <tr>
                                <td>${issue.title}</td>
                                <td>${issue.status.charAt(0).toUpperCase() + issue.status.slice(1)}</td>
                                <td>${issue.priority.charAt(0).toUpperCase() + issue.priority.slice(1)}</td>
                                <td>${issue.project ? issue.project.name : 'N/A'}</td>
                                <td>${tagsHtml}</td>
                                <td>
                                    <a href="/issues/${issue.id}" class="btn btn-info btn-sm">View</a>
                                    <a href="/issues/${issue.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="/issues/${issue.id}" method="POST" style="display:inline;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>`;
                    });
                })
                .catch(err => console.error(err));
        }, 300); // 300ms debounce
    });
});
</script>
@endsection
