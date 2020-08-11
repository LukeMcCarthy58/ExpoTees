@extends('layouts.app')

@section('content')
    <h1>Projects</h1>
    @if(count($projects) > 0)
    @foreach($projects as $project)
    <div class="card p-3">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <img style="width: 100%;" src="/storage/cover_images/{{$project->project_image_path}}" alt="Uploaded image">
            </div>
            <div class="col-md-8 col-sm-4">
                <h3><a href="/posts/{{$project->project_id}}">{{$project->project_title}}</a></h3>
                @guest

                @else
                    @if(Auth::user()->id == $project->project_user)
                    <h4>
                        You can edit this, it's your project!
                    </h4>
                    @endif
                @endguest
                <small>Written on {{$project->project_created_at}} by {{$project->first_name}} {{$project->last_name}}</small>
            </div>
        </div>
    </div>
    @endforeach
        {{$projects->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection