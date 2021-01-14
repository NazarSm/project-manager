@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"
                         style=" display: flex;"
                    >
                        <h3>{{ $task->title }}</h3>

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" style="margin-left: 75px"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('tasks.change_status') }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                               {{-- @foreach($statuses as $status)
                                    <a class="dropdown-item"
                                       href="{{ route('change.status', ['id' => $task->id, 'status' => $status ]) }}"
                                    >
                                        {{array_key_first($status)}}
                                    </a>
                                @endforeach--}}
                                <a class="dropdown-item"
                                   href="{{ route('change.status', ['id' => $task->id, 'status' => $statuses['new'] ]) }}"
                                >
                                    {{ __('tasks.new_task') }}
                                </a>
                                <a class="dropdown-item"
                                   href="{{ route('change.status', ['id' => $task->id, 'status' => $statuses['in_progress']] ) }}"
                                >
                                    {{ __('tasks.in_progress') }}
                                </a>
                                <a class="dropdown-item"
                                   href="{{ route('change.status', ['id' => $task->id, 'status' => $statuses['done']] ) }}"
                                >
                                    {{ __('tasks.done') }}
                                </a>

                                <form id="logout-form" action="{{ route('change.status') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                    </div>
                    <div class="card-body">
                        <p>{{$task->description}}</p>
                        <hr>
                        @if(!empty($task->files))
                            @foreach($task->files as $file)
                            <p>Click
                                <a href="{{ route('download.file', $file->id)}}" ><b>{{ $file->original_name }}</b></a>
                                for download
                            </p>
                            @endforeach
                        @endif
                    </div>

                        <div class="card-footer">
                            <a href="{{ route('tasks.edit', $task->id) }}">
                            Edit
                            </a>
                        </div>

                </div>

            </div>
        </div>
    </div>
@endsection
