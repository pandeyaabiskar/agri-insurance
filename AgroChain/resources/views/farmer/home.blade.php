@extends('layouts.farmerapp')


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
                                    <i class="fas fa-rupee-sign"></i>
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
                                    <div class="widget-heading">Total Planted Crops</div>
                                    <div class="widget-subheading">Not Harvested</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{$planted}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-arielle-smile">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Harvested Crops</div>
                                    <div class="widget-subheading">This Year's Harvest</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{$harvested}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-grow-early">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Verified Crops</div>
                                    <div class="widget-subheading">Verified by Government</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span>{{$verified}}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content bg-premium-dark">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Plants Sold</div>
                                    <div class="widget-subheading">Revenue streams</div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-warning"><span>Rs 10,000</span></div>
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
                                        <div class="widget-heading">Total Projects</div>
                                        <div class="widget-subheading">Crowdfarming</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-success">{{count($activeProjects)}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-6 col-xl-4">
                        <div class="card mb-3 widget-content">
                            <div class="widget-content-outer">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="widget-heading">Fund Collected</div>
                                        <div class="widget-subheading">From Crowdfarmers</div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-warning">Rs. 15000</div>
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
                                        <div class="widget-heading">Remaining Amount</div>
                                        <div class="widget-subheading"></div>
                                    </div>
                                    <div class="widget-content-right">
                                        <div class="widget-numbers text-danger">Rs. 10000</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
                                                                                                                        <div>{{$activeInsuranceApplication->projects->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">Rs. {{$activeInsuranceApplication->cost}}</td>
                                                <td class="text-center">{{$activeInsuranceApplication->area}} hectares</td>
                                                <td class="text-center">{{$activeInsuranceApplication->fromDate}}</td>
                                                <td class="text-center">{{$activeInsuranceApplication->toDate}}</td>
                                                <td class="text-center">{{$activeInsuranceApplication->duration}} month(s)</td>
                                                <td class="text-center">Rs. {{$activeInsuranceApplication->amount}}</td>
                                                <th class="text-center">Rs. {{5/100 * $activeInsuranceApplication->amount}}</th>
                                                <td class="text-center">
                                                    @if(isset($activeInsuranceApplication->spi3))
                                                    @if($activeInsuranceApplication->spi3 >= 1.0)
                                                        <div class="badge badge-warning">Flood Detected</div>@endif
                                                    @if($activeInsuranceApplication->spi3 <= -1.0)
                                                        <div class="badge badge-warning">Drought Detected</div>@endif
                                                    @else
                                                        @if($activeInsuranceApplication->status == 3)
                                                            <div class="badge badge-success">Active</div>@endif
                                                        @if($activeInsuranceApplication->status == 2)
                                                            <div class="badge badge-warning">Premium Pending</div>@endif
                                                        @if($activeInsuranceApplication->status == 1)
                                                            <div class="badge badge-success">Verified</div>@endif
                                                        @if($activeInsuranceApplication->status == 0)
                                                            <div class="badge badge-warning">Pending</div>@endif
                                                        @if($activeInsuranceApplication->status == -1)
                                                            <div class="badge badge-danger">Rejected</div>@endif
                                                    @endif

                                                </td>
                                                <td class="text-center">
                                                    @if($activeInsuranceApplication->status == 2)
                                                        <form onsubmit="event.preventDefault(); return App.payPremium(this);">
                                                            <input type="hidden" name="premium" value="{{5/100 * $activeInsuranceApplication->amount}}">
                                                            <input type="hidden" name="policy_id" value="{{$activeInsuranceApplication->policy_id}}">
                                                            <input type="hidden" name="application_id" value="{{$activeInsuranceApplication->id}}">


                                                            <button class="mt-1 btn btn-primary">Pay Premium</button>
                                                        </form>
                                                    @endif
                                                    @if($activeInsuranceApplication->status == 3)

                                                        <a href="{{route('policy.details', ['id' => $activeInsuranceApplication->policy_id, 'district' => $activeInsuranceApplication->district, 'application_id' => $activeInsuranceApplication->id])}}">
                                                            <button class="btn btn-primary">
                                                                @if(isset($activeInsuranceApplication->spi3))Take Action @else<i class="far fa-eye"></i>@endif
                                                            </button>
                                                        </a>@endif
                                                    @if($activeInsuranceApplication->status == 0)
                                                        <form
                                                            action="{{route('insurance.destroy', ['id' => $activeInsuranceApplication->id])}}"
                                                            method="post" style="display: inline">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">
                                                            <input type="hidden" name="application_id" value="{{$activeInsuranceApplication->id}}">
                                                            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>

                                                        </form>
                                                    @endif
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
                            <div class="card-header">Active Crowdfarming Projects
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <button class="active btn btn-focus">Last Week</button>
                                        <button class="btn btn-focus">All Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(count($activeProjects) > 0)
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Project Name</th>
                                            <th class="text-center">Crop Name</th>
                                            <th class="text-center">Target Amount</th>
                                            <th class="text-center">Minimum Investment</th>
                                            <th class="text-center">Season</th>
                                            <th class="text-center">Project Validity</th>
                                            <th class="text-center">Fund Collected</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($activeProjects as $activeProject)
                                            <tr>
                                                <td class="text-center text-muted">#{{$activeProject->pid}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$activeProject->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$activeProject->fruit}}</td>
                                                <td class="text-center">Rs. {{$activeProject->units}}</td>
                                                <td class="text-center">Rs. {{$activeProject->price}}</td>
                                                <td class="text-center">{{$activeProject->season}}</td>
                                                <td class="text-center">{{$activeProject->duration}} years</td>
                                                <td class="text-center">Rs. {{$activeProject->balance}}</td>
                                                <td class="text-center"> <span class="badge badge-success">Available</span>
                                                    @if($activeProject->isInsured == 1)
                                                        <div class="badge badge-success">Insured</div>@endif
                                                    @if($activeProject->isInsured == 0)
                                                        <div class="badge badge-danger">Not Insured</div>@endif
                                                    </td>
                                                <td class="text-center">
                                                    <a href="{{route('projects.show', ['id' => $activeProject->id])}}">
                                                        <button class="btn btn-primary"><i class="far fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    {{-- <a href="{{route('projects.edit', ['id' => $activeProject->id])}}">
                                                        <button class="btn btn-warning"><i class="fas fa-edit"></i>
                                                        </button>
                                                    </a> --}}
                                                    <form onsubmit="event.preventDefault(); return App.cancelProject(this);" style="display: inline">
                                                        {{-- <form method="post" action="{{route('projects.destroy', ['id' => $activeProject->id])}}" style="display: inline">
                                                            {{ method_field('DELETE') }} --}}
                                                            @csrf


                                                        <input type="hidden" name="project_Id" value="{{$activeProject->pid}}">
{{--                                                        <input type="hidden" name="projectId" value="{{$activeProject->id}}">--}}

                                                        <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
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
                            <div class="card-header">Cancelled Crowdfarming Projects
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <button class="active btn btn-focus">Last Week</button>
                                        <button class="btn btn-focus">All Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(count($cancelledProjects) > 0)
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Project Name</th>
                                            <th class="text-center">Crop Name</th>
                                            <th class="text-center">Target Amount</th>
                                            <th class="text-center">Minimum Investment</th>
                                            <th class="text-center">Season</th>
                                            <th class="text-center">Project Validity</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cancelledProjects as $cancelledProject)
                                            <tr>
                                                <td class="text-center text-muted">#{{$cancelledProject->pid}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$cancelledProject->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$cancelledProject->fruit}}</td>
                                                <td class="text-center">Rs. {{$cancelledProject->units}}</td>
                                                <td class="text-center">Rs. {{$cancelledProject->price}}</td>
                                                <td class="text-center">{{$cancelledProject->season}}</td>
                                                <td class="text-center">{{$cancelledProject->duration}} years</td>
                                                <td class="text-center">
                                                    <span class="badge badge-danger">Cancelled</span></td>
                                                <td class="text-center">
                                                    <a href="{{route('projects.show', ['id' => $cancelledProject->id])}}">
                                                        <button class="btn btn-primary"><i class="far fa-eye"></i>
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
                            <div class="card-header">Requested Withdrawals
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <button class="active btn btn-focus">Last Week</button>
                                        <button class="btn btn-focus">All Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(count($requestedWithdrawals) > 0)
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Project Name</th>
                                            <th class="text-center">Requested Amount</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Approvals</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($requestedWithdrawals as $requestedWithdrawal)
                                        @if($requestedWithdrawal->projects->status != 0)
                                            <tr>
                                                <td class="text-center text-muted">#{{$requestedWithdrawal->projects->pid}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$requestedWithdrawal->projects->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$requestedWithdrawal->amount}}</td>
                                                <td class="text-center">{{$requestedWithdrawal->description}}</td>
                                                <td class="text-center">{{$requestedWithdrawal->approvals}} / {{$requestedWithdrawal->projects->contributors}}</td>
                                                <td class="text-center">
                                                    @if ($requestedWithdrawal->withdrawan == 0)<span class="badge badge-warning">Pending Approvals</span>
                                                    @elseif($requestedWithdrawal->withdrawan == -1)<span class="badge badge-danger">Declined</span>
                                                    @else<span class="badge badge-success">Accepted</span> @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($requestedWithdrawal->withdrawan == 1) <span class="badge badge-success">Withdrawan</span>
                                                    @elseif($requestedWithdrawal->withdrawan == -1) <span class="badge badge-danger">Request Declined</span>
                                                    @else
                                                    {{-- <a href="{{route('withdrawals.withdraw', ['id' => $requestedWithdrawal->id])}}">
                                                        <button class="btn btn-primary" @if($requestedWithdrawal->approvals < ($requestedWithdrawal->projects->contributors / 2)) disabled  @endif>Withdraw
                                                        </button>
                                                    </a> --}}

                                                    <form onsubmit="event.preventDefault(); return App.finalizeWithdrawal(this);">
                                                        <input type="hidden" name="project_Id" value="{{$requestedWithdrawal->projects->pid}}">
                                                        <input type="hidden" name="withdrawal_id" value="{{($requestedWithdrawal->id) - 1}}">
                                                        <input type="hidden" name="withdrawalid" value="{{$requestedWithdrawal->id}}">

                                                        <button class="mt-1 btn btn-primary" @if($requestedWithdrawal->approvals < ($requestedWithdrawal->projects->contributors / 2)) disabled  @endif>Withdraw</button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
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
                            <div class="card-header">Requested Crops
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <button class="active btn btn-focus">Last Week</button>
                                        <button class="btn btn-focus">All Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(count($requestedCrops) > 0)
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Crop Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Requested Date</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($requestedCrops as $requestedCrop)
                                            <tr>
                                                <td class="text-center text-muted">#{{$requestedCrop->id}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$requestedCrop->crops->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$requestedCrop->quantity}}</td>
                                                <td class="text-center">{{$requestedCrop->created_at}}</td>
                                                <td class="text-center">
                                                    @if($requestedCrop->status == 1)
                                                        <div class="badge badge-success">Approved</div>@endif
                                                    @if($requestedCrop->status == 0)
                                                        <div class="badge badge-warning">Pending</div>@endif
                                                    @if($requestedCrop->status == -1)
                                                        <div class="badge badge-danger">Rejected</div>@endif
                                                </td>
                                                <td class="text-center">
                                                    {{--                                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">--}}
                                                    {{--                                                Details--}}
                                                    {{--                                            </button>--}}
                                                    @if($requestedCrop->status == 0)
                                                        <form
                                                            action="{{route('croprequests.destroy', ['id' => $requestedCrop->id])}}"
                                                            method="post">
                                                            @csrf
                                                            <input name="_method" type="hidden" value="DELETE">

                                                            <button class="btn btn-danger p-1" type="submit">Cancel
                                                                Request
                                                            </button>
                                                        </form>
                                                    @else
                                                        <a href="#">
                                                            <button class="btn btn-primary p-1"
                                                                    @if($requestedCrop->status == -1)disabled @endif>
                                                                View
                                                                Details
                                                            </button>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="card p-3 text-center border-danger">No Records Found!!!</div>
                                @endif
                            </div>
                            {{--                            <div class="d-block text-center card-footer">--}}
                            {{--                                <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i--}}
                            {{--                                        class="pe-7s-trash btn-icon-wrapper"> </i></button>--}}
                            {{--                                <button class="btn-wide btn btn-success">Save</button>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="row mb-5" id="activeProject">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">Issued Crops
                                <div class="btn-actions-pane-right">
                                    <div role="group" class="btn-group-sm btn-group">
                                        <button class="active btn btn-focus">Last Week</button>
                                        <button class="btn btn-focus">All Month</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @if(count($issuedCrops) > 0)
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Crop Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Updated Date</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($issuedCrops as $issuedCrop)
                                            <tr>
                                                <td class="text-center text-muted">#{{$issuedCrop->token}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$issuedCrop->requests->crops->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{$issuedCrop->requests->quantity}}</td>
                                                <td class="text-center">{{$issuedCrop->updated_at}}</td>
                                                <td class="text-center">
                                                    @if($issuedCrop->status == 0)
                                                        <div class="badge badge-success" id="state">Issued</div>
                                                    @elseif($issuedCrop->status == 1)
                                                        <div class="badge badge-success" id="state">Planted</div>
                                                    @elseif($issuedCrop->status == 2)
                                                        <div class="badge badge-success" id="state">Harvested</div>
                                                    @elseif($issuedCrop->status == 5)
                                                        <div class="badge badge-danger" id="state">Not Verified</div>
                                                    @elseif($issuedCrop->status == 3)
                                                        <div class="badge badge-success" id="state">Verified</div>
                                                    @elseif($issuedCrop->status == 4)
                                                        <div class="badge badge-success" id="state">Shipped</div>
                                                    @else($issuedCrop->status == -1)
                                                        <div class="badge badge-danger" id="state">Verification Failed
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($issuedCrop->status == 0)
                                                        <a href="#"
                                                           onclick="event.preventDefault(); App.plantCrop({{$issuedCrop->token}},{{$issuedCrop->id}});">
                                                            <button class="btn btn-primary p-1">Plant Crop</button>
                                                        </a>
                                                    @elseif($issuedCrop->status == 1)
                                                        <a href="#"
                                                           onclick="event.preventDefault(); App.harvestCrop({{$issuedCrop->token}},{{$issuedCrop->id}});">
                                                            <button class="btn btn-primary p-1">Harvest Crop</button>
                                                        </a>
                                                    @elseif($issuedCrop->status == 2)
                                                        <a href="{{route('issuerecords.edit', ['id' => $issuedCrop->id])}}">
                                                            <button class="btn btn-primary p-1">Request Verify</button>
                                                        </a>
                                                    @elseif($issuedCrop->status == 4)
                                                        <form method="post" action="{{route('crop.track')}}">
                                                            @csrf
                                                            <input id="token" type="hidden" class="form-control"
                                                                   name="token" value="{{$issuedCrop->token}}">
                                                            <input class="btn btn-primary" type="submit"
                                                                   value="View Details">
                                                        </form>

                                                    @else
                                                        <a href="#"
                                                           onclick="event.preventDefault(); App.shipCrop({{$issuedCrop->token}},{{$issuedCrop->id}});">
                                                            <button class="btn btn-primary p-1"
                                                                    @if($issuedCrop->status == 5 || $issuedCrop->status == -1) disabled @endif>
                                                                Ship Crop
                                                            </button>
                                                        </a>
                                                    @endif
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
                            <h3 class="my-4 text-left ml-3">New in Crop Market</h3>
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
                                                    <a href="{{route('croprequests.edit', ['id' => $crop->id])}}">
                                                        <button class="btn btn-success float-right ml-2">Request Crop
                                                        </button>
                                                    </a>
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
    @endpush
