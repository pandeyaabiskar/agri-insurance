<?php

namespace App\Http\Controllers;

use App\CropRequest;
use App\IssueRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Crop;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth')->only(['registerLand']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(session('role') == 'admin'){
            $farmers = count(User::all()) - 1;
            $crops = Crop::orderBy('created_at', 'desc')->get();
            $availableCrops = count(Crop::where('isAvailable', 1)->get());
            $issuedCrops = count(IssueRecord::all());
            $requestedCrops = CropRequest::where('status', 0)->orderBy('created_at', 'desc')->get();
            $verificationRequests = IssueRecord::where('status', 5)->orderBy('created_at', 'desc')->get();
            return view('admin.home', compact('farmers', 'crops', 'availableCrops', 'requestedCrops', 'issuedCrops', 'verificationRequests'));
        }else {
            $crops = Crop::where('isAvailable', 1)->orderBy('created_at', 'desc')->limit(4)->get();
            $requestedCrops = CropRequest::where('user_id', Auth::user()->id)->whereBetween('status', [-1,0])->orderBy('created_at', 'desc')->get();
            $issuedCrops = IssueRecord::orderBy('created_at', 'desc')->get();
            $planted = count(IssueRecord::where('status', 1)->get());
            $harvested = count(IssueRecord::where('status', 2)->get());
            $shipped = count(IssueRecord::where('status', 4)->get());
            $verified = count(IssueRecord::where('status', 3)->get());
            $verified += $shipped;
            return view('home', compact('crops', 'requestedCrops', 'issuedCrops', 'planted', 'harvested', 'verified', 'shipped'));
        }
    }


}
