@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col shadow p-4 d-inline">
                <form action="/project" method="post">
                    @csrf
                    @method('post')

                    @include('project._form',[
                                'project' => new \App\Models\Project(),
                                'header'=>'Create Something New',
                                'btn_text'=>'Create New Project'

                                ])

                </form>
            </div>
        </div>
    </div>

    {{--    <div class="container ">
            <div class="row">
                <div class="col shadow p-4 d-inline">
                    <form action="/project" method="post">
                        @csrf
                        @method('post')
                        <div class="form-group  ">
                            <h4>Create New Project</h4>

                            <input type="text" name="title" placeholder="enter title" class="form-control">

                            <lable class=" alert-danger form-control mt-3 d-block">error show</lable>
                            <hr>
                            <textarea name="description" cols="30" rows="10" class="form-control"></textarea>

                            <span class=" alert-danger form-control mt-3 d-block">error show</span>

                            <hr>
                            <div class="d-flex justify-content-center ">
                                <a href="/project" class="btn btn-danger shadow ">Cancle</a>
                                <div class="col-1"></div>
                                <button type="submit" class="btn btn-primary shadow ">Create New</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div--}}>
@endsection
