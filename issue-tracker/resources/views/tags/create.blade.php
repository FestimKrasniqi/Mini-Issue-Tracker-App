@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Tag</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tag Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="color" class="form-label">Tag Color (Hex)</label>
            <input type="text" name="color" id="color" class="form-control" placeholder="#ff0000">
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
