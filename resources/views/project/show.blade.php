@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        {{--top bar--}}
        <div class="row">
            <div class="col-8 mx-auto ">
                <section class="d-flex mr-5 justify-content-between align-items-center">
                    <div class=" align-items-center">
                        <span class="text-muted"><b>My project / {{$project->title}}</b></span>
                    </div>
                    <a href="/project/"
                       class="btn btn-primary ">
                        back</a>
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
                    <div class="card shadow-1-secondary p-3 border ripple hover-shadow">New Task one</div>
                    <div class="card shadow-1-secondary p-3 border">New Task one</div>
                    <div class="card shadow-1-secondary p-3 border">New Task one</div>
                    <div class="card shadow-1-secondary p-3 border">New Task one</div>
                    <div class="card shadow-1-secondary p-3 border">New Task one</div>
                </div>
                {{--end tasks--}}
                <div class="mt-5">
                    <h5 class="text-muted">General Notes</h5>
                    <textarea class="card w-100"  style="min-height: 200px"> </textarea>
                </div>
            </div>
            {{-- end left side--}}

            {{--righ side--}}
            <div class="col-md-3 border">
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
                </div>
            </div>
            {{--end right side --}}
        </div>
    </div>

@endsection
