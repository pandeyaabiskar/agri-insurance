@extends('layouts.adminapp')


@section('content')

        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="fas fa-leaf"></i></div>
                            <div>Analytics Dashboard
                                <div class="page-title-subheading">Control everything right from here.
                                </div>
                            </div>
                        </div>
                        <div class="page-title-actions">
                            <button type="button" data-toggle="tooltip" title="Balance in Ether"
                                    data-placement="bottom"
                                    class="btn-shadow mr-3 btn btn-dark">
                                    <i class="fab fa-ethereum"></i>
                                Wallet Balance :  <span id="wallet" class = "text-success font-weight-bold"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-midnight-bloom">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Total Crops</div>
                                    <div class="widget-subheading">In Inventory</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{count($crops)}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-arielle-smile">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Available Crops</div>
                                    <div class="widget-subheading">Available For Sale</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{$availableCrops}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-grow-early">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Issued Crops</div>
                                    <div class="widget-subheading">Issued to Farmers</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{$issuedCrops}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-premium-dark">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Registered Farmers</div>
                                    <div class="widget-subheading">Verified for Production</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-warning"><span>{{$farmers}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Total Trees</div>
                                        <div class="widget-subheading">Harvestable</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-success">100</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Trees Adopted</div>
                                        <div class="widget-subheading">By Crowdfarmers</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-warning">15</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Remaining</div>
                                        <div class="widget-subheading">Unadopted Trees</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-danger">85</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Income</div>
                                        <div class="widget-subheading">Expected totals</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-focus">$147</div>
                                    </div>
                                </div>
                                <div class="widget-progress-wrapper">
                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="54"
                                             aria-valuemin="0" aria-valuemax="100" style="width: 54%;"></div>
                                    </div>
                                    <div class="progress-sub-label">
                                        <div class="sub-label-left">Expenses</div>
                                        <div class="sub-label-right">100%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">Active Insurances
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <button class="active btn btn-focus">Last Week</button>
                                        <button class="btn btn-focus">All Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(count($activeInsuranceApplications) > 0)
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Project Name</th>
                                            <th class="text-center">Initial Cost</th>
                                            <th class="text-center">Area Insured</th>
                                            <th class="text-center">Start Date</th>
                                            <th class="text-center">End Date</th>
                                            <th class="text-center">Insurance Period</th>
                                            <th class="text-center">Insurance Amount</th>
                                            <th class="text-center">Premium</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($activeInsuranceApplications as $activeInsuranceApplication)
                                            <tr>
                                                <td class="text-center text-muted">#{{$activeInsuranceApplication->id}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$activeInsuranceApplication->verifications->applications->projects->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">Rs. {{$activeInsuranceApplication->verifications->applications->cost}}</td>
                                                <td class="text-center">{{$activeInsuranceApplication->verifications->area}} hectares</td>
                                                <td class="text-center">{{$activeInsuranceApplication->verifications->applications->fromDate}}</td>
                                                <td class="text-center">{{$activeInsuranceApplication->verifications->applications->toDate}}</td>
                                                <td class="text-center">{{$activeInsuranceApplication->verifications->applications->duration}} month(s)</td>
                                                <td class="text-center">Rs. {{$activeInsuranceApplication->amount}}</td>
                                                <td class="text-center">Rs. {{$activeInsuranceApplication->premium}}</td>

                                                <td class="text-center">
                                                    @if($activeInsuranceApplication->verifications->applications->status == 3)
                                                        <div class="badge badge-success">Paid</div>@endif
                                                    @if($activeInsuranceApplication->verifications->applications->status == 2)
                                                        <div class="badge badge-warning">Premium Pending</div>@endif
                                                    @if($activeInsuranceApplication->status == -1)
                                                        <div class="badge badge-danger">Expired</div>@endif
                                                </td>
                                                <td class="text-center">
                                                    @if($activeInsuranceApplication->isPaid == 0)
                                                    <form onsubmit="event.preventDefault(); return App.loadFund(this);">
                                                        <input type="hidden" name="fund" value="{{$activeInsuranceApplication->amount - $activeInsuranceApplication->premium}}">
                                                        <input type="hidden" name="policy_id" value="{{$activeInsuranceApplication->id}}">


                                                        <button class="mt-1 btn btn-primary">Load Fund</button>
                                                    </form>
                                                    @endif
                                                        @if($activeInsuranceApplication->isPaid == 1)

                                                        <a href="#">
                                                        <button class="btn btn-primary"><i class="far fa-eye"></i>
                                                        </button>
                                                    </a>@endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="card p-3 text-center border-danger">No Records Found!!!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header"> Insurance Approval Requests
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <button class="active btn btn-focus">Last Week</button>
                                        <button class="btn btn-focus">All Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">

                                @if(count($verifiedInsuranceApplications) > 0)
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Project Name</th>
                                            <th class="text-center">Initial Cost</th>
                                            <th class="text-center">Area Insured</th>
                                            <th class="text-center">Start Date</th>
                                            <th class="text-center">End Date</th>
                                            <th class="text-center">Insurance Period</th>
                                            <th class="text-center">Insurance Amount</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($verifiedInsuranceApplications as $verifiedInsuranceApplication)
                                            <tr>
                                                <td class="text-center text-muted">#{{$verifiedInsuranceApplication->id}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$verifiedInsuranceApplication->applications->projects->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">Rs. {{$verifiedInsuranceApplication->applications->cost}}</td>
                                                <td class="text-center">{{$verifiedInsuranceApplication->applications->area}} hectares</td>
                                                <td class="text-center">{{$verifiedInsuranceApplication->applications->fromDate}}</td>
                                                <td class="text-center">{{$verifiedInsuranceApplication->applications->toDate}}</td>
                                                <td class="text-center">{{$verifiedInsuranceApplication->applications->duration}} month(s)</td>
                                                <td class="text-center">Rs. {{$verifiedInsuranceApplication->applications->amount}}</td>
                                                <td class="text-center">
                                                    @if($verifiedInsuranceApplication->applications->status == 2)
                                                        <div class="badge badge-success">Approved</div>@endif
                                                    @if($verifiedInsuranceApplication->applications->status == 1)
                                                        <div class="badge badge-success">Verified</div>@endif
                                                    @if($verifiedInsuranceApplication->applications->status == 0)
                                                        <div class="badge badge-warning">Pending</div>@endif
                                                    @if($verifiedInsuranceApplication->applications->status == -1)
                                                        <div class="badge badge-danger">Rejected</div>@endif
                                                </td>
                                                    <td class="text-center">
                                                        <a href="{{route('policies.index', ['id' => $verifiedInsuranceApplication->applications->id])}}">
                                                            <button class="btn btn-primary">Initiate Approval
                                                            </button>
                                                        </a>
                                                    </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="card p-3 text-center border-danger">No Records Found!!!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">Request for Profile Verification
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <button class="active btn btn-focus">Last Week</button>
                                        <button class="btn btn-focus">All Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(count($verificationProfiles) > 0)
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Farmer ID</th>
                                            <th>Farmer Name</th>
                                            <th class="text-center">Farm Name</th>
                                            <th class="text-center">Farm Location</th>
                                            <th class="text-center">Registration</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($verificationProfiles as $verificationProfile)
                                            <tr>
                                                <td class="text-center text-muted">#{{$verificationProfile->users->account}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$verificationProfile->users->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$verificationProfile->farm_name}}</td>
                                                <td class="text-center">{{$verificationProfile->farm_location}}</td>
                                                <td class="text-center">{{$verificationProfile->registration}}</td>
                                                <td class="text-center">
                                                    <a href="{{route('updatefarmer.accept', ['id' => $verificationProfile->id])}}">
                                                        <button class="btn btn-success mr-2" type="submit">Verify</button>
                                                    </a>
                                                    <a href="{{route('updatefarmer.reject', ['id' => $verificationProfile->id])}}">
                                                        <button type="button" class="btn btn-danger ">Reject</button>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="card p-3 text-center border-danger">No Records Found!!!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5" id="activeProject">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">Request For Crops
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <button class="active btn btn-focus">Last Week</button>
                                        <button class="btn btn-focus">All Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(count($requestedCrops) > 0)
                                    <div class="row">
                                        @foreach($requestedCrops as $requestedCrop)
                                            <div class="card col m-2 overflow-hidden">
                                                <div class="card-header row ">
                                                    <h4 class="m-0 col-md-6"><strong
                                                            id="cropName">{{$requestedCrop->crops->name}}</strong></h4>
                                                </div>
                                                <div class="card-body">
                                                    <form action="{{route('issuerecords.store')}}" method="post" onsubmit="event.preventDefault(); return App.issueCrop(this);">
                                                        @csrf
                                                        <table class="table table-borderless">
                                                            <tr>
                                                                <td><strong>Crop Name :</strong></td>
                                                                <td>
                                                                    <input  type="text" class="form-control" name="crop_name" value="{{$requestedCrop->crops->name}}" required readonly autofocus>
                                                                    <input type="hidden" class="form-control" name="id" value="{{$requestedCrop->id}}" required readonly autofocus>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Farmer ID :</strong></td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="buyer_id" value="{{$requestedCrop->users->account}}" required readonly autofocus>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Quantity :</strong></td>
                                                                <td>
                                                                    <input type="number" class="form-control" name="quantity" value="{{$requestedCrop->quantity}}" required readonly autofocus>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Price :</strong></td>
                                                                <td id="cropPrice">
                                                                    <input type="number" class="form-control" name="price" value="{{$requestedCrop->crops->price}}" required readonly autofocus>
                                                                </td>
                                                            </tr>
                                                        </table>

                                                        <div>
                                                            <a href="{{route('croprequests.reject', ['id' => $requestedCrop->id])}}">
                                                                <button type="button" class="btn btn-danger float-right">Reject</button>
                                                            </a>
                                                            <a href="#">
                                                                <button class="btn btn-success float-right mr-2" type="submit">Issue</button>
                                                            </a>

                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                @else
                                    <div class="card p-3 text-center border-danger">No Records Found!!!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">Request for Verification
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <button class="active btn btn-focus">Last Week</button>
                                        <button class="btn btn-focus">All Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(count($verificationRequests) > 0)
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Crop Token</th>
                                            <th>Crop Name</th>
                                            <th class="text-center">Farmer ID</th>
                                            <th class="text-center">Requested Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($verificationRequests as $verificationRequest)
                                            <tr>
                                                <td class="text-center text-muted">#{{$verificationRequest->token}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$verificationRequest->requests->crops->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$verificationRequest->users->account}}</td>
                                                <td class="text-center">{{$verificationRequest->created_at}}</td>
                                                <td class="text-center">
                                                    <a href="#" onclick="event.preventDefault(); App.verifyCrop({{$verificationRequest->token}},{{$verificationRequest->id}});">
                                                        <button class="btn btn-success mr-2" type="submit">Verify</button>
                                                    </a>
                                                    <a href="{{route('issuerecords.reject', ['id' => $verificationRequest->id])}}">
                                                        <button type="button" class="btn btn-danger ">Reject</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="card p-3 text-center border-danger">No Records Found!!!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="text-left">
                            <h3 class="my-4 text-left ml-3">Recent Crops</h3>
                            @if(count($crops) > 0)
                                <div class="row">
                                    @foreach($crops as $crop)
                                        <div class="card w-25 m-4 overflow-hidden card-shadow-success">
                                            <div class="card-header row ">
                                                <h4 class="m-0 col"><strong>{{$crop->name}}</strong></h4>
                                                @if(!$crop->isAvailable)
                                                    <button class="btn btn-warning float-right mr-2 col" disabled>
                                                        Unavailable
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td><strong>Crop ID :</strong></td>
                                                        <td id="cropId">{{$crop->id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Price :</strong></td>
                                                        <td>Rs. {{$crop->price}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Season :</strong></td>
                                                        <td>{{$crop->season}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Harvest Days :</strong></td>
                                                        <td>{{$crop->harvest_days}} days</td>
                                                    </tr>
                                                </table>
                                                <div>
                                                    @if($crop->isAvailable)
                                                        <a href="{{route('crops.edit', ['id' => $crop->id])}}">
                                                            <button class="btn btn-warning float-right">Mark Unavailable
                                                            </button>
                                                        </a>
                                                    @else
                                                        <a href="{{route('crops.available', ['id' => $crop->id])}}">
                                                            <button class="btn btn-success float-right">Make Available
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                            @else
                                <div class="card p-5 text-center">
                                    <h3 class="m-0">No Records Found!!!</h3>
                                </div>@endif
                        </div>
                    </div>
                </div>


            </div>


            @endsection
            @push('scripts')
                <script src="{{ asset('js/truffle-contract.js') }}"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
                <script src="{{ asset('js/contract.js') }}"></script>
                <script>
                    $(window).on('load', function () {
                        App.skuCountForAdmin();

                    });
                </script>
    @endpush
