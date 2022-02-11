@extends('layouts.userapp')

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

            <div class="row mb-5">
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
                            @if(count($contributedProjects) > 0)
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
                                        <th class="text-center">Contributed Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contributedProjects as $contributedProject)
                                        <tr>
                                            <td class="text-center text-muted">#{{$contributedProject->projects->pid}}</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-left flex2">
                                                        <div>{{$contributedProject->projects->name}}</div>
                                                        {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{$contributedProject->projects->fruit}}</td>
                                            <td class="text-center">Rs. {{$contributedProject->projects->units}}</td>
                                            <td class="text-center">Rs. {{$contributedProject->projects->price}}</td>
                                            <td class="text-center">{{$contributedProject->projects->season}}</td>
                                            <td class="text-center">{{$contributedProject->projects->duration}} years</td>
                                            <td class="text-center">{{$contributedProject->contribution}}</td>
                                            <td class="text-center">@if($contributedProject->projects->status == 1) <span class="badge badge-success">Active</span> @else
                                                <span class="badge badge-danger">Cancelled & Refunded</span> @endif</td>
                                            <td class="text-center">
                                                <a href="{{route('projects.show', ['id' => $contributedProject->projects->id])}}">
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

            <div class="row">
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
                                    @if($requestedWithdrawal->withdrawan == 0)
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
                                            @if(count($approvedWithdrawals) > 0)
                                                @foreach($approvedWithdrawals as $approvedWithdrawal) 
                                                @if(($approvedWithdrawal->withdrawals->id == $requestedWithdrawal->id)) 
                                                <span class="badge badge-success">Approval Given</span> 
                                                @break 
                                                @else
                                                {{-- <a href="{{route('approvals.approve', ['id' => $requestedWithdrawal->id])}}">
                                                    <button class="btn btn-primary">Approve
                                                    </button>
                                                </a>  --}}

                                                <form onsubmit="event.preventDefault(); return App.approveWithdrawal(this);">
                            <input type="hidden" name="project_Id" value="{{$requestedWithdrawal->projects->pid}}">
                            <input type="hidden" name="withdrawal_id" value="{{($requestedWithdrawal->id) - 1}}">
                            <input type="hidden" name="withdrawalid" value="{{$requestedWithdrawal->id}}">
                    
                            <button class="mt-1 btn btn-primary">Approve</button>
                        </form>
                                                {{-- <a href="{{route('approvals.decline', ['id' => $requestedWithdrawal->id])}}">
                                                    <button class="btn btn-danger">Decline
                                                    </button>
                                                </a> --}}
                                                @endif 
                                                @endforeach 
                                                @else
                                                <form onsubmit="event.preventDefault(); return App.approveWithdrawal(this);">
                            <input type="hidden" name="project_Id" value="{{$requestedWithdrawal->projects->pid}}">
                            <input type="hidden" name="withdrawal_id" value="{{($requestedWithdrawal->id) - 1}}">
                            <input type="hidden" name="withdrawalid" value="{{$requestedWithdrawal->id}}">
                    
                            <button class="mt-1 btn btn-primary">Approve</button>
                        </form>
                                                @endif

                                                
                                            </td>
                                        </tr>
                                        @endif
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
                        <div class="card-header">Completed Withdrawals
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
                                    @if($requestedWithdrawal->withdrawan == 1)
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
                                                @foreach($approvedWithdrawals as $approvedWithdrawal) @if($approvedWithdrawal->withdrawals->id == $requestedWithdrawal->id) <span class="badge badge-success">Approval Given</span> @break @endif @endforeach 
                                                @if($approvedWithdrawal->withdrawals->id != $requestedWithdrawal->id)
                                                <a href="{{route('approvals.approve', ['id' => $requestedWithdrawal->id])}}">
                                                    <button class="btn btn-primary">Approve
                                                    </button>
                                                </a>@endif
                                                
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
                        <div class="card-header">Cancelled Withdrawals
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
                                    @if($requestedWithdrawal->withdrawan == -1)
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
                                                @foreach($approvedWithdrawals as $approvedWithdrawal) @if($approvedWithdrawal->withdrawals->id == $requestedWithdrawal->id) <span class="badge badge-success">Approval Given</span> @break @endif @endforeach 
                                                @if($approvedWithdrawal->withdrawals->id != $requestedWithdrawal->id)
                                                <a href="{{route('approvals.approve', ['id' => $requestedWithdrawal->id])}}">
                                                    <button class="btn btn-primary">Approve
                                                    </button>
                                                </a>@endif
                                                
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
        </div>

        

        
@endsection

@push('scripts')
    <script src="{{ asset('js/truffle-contract.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('js/contract.js') }}"></script>
@endpush
