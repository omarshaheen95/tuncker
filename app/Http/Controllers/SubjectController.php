<?php

namespace App\Http\Controllers;

use App\Subject;
use Lang;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
   
    public function index()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/subject';

        $subjects = Subject::all();

        return view($guard['path'].'subject.index', compact('subjects', 'path'));
    }

    public function create()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/subject';

        return view($guard['path'].'subject.create', compact('path'));
    }

    public function store(Request $request)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];
        $path = '/'.$guard['role'].'/subject';
        $this->validate($request,[
            'ar_name'=> 'required',
            'en_name'=>'required',
            'ar_description'=>'required',
            'en_description'=>'required',
        ],[
            'ar_name.required'=> Lang::get('error.ar_name'),
            'en_name.required'=> Lang::get('error.en_name'),
            'ar_description.required'=> Lang::get('error.ar_description'),
            'en_description.required'=> Lang::get('error.en_description'),
        ]);
        $data = $request->all();
        $subject = Subject::create($data);
        return redirect()->back()->with('message', Lang::get('error.create-data'))->with('m-class', 'primary');
    
    }

    public function show($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $subject = Subject::find($id);
        if(!$subject){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        return view($guard['path'].'subject.show',compact('path','subject'));

    }

    public function update(Request $request, $id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $subject = Subject::find($id);
        if(!$subject){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        $this->validate($request,[
            'ar_name'=> 'required',
            'en_name'=>'required',
            'ar_description'=>'required',
            'en_description'=>'required',
        ],[
            'ar_name.required'=> Lang::get('error.ar_name'),
            'en_name.required'=> Lang::get('error.en_name'),
            'ar_description.required'=> Lang::get('error.ar_description'),
            'en_description.required'=> Lang::get('error.en_description'),
        ]);
        $data = $request->all();

        $subject->update($data);
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
    }

    public function destroy($id)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];

        $subject = Subject::find($id);

        if(!$subject){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        
        $subject->delete();
        
        return redirect()->back()->with('message', Lang::get('error.delete-data'))->with('m-class', 'primary');
    }
}
