@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tags</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Create Tag</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Color</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <span class="badge" style="background-color: {{ $tag->color ?? '#6c757d' }}">
                            {{ $tag->color ?? 'N/A' }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
