@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-info">Go Back</a><br><br>
    <h1>{{$project->project_title}}</h1>
    @if(!Auth::guest())
        @if(Auth::user()->id == $project->project_user)
        <a href="/posts/{{$project->project_id}}/edit" class="btn btn-success">Edit</a>

        {!!Form::open(['action' => ['ProjectsController@destroy', $project->project_id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
        <br><br>
        @endif
    @endif
    <img style="width: 100%;" src="/storage/cover_images/{{$project->project_image_path}}" alt="Uploaded image">
    <br>
    <br>
    <br>
    <div>
        {!!$project->project_description!!}
    </div>
    <hr>
    <small>Written on {{$project->project_created_at}}</small>
@endsection