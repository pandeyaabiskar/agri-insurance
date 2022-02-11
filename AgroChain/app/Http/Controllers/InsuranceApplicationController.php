<?php

namespace App\Http\Controllers;

use App\InsuranceApplication;
use App\InsuranceVerification;
use Illuminate\Http\Request;
use App\Farmer;
use App\Project;
use Auth;
use Illuminate\Support\Facades\Session;

class InsuranceApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('insurance');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $details = Farmer::where('user_id',Auth::user()->id)->first();
        $activeProjects = Project::where('farmer_id', Auth::user()->id)->where('status', 1)->get();

        return view('farmer.applyInsurance', compact('details', 'activeProjects'));
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
        $insuranceApplication = new InsuranceApplication();
        $insuranceApplication->project_id = $request['name'];
        $insuranceApplication->area = $request['area'];
        $insuranceApplication->cost = $request['cost'];
        $insuranceApplication->district = $request['districts'];
        $insuranceApplication->fromDate = $request['from-date'];
        $insuranceApplication->toDate = $request['to-date'];
        $insuranceApplication->duration = $request['duration'];
        $insuranceApplication->amount = $request['insurance-amount'];
        $insuranceApplication->lat = $request['lat'];
        $insuranceApplication->lon = $request['lon'];
        $insuranceApplication->facilities = $request['facilities'];
        $insuranceApplication->experience = $request['experience'];
        $insuranceApplication->pastinsurance = $request['past_insurance'];
        $insuranceApplication->pastloss = $request['past_loss'];
        $insuranceApplication->lossDate = $request['past_loss_date'];
        $insuranceApplication->lossReason = $request['past_loss_reason'];
        $insuranceApplication->lossAmount = $request['past_loss_amount'];
        $insuranceApplication->farmer_id = Auth::user()->id;

        if($insuranceApplication->save()){
            Session::flash('message', 'Application for Insurance submitted successfully!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InsuranceApplication  $insuranceApplication
     * @return \Illuminate\Http\Response
     */
    public function display($id)
    {
        $details = InsuranceApplication::find($id);
        return view('riskmanager.verify', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InsuranceApplication  $insuranceApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(InsuranceApplication $insuranceApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InsuranceApplication  $insuranceApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InsuranceApplication $insuranceApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InsuranceApplication  $insuranceApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request['application_id'];
        if(InsuranceApplication::where('id', $id)->delete()){
            Session::flash('message', 'Insurance Application has been successfully deleted!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

    public function verify($id){
        $withdrawal = Withdrawal::select('project_id')->where('id', $id)->first();
        if(!Approval::where([['user_id', '=', Auth::user()->id], ['project_id' , '=', $withdrawal['project_id']], ['withdrawal_id' , '=', $id]])->first()){
            $approval = new Approval();
            $approval->user_id = Auth::user()->id;
            $approval->project_id = $withdrawal['project_id'];
            $approval->withdrawal_id = $id;

            if($approval->save()){
                $withdrawal = Withdrawal::select('approvals')->where([['project_id' , '=', $withdrawal['project_id']], ['id' , '=', $id]])->first();
                $approvals = $withdrawal['approvals'] + 1;
                if (Withdrawal::where('id' , $id)->update(['approvals' => $approvals])) {
                    Session::flash('message', 'Withdraw request approved successfully!');
                    Session::flash('class', 'success');
                    return redirect('/home');
                }
            }

        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

    public function reject($id)
    {
        if(InsuranceApplication::where('id', $id)->update(['status' => -1])){
            if(InsuranceVerification::where('application_id', $id)->update(['status' => -1])) {
                Session::flash('message', 'Insurance Application Request has been successfully rejected!');
                Session::flash('class', 'success');
                return redirect('/home');
            }
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }
    public function payPremium(Request $request)
    {

        if(InsuranceApplication::where('id',  $request['application_id'])->update(['status' => 3])) {
            Session::flash('message', 'Premium Paid successfully!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }
}
