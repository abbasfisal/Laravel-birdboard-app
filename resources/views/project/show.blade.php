@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        {{--top bar--}}
        <div class="row">
            <div class="col-8 mx-auto ">
                <section class="d-flex mr-5 justify-content-between align-items-center">
                    <div class=" align-items-center">
                        <span class="text-muted"><b>
                                <a href="/project"> My project /</a>
                                {{$project->title}}</b></span>
                    </div>
                    <a href="{{$project->path().'/edit'}}"
                       class="btn btn-primary ">
                        Edit Project</a>
                </section>
            </div>
        </div>
        {{--end top bar--}}

        <div class="row mt-5">
            {{--left side bar--}}
            <div class="col-md-9 shadow p-4 d-inline">

                {{--tasks--}}
                <div class="gap-2 d-grid ">
                    <b>tasks</b>

                    {{-- create new Task--}}
                    <div class="card shadow-1-secondary p-3">
                        <form action="{{$project->path().'/tasks'}}" method="Post">
                            @csrf
                            @method('POST')
                            <input type="text" name="body" class="form-control" placeholder="Enter New Task"/>
                        </form>
                    </div>
                    {{-- /create new Task--}}

                    @forelse($project->tasks as $task)
                        <div class="card shadow-1-secondary p-3 border ripple hover-shadow">

                            <form action="{{$project->path().'/tasks/'.$task->id}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="d-flex justify-content-between align-items-center">
                                    <input type="text" name="body"
                                           class="border-0 w-75 {{$task->completed ? 'text-muted' : null}}"
                                           value="{{$task->body}}"/>

                                    <input type="checkbox"
                                           name="completed"
                                           onchange="this.form.submit()"
                                           {{$task->completed ? 'checked' : null}}
                                           class="form-check-input "
                                    >
                                </div>
                            </form>
                        </div>
                    @empty
                        <h3>No Tasks Yet</h3>
                    @endforelse
                </div>
                {{--end tasks--}}

                {{-- general notes--}}
                <div class="mt-5">
                    <form action="{{$project->path()}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <h5 class="text-muted">General Notes</h5>
                        <textarea name="notes" class="card w-100"
                                  style="min-height: 200px">{{$project->notes}} </textarea>
                        <button type="submit" class="btn btn-primary w-100 mt-2">Save Notes</button>
                    </form>

                </div>
                {{-- /genral notes--}}
            </div>
            {{-- end left side--}}

            {{--righ side--}}
            <div class="col-md-3 ">
                <div class="col">

                    <div class="card shadow h-100 ">
                        <div class="card-body">
                            <h5 class='card-title'
                                style="padding-left: 14px; border-left: 4px solid #ffa900">  {{$project->title}} </h5>
                            <p class="card-text pt-3 small justify">
                                {{$project->description }}
                            </p>
                            <figcaption class="blockquote-footer">
                                <b>{{$project->created_at->diffforHumans()}}</b>
                            </figcaption>
                        </div>
                    </div>

                    {{-- activity card --}}
                    @include('project.activity.card')
                    {{--/activity card--}}


                </div>
            </div>
            {{--end right side --}}
        </div>
    </div>

@endsection
