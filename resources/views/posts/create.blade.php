@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'ProjectsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('project_title', 'Project Title')}}
            {{Form::text('project_title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('project_description', 'Project Description')}}
            {{Form::textarea('project_description', '', ['id' => 'editor', 'class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
        <div class="form-group">
            {{Form::file('project_image')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection