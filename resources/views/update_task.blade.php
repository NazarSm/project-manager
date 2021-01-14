@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="balance">{{ isset($editTask) ? __('tasks.edit_task') : __('tasks.new_task') }}</h3>
                    </div>
                    <div class="card-body">
                        @if(isset($editTask))
                            <form method="POST" action="{{ route('tasks.update', $editTask->id) }}"
                                  enctype="multipart/form-data">
                                {{ method_field('PATCH') }}

                                @else
                                    <form method="POST" action="{{ route('tasks.store') }}"
                                          enctype="multipart/form-data">
                                        @endif
                                        {{ csrf_field() }}

                                        <input type="text"
                                               name="projectId"
                                               value="{{$projectId}}"
                                               hidden>

                                        <div class="mt-4">
                                            <label for="title">{{ __('tasks.name') }}</label>
                                            <input name="title"
                                                   type="text"
                                                   value="{{ isset($editTask) ? $editTask->title : '' }}"
                                            >
                                        </div>

                                        <div class="mt-4">
                                            <label for="description">{{ __('tasks.description') }}</label>
                                            <textarea name="description"
                                                      cols="45"
                                                      rows="4"
                                            >{{ isset($editTask) ? $editTask->description : '' }}</textarea>
                                        </div>


                                        <div class="mt-4">
                                            @if(!empty($editTask->files))
                                                @foreach($editTask->files as $file)
                                                    <p>
                                                        <a href="{{ route('download.file', $file->id)}}" ><b>{{ $file->original_name }}</b></a>
                                                        <a href="{{ route('delete.file', $file->id) }}"><i class="bi bi-trash"></i></a>
                                                    </p>
                                                @endforeach
                                            @endif

                                            <label for="file">{{ __('tasks.please_add_file') }}</label>
                                            <p><input type="file"
                                                      id="file"
                                                      name="file"
                                                />
                                        </div>

                                        <button type="submit"
                                                class="btn btn-outline-success"
                                        >
                                            {{isset($editTask) ? __('tasks.update') : __('tasks.create') }}
                                        </button>
                                    </form>

                                    @if(isset($editTask))
                                        <form action="{{route('tasks.destroy', $editTask->id)}}"
                                              method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}

                                            <button type="submit"
                                                    class="btn btn-outline-danger"
                                            >
                                                {{ __('tasks.delete') }}
                                            </button>
                                        </form>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>
@endsection
