@extends('layouts.app')

@section('content')
<h1>{{ $project->name }}</h1>
<p>{{ $project->description }}</p>
<p><strong>Start Date:</strong> {{ $project->start_date }}</p>
<p><strong>Deadline:</strong> {{ $project->deadline }}</p>

<h3>Issues</h3>
@if($project->issues->count())
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Due Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($project->issues as $issue)
        <tr>
            <td>{{ $issue->title }}</td>
            <td>{{ ucfirst($issue->status) }}</td>
            <td>{{ ucfirst($issue->priority) }}</td>
            <td>{{ $issue->due_date }}</td>
        </tr>
        @endforeach
    </tbody>

</table>


@else
<p>No issues found for this project.</p>
@endif
<a href = "{{ route('projects.index')}}" class="btn btn-secondary mt-3">Back to List</a>
@endsection
