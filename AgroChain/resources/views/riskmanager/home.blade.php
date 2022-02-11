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
                                    <i class="fas fa-rupee-sign"></i>
                                Wallet Balance :  <span id="wallet" class = "text-success font-weight-bold"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-header">Insurance Verification Requests

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
                                                <td class="text-center">
                                                    @if($activeInsuranceApplication->status == 2)
                                                        <div class="badge badge-success">Approved</div>@endif
                                                    @if($activeInsuranceApplication->status == 1)
                                                        <div class="badge badge-success">Verified</div>@endif
                                                    @if($activeInsuranceApplication->status == 0)
                                                        <div class="badge badge-warning">Pending</div>@endif
                                                    @if($activeInsuranceApplication->status == -1)
                                                        <div class="badge badge-danger">Rejected</div>@endif
                                                </td>
                                                @if($activeInsuranceApplication->status == 0)
                                                <td class="text-center">
                                                    <a href="{{route('verifications.index', ['id' => $activeInsuranceApplication->id])}}">
                                                        <button class="btn btn-primary">Initiate Verification
                                                        </button>
                                                    </a>
                                                </td>@else
                                                    <td class="text-center">
                                                        <a href="#">
                                                            <button class="btn btn-primary" disabled>Initiate Verification
                                                            </button>
                                                        </a>
                                                    </td>
                                                @endif
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
                            <div class="card-header">Verified Insurance Requests

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
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($verifiedInsuranceApplications as $verifiedInsuranceApplication)
                                            <tr>
                                                <td class="text-center text-muted">#{{$verifiedInsuranceApplication->id}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$verifiedInsuranceApplication->projects->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">Rs. {{$verifiedInsuranceApplication->cost}}</td>
                                                <td class="text-center">{{$verifiedInsuranceApplication->area}} hectares</td>
                                                <td class="text-center">{{$verifiedInsuranceApplication->fromDate}}</td>
                                                <td class="text-center">{{$verifiedInsuranceApplication->toDate}}</td>
                                                <td class="text-center">{{$verifiedInsuranceApplication->duration}} month(s)</td>
                                                <td class="text-center">Rs. {{$verifiedInsuranceApplication->amount}}</td>
                                                <td class="text-center">
                                                    @if($verifiedInsuranceApplication->status == 2)
                                                        <div class="badge badge-success">Approved</div>@endif
                                                    @if($verifiedInsuranceApplication->status == 1)
                                                        <div class="badge badge-success">Verified</div>@endif
                                                    @if($verifiedInsuranceApplication->status == 0)
                                                        <div class="badge badge-warning">Pending</div>@endif
                                                    @if($verifiedInsuranceApplication->status == -1)
                                                        <div class="badge badge-danger">Rejected</div>@endif
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
                            <div class="card-header">Active Insurances

                            </div>
                            <div class="table-responsive">

                                @if(count($activeInsurances) > 0)
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
                                        @foreach($activeInsurances as $activeInsurance)
                                            <tr>
                                                <td class="text-center text-muted">#{{$activeInsurance->id}}</td>
                                                <td>
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-left flex2">
                                                            <div>{{$activeInsurance->projects->name}}</div>
                                                            {{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">Rs. {{$activeInsurance->cost}}</td>
                                                <td class="text-center">{{$activeInsurance->area}} hectares</td>
                                                <td class="text-center">{{$activeInsurance->fromDate}}</td>
                                                <td class="text-center">{{$activeInsurance->toDate}}</td>
                                                <td class="text-center">{{$activeInsurance->duration}} month(s)</td>
                                                <td class="text-center">Rs. {{$activeInsurance->amount}}</td>
                                                <td class="text-center">
                                                    @if($activeInsurance->status == 2)
                                                        <div class="badge badge-success">Approved</div>@endif
                                                    @if($activeInsurance->status == 1)
                                                        <div class="badge badge-success">Verified</div>@endif
                                                    @if($activeInsurance->status == 0)
                                                        <div class="badge badge-warning">Pending</div>@endif
                                                    @if($activeInsurance->status == -1)
                                                        <div class="badge badge-danger">Rejected</div>@endif
                                                </td>
                                                @if($activeInsurance->status == 0)
                                                    <td class="text-center">
                                                        <a href="{{route('verifications.index', ['id' => $activeInsurance->id])}}">
                                                            <button class="btn btn-primary">Initiate Verification
                                                            </button>
                                                        </a>
                                                    </td>@else
                                                    <td class="text-center">
                                                        <a href="#">
                                                            <button class="btn btn-primary" disabled>Initiate Verification
                                                            </button>
                                                        </a>
                                                    </td>
                                                @endif
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


            </div>


            @endsection
            @push('scripts')
                <script src="{{ asset('js/truffle-contract.js') }}"></script>
                <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
                <script src="{{ asset('js/contract.js') }}"></script>
    @endpush
