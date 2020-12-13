<?php

namespace App\Http\Controllers;

use App\Crop;
use App\CropRequest;
use App\IssueRecord;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CropController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session('role') == 'admin'){

        }else {
            $crops = Crop::where('isAvailable', 1)->orderBy('created_at', 'desc')->get();
            return view('cropsList', compact('crops'));
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
        $crop = new Crop();
        $crop->name = $request['name'];
        $crop->price = $request['price'];
        $crop->season = $request['season'];
        $crop->harvest_days = $request['harvest'];

        if($crop->save())
        {
            Session::flash('message', 'New Crop has been successfully added!');
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
     * @param  \App\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function show(Crop $crop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Crop::where('id', $id)->update(['isAvailable' => 0])){
            Session::flash('message', 'Marked Unavailable!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
        }

    public function makeAvailable($id)
    {
        if(Crop::where('id', $id)->update(['isAvailable' => 1])){
            Session::flash('message', 'Marked Available!');
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
     * @param  \App\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crop $crop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Crop  $crop
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Crop::where('id', $id)->delete()){
            Session::flash('message', 'Crop has been successfully added!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }


    public function addCrop(){
        return view('admin.register');
    }

    public function trackCrop(Request $request){
        $cropRecord = IssueRecord::where('token', $request['token'])->where('status','>','-1')->get();
        if(count($cropRecord) > 0){
            return view('cropsDetails', compact('cropRecord'));
        }
        Session::flash('message', 'Token Number is invalid');
        Session::flash('class', 'danger');
        return view('welcome');
    }




    public function changeCropState(Request $request){
        if($request['state'] != 0) {
            if (IssueRecord::where('id', $request['id'])->update(['status' => $request['state']])) {
                if ($request['state'] == 1) {
                    Session::flash('message', 'Crop has been successfully planted!');
                } elseif ($request['state'] == 2) {
                    Session::flash('message', 'Crop has been successfully harvested!');
                } elseif ($request['state'] == 3) {
                    Session::flash('message', 'Crop has been successfully verified for shipping!');
                } elseif ($request['state'] == 4) {
                    Session::flash('message', 'Crop has been successfully shipped!');
                }
                Session::flash('class', 'success');
                return redirect('/home');
            }
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

}
