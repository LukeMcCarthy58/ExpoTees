@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <img class="mx-auto d-block" style="width: 150px; height:150px;" src="https://expotees-images.s3.eu-west-2.amazonaws.com/images/expotees.png" alt="Logo">
            </div>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::user()->role == "Student")
                        <a href="/posts/create" class="btn btn-primary">New Project</a>
                        <br><br>
                        @if(count($projects) > 0)
                        <h3>Your Projects</h3>
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{$project->project_title}}</td>
                                    <td>
                                        @if($project->project_approved_at > 0)
                                            Approved for Expo Tees!
                                        @elseif($project->project_completed_at > 0)
                                            Awaiting Expo Tees Decision
                                        @else
                                            Not yet accepted
                                        @endif
                                    </td>
                                    <td><a href="/posts/{{$project->project_id}}/edit" class="btn btn-success">Edit</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['ProjectsController@destroy', $project->project_id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <p>You have no posts</p>
                        @endif
                    @else
                        @if(Auth::user()->role == "Supervisor")
                            <p>Please navigate to Projects to view and accept student projects which are under your supervision.</p>
                        @else
                            <p>Please navigate to Projects to view and approve student projects for the Expo.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
