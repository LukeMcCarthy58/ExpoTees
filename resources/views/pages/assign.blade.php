@extends('layouts.app')

@section('content')
    <h1>Assign Students to Supervisors</h1>
    {!! Form::open(['action' => 'AssignsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group row">
            <label for="supervisors" class="col-md-4 col-form-label">Supervisors:</label>
            <div class="col-md-8">
                <select class="form-control" id="supervisors" name="supervisors">
                    @foreach($supervisors as $supervisor)
                        <option value="{{$supervisor->id}}">{{$supervisor->first_name}} {{$supervisor->last_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="students" class="col-md-4 col-form-label ">Students:</label>
            <div class="col-md-8">
                <select class="form-control" id="students" name="students">
                    @foreach($students as $student)
                        <option value="{{$student->id}}">{{$student->first_name}} {{$student->last_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-2">
                <button type="submit" class="btn btn-success">
                    {{ __('Assign') }}
                </button>
            </div>
        </div>
    {!! Form::close() !!}
    <br>
    <h1>Supervisor Student Links</h1>
    <table class="table table-striped">
        <tr>
            <th>Supervisor</th>
            <th>Student</th>
            <th></th>
        </tr>
        @if(count($existinglinks) > 0)
            @foreach($existinglinks as $existinglink)
                <tr>
                    <td>{{$existinglink->supervisor_fname}} {{$existinglink->supervisor_lname}}</td>
                    <td>{{$existinglink->student_fname}} {{$existinglink->student_lname}}</td>
                    <td>
                        {!!Form::open(['action' => ['AssignsController@destroy', $existinglink->linkid], 'method' => 'POST', 'class' => 'float-right'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">No links currently exist</td>
            </tr>
        @endif
    </table>
@endsection