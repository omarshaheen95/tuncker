<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Lang;
use App\School;
use App\Teacher;
use App\Student;
use Mail;
use App\Mail\ConfirmSubscription;

class SettingController extends Controller
{
    public function pricing()
    {
        $guard = $this->getGuard();
        if($guard['role'] == 'admin'){
            return view($guard['path'].'invoice.pricing');            
        }elseif($guard['role'] == 'school'){
            return view($guard['path'].'invoice.pricing');
        }elseif($guard['role'] == 'teacher'){
            return view($guard['path'].'invoice.pricing');            
        }else{
            return view($guard['path']);
        }
    }
    
    public function profile()
    {
        $guard = $this->getGuard();
        if($guard['role'] == 'admin'){
            return view($guard['path'].'profile');            
        }elseif($guard['role'] == 'school'){
            return view($guard['path'].'profile');
        }elseif($guard['role'] == 'teacher'){
            return view($guard['path'].'profile');            
        }else{
            return view($guard['path']);
        }
    }

    public function updatePassword(Request $request)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $this->validate($request,[
            'password'=>'required',
            'new-password'=>'required',
        ],[
            'password.required'=> Lang::get('error.password'),
            'new-password.required'=> Lang::get('error.new-password'),
        ]);

        if($guard['role'] == 'admin'){
            $user = $guard['user'];
        }elseif($guard['role'] == 'school'){
            $user = $guard['user'];
        }elseif($guard['role'] == 'teacher'){
            $user = $guard['user'];            
        }

        if(!empty($data['password']) && !empty($data['new-password'])){
		    if(Hash::check($data['password'], $user->password)	){
                $password = bcrypt($data['new-password']);
            }else{
                return redirect()->back()->with('message', Lang::get('error.old-password'))->with('m-class', 'danger');
            }
        }else{
            return redirect()->back()->with('message', Lang::get('error.complete-data'))->with('m-class', 'danger');
        }

        $user->update([
            'password' => $password,
        ]);
        return redirect()->back()->with('message', Lang::get('error.complete-password'))->with('m-class', 'primary');


    }

    public function updateInformation(Request $request)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        
        $user = $guard['user'];
        if($guard['role'] == 'admin'){
            $this->validate($request,[
                'name'=> 'required',
                'email'=>'required|unique:admins,email,'.$user->id,
                'IBAN'=>'required',
                'phone'=>'required',
            ],[
                'name.required'=> Lang::get('error.name'),
                'email.required'=> Lang::get('error.email'),
                'email.unique'=> Lang::get('error.unique-email'),
                'IBAN.required'=> Lang::get('error.IBAN'),
                'phone.requierd' => Lang::get('error.phone')
            ]);
            $user->update([
                'name' =>$data['name'],
                'email' =>$data['email'],
                'IBAN' =>$data['IBAN'],
                'phone' =>$data['phone'],
            ]);
            return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
            
        }elseif($guard['role'] == 'school'){
            $this->validate($request,[
                'ar_name'=> 'required',
                'en_name'=>'required',
                'email'=>'required|unique:admins,email,'.$user->id,
                'phone'=>'required',
                'ar_address'=>'required',
                'en_address'=>'required',
                'ar_delegate'=>'required',
                'en_delegate'=>'required',
            ],[
                'ar_name.required'=> Lang::get('error.ar_name'),
                'en_name.required'=> Lang::get('error.en_name'),
                'email.required'=> Lang::get('error.email'),
                'email.unique'=> Lang::get('error.unique-email'),
                'ar_address.required'=> Lang::get('error.ar_address'),
                'en_address.required'=> Lang::get('error.en_address'),
                'ar_delegate.required'=> Lang::get('error.ar_delegate'),
                'en_delegate.required'=> Lang::get('error.en_delegate'),
                'phone.requierd' => Lang::get('error.phone'),
            ]);
            $user->update([
                'ar_name' =>$data['ar_name'],
                'en_name' =>$data['en_name'],
                'ar_address' =>$data['ar_address'],
                'en_address' =>$data['en_address'],
                'ar_delegate' =>$data['ar_delegate'],
                'en_delegate' =>$data['en_delegate'],
                'email' =>$data['email'],
                'phone' =>$data['phone'],
                'url' => isset($data['url']) ? $data['url']:null,
            ]);
            return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
            
        }elseif($guard['role'] == 'teacher'){
            $this->validate($request,[
                'ar_name'=> 'required',
                'en_name'=>'required',
                'email'=>'required|unique:admins,email,'.$user->id,
                'phone'=>'required',
                'ar_address'=>'required',
                'en_address'=>'required',
                'ar_description'=>'required',
                'en_description'=>'required',
            ],[
                'ar_name.required'=> Lang::get('error.ar_name'),
                'en_name.required'=> Lang::get('error.en_name'),
                'email.required'=> Lang::get('error.email'),
                'email.unique'=> Lang::get('error.unique-email'),
                'ar_address.required'=> Lang::get('error.ar_address'),
                'en_address.required'=> Lang::get('error.en_address'),
                'ar_description.required'=> Lang::get('error.ar_description'),
                'en_description.required'=> Lang::get('error.en_description'),
                'phone.requierd' => Lang::get('error.phone'),
            ]);
            $user->update([
                'ar_name' =>$data['ar_name'],
                'en_name' =>$data['en_name'],
                'ar_address' =>$data['ar_address'],
                'en_address' =>$data['en_address'],
                'ar_description' =>$data['ar_description'],
                'en_description' =>$data['en_description'],
                'email' =>$data['email'],
                'phone' =>$data['phone'],
            ]);
            return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
                     
        }
        
    }

    public function updateImage(Request $request)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $user = $guard['user'];
        if($guard['role'] == 'school')
        {
            $this->validate($request,[
                'image'=>'required',
            ],[
                'image.requierd' => Lang::get('error.r_image'),
            ]);

            if($request->hasFile('image')){
                $file = $request->file('image');
                $new_name = $this->uploadImage($file,'cp/images/profile');

                if($user->image != 'default.png'){
                    if(file_exists(base_path().'/public/cp/images/profile/'.$user->image)){
                        unlink(base_path().'/public/cp/images/profile/'.$user->image);
                    }
                }
            }
            
            $user->update([
                'image' => $new_name,
            ]);
            return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
            
        }
        elseif($guard['role'] == 'teacher')
        {
            $this->validate($request,[
                'image'=>'required',
            ],[
                'image.required'=> Lang::get('error.r_image'),
            ]);

            if($request->hasFile('image')){
                $file = $request->file('image');
                $new_name = $this->uploadImage($file,'cp/images/profile');

                if($user->image != 'default.png'){
                    if(file_exists(base_path().'/public/cp/images/profile'.$user->image)){
                        unlink(base_path().'/public/cp/images/profile'.$user->image);
                    }
                }
            }

            $user->update([
                'image' => $new_name,
            ]);
            return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
                     
        }
    }

    public function updateActiveSchool(Request $request,$id)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $this->validate($request,[
            'active'=>'required',
        ],[
            'active.required'=> Lang::get('error.active-message'),
        ]);
        
        $school = School::find($id);

        if(!$school){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        $teachers = Teacher::where('school_id',$id)->get();
        if($data['active'] == 3 || $data['active'] == 4){
            
            //dd($teachers);
            foreach($teachers as $teacher){
                $teacher->update(['active' => 0]);
            }
            
        }else{
            foreach($teachers as $teacher){
                $teacher->update(['active' => 1]);
            }
            
        }
        if($data['active'] == 2){
            Mail::to($school->email)->send(new ConfirmSubscription);
        }
        $school->update([
            'active' => $data['active'],
            'active_to' => $data['active_to'],
        ]);

        
        return redirect()->back()->with('message', Lang::get('error.complete-activation'))->with('m-class', 'primary');


    }

    public function updatePasswordSchool(Request $request,$id)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $this->validate($request,[
            'new-password'=>'required',
        ],[
            'new-password.required'=> Lang::get('error.new-password'),
        ]);
        
        $school = School::find($id);

        if(!$school){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        

        if(!empty($data['new-password'])){
            $password = bcrypt($data['new-password']);
        }else{
            return redirect()->back()->with('message', Lang::get('error.complete-data'))->with('m-class', 'danger');
        }

        $school->update([
            'password' => $password,
        ]);
        return redirect()->back()->with('message', Lang::get('error.complete-password'))->with('m-class', 'primary');


    }

    public function updateInformationSchool(Request $request,$id)
    {
        $guard = $this->getGuard();
        $data = $request->all();

        $school = School::find($id);

        if(!$school){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        $this->validate($request,[
            'ar_name'=> 'required',
            'en_name'=>'required',
            'email'=>'required|unique:admins,email,'.$school->id,
            'phone'=>'required',
            'ar_address'=>'required',
            'en_address'=>'required',
            'ar_delegate'=>'required',
            'en_delegate'=>'required',
        ],[
            'ar_name.required'=> Lang::get('error.ar_name'),
            'en_name.required'=> Lang::get('error.en_name'),
            'email.required'=> Lang::get('error.email'),
            'email.unique'=> Lang::get('error.unique-email'),
            'ar_address.required'=> Lang::get('error.ar_address'),
            'en_address.required'=> Lang::get('error.en_address'),
            'ar_delegate.required'=> Lang::get('error.ar_delegate'),
            'en_delegate.required'=> Lang::get('error.en_delegate'),
            'phone.requierd' => Lang::get('error.phone'),
        ]);

        $school->update([
            'ar_name' =>$data['ar_name'],
            'en_name' =>$data['en_name'],
            'ar_address' =>$data['ar_address'],
            'en_address' =>$data['en_address'],
            'ar_delegate' =>$data['ar_delegate'],
            'en_delegate' =>$data['en_delegate'],
            'email' =>$data['email'],
            'phone' =>$data['phone'],
            'url' => isset($data['url']) ? $data['url']:null,
        ]);
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');

    }

    public function updateImageSchool(Request $request,$id)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $school = School::find($id);

        if(!$school){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        
        $this->validate($request,[
            'image'=>'required',
        ],[
            'image.requierd' => Lang::get('error.r_image'),
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $new_name = $this->uploadImage($file,'cp/images/profile');

            if($school->image != 'default.png'){
                if(file_exists(base_path().'/public/cp/images/profile/'.$school->image)){
                    unlink(base_path().'/public/cp/images/profile/'.$school->image);
                }
            }
        }
            
        $school->update([
            'image' => $new_name,
        ]);
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
            
    }

    public function updatePasswordTeacher(Request $request,$id)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $this->validate($request,[
            'new-password'=>'required',
        ],[
            'new-password.required'=> Lang::get('error.new-password'),
        ]);
        
        $teacher = Teacher::find($id);

        if(!$teacher){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        

        if(!empty($data['new-password'])){
            $password = bcrypt($data['new-password']);
        }else{
            return redirect()->back()->with('message', Lang::get('error.complete-data'))->with('m-class', 'danger');
        }

        $teacher->update([
            'password' => $password,
        ]);
        return redirect()->back()->with('message', Lang::get('error.complete-password'))->with('m-class', 'primary');


    }

    public function updateInformationTeacher(Request $request,$id)
    {
        $guard = $this->getGuard();
        $data = $request->all();

        $teacher = Teacher::find($id);

        if(!$teacher){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        $this->validate($request,[
            'ar_name'=> 'required',
            'en_name'=>'required',
            'email'=>'required|unique:admins,email,'.$teacher->id,
            'phone'=>'required',
            'ar_address'=>'required',
            'en_address'=>'required',
            'ar_description'=>'required',
            'en_description'=>'required',
        ],[
            'ar_name.required'=> Lang::get('error.ar_name'),
            'en_name.required'=> Lang::get('error.en_name'),
            'email.required'=> Lang::get('error.email'),
            'email.unique'=> Lang::get('error.unique-email'),
            'ar_address.required'=> Lang::get('error.ar_address'),
            'en_address.required'=> Lang::get('error.en_address'),
            'ar_description.required'=> Lang::get('error.ar_description'),
            'en_description.required'=> Lang::get('error.en_description'),
            'phone.requierd' => Lang::get('error.phone'),
        ]);
        $teacher->update([
            'ar_name' =>$data['ar_name'],
            'en_name' =>$data['en_name'],
            'ar_address' =>$data['ar_address'],
            'en_address' =>$data['en_address'],
            'ar_description' =>$data['ar_description'],
            'en_description' =>$data['en_description'],
            'email' =>$data['email'],
            'phone' =>$data['phone'],
        ]);
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');

    }

    public function updateImageTeacher(Request $request,$id)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $teacher = Teacher::find($id);

        if(!$teacher){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        
        $this->validate($request,[
            'image'=>'required',
        ],[
            'image.requierd' => Lang::get('error.r_image'),
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $new_name = $this->uploadImage($file,'cp/images/profile');

            if($teacher->image != 'default.png'){
                if(file_exists(base_path().'/public/cp/images/profile/'.$teacher->image)){
                    unlink(base_path().'/public/cp/images/profile/'.$teacher->image);
                }
            }
        }
            
        $teacher->update([
            'image' => $new_name,
        ]);
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
            
    }

    public function updateInformationStudent(Request $request,$id)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $user = $guard['user'];
        $student = Student::find($id);

        if(!$student){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        

        if($guard['role'] == 'admin'){
            $this->validate($request,[
                'ar_name'=> 'required',
                'en_name'=>'required',
                'school_id'=>'required|exists:schools,id',
                'teacher_id'=>'required|exists:teachers,id',
                'dob'=>'required',
                
                'nationality'=>'required',
                'year_lang'=>'required',
            ],[
                'ar_name.required'=> Lang::get('error.ar_name'),
                'en_name.required'=> Lang::get('error.en_name'),
                'dob.required'=> Lang::get('error.dob'),
                
                'nationality.required'=> Lang::get('error.nationality'),
                'year_lang.required'=> Lang::get('error.year_lang'),
                'school_id.required'=> Lang::get('error.school_id'),
                'teacher_id.required'=> Lang::get('error.teacher_id'),
                'school_id.exists'=> Lang::get('error.exists-school_id'),
                'teacher_id.exists'=> Lang::get('error.exists-teacher_id'),
            ]);
            $student->update([
                'ar_name' =>$data['ar_name'],
                'en_name' =>$data['en_name'],
                'dob' =>$data['dob'],
                'nationality' =>$data['nationality'],
                'year_lang' =>$data['year_lang'],
                'school_id' =>$data['school_id'],
                'teacher_id' =>$data['teacher_id'],
            ]);
        }elseif($guard['role'] == 'school'){
            $this->validate($request,[
                'ar_name'=> 'required',
                'en_name'=>'required',
                'teacher_id'=>'required|exists:teachers,id',
                'dob'=>'required',
                'nationality'=>'required',
                'year_lang'=>'required',
            ],[
                'ar_name.required'=> Lang::get('error.ar_name'),
                'en_name.required'=> Lang::get('error.en_name'),
                'dob.required'=> Lang::get('error.dob'),
                'nationality.required'=> Lang::get('error.nationality'),
                'year_lang.required'=> Lang::get('error.year_lang'),
                'school_id.required'=> Lang::get('error.school_id'),
                'teacher_id.required'=> Lang::get('error.teacher_id'),
                'teacher_id.exists'=> Lang::get('error.exists-teacher_id'),
            ]);
            if($user->id == $student->school_id){
                $student->update([
                    'ar_name' =>$data['ar_name'],
                    'en_name' =>$data['en_name'],
                    'dob' =>$data['dob'],
                    'nationality' =>$data['nationality'],
                    'year_lang' =>$data['year_lang'],
                    'teacher_id' =>$data['teacher_id'],
                ]);
            }
        }elseif($guard['role'] == 'teacher'){
            $this->validate($request,[
                'ar_name'=> 'required',
                'en_name'=>'required',
                'dob'=>'required',
                'nationality'=>'required',
                'year_lang'=>'required',
            ],[
                'ar_name.required'=> Lang::get('error.ar_name'),
                'en_name.required'=> Lang::get('error.en_name'),
                'dob.required'=> Lang::get('error.dob'),
                'nationality.required'=> Lang::get('error.nationality'),
                'year_lang.required'=> Lang::get('error.year_lang'),
            ]);
            if($user->id == $student->teacher_id){
                $student->update([
                    'ar_name' =>$data['ar_name'],
                    'en_name' =>$data['en_name'],
                    'dob' =>$data['dob'],
                    'nationality' =>$data['nationality'],
                    'year_lang' =>$data['year_lang'],
                ]);
            }
        }
        
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');

    }

    public function updateImageStudent(Request $request,$id)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $student = Student::find($id);

        if(!$student){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        
        $this->validate($request,[
            'image'=>'required',
        ],[
            'image.requierd' => Lang::get('error.r_image'),
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $new_name = $this->uploadImage($file,'cp/images/profile');

            if($student->image != 'default.png'){
                if(file_exists(base_path().'/public/cp/images/profile/'.$student->image)){
                    unlink(base_path().'/public/cp/images/profile/'.$student->image);
                }
            }
        }
            
        $student->update([
            'image' => $new_name,
        ]);
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
            
    }
}
