<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\Teacher;
use Lang;

class SchoolController extends Controller
{
    public function index()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/school';
        if($guard['role'] == 'admin'){
            $schools = School::all();
            return view($guard['path'].'school.index',compact('path','schools'));
        }
    }

    public function show($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $school = School::find($id);

        if(!$school){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        return view($guard['path'].'school.show',compact('path','school'));
    }


    public function deleteSchool($id)
    {
        $school = School::find($id);

        if(!$school){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        if($school->image != 'default.png'){
            if(file_exists(base_path().'/public/cp/images/profile/'.$school->image)){
                unlink(base_path().'/public/cp/images/profile/'.$school->image);
            }
        }
        $school->delete();
        return redirect()->back()->with('message', Lang::get('error.delete-data'))->with('m-class', 'primary');
        
    }

    public function getTeachers($id)
    {
        $teachers = Teacher::where('school_id', $id)->get();
        return response()->json(['success'=>true,'teachers'=>$teachers]);
    }

}
