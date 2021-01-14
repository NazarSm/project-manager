@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="balance">{{ isset($editProject) ? __('projects.edit_project') : __('projects.new_project') }}</h3>
                    </div>
                    <div class="card-body">
                        @if(isset($editProject))
                            <form method="POST" action="{{ route('projects.update', $editProject->id) }}">
                                {{ method_field('PATCH') }}
                                @else
                                    <form method="POST" action="{{ route('projects.store') }}">
                                        @endif
                                        {{ csrf_field() }}

                                        <label for="title">{{ __('projects.name') }}</label>
                                        <input name="title"
                                               type="text"
                                               value="{{ isset($editProject) ? $editProject->title : '' }}"
                                        >

                                        <button type="submit"
                                                class="btn btn-outline-success"
                                        >
                                            {{isset($editProject) ? __('projects.update') : __('projects.create')  }}
                                        </button>
                                    </form>
                                        @if(isset($editProject))
                                            <form action="{{route('projects.destroy', $editProject->id)}}"
                                                  method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit"
                                                        class="btn btn-outline-danger"
                                                >
                                                    {{ __('projects.delete') }}
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
