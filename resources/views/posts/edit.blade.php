@extends('layouts.app')

@section('content')
    <h1>Edit Project</h1>
    {!! Form::open(['action' => ['ProjectsController@update', $project->project_id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('project_title', 'Project Title')}}
            {{Form::text('project_title', $project->project_title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('project_description', 'Project Description')}}
            {{Form::textarea('project_description', $project->project_description, ['id' => 'editor', 'class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
        <div class="form-group">
            {{Form::file('project_image')}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection