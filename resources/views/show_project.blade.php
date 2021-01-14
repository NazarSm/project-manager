@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"
                         style="display: flex;"
                    >
                        <h3 class="balance">{{ $project->title }}</h3>
                        <a href="{{ route('projects.edit', $project->id) }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="card-group">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('tasks.new_tasks') }}</h5>
                                    <hr>
                                    @if(sizeof($newTasks))
                                        <div class="card">
                                            @foreach($newTasks as $newTask)
                                                <div class="card-header">
                                                    <p class="card-text">
                                                        <a href="{{ route('tasks.show', $newTask->id) }}">{{ $newTask->title }}</a>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="card-text"><b>{{ __('tasks.no_new_tasks') }}</b></p>
                                    @endif
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('tasks.in_progress') }}</h5>
                                    <hr>
                                    @if(sizeof($inProgressTasks))
                                        <div class="card">
                                            @foreach($inProgressTasks as $inProgressTask)
                                                <div class="card-header">
                                                    <p class="card-text">
                                                        <a href="{{ route('tasks.show', $inProgressTask->id) }}">{{ $inProgressTask->title }}</a>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="card-text"><b>{{ __('tasks.no_tasks_in_progress') }}</b></p>
                                    @endif
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('tasks.done') }}</h5>
                                    <hr>
                                    @if(sizeof($doneTasks))
                                        <div class="card">
                                            @foreach($doneTasks as $doneTask)
                                                <div class="card-header">
                                                    <p class="card-text">
                                                        <a href="{{ route('tasks.show', $doneTask->id) }}">{{ $doneTask->title }}</a>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="card-text"><b>{{ __('tasks.no_done_tasks') }}</b></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}">{{ __('tasks.add') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
