@extends('layouts.app')
@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-8 mx-auto ">
                <section class="d-flex mr-5 justify-content-between align-items-center">
                    <div class=" align-items-center">
                        <span class="text-muted"><b>My project</b></span>
                    </div>
                    <a href="/project/create"
                       class="btn btn-primary ">
                        Create new</a>
                </section>
            </div>
        </div>


        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">

            @forelse($projects as $project)
                <div class="col">
                    <div class="card shadow h-100 ">

                        <div class="card-body">
                            <a href="/project/{{$project->id}}">
                                <h5 class='card-title' style="padding-left: 14px; border-left: 4px solid #ffa900">  {{$project->title}} </h5>
                            </a>
                            <p class="card-text pt-3">
                                {{\Illuminate\Support\Str::limit($project->description ,100,' ...')}}
                            </p>
                        </div>

                    </div>
                </div>
            @empty
                <h3>No Project</h3>
            @endforelse
        </div>


    </div>

    </div>
@endsection
