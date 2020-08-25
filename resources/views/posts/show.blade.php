@extends('layouts.app')

@section('content')
    @if(!Auth::guest())
        @if(Auth::user()->role == "Supervisor")
            <a href="/supervisorprojects" class="btn btn-info">Go Back</a><br><br>
        @elseif(Auth::user()->role == "Admin" || Auth::user()->role == "Superadmin")
            <a href="/adminprojects" class="btn btn-info">Go Back</a><br><br>
        @else
            <a href="/posts" class="btn btn-info">Go Back</a><br><br>
        @endif
    @else
        <a href="/posts" class="btn btn-info">Go Back</a><br><br>
    @endif
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
    <img style="width: 100%;" src="{{$project->project_image_url}}" alt="Uploaded image">
    <br>
    <br>
    <br>
    <div>
        {!!$project->project_description!!}
    </div>
    <hr>
    <small>Written on {{$project->project_created_at}}</small>
@endsection