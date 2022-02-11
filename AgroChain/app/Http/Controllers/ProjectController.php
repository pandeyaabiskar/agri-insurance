<?php

namespace App\Http\Controllers;

use App\InsuranceApplication;
use App\InsurancePolicy;
use App\InsuranceVerification;
use App\Project;
use App\Farmer;
use App\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Auth;

class ProjectController extends Controller
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
        return view('project');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectactive = "mm-active";
        $details = Farmer::where('user_id',Auth::user()->id)->first();
        return view('farmer.addProject', compact('projectactive', 'details'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $project = new Project();
        $project->pid = $request['sku'];
        $project->name = $request['name'];
        $project->fruit = $request['fruit'];
        $project->species = $request['species'];
        $project->description = $request['description'];
        $project->units = $request['units'];
        $project->price = $request['price'];
        $project->season = $request['season'];
        $project->duration = $request['duration'];
        $project->farmer_id = Auth::user()->id;
        if ($request->hasFile('image')) {

            //  Let's do everything here
            if ($request->file('image')->isValid()) {

                //
//                $validated = $request->validate([
//                    'image' => 'mimes:jpeg,png|max:1014',
//                ]);

                $extension = $request->image->extension();
                $filename = $this->generateBarcodeNumber().".".$extension;
                $image = $request->file('image');
                Storage::disk('public')->put($filename,  File::get($image));
                $project->filename = $filename;
            }

        }

        if($project->save()){
            Session::flash('message', 'New Adoption Project has been created successfully!');
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
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Project::find($id);

        if(count(InsuranceApplication::where('project_id', $id)->get()) != 0){
            $application = InsuranceApplication::where('project_id', $id)->get()[0];
            $details->application_id = $application->id;
            $details->insurance_status = $application->status;
            $details->district = $application->district;
            if(count(InsuranceVerification::where('application_id', $application->id)->get()) != 0){
                $verification = InsuranceVerification::where('application_id', $application->id)->get()[0];
                if(count(InsurancePolicy::where('verification_id', $verification->id)->get()) != 0){
                    $policy = InsurancePolicy::where('verification_id', $verification->id)->get()[0];
                    $details->policy_id = $policy->id;

                }
            }
        }
        return view('projectDetails', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request['projectId'];
        if(Project::where('id', $id)->update(['status' => 0])) {
            if(Contribution::where('project_id', $id)->update(['contribution' => 0])) {
                Session::flash('message', 'Project cancelled and amount refunded!');
                Session::flash('class', 'success');
                return redirect('/home');
            }

        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');

    }

    public function delete(Request $request)
    {
        $id = $request['projectId'];
        if(Project::where('id', $id)->update(['status' => 0])) {
            if(Contribution::where('project_id', $id)->update(['contribution' => 0])) {
                Session::flash('message', 'Project cancelled and amount refunded!');
                Session::flash('class', 'success');
                return redirect('/home');
            }

        }
        Session::flash('message', 'Please Try Again!');
        Session::flash('class', 'danger');
        return redirect('/home');

    }


}
