<?php

namespace App\Http\Controllers;

use App\Approval;
use Illuminate\Http\Request;
use App\Withdrawal;
use Auth;
use Illuminate\Support\Facades\Session;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Approval  $approval
     * @return \Illuminate\Http\Response
     */
    public function show(Approval $approval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Approval  $approval
     * @return \Illuminate\Http\Response
     */
    public function edit(Approval $approval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Approval  $approval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approval $approval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Approval  $approval
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approval $approval)
    {
        //
    }

    public function approve($id){
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

    public function decline($id){
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


}
