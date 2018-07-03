<?php

namespace App\Http\Controllers;

use App\SubSubject;
use App\Subject;
use Lang;
use Illuminate\Http\Request;

class SubSubjectController extends Controller
{
    public function index()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/sub-subject';

        $subjects = SubSubject::with('subject')->get();

        return view($guard['path'].'sub-subject.index', compact('subjects', 'path'));
    }

    public function create()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/sub-subject';
        $subjects = Subject::all();

        return view($guard['path'].'sub-subject.create', compact('subjects', 'path'));
    }

    public function store(Request $request)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];
        if($user->active == 1){
            if($user->count_teachers >= 1){
                return redirect()->back()->with('message', Lang::get('error.more_teacher'))->with('m-class', 'danger');
            }
        }
        $path = '/'.$guard['role'].'/sub-subject';
        $this->validate($request,[
            'ar_name'=> 'required',
            'en_name'=>'required',
            'ar_description'=>'required',
            'en_description'=>'required',
            'subject_id' => 'required|exists:subjects,id',
        ],[
            'ar_name.required'=> Lang::get('error.ar_name'),
            'en_name.required'=> Lang::get('error.en_name'),
            'ar_description.required'=> Lang::get('error.ar_description'),
            'en_description.required'=> Lang::get('error.en_description'),
            'subject_id.required'=> Lang::get('error.subject_id'),
            'subject_id.exists'=> Lang::get('error.exists-subject_id'),
        ]);
        $data = $request->all();
        $sub_subject = SubSubject::create($data);
        return redirect()->back()->with('message', Lang::get('error.create-data'))->with('m-class', 'primary');
    
    }

    public function show($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $subject = SubSubject::find($id);
        if(!$subject){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        $subjects = Subject::all();
        return view($guard['path'].'sub-subject.show',compact('path','subject','subjects'));

    }

    public function update(Request $request, $id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $subject = SubSubject::find($id);
        if(!$subject){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        $this->validate($request,[
            'ar_name'=> 'required',
            'en_name'=>'required',
            'ar_description'=>'required',
            'en_description'=>'required',
            'subject_id' => 'required|exists:subjects,id',
        ],[
            'ar_name.required'=> Lang::get('error.ar_name'),
            'en_name.required'=> Lang::get('error.en_name'),
            'ar_description.required'=> Lang::get('error.ar_description'),
            'en_description.required'=> Lang::get('error.en_description'),
            'subject_id.required'=> Lang::get('error.subject_id'),
            'subject_id.exists'=> Lang::get('error.exists-subject_id'),
        ]);
        $data = $request->all();

        $subject->update($data);
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
    }

    public function destroy($id)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];

        $subject = SubSubject::find($id);

        if(!$subject){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        
        $subject->delete();
        
        return redirect()->back()->with('message', Lang::get('error.delete-data'))->with('m-class', 'primary');
    }
}
