<div class="form-group  ">
    <h4>{{$header ?? 'Edit Your Project'}}</h4>

    <input type="text" name="title"
           value="{{$project->title}}"
           placeholder="enter title" class="form-control"/>

    @error('title')
    <lable class=" alert-danger form-control mt-3 d-block">
        {{$message}}
    </lable>
    @enderror
    <hr>
    <textarea name="description" cols="30" rows="10" class="form-control">{{$project->description}}</textarea>

    @error('description')
    <lable class=" alert-danger form-control mt-3 d-block">
        {{$message}}
    </lable>
    @enderror


    <hr>
    <div class="d-flex justify-content-center ">
        <a href="{{$project->path()}}" class="btn btn-danger shadow ">Cancle</a>
        <div class="col-1"></div>
        <button type="submit" class="btn btn-primary shadow ">{{$btn_text ?? __('Update Project')}}</button>

    </div>
</div>
