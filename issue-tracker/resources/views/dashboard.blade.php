@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        <!-- Projects Card -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Projects</h5>
                    <p class="card-text">Manage and view all projects.</p>
                    <a href="{{ route('projects.index') }}" class="btn btn-primary">Go to Projects</a>
                </div>
            </div>
        </div>

        <!-- Issues Card -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Issues</h5>
                    <p class="card-text">Track and resolve issues.</p>
                    <a href="{{ route('issues.index') }}" class="btn btn-warning">Go to Issues</a>
                </div>
            </div>
        </div>

        <!-- Tags Card -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Tags</h5>
                    <p class="card-text">Organize and manage tags.</p>
                    <a href="{{ route('tags.index') }}" class="btn btn-info">Go to Tags</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
