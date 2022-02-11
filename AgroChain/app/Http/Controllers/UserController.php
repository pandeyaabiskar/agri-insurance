<?php

namespace App\Http\Controllers;

use App\User;
use App\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personal = User::where('id', $id)->get();
        $farm = Farmer::where('user_id', $id)->get();
        return view('farmer.editProfile', compact('personal', 'farm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
;        if (User::find($id)->update($request->all())) {
            if ($request->hasFile('image')) {
                //  Let's do everything here
                if ($request->file('image')->isValid()) {

                    $extension = $request->image->extension();
                    $filename = $this->generateBarcodeNumber() . "." . $extension;
                    $image = $request->file('image');
                    Storage::disk('public')->put($filename, File::get($image));

                    if ($user->filename != 'profile.jpg') {
                        Storage::disk('public')->delete($user->filename);
                    }

                    if (User::where('id', $id)->update(['filename' => $filename])) {
                        Session::flash('message', 'User Details has been successfully updated!');
                        Session::flash('class', 'success');
                        return redirect('/profile');
                    }
                }

            }
            Session::flash('message', 'User Details has been successfully updated!');
            Session::flash('class', 'success');
            return redirect('/profile');

        }

        Session::flash('message', 'Please try again!');
        Session::flash('class', 'danger');
        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
