<?php

namespace App\Http\Controllers;

use App\Contribution;
use App\User;
use App\Project;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;


class ContributionController extends Controller
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
        if(!Contribution::where([['user_id', '=', Auth::user()->id], ['project_id' , '=', $request['projectId']]])->first()){
            $contribution = new Contribution();
            $contribution->user_id = Auth::user()->id;
            $contribution->project_id = $request['projectId'];
            $contribution->contribution = $request['investment'];

            if($contribution->save()){
                $project = Project::select('balance', 'contributors')->where('id', $request['projectId'])->first();
                $contributorsCount = $project['contributors'] + 1;
                $balance = $project['balance'] + $request['investment'];
                if (Project::where('id', $request['projectId'])->update(['contributors' => $contributorsCount])) {
                    if (Project::where('id', $request['projectId'])->update(['balance' => $balance])) {
                        Session::flash('message', 'Contribution to the project successfully made!');
                        Session::flash('class', 'success');
                        $details = Project::find($request['projectId']);
                        return view('projectDetails', compact('details'));
                    }
                } 
            }
            Session::flash('message', 'Please Try Again!');
            Session::flash('class', 'danger');
            $details = Project::find($request['projectId']);
            return view('projectDetails', compact('details'));
        }else {
            $past_contribution = Contribution::select('contribution')->where([['user_id', '=', Auth::user()->id], ['project_id' , '=', $request['projectId']]])->first();
            
            $updated_contribution = $past_contribution['contribution'] + $request['investment'];
            if (Contribution::where([['user_id', '=', Auth::user()->id], ['project_id' , '=', $request['projectId']]])->update(['contribution' => $updated_contribution])) {
                $project = Project::select('balance')->where('id', $request['projectId'])->first();
                $balance = $project['balance'] + $request['investment'];
                if (Project::where('id', $request['projectId'])->update(['balance' => $balance])) {
                    Session::flash('message', 'Contribution to the project successfully made!');
                    Session::flash('class', 'success');
                    $details = Project::find($request['projectId']);
                    return view('projectDetails', compact('details'));
                } 
            } 

            Session::flash('message', 'Please try again!');
            Session::flash('class', 'danger');
            $details = Project::find($request['projectId']);
            return view('projectDetails', compact('details'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function show(Contribution $contribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function edit(Contribution $contribution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contribution $contribution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contribution  $contribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contribution $contribution)
    {
        //
    }
}
