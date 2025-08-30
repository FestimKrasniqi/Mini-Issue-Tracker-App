@extends('layouts.app')

@section('content')
<h1>Projects</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Start Date</th>
            <th>Deadline</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td><a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></td>
            <td>{{ $project->description }}</td>
            <td>{{ $project->start_date }}</td>
            <td>{{ $project->deadline }}</td>
            <td>
                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info btn-sm">View</a>
                <a class="btn btn-sm btn-warning" href="{{ route('projects.edit', $project) }}">Edit</a>

                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
