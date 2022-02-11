<?php

namespace App\Http\Controllers;

use App\ClaimNotification;
use App\CropRequest;
use App\InsuranceApplication;
use App\InsurancePolicy;
use App\InsuranceVerification;
use App\IssueRecord;
use App\Project;
use App\Farmer;
use App\Contribution;
use App\Withdrawal;
use App\Approval;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Crop;
use Auth;
use Illuminate\Support\Facades\Storage;


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
            $farmers = count(User::where('isAdmin', 0)->get());
            $crops = Crop::orderBy('created_at', 'desc')->get();
            $availableCrops = count(Crop::where('isAvailable', 1)->get());
            $issuedCrops = count(IssueRecord::all());
            $requestedCrops = CropRequest::where('status', 0)->orderBy('created_at', 'desc')->get();
            $verificationProfiles = Farmer::where('verified', 0)->orderBy('created_at', 'desc')->get();
            $verificationRequests = IssueRecord::where('status', 5)->orderBy('created_at', 'desc')->get();
            $verifiedInsuranceApplications = InsuranceVerification::where('status', 1)->get();
            $activeInsuranceApplications = InsurancePolicy::all();
            $dashboardactive = "mm-active";
            return view('admin.home', compact('farmers', 'crops', 'availableCrops', 'requestedCrops', 'issuedCrops', 'verificationRequests', 'verificationProfiles', 'dashboardactive', 'verifiedInsuranceApplications', 'activeInsuranceApplications'));
        }elseif(session('role') == 'riskmanager') {
            $activeInsurances = InsuranceApplication::where('status', 2)->get();
            $activeInsuranceApplications = InsuranceApplication::where('status', 0)->get();
            $verifiedInsuranceApplications = InsuranceApplication::where('status', 1)->get();
            $dashboardactive = "mm-active";
            return view('riskmanager.home', compact('dashboardactive', 'activeInsuranceApplications', 'verifiedInsuranceApplications', 'activeInsurances'));
        }
        elseif(session('role') == 'farmer') {
            $crops = Crop::where('isAvailable', 1)->orderBy('created_at', 'desc')->get();
            $requestedCrops = CropRequest::where('user_id', Auth::user()->id)->whereBetween('status', [-1,0])->orderBy('created_at', 'desc')->get();
            $issuedCrops = IssueRecord::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
            $activeProjects = Project::where('farmer_id', Auth::user()->id)->where('status', 1)->get();
            $cancelledProjects = Project::where('farmer_id', Auth::user()->id)->where('status', 0)->get();
            $requestedWithdrawals = Withdrawal::where('farmer_id', Auth::user()->id)->get();
            $planted = count(IssueRecord::where('user_id', Auth::user()->id)->where('status', 1)->get());
            $harvested = count(IssueRecord::where('user_id', Auth::user()->id)->where('status', 2)->get());
            $shipped = count(IssueRecord::where('user_id', Auth::user()->id)->where('status', 4)->get());
            $verified = count(IssueRecord::where('user_id', Auth::user()->id)->where('status', 3)->get());
            $activeInsuranceApplications = InsuranceApplication::where('farmer_id', Auth::user()->id)->get();

            foreach ($activeProjects as $activeProject){
                if(count(InsuranceApplication::where('farmer_id', Auth::user()->id)->where('project_id', $activeProject->id)->where('status', 3)->get()) != 0){
                    $activeProject->isInsured = 1;
                }else {
                    $activeProject->isInsured = 0;

                }
            }

            foreach ($activeInsuranceApplications as $activeInsuranceApplication){
                if(count(InsuranceVerification::where('application_id', $activeInsuranceApplication->id)->where('status', 2)->get()) != 0){
                    $verificationId = InsuranceVerification::where('application_id', $activeInsuranceApplication->id)->where('status', 2)->get(['id'])[0]->id;
                    if(count(InsurancePolicy::where('verification_id', $verificationId)->get()) != 0) {
                        $policyId = InsurancePolicy::where('verification_id', $verificationId)->get(['id'])[0]->id;
                        $activeInsuranceApplication->policy_id = $policyId;
                    }
                }
            }
            foreach ($activeInsuranceApplications as $activeInsuranceApplication){
                if(count(ClaimNotification::where('application_id', $activeInsuranceApplication->id)->where('farmer_id', Auth::user()->id)->get()) != 0){
                    $claim = ClaimNotification::where('application_id', $activeInsuranceApplication->id)->where('farmer_id', Auth::user()->id)->get()[0];
                    $activeInsuranceApplication->spi1 = $claim->spi1;
                    $activeInsuranceApplication->spi3 = $claim->spi3;
                    $activeInsuranceApplication->claim_status = $claim->status;
                }
            }
            $verified += $shipped;
            $dashboardactive = "mm-active";
            return view('farmer.home', compact('crops', 'requestedCrops', 'issuedCrops', 'activeProjects', 'cancelledProjects', 'requestedWithdrawals', 'planted', 'harvested', 'verified', 'shipped', 'dashboardactive', 'activeInsuranceApplications'));
        }else{
            //Selects all the projects in which the user is involved
            $contributedProjects = Contribution::where('user_id', Auth::user()->id)->get();

            //Array of project ids in which the user is involved
            $projectids = [];
            foreach ($contributedProjects as $contributedProject){
                array_push($projectids, $contributedProject['project_id']);
            }

            //Selects all the withdraws of all projects in which the user is involved
            $requestedWithdrawals = Withdrawal::whereIn('project_id', $projectids)->get();
            $withdrawalids = [];
            foreach ($requestedWithdrawals as $requestedWithdrawal){
                array_push($withdrawalids, $requestedWithdrawal['id']);
            }

            //Selects all the approvals of withdraws of all projects in which the user is involved
            $approvedWithdrawals = Approval::where('user_id', Auth::user()->id)->whereIn('withdrawal_id', $withdrawalids)->get();

             //For the activation of the links in the sidebar
            $dashboardactive = "mm-active";
            return view('user.home', compact('contributedProjects', 'requestedWithdrawals', 'approvedWithdrawals'));
        }
    }

    public function welcome(){
        $activeProjects = Project::where('status', 1)->get();
        return view('welcome', compact('activeProjects'));
    }

    public function profile(){
        $details = Farmer::where('user_id',Auth::user()->id)->first();
        $profileactive = "mm-active";
        return view('farmer.profile', compact('details', 'profileactive'));

    }

}
