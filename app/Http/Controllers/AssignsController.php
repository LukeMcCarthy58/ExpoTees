<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supervisor_Student_Link;
use App\User;

class AssignsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $supervisors = User::where('role', 'Supervisor')->get();
        $students = User::where('role', 'Student')->get();
        $existingLinks = Supervisor_Student_Link::leftJoin('users as supervisors', 'supervisor_student_link.supervisor_id', '=', 'supervisors.id')
        ->leftJoin('users as students', 'supervisor_student_link.student_id', '=', 'students.id')
        ->select('supervisors.first_name as supervisor_fname','supervisors.last_name as supervisor_lname','students.first_name as student_fname','students.last_name as student_lname','supervisor_student_link.id as linkid')
        ->orderBy('supervisors.first_name','asc')
        ->orderBy('supervisors.last_name','asc')->paginate(5);
        return view('pages.assign')->with('supervisors', $supervisors)->with('students', $students)->with('existinglinks', $existingLinks);
    }

    public function store(Request $request)
    {
        $link = new Supervisor_Student_Link;
        $link->supervisor_id = $request->supervisors;
        $link->student_id = $request->students;
        $link->save();

        return redirect('/assign')->with('success', 'Student assigned to supervisor');
    }

    public function destroy($id)
    {
        $link = Supervisor_Student_Link::find($id);

        //Check for correct user
        if(auth()->user()->role !=="Admin" && auth()->user()->role !=="Superadmin") {
            return redirect('/')->with('error', 'Unauthorised Page');
        }

        $link->delete();
        return redirect('/assign')->with('success', 'Link Removed');
    }
}
