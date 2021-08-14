@extends('layouts.app')

@section('content')
    <div class="container ">
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
                        <button type="submit" class="btn btn-primary shadow mx-auto d-flex ">Create New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
