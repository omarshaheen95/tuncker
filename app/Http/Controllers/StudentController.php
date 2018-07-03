<?php

namespace App\Http\Controllers;

use App\Student;
use App\School;
use App\Teacher;
use App\StudentSubject;
use App\SubSubject;
use App\Subject;
use App\Standard;
use App\StudentStandard;
use Lang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudentController extends Controller
{
    
    public function index()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/student';
        if($guard['role'] == 'admin'){
            $students = Student::all();

            return view($guard['path'].'student.index', compact('students','path'));
        }elseif($guard['role'] == 'school'){
            $students = Student::where('school_id', $guard['id'])->get();

            return view($guard['path'].'student.index', compact('students','path'));
        }elseif($guard['role'] == 'teacher'){
            $students = Student::where('teacher_id', $guard['id'])->get();

            return view($guard['path'].'student.index', compact('students','path'));
        }else{
            return view($guard['path']);
        }
    }

    
    public function create()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/student';
        $subjects = Subject::all();
        return view($guard['path'].'student.create', compact('path','subjects'));
    }

    public function store(Request $request)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];
        
        if($user->active == 1 ){
            if( $user->count_students >= 5){
                return redirect()->back()->with('message', Lang::get('error.more_student'))->with('m-class', 'danger');
            }
        }

        

        $path = '/'.$guard['role'].'/student';
        $this->validate($request,[
            'ar_name'=> 'required',
            'en_name'=>'required',
            'dob'=>'required',
            'image' => 'required|image',
            'nationality'=>'required',
            'year_lang'=>'required',
        ],[
            'ar_name.required'=> Lang::get('error.ar_name'),
            'en_name.required'=> Lang::get('error.en_name'),
            'dob.required'=> Lang::get('error.dob'),
            'image.required'=> Lang::get('error.r_image'),
            'nationality.required'=> Lang::get('error.nationality'),
            'year_lang.required'=> Lang::get('error.year_lang'),
        ]);
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $new_name = $this->uploadImage($file,'cp/images/profile');
            $data['image'] = $new_name;
        }else{
            return redirect()->back()->with('message', Lang::get('error.image'))->with('m-class', 'danger');
        }

        $data['teacher_id'] = $user->id;
        $data['school_id'] = $user->school->id;
        $student = Student::create($data);
        $selected_subjects = $request->input('subjects');
        if(isset($selected_subjects)){
            foreach($selected_subjects as $s_subject){
                $standards = Subject::where('id', $s_subject)->first()->standards;
                StudentSubject::create([
                    'student_id' => $student->id,
                    'subject_id' => $s_subject,
                ]);
                
                if(count($standards) > 0){
                    foreach($standards as $standard){
                        StudentStandard::create([
                            'standard_id' => $standard->id,
                            'student_id' => $student->id,
                        ]);
                    }
                }
            }
        }
        return redirect()->back()->with('message', Lang::get('error.create-data'))->with('m-class', 'primary');
    }

    public function show($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';
        $user = $guard['user'];

        $student = Student::find($id);
        $schools = School::all();
        

        if(!$student){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        $student_subjects = StudentSubject::where('student_id', $id)->get();
        $s_s = $student_subjects->unique()->pluck('subject_id');

        $subjects = Subject::all();
        //dd($sub_subjects);
        $teachers = Teacher::where('school_id', $student->school_id)->get();
        if($guard['role'] == 'admin'){
            return view($guard['path'].'student.show',compact('path','student','schools','teachers', 's_s', 'subjects'));
        }elseif($guard['role'] == 'school'){
            if($user->id  == $student->school_id){
                return view($guard['path'].'student.show',compact('path','student','schools','teachers', 's_s', 'subjects'));
            }else{
                return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
            }
        }elseif($guard['role'] == 'teacher'){
            if($user->id  == $student->teacher_id){
                return view($guard['path'].'student.show',compact('path','student','schools','teachers', 's_s', 'subjects'));
            }else{
                return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
            }
        }

        

        
    }

    public function prepare_report($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';
        $user = $guard['user'];

        $student = Student::find($id);
        
        
        if(!$student){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        $sutdent_subjects = StudentSubject::where('student_id', $student->id)->get()->unique()->pluck('subject_id')->all();

        $subjects = SubSubject::whereIn('subject_id', $sutdent_subjects)->get();

        $subjects = $subjects->chunk(1);

        if($guard['role'] == 'admin'){
            return view($guard['path'].'student.prepare_report',compact('path', 'student', 'subjects'));
        }elseif($guard['role'] == 'school'){
            if($user->id  == $student->school_id){
                return view($guard['path'].'student.prepare_report',compact('path', 'student', 'subjects'));
            }else{
                return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
            }
        }elseif($guard['role'] == 'teacher'){
            if($user->id  == $student->teacher_id){
                return view($guard['path'].'student.prepare_report',compact('path', 'student', 'subjects'));
            }else{
                return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
            }
        }
    }

    public function report(Request $request, $id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';
        $user = $guard['user'];

        $student = Student::find($id);
        $schools = School::all();
        

        if(!$student){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        //dd($student);
        $data = $request->all();
        
        $student_subjects = StudentSubject::where('student_id', $id)->get();

        $s_s = $student_subjects->unique()->pluck('subject_id')->all();

        $sub_subjects = SubSubject::whereIn('subject_id',$s_s)->get();

        //$sub_subjects_id = $sub_subjects->unique()->pluck('id')->all();

        $sub_subject_collection = collect();
        
        //dd($data['subjects']);
        if(isset($data['startDate']) && isset($data['endDate'])){
            $start = Carbon::createFromFormat('d-M-Y', $data['startDate'])->toDateString() .' 00:00:00';
            $end = Carbon::createFromFormat('d-M-Y', $data['endDate'])->toDateString() .' 23:59:59';
        }
        
        if(isset($data['subjects'])){
            foreach($data['subjects'] as $one_subject){
                $sub_id = SubSubject::find($one_subject);
            
                $standards = Standard::where('sub_subject_id', $sub_id->id)->get();
    
                $standards_id = $standards->unique()->pluck('id')->all();
                if(isset($data['startDate']) && isset($data['endDate'])){
                    $student_standards = StudentStandard::whereIn('standard_id',$standards_id)->where('student_id', $id)->where('updated_at','>=',$start)->where('updated_at','<=',$end)->get();
                    //dd($start.' lkn '.$end);
                }else{
                    $student_standards = StudentStandard::whereIn('standard_id',$standards_id)->where('student_id', $id)->get();
                }
                foreach($student_standards as $key => $student_standard){
                    if($student_standard->e_status){
                        $student_standard['status_result'] = '<i class="fa fa-3x fa-star text-primary"></i>';
                        $student_standard['date_result'] = $student_standard->e_type;
                        $student_standard['rate_school'] = $student_standard->rate_about_school($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['rate_system'] = $student_standard->rate_about_system($student_standard->standard_id,$student_standard->student_id);
                    }elseif($student_standard->m_status){
                        $student_standard['status_result'] = '<i class="fa fa-3x fa-star text-success"></i>';
                        $student_standard['date_result'] = $student_standard->m_type;
                        $student_standard['rate_school'] = $student_standard->rate_about_school($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['rate_system'] = $student_standard->rate_about_system($student_standard->standard_id,$student_standard->student_id);
                    }elseif($student_standard->a_status){
                        $student_standard['status_result'] = '<i class="fa fa-3x fa-star text-warning"></i>';
                        $student_standard['date_result'] = $student_standard->a_type;
                        $student_standard['rate_system'] = $student_standard->rate_about_system($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['rate_school'] = $student_standard->rate_about_school($student_standard->standard_id,$student_standard->student_id);
                        
                    }elseif($student_standard->t_status){
                        $student_standard['status_result'] = '<i class="fa fa-3x fa-star text-danger"></i>';
                        $student_standard['rate_school'] = $student_standard->rate_about_school($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['rate_system'] = $student_standard->rate_about_system($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['date_result'] = $student_standard->t_type;
                    }else{
                        /*$student_standard['status_result'] = '<i class="fa fa-3x fa-star-o"></i>';
                        $student_standard['rate_school'] = $student_standard->rate_about_school($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['rate_system'] = $student_standard->rate_about_system($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['date_result'] = $student_standard->u_type;*/
                        $student_standards->forget($key);
                    }
                }
    
                $student_standards_chunks = $student_standards->chunk(10);
    
                $result_collection = collect([
                    'standards' => $student_standards_chunks,
                    'name' => $sub_id->subject->ar_name,
                    'sub_name' => $sub_id->ar_name,
                ]);
    
                $sub_subject_collection->push($result_collection);
    
            }
        }else{
            foreach($sub_subjects as $sub_id){
            
            
                $standards = Standard::where('sub_subject_id', $sub_id->id)->get();
    
                $standards_id = $standards->unique()->pluck('id')->all();
                if(isset($data['startDate']) && isset($data['endDate'])){
                    $student_standards = StudentStandard::whereIn('standard_id',$standards_id)->where('student_id', $id)->where('updated_at','>=',$start)->where('updated_at','<=',$end)->get();
                    //dd($start.' lkn '.$end);
                }else{
                    $student_standards = StudentStandard::whereIn('standard_id',$standards_id)->where('student_id', $id)->get();
                }
                foreach($student_standards as $key => $student_standard){
                    if($student_standard->e_status){
                        $student_standard['status_result'] = '<i class="fa fa-3x fa-star text-primary"></i>';
                        $student_standard['date_result'] = $student_standard->e_type;
                        $student_standard['rate_school'] = $student_standard->rate_about_school($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['rate_system'] = $student_standard->rate_about_system($student_standard->standard_id,$student_standard->student_id);
                    }elseif($student_standard->m_status){
                        $student_standard['status_result'] = '<i class="fa fa-3x fa-star text-success"></i>';
                        $student_standard['date_result'] = $student_standard->m_type;
                        $student_standard['rate_school'] = $student_standard->rate_about_school($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['rate_system'] = $student_standard->rate_about_system($student_standard->standard_id,$student_standard->student_id);
                    }elseif($student_standard->a_status){
                        $student_standard['status_result'] = '<i class="fa fa-3x fa-star text-warning"></i>';
                        $student_standard['date_result'] = $student_standard->a_type;
                        $student_standard['rate_system'] = $student_standard->rate_about_system($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['rate_school'] = $student_standard->rate_about_school($student_standard->standard_id,$student_standard->student_id);
                        
                    }elseif($student_standard->t_status){
                        $student_standard['status_result'] = '<i class="fa fa-3x fa-star text-danger"></i>';
                        $student_standard['rate_school'] = $student_standard->rate_about_school($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['rate_system'] = $student_standard->rate_about_system($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['date_result'] = $student_standard->t_type;
                    }else{
                        /*$student_standard['status_result'] = '<i class="fa fa-3x fa-star-o"></i>';
                        $student_standard['rate_school'] = $student_standard->rate_about_school($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['rate_system'] = $student_standard->rate_about_system($student_standard->standard_id,$student_standard->student_id);
                        $student_standard['date_result'] = $student_standard->u_type;*/
                        $student_standards->forget($key);
                    }
                }
    
                $student_standards_chunks = $student_standards->chunk(10);
    
                $result_collection = collect([
                    'standards' => $student_standards_chunks,
                    'name' => $sub_id->subject->ar_name,
                    'sub_name' => $sub_id->ar_name,
                ]);
    
                $sub_subject_collection->push($result_collection);
    
            }
        }

         return view($guard['path'].'student.report',compact('path', 'student', 'sub_subject_collection', 'student_subjects', 'student_standards'));

        //dd($sub_subject_collection);
        
        if($guard['role'] == 'admin'){
            return view($guard['path'].'student.report',compact('path', 'student', 'sub_subject_collection', 'student_subjects', 'student_standards'));
        }elseif($guard['role'] == 'school'){
            if($user->id  == $student->school_id){
                return view($guard['path'].'student.report',compact('path', 'student', 'sub_subject_collection', 'student_subjects', 'student_standards'));
            }else{
                return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
            }
        }elseif($guard['role'] == 'teacher'){
            if($user->id  == $student->teacher_id){
                return view($guard['path'].'student.report',compact('path', 'student', 'sub_subject_collection', 'student_subjectsx', 'student_standards'));
            }else{
                return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
            }
        }

        

        
    }

    public function deleteStudent($id)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];

        $student = Student::find($id);

        if(!$student){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        
        if($guard['role'] == 'admin'){
            if($student->image != 'default.png'){
                if(file_exists(base_path().'/public/cp/images/profile/'.$student->image)){
                    unlink(base_path().'/public/cp/images/profile/'.$student->image);
                }
            }
            $student->delete();
        }elseif($guard['role'] == 'school'){
            if($user->id == $student->school_id){
                if($student->image != 'default.png'){
                    if(file_exists(base_path().'/public/cp/images/profile/'.$student->image)){
                        unlink(base_path().'/public/cp/images/profile/'.$student->image);
                    }
                }
                $student->delete();
            }
        }elseif($guard['role'] == 'teacher'){
            if($user->id == $student->teacher_id){
                if($student->image != 'default.png'){
                    if(file_exists(base_path().'/public/cp/images/profile/'.$student->image)){
                        unlink(base_path().'/public/cp/images/profile/'.$student->image);
                    }
                }
                $student->delete();
            }
        }
        
        return redirect()->back()->with('message', Lang::get('error.delete-data'))->with('m-class', 'primary');
        
    }

    public function edit(Student $student)
    {
        //
    }

    public function updateSubjectStudent(Request $request,$id)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $user = $guard['user'];
        $student = Student::find($id);

        if(!$student){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        $this->validate($request,[
            'subjects'=> 'required|exists:subjects,id',
        ],[
            'subjects.required'=> Lang::get('error.subjects'),
            'subjects.exists'=> Lang::get('error.exists-subjects'),
        ]);

        $selected_subjects = $request->input('subjects');
        //dd($selected_subjects);

        if($guard['role'] == 'admin'){
            foreach($selected_subjects as $s_subject){
                $is_exists = StudentSubject::where('student_id', $id)->where('subject_id', $s_subject)->first();
                $standards = Subject::where('id', $s_subject)->first()->standards;
                if(!$is_exists){
                    
                    StudentSubject::create([
                        'student_id' => $id,
                        'subject_id' => $s_subject,
                    ]);
                    
                    if(count($standards) > 0){
                        foreach($standards as $standard){
                            StudentStandard::create([
                                'standard_id' => $standard->id,
                                'student_id' => $id,
                            ]);
                        }
                    }

                }
            }
            $not_selected = StudentSubject::where('student_id', $id)->whereNotIn('subject_id', $selected_subjects)->get();
            
            foreach($not_selected as $n_selected){
                $standards = Subject::where('id', $n_selected->subject_id)->first()->standards->unique()->pluck('id')->all();
                if(count($standards) > 0){
                    StudentStandard::whereIn('standard_id', $standards)->where('student_id', $id)->delete();
                }
                $n_selected->delete();
            }
            return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
        }elseif($guard['role'] == 'school'){
            if($user->id == $student->school_id){
                foreach($selected_subjects as $s_subject){
                    $is_exists = StudentSubject::where('student_id', $id)->where('subject_id', $s_subject)->first();
                    $standards = Subject::where('id', $s_subject)->first()->standards;
                    if(!$is_exists){
                        
                        StudentSubject::create([
                            'student_id' => $id,
                            'subject_id' => $s_subject,
                        ]);
                        
                        if(count($standards) > 0){
                            foreach($standards as $standard){
                                StudentStandard::create([
                                    'standard_id' => $standard->id,
                                    'student_id' => $id,
                                ]);
                            }
                        }
    
                    }
                }
                $not_selected = StudentSubject::where('student_id', $id)->whereNotIn('subject_id', $selected_subjects)->get();
                
                foreach($not_selected as $n_selected){
                    $standards = Subject::where('id', $n_selected->subject_id)->first()->standards->unique()->pluck('id')->all();
                    if(count($standards) > 0){
                        StudentStandard::whereIn('standard_id', $standards)->where('student_id', $id)->delete();
                    }
                    $n_selected->delete();
                }
                return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
            }else{
                return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
            }
        }elseif($guard['role'] == 'teacher'){
            if($user->id == $student->teacher_id){
                foreach($selected_subjects as $s_subject){
                    $is_exists = StudentSubject::where('student_id', $id)->where('subject_id', $s_subject)->first();
                    $standards = Subject::where('id', $s_subject)->first()->standards;
                    if(!$is_exists){
                        
                        StudentSubject::create([
                            'student_id' => $id,
                            'subject_id' => $s_subject,
                        ]);
                        
                        if(count($standards) > 0){
                            foreach($standards as $standard){
                                StudentStandard::create([
                                    'standard_id' => $standard->id,
                                    'student_id' => $id,
                                ]);
                            }
                        }
    
                    }
                }
                $not_selected = StudentSubject::where('student_id', $id)->whereNotIn('subject_id', $selected_subjects)->get();
                
                foreach($not_selected as $n_selected){
                    $standards = Subject::where('id', $n_selected->subject_id)->first()->standards->unique()->pluck('id')->all();
                    if(count($standards) > 0){
                        StudentStandard::whereIn('standard_id', $standards)->where('student_id', $id)->delete();
                    }
                    $n_selected->delete();
                }
                return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
            }else{
                return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
            }
        }
        
        return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'primary');

    }

    public function destroy(Student $student)
    {
        //
    }


    

    public function schoolStudents($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/student';
        if($guard['role'] == 'admin'){
            $students = Student::where('school_id', $id)->get();
            return view($guard['path'].'student.index', compact('students','path'));
        }
    }
    
    public function teacherStudents($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/student';
        $user = $guard['user'];
        if($guard['role'] == 'admin'){
            $students = Student::where('school_id', $id)->get();
            return view($guard['path'].'student.index', compact('students','path'));
        }elseif($guard['role'] == 'school'){
            $teacher = Teacher::find($id);
            if(!$teacher || $teacher->school_id != $user->id){
                return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
            }
            $students = Student::where('school_id', $id)->get();
            return view($guard['path'].'student.index', compact('students','path'));
        }
    }
}
