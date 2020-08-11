<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Project_Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::select('*')
        ->join('project_images', 'projects.project_image', '=', 'project_images.project_image_id')
        ->join('users', 'projects.project_user', '=', 'users.id')
        ->orderBy('project_created_at','desc')->paginate(10);
        //return $projects;
        return view('posts.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'project_title' => 'required',
            'project_description' => 'required',
            'project_image' => 'required'
        ]);
        //Handle file upload
        if($request->hasFile('project_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('project_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('project_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('project_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $current_timestamp = Carbon::now()->toDateTimeString();
        //Create Post
        $project_image = new Project_Image;
        $project_image->project_image_path = $fileNameToStore;
        $project_image->save();
        $project_image_id = $project_image->id;

        $project = new Project;
        $project->project_title = $request->input('project_title');
        $project->project_description = $request->input('project_description');
        $project->project_user = auth()->user()->id;
        $project->project_image = $project_image_id;
        $project->project_created_at = $current_timestamp;
        $project->save();


        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        //Check for correct user
        if(auth()->user()->id !==$project->project_user) {
            return redirect('/posts')->with('error', 'Unauthorised Page');
        }

        if($project->project_image != 'noimage.jpg') {
            //Delete image
            Storage::delete('public/cover_images/'.$project->project_image);
        }

        $project->delete();
        return redirect('/posts')->with('success', 'Project Removed');
    }
}
