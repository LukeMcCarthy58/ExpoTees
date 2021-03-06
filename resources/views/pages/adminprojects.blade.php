@extends('layouts.app')

@section('content')
    <h1>Projects</h1>
    @if(count($projects) > 0)
    @foreach($projects as $project)
    <div class="card p-3">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <img style="width: 100%;" src="{{$project->project_image_url}}" alt="Uploaded image">
            </div>
            <div class="col-md-8 col-sm-4">
                <h3><a href="/posts/{{$project->project_id}}">{{$project->project_title}}</a></h3>
                <small>Written on {{$project->project_created_at}} by {{$project->first_name}} {{$project->last_name}}</small>
                @if(!Auth::guest())
                    @if($project->project_completed_at > 0 && $project->project_approved_at > 0)
                        <br><br><h4>Approved for Expo Tees!</h4>
                    @elseif($project->project_completed_at > 0)
                        {!!Form::open(['action' => ['AdminController@update', $project->project_id], 'method' => 'POST', 'class' => 'float-right'])!!}
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Approve for Expo', ['class' => 'btn btn-success'])}}
                        {!!Form::close()!!}
                    @endif
                @endif
            </div>
        </div>
    </div>
    @endforeach
        {{$projects->links()}}
    @else
        <p>No projects found</p>
    @endif
@endsection