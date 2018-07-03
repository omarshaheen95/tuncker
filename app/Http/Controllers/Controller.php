<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    


    protected function getGuard()
    {
        $guard = Auth::guard()->getNameGuard();
        
        if($guard == 'admin'){
            $result['role'] = "admin";
            $result['path'] = "admin.cp.";
            $result['user'] = Auth::guard('admin')->user();
            $result['id'] = Auth::guard('admin')->user()->id;
            return $result;
        }
        elseif($guard == 'school'){
            $result['role'] = "school";
            $result['path'] = "school.cp.";
            $result['user'] = Auth::guard('school')->user();
            $result['id'] = Auth::guard('school')->user()->id;
            return $result;
        }
        elseif($guard == 'teacher'){
            $result['role'] = "teacher";
            $result['path'] = "teacher.cp.";
            $result['user'] = Auth::guard('teacher')->user();
            $result['id'] = Auth::guard('teacher')->user()->id;
            return $result;
        }
        else{
            $result['role'] = "Unauthenticated";
            $result['path'] = "welcome";
            return $result;
        }
        return $result;
    }

    protected function uploadImage($file,$path){
        $fileName = $file->getClientOriginalName();
        $file_exe = $file->getClientOriginalExtension();
        $new_name = uniqid().'.'.$file_exe;
        $destienation = public_path($path);
        $file->move($destienation , $new_name);
        return $new_name;
    }
    
}
