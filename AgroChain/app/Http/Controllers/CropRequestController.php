<?php

namespace App\Http\Controllers;

use App\Crop;
use App\CropRequest;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CropRequestController extends Controller
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
        $croprequest = new CropRequest();
        $croprequest->user_id = Auth::user()->id;
        $croprequest->crop_id = $request['id'];
        $croprequest->quantity= $request['quantity'];

        if($croprequest->save()){
            Session::flash('message', 'Crop has been successfuly requested!');
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
     * @param  \App\CropRequest  $cropRequest
     * @return \Illuminate\Http\Response
     */
    public function show(CropRequest $cropRequest)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CropRequest  $cropRequest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $crop = Crop::where('id', $id)->get();
        return view('requestCrop', compact('crop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CropRequest  $cropRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CropRequest $cropRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CropRequest  $cropRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(CropRequest::where('id', $id)->delete()){
            Session::flash('message', 'Crop Request has been successfuly deleted!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }


    public function cancelRequest($id){
        if(CropRequest::where('id', $id)->update(['status' => -1])){
            Session::flash('message', 'Crop Request has been successfuly rejected!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }
}
