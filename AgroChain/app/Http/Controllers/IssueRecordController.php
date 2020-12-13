<?php

namespace App\Http\Controllers;

use App\CropRequest;
use App\IssueRecord;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IssueRecordController extends Controller
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
        $new_record = new IssueRecord();
        $user_id = User::where('account', $request['buyer_id'])->get();
        $new_record->user_id = $user_id[0]->id;
        $new_record->token = $request['sku'];

        if(CropRequest::where('id', $request['id'])->update(['status' => 1])) {
            $new_record->request_id = $request['id'];
            if($new_record->save()){

                    Session::flash('message', 'Crop has been successfully issued!');
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
     * @param  \App\IssueRecord  $issueRecord
     * @return \Illuminate\Http\Response
     */
    public function show(IssueRecord $issueRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IssueRecord  $issueRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (IssueRecord::where('id', $id)->update(['status' => 5])) {
            Session::flash('message', 'Request for verification has been successfully sent!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IssueRecord  $issueRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IssueRecord $issueRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IssueRecord  $issueRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueRecord $issueRecord)
    {
        //
    }


    public function acceptRequest(Request $request){
        if(IssueRecord::where('id', $request['id'])->update(['status' => $request['state']])){
            Session::flash('message', 'Crop has been successfully verified for shipping!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

    public function cancelRequest($id){
        if(IssueRecord::where('id', $id)->update(['status' => -1])){
            Session::flash('message', 'Crop Verification Request has been successfully rejected!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

}
