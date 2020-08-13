@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
    <h1>Expo Tees 2019</h1>
    <a href="https://www.tees.ac.uk/expotees/" target="_blank"><img class="mx-auto d-block" style="width: 150px; height:150px;" src="/storage/cover_images/expotees.png" alt="Logo"></a>
    <p>Welcome to the Expo Tees 2019 content management system.</p>
    @guest
    <p><a href="/login" class="btn btn-primary btn-lg" role="button">Login</a>&nbsp;<a href="/register" class="btn btn-success btn-lg" role="button">Register</a></p>
    @endguest
@endsection

