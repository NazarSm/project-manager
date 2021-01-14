@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="balance">{{ __('projects.my_projects') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-group">
                            @if($projects)
                                @foreach($projects as $project)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>{{ __('projects.you_have_no_projects') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('projects.create') }}" class="btn btn-outline-success">{{ __('projects.create_project') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
