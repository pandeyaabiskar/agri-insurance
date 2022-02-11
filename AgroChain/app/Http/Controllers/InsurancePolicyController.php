<?php

namespace App\Http\Controllers;

use App\ClaimNotification;
use App\InsuranceApplication;
use App\InsurancePolicy;
use App\InsuranceVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class InsurancePolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request['id'];
        $activeInsuranceApplications = InsuranceApplication::where('id', $id)->where('status', 1)->get();
        $verifiedInsuranceApplications = InsuranceVerification::where('application_id', $id)->get();
        $process = new Process(['python', 'D:\Blockchain\AgroChain Project\Climate Analysis\spi_full.py', $activeInsuranceApplications[0]->district]);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $path = 'D:\Blockchain\AgroChain Project\Climate Analysis\spi_full_output\output'.$activeInsuranceApplications[0]->district.'.csv';
        $spi_data = array_map('str_getcsv', file($path));
        return view('admin.createInsurance', compact('activeInsuranceApplications', 'verifiedInsuranceApplications', 'spi_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $policy = new InsurancePolicy();
        $policy->verification_id = $request['verification_id'];
        $policy->amount = $request['amount'];
        $policy->premium = $request['premium'];
        $policy->isPaid = 0;

        if($policy->save()){
            if(InsuranceApplication::where('id', $request['application_id'])->update(['status' => 2])) {
                if(InsuranceVerification::where('application_id', $request['application_id'])->update(['status' => 2])) {
                    Session::flash('message', 'Insurance Application Approved successfully!');
                    Session::flash('class', 'success');
                    return redirect('/home');
                }
            }
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InsurancePolicy  $insurancePolicy
     * @return \Illuminate\Http\Response
     */
    public function show(InsurancePolicy $insurancePolicy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InsurancePolicy  $insurancePolicy
     * @return \Illuminate\Http\Response
     */
    public function edit(InsurancePolicy $insurancePolicy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InsurancePolicy  $insurancePolicy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InsurancePolicy $insurancePolicy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InsurancePolicy  $insurancePolicy
     * @return \Illuminate\Http\Response
     */
    public function destroy(InsurancePolicy $insurancePolicy)
    {
        //
    }

    public function loadFund(Request $request)
    {

            if(InsurancePolicy::where('id',  $request['policy_id'])->update(['isPaid' => 1])) {
                    Session::flash('message', 'Fund loaded successfully!');
                    Session::flash('class', 'success');
                    return redirect('/home');
            }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }
    public function details(Request $request)
    {
        $policy = InsurancePolicy::where('id', $request['id'])->get()[0];
        if(count(ClaimNotification::where('application_id', $request['application_id'])->get()) != 0){
            $claim = ClaimNotification::where('application_id', $request['application_id'])->get()[0];
            $policy->notification_id = $claim->id;
            $policy->spi1 = $claim->spi1;
            $policy->spi3 = $claim->spi3;
            $policy->claim_status = $claim->status;
        }
        $process = new Process(['python', 'D:\Blockchain\AgroChain Project\Climate Analysis\spi_full.py', $request['district']]);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $path = 'D:\Blockchain\AgroChain Project\Climate Analysis\spi_full_output\output'.$request['district'].'.csv';
        $spi_data = array_map('str_getcsv', file($path));
        return view('policyDetails', compact('policy', 'spi_data' ));
    }
    public function claim(Request $request)
    {
        if(ClaimNotification::where('id',  $request['notification_id'])->update(['status' => 1])) {
            Session::flash('message', 'Claim Status Updated successfully!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }
}
