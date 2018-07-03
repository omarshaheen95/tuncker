<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use Lang;

class TeacherController extends Controller
{
    public function index()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/teacher';
        if($guard['role'] == 'admin'){
            $teachers = Teacher::all();

            return view($guard['path'].'teacher.index', compact('teachers','path'));
        }elseif($guard['role'] == 'school'){
            $teachers = Teacher::where('school_id', $guard['id'])->get();

            return view($guard['path'].'teacher.index', compact('teachers','path'));
        }else{
            return view($guard['path']);
        }
    }

    public function show($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $teacher = Teacher::find($id);

        if(!$teacher){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        return view($guard['path'].'teacher.show',compact('path','teacher'));
    }

    public function create()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/teacher';
        return view($guard['path'].'teacher.create', compact('path'));
    }

    public function store(Request $request)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];
        $path = '/'.$guard['role'].'/teacher';
        $this->validate($request,[
            'ar_name'=> 'required',
            'en_name'=>'required',
            'email' => 'required|max:255|email|unique:teachers',
            'phone' => 'required',
            'ar_address'=>'required',
            'en_address'=>'required',
            'image' => 'required|image',
            'ar_description'=>'required',
            'en_description'=>'required',
        ],[
            'ar_name.required'=> Lang::get('error.ar_name'),
            'en_name.required'=> Lang::get('error.en_name'),
            'email.required'=> Lang::get('error.email'),
            'email.unique'=> Lang::get('error.unique-email'),
            'ar_address.required'=> Lang::get('error.ar_address'),
            'en_address.required'=> Lang::get('error.en_address'),
            'phone.required'=> Lang::get('error.phone'),
            'r_image.required'=> Lang::get('error.r_image'),
            'ar_description.required'=> Lang::get('error.ar_description'),
            'en_description.required'=> Lang::get('error.en_description'),
        ]);
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $new_name = $this->uploadImage($file,'cp/images/profile');
            $data['image'] = $new_name;
        }else{
            return redirect()->back()->with('message', Lang::get('error.image').'tt')->with('m-class', 'danger');
        }

        $data['school_id'] = $user->id;
        $data['password'] = bcrypt('123456');
        $teacher = Teacher::create($data);
        return redirect()->back()->with('message', Lang::get('error.create-data'))->with('m-class', 'primary');
    }

    public function deleteTeacher($id)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];

        $teacher = Teacher::find($id);

        if(!$teacher){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        
        if($guard['role'] == 'admin'){
            if($teacher->image != 'default.png'){
                if(file_exists(base_path().'/public/cp/images/profile/'.$teacher->image)){
                    unlink(base_path().'/public/cp/images/profile/'.$teacher->image);
                }
            }
            $teacher->delete();
        }elseif($guard['role'] == 'school'){
            if($user->id == $teacher->school_id){
                if($teacher->image != 'default.png'){
                    if(file_exists(base_path().'/public/cp/images/profile/'.$teacher->image)){
                        unlink(base_path().'/public/cp/images/profile/'.$teacher->image);
                    }
                }
                $teacher->delete();
            }
        }
        
        return redirect()->back()->with('message', Lang::get('error.delete-data'))->with('m-class', 'primary');
        
    }

    public function disabledTeacher($id)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];

        $teacher = Teacher::find($id);
        if($teacher->active == 1){
            $active = 0;
        }else{
            $active = 1;
        }
        if(!$teacher){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        
        if($guard['role'] == 'admin'){
            
            $teacher->update([
                'active' => $active,
            ]);
        }elseif($guard['role'] == 'school'){
            if($user->id == $teacher->school_id){
                
                $teacher->update([
                    'active' => $active,
                ]);
            }
        }
        
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
    }

    public function schoolTeachers($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/teacher';
        if($guard['role'] == 'admin'){
            $teachers = Teacher::where('school_id', $id)->get();
            return view($guard['path'].'teacher.index', compact('teachers','path'));
        }
    }
}
