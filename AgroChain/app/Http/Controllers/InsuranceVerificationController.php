<?php

namespace App\Http\Controllers;

use App\InsuranceApplication;
use App\InsuranceVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class InsuranceVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request['id'];
        $activeInsuranceApplications = InsuranceApplication::where('id', $id)->where('status', 0)->get();
        return view('riskmanager.verifyInsurance', compact('activeInsuranceApplications'));
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
//        dd($request);
        $insuranceVerification = new InsuranceVerification();
        $insuranceVerification->application_id = $request['application_id'];
        $insuranceVerification->fruit = $request['fruit'];
        $insuranceVerification->species = $request['species'];
        $insuranceVerification->area = $request['area'];
        $insuranceVerification->cost = $request['cost'];
        $insuranceVerification->facilities = $request['facilities'];
        $insuranceVerification->condition = $request['condition'];
        $insuranceVerification->disease = $request['disease_question'];
        $insuranceVerification->disease_description = $request['disease_description'];
        $insuranceVerification->care = $request['care'];
        $insuranceVerification->future_disease = $request['possible_disease'];
        $insuranceVerification->risk = $request['risk_description'];
        $insuranceVerification->status = $request['risk_suggestion'];
        $insuranceVerification->riskmanager_id = Auth::user()->id;

        if($insuranceVerification->save()){
            if(InsuranceApplication::where('id', $request['application_id'])->update(['status' => 1])) {
                Session::flash('message', 'Verification form submitted successfully!');
                Session::flash('class', 'success');
                return redirect('/home');
            }
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InsuranceVerification  $insuranceVerification
     * @return \Illuminate\Http\Response
     */
    public function show(InsuranceVerification $insuranceVerification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InsuranceVerification  $insuranceVerification
     * @return \Illuminate\Http\Response
     */
    public function edit(InsuranceVerification $insuranceVerification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InsuranceVerification  $insuranceVerification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InsuranceVerification $insuranceVerification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InsuranceVerification  $insuranceVerification
     * @return \Illuminate\Http\Response
     */
    public function destroy(InsuranceVerification $insuranceVerification)
    {
        //
    }
}
