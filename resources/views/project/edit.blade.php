@extends('layouts.app')

@section('content')

    <div class="container ">
        <div class="row">
            <div class="col-8 shadow p-4 mx-auto">
                <form action="{{$project->path()}}" method="post">

                    @csrf
                    @method('patch')
                    @include('project._form')

                </form>
            </div>
        </div>
    </div>


@endsection
