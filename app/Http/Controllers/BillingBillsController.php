<?php

namespace App\Http\Controllers;

use App\BillingBills;
use Lang;
use Carbon\Carbon;
use App\School;
use Illuminate\Http\Request;

class BillingBillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';
        if($guard['role'] == 'admin'){
            $billingBills = BillingBills::all();
            
            return view($guard['path'].'invoice.index', compact('billingBills','path'));
        }elseif($guard['role'] == 'school'){
            $billingBills = BillingBills::where('school_id', $guard['id'])->get();

            return view($guard['path'].'invoice.index', compact('billingBills','path'));
        }else{
            return view($guard['path']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'NORV'=> 'required',
        ],[
            'NORV.required'=> Lang::get('error.NORV'),
        ]);
        $guard = $this->getGuard();
        $user = $guard['id'];
        $data = $request->all();
        $data['school_id'] = $user;
        BillingBills::create([
            'NORV' => $data['NORV'],
            'school_id' => $user,
        ]);
        
        
        return redirect()->back()->with('message', Lang::get('error.create-billing'))->with('m-class', 'primary');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BillingBills  $billingBills
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $BillingBill = BillingBills::find($id);

        if(!$BillingBill){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }
        $user = $guard['user'];
        if($guard['role'] == 'admin'){
            return view($guard['path'].'invoice.invoice',compact('path','BillingBill'));
        }elseif($guard['role'] == 'school'){
            if($user->id == $BillingBill->school_id){
                return view($guard['path'].'invoice.invoice',compact('path','BillingBill'));
            }else{
                return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
            }
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BillingBills  $billingBills
     * @return \Illuminate\Http\Response
     */
    public function edit(BillingBills $billingBills)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BillingBills  $billingBills
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $BillingBill = BillingBills::find($id);

        if(!$BillingBill){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        $dt = Carbon::now()->addYear();

        $BillingBill->update([
            'accepted' => 1,
            'active_to' => $dt,
        ]);
        $school = School::find($BillingBill->school_id);
        $school->update([
            'active' => 1,
        ]);
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
    }
    public function reject(Request $request, $id)
    {
        $guard = $this->getGuard();
        $path = '/'.$guard['role'].'/';

        $BillingBill = BillingBills::find($id);

        if(!$BillingBill){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        $dt = Carbon::now()->addYear();

        $BillingBill->update([
            'accepted' => 0,
            'active_to' => null,
        ]);
        
        return redirect()->back()->with('message', Lang::get('error.edit-data'))->with('m-class', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BillingBills  $billingBills
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guard = $this->getGuard();
        $user = $guard['user'];

        $BillingBill = BillingBills::find($id);

        if(!$BillingBill){
            return redirect()->back()->with('message', Lang::get('error.selected'))->with('m-class', 'danger');
        }

        if($guard['role'] == 'admin'){
            if(is_null($BillingBill->active_to)){
                $BillingBill->delete();
            }else{
                return redirect()->back()->with('message', Lang::get('pricing.no_delete_invoice'))->with('m-class', 'danger');
            }

        }elseif($guard['role'] == 'school'){
            if($user->id == $BillingBill->school_id){
                if(is_null($BillingBill->active_to)){
                    $BillingBill->delete();
                }else{
                    return redirect()->back()->with('message', Lang::get('pricing.no_delete_invoice'))->with('m-class', 'danger');
                }
            }
        }
        
        
        return redirect()->back()->with('message', Lang::get('error.delete-data'))->with('m-class', 'primary');
    }
}
