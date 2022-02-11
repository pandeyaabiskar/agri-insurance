<?php

namespace App\Http\Controllers;

use App\Withdrawal;
use App\Project;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class WithdrawalController extends Controller
{
    function barcodeNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Project::where('filename', '=', $number)->exists();
        }

    function generateBarcodeNumber() {
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $withdrawal = new Withdrawal();
            $withdrawal->farmer_id = Auth::user()->id;
            $withdrawal->project_id = $request['projectId'];
            $withdrawal->description = $request['description'];
            $withdrawal->amount = $request['amount'];

            if ($request->hasFile('image')) {
                //  Let's do everything here
                if ($request->file('image')->isValid()) {
                    $extension = $request->image->extension();
                    $filename = $this->generateBarcodeNumber().".".$extension;
                    $image = $request->file('image');
                    Storage::disk('public')->put($filename,  File::get($image));
                    $withdrawal->filename = $filename;
                }
    
            }

            if($withdrawal->save()){
                Session::flash('message', 'Withdrawal Request created successfully!');
                Session::flash('class', 'success');
                $details = Project::find($request['projectId']);
                return view('projectDetails', compact('details'));
            }
            Session::flash('message', 'Please Try Again!');
            Session::flash('class', 'danger');
            $details = Project::find($request['projectId']);
            return view('projectDetails', compact('details'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
    }

    public function withdraw($id){
                if (Withdrawal::where('id' , $id)->update(['withdrawan' => 1])) {
                        Session::flash('message', 'Withdraw completed successfully!');
                        Session::flash('class', 'success');
                        return redirect('/home');
                } 

        Session::flash('message', 'Please Try Again!');
            Session::flash('class', 'danger');
            return redirect('/home');
    }

}
