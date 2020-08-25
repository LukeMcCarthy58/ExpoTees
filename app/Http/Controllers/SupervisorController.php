<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Project;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $projects = Project::select('*')
        ->join('project_images', 'projects.project_image_id', '=', 'project_images.project_image_id')
        ->join('users', 'projects.project_user', '=', 'users.id')
        ->join('supervisor_student_link', 'users.id', '=', 'supervisor_student_link.student_id')
        ->orderBy('project_created_at','desc')->paginate(10);
        //return $projects;
        return view('pages.supervisorprojects')->with('projects', $projects);
    }
    public function update(Request $request, $id)
    {
        //Create Post
        $project = Project::find($id);
        $project->project_completed_at = Carbon::now()->toDateTimeString();
        $project->save();

        return redirect('/supervisorprojects')->with('success', 'Post Approved');
    }
}
