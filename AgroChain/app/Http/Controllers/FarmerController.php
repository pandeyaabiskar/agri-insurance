<?php

namespace App\Http\Controllers;

use App\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Auth;

class FarmerController extends Controller
{

    function barcodeNumberExists($number)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Farmer::where('filename', '=', $number)->exists();
    }

    function generateBarcodeNumber()
    {
        $number = mt_rand(1000000000, 9999999999); // better than rand()

        // call the same function if the barcode exists already
        if ($this->barcodeNumberExists($number)) {
            return $this->generateBarcodeNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $farm = new Farmer();
        $farm->farm_name = $request['name'];
        $farm->farm_location = $request['location'];
        $farm->farm_contact = $request['contact'];
        $farm->registration = $request['registration'];
        $farm->size = $request['size'];
        $farm->description = $request['description'];
        $farm->user_id = Auth::user()->id;
        $farm->updated = 1;
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {

                $extension = $request->image->extension();
                $filename = $this->generateBarcodeNumber() . "." . $extension;
                $image = $request->file('image');
                Storage::disk('public')->put($filename, File::get($image));
                $farm->filename = $filename;
            }

        }

        if ($farm->save()) {
            Session::flash('message', 'Farm Details Updated Successfully!');
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
     * @param \App\Farmer $farmer
     * @return \Illuminate\Http\Response
     */
    public function show(Farmer $farmer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Farmer $farmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmer $farmer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Farmer $farmer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $farm = Farmer::where('user_id', $id)->first();
        if ($farm != null) {
            if (Farmer::find($farm->id)->update(['farm_name' => $request['name'], 'farm_location' => $request['location'], 'farm_contact' => $request['contact'],
                'registration' => $request['registration'], 'size' => $request['size'], 'description' => $request['description']])) {
                if ($request->hasFile('image')) {
                    //  Let's do everything here
                    if ($request->file('image')->isValid()) {

                        $extension = $request->image->extension();
                        $filename = $this->generateBarcodeNumber() . "." . $extension;
                        $image = $request->file('image');
                        Storage::disk('public')->put($filename, File::get($image));

                        
                        if ($farm->filename != 'farm.jpg') {
                            Storage::disk('public')->delete($farm->filename);
                        }

                        if (Farmer::where('user_id', $id)->update(['filename' => $filename])) {
                            Session::flash('message', 'Farm Details has been successfully updated!');
                            Session::flash('class', 'success');
                            return redirect('/profile');
                        }
                    }

                }
                Session::flash('message', 'Farm Details has been successfully updated!');
                Session::flash('class', 'success');
                return redirect('/profile');


            }

            Session::flash('message', 'Please try again!');
            Session::flash('class', 'danger');
            return redirect('/profile');
        }else{
            $farm = new Farmer();
            $farm->farm_name = $request['name'];
            $farm->farm_location = $request['location'];
            $farm->farm_contact = $request['contact'];
            $farm->registration = $request['registration'];
            $farm->size = $request['size'];
            $farm->description = $request['description'];
            $farm->user_id = Auth::user()->id;
            $farm->updated = 1;
            if ($request->hasFile('image')) {
                //  Let's do everything here
                if ($request->file('image')->isValid()) {

                    $extension = $request->image->extension();
                    $filename = $this->generateBarcodeNumber() . "." . $extension;
                    $image = $request->file('image');
                    Storage::disk('public')->put($filename, File::get($image));
                    $farm->filename = $filename;
                }

            }

            if ($farm->save()) {
                Session::flash('message', 'Farm Details Updated Successfully!');
                Session::flash('class', 'success');
                return redirect('/profile');
            }
            Session::flash('message', 'Please Try Again!');
            Session::flash('class', 'danger');
            return redirect('/profile');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Farmer $farmer
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Farmer $farmer)
    {
        //
    }

    public function acceptRequest(Request $request){
        if(Farmer::where('id', $request['id'])->update(['verified' => 1])){
            Session::flash('message', 'Farmer has been successfully verified!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

    public function cancelRequest($id){
        if(Farmer::where('id', $id)->update(['verified' => -1])){
            Session::flash('message', 'Farmer Verification Request has been successfully rejected!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }

    public function resubmit($id){
        if(Farmer::where('user_id', $id)->update(['verified' => 0])){
            Session::flash('message', 'Profile Verification Requested Successfully!');
            Session::flash('class', 'success');
            return redirect('/home');
        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');
    }
}
