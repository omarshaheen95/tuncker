<?php

namespace App\Http\Controllers;

use App\Standard;
use App\Student;
use App\SubSubject;
use App\StudentSubject;
use App\StudentStandard;
use Lang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StandardController extends Controller
{
    public function index()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/standard';

        $standards = Standard::all();

        return view($guard['path'].'standard.index', compact('standards', 'path'));
    }

    public function studentStandards($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $standards = Standard::where('sub_subject_id', $id)->get();
        if(count($standards) <= 0){
            return redirect()->back()->with('message', Lang::get('error.no-standards'))->with('m-class', 'danger');
        }

        $standards = Standard::where('sub_subject_id', $id)->get();
        $id_standards = Standard::where('sub_subject_id', $id)->get()->unique()->pluck('id')->all();
        $students_standards = StudentStandard::whereIn('standard_id', $id_standards)->with('standard')->get()->toArray();
        $id_students_standards = StudentStandard::whereIn('standard_id', $id_standards)->get()->unique()->pluck('student_id')->all();
        $students = Student::whereIn('id', $id_students_standards)->get();
        /**/
        
        //dd($students_standards);
        return view($guard['path'].'standard.student-standard',compact('path', 'standards', 'students', 'students_standards'));
    }

    public function updateStudentStandard(Request $request)
    {
        $guard = $this->getGuard();
        $data = $request->all();
        $error = [];
        $error['heading'] = Lang::get('error.error');
        $error['message'] = Lang::get('error.selected');
        $error['icon'] = 'error';
        $error['color'] = '#f2a654';
        $error['position'] = 'top-left';
        $error['status'] = false;
        $result = [];
        $result['heading'] = 'Success';
        $result['message'] = 'Done operations';
        
        $result['status'] = true;
        
        $student = Student::find($data['student_id']);
        if(!$student){
            return $error;
        }

        if($student->teacher_id != $guard['id']){
            $error['message'] = Lang::get('error.unAuth');
            return $error;
        }

        $standard = StudentStandard::where('student_id', $student->id)->where('id', $data['standard_id'])->first();
        if(!$standard){
            $error['message'] = Lang::get('error.no_standard');
            return $error;
        }

        if($standard->u_status == 1 && $standard->t_status == 0){
            $standard->update([
                't_status' => 1,
                't_type' => Carbon::now(),
            ]);
            $result['nextStep'] = 'Next Step A';
            $result['step'] = 'T';
            $result['text'] = ' T';
            $result['iconTyep'] = '<i class="fa fa-2x fa-star text-danger"></i>';
        }elseif($standard->t_status == 1 && $standard->a_status == 0){
            $standard->update([
                'a_status' => 1,
                'a_type' => Carbon::now(),
            ]);
            $result['nextStep'] = 'Next Step M';
            $result['step'] = 'A';
            $result['text'] = ' A';
            $result['iconTyep'] = '<i class="fa fa-2x fa-star text-warning"></i>';
        }elseif($standard->a_status == 1 && $standard->m_status == 0){
            $standard->update([
                'm_status' => 1,
                'm_type' => Carbon::now(),
            ]);
            $result['nextStep'] = 'Next Step E';
            $result['step'] = 'M';
            $result['text'] = ' M';
            $result['iconTyep'] = '<i class="fa fa-2x fa-star text-success"></i>';
        }elseif($standard->m_status == 1 && $standard->e_status == 0){
            $standard->update([
                'e_status' => 1,
                'e_type' => Carbon::now(),
            ]);
            $result['nextStep'] = 'Next Step U';
            $result['step'] = 'E';
            $result['text'] = ' E';
            $result['iconTyep'] = '<i class="fa fa-2x fa-star text-primary"></i>';
        }elseif($standard->e_status == 0){
            $standard->update([
                'e_status' => 1,
                'e_type' => Carbon::now(),
            ]);
            $result['nextStep'] = 'Next Step U';
            $result['step'] = 'E';
            $result['text'] = ' E';
            $result['iconTyep'] = '<i class="fa fa-2x fa-star text-primary"></i>';
        }else{
            $standard->update([
                't_status' => 0,
                't_type' => null,
                'a_status' => 0,
                'a_type' => null,
                'm_status' => 0,
                'm_type' => null,
                'e_status' => 0,
                'e_type' => null,
            ]);
            $result['nextStep'] = 'Next Step T';
            $result['step'] = 'U';
            $result['text'] = ' U';
            $result['iconTyep'] = '<i class="fa fa-2x fa-star-o"></i>';
        }
        $result['icon'] = 'success';
        $result['color'] = '#f96868';
        $result['position'] = 'top-left';
        
        return $result;
    }

    public function subjectStandards($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/standard';

        $standards = Standard::where('sub_subject_id', $id)->get();

        return view($guard['path'].'standard.index', compact('standards', 'path'));
    }

    public function create()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/standard';
        $s_subjects = SubSubject::all();

        return view($guard['path'].'standard.create', compact('path', 's_subjects'));
    }

    public function store(Request $request)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];
        $path = '/'.$guard['role'].'/standard';
        $this->validate($request,[
            'standard'=> 'required',
            'sub_subject_id'=>'required|exists:sub_subjects,id',
        ],[
            'standard.required'=> Lang::get('error.standard'),
            'sub_subject_id.required'=> Lang::get('error.standard'),
            'sub_subject_id.exists'=> Lang::get('error.exists-standard'),
        ]);
        $data = $request->all();
        $standard = Standard::create($data);
        $subject = $standard->sub_subject->subject;
        $student_subjects = StudentSubject::where('subject_id', $subject->id)->get();
        if(count($student_subjects) > 0){
            $s_s = $student_subjects->unique()->pluck('student_id')->all();
            //dd($s_s);
            foreach($s_s as $key => $value){
                StudentStandard::create([
                    'standard_id' => $standard->id,
                    'student_id' => $value,
                ]);
            }
        }
        return redirect()->back()->with('message', Lang::get('error.create-data'))->with('m-class', 'primary');
    
    }

    public function show($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';
        $s_subjects = SubSubject::all();

        $standard = Standard::find($id);
        if(!$standard){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        return view($guard['path'].'standard.show',compact('path', 's_subjects', 'standard'));

    }

    public function update(Request $request, $id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $standard = Standard::find($id);
        if(!$standard){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        $this->validate($request,[
            'standard'=> 'required',
            'sub_subject_id'=>'required|exists:sub_subjects,id',
        ],[
            'standard.required'=> Lang::get('error.standard'),
            'sub_subject_id.required'=> Lang::get('error.standard'),
            'sub_subject_id.exists'=> Lang::get('error.exists-standard'),
        ]);
        $data = $request->all();

        $standard->update($data);
        return redirect('/admin/standard')->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
    }

    public function destroy($id)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];

        $standard = Standard::find($id);

        if(!$standard){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        
        $standard->delete();
        
        return redirect()->back()->with('message', Lang::get('error.delete-data'))->with('m-class', 'primary');
    }
}
