@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$planted}}</h5>
                        <p class="card-text">Total Planted Crops</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$harvested}}</h5>
                        <p class="card-text">Harvested</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$verified}}</h5>
                        <p class="card-text">Verified</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$shipped}}</h5>
                        <p class="card-text">Shipped</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="text-left">
                    <h3 class="my-4 text-left">Requested Crops</h3>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ml-auto">
                        <div class="card">
                            <div class="card-header">Crops List</div>

                            <div class="card-body">
                                @if(count($requestedCrops) > 0)
                                    <table class="table" id="table">
                                        <tr>
                                            <th>Crop Name</th>
                                            <th>Quantity</th>
                                            <th>Requested Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        @foreach($requestedCrops as $requestedCrop)
                                            <tr>
                                                <td>{{$requestedCrop->crops->name}}</td>
                                                <td>{{$requestedCrop->quantity}}</td>
                                                <td>{{$requestedCrop->created_at}}</td>
                                                <td>
                                                    @if($requestedCrop->status == 1) <strong class="btn-success p-1">Approved</strong>@endif
                                                    @if($requestedCrop->status == 0) <strong class="btn-warning p-1">Pending</strong>@endif
                                                    @if($requestedCrop->status == -1) <strong class="btn-danger p-1">Rejected</strong>@endif
                                                </td>
                                                <td>
                                                @if($requestedCrop->status == 0)
                                                    <form action="{{route('croprequests.destroy', ['id' => $requestedCrop->id])}}" method="post">
                                                        @csrf
                                                        <input name="_method" type="hidden" value="DELETE">

                                                        <button class="btn btn-danger p-1" type="submit">Cancel Request</button>
                                                    </form>
                                                    @else
                                                    <a href="#"><button class="btn btn-primary p-1" @if($requestedCrop->status == -1)disabled @endif>View Details</button></a>
                                                @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <div class="card p-3 text-center border-danger">No Records Found!!!</div>
                                        @endif
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row mt-5" id="recentTransactions">
            <div class="col-md-12">
                <div class="text-left">
                    <h3 class="my-4 text-left">Issued Crops</h3>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ml-auto">
                        <div class="card">
                            <div class="card-header">Crops List</div>

                            <div class="card-body">
                                @if(count($issuedCrops) > 0)
                                    <table class="table" id="table">
                                        <tr>
                                            <th>Crop Token</th>
                                            <th>Crop Name</th>
                                            <th>Quantity</th>
                                            <th>Updated Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        @foreach($issuedCrops as $issuedCrop)
                                            <tr>
                                                <td>{{$issuedCrop->token}}</td>
                                                <td>{{$issuedCrop->requests->crops->name}}</td>
                                                <td>{{$issuedCrop->requests->quantity}}</td>
                                                <td>{{$issuedCrop->updated_at}}</td>
                                                <td>
                                                    @if($issuedCrop->status == 0)
                                                        <strong class="btn-success p-1" id="state">Issued</strong>
                                                    @elseif($issuedCrop->status == 1)
                                                        <strong class="btn-success p-1" id="state">Planted</strong>
                                                    @elseif($issuedCrop->status == 2)
                                                        <strong class="btn-success p-1" id="state">Harvested</strong>
                                                    @elseif($issuedCrop->status == 5)
                                                        <strong class="btn-danger p-1" id="state">Not Verified</strong>
                                                    @elseif($issuedCrop->status == 3)
                                                        <strong class="btn-success p-1" id="state">Verified</strong>
                                                    @elseif($issuedCrop->status == 4)
                                                        <strong class="btn-success p-1" id="state">Shipped</strong>
                                                        @else($issuedCrop->status == -1)
                                                            <strong class="btn-danger p-1" id="state">Verification Failed</strong>

                                                    @endif
                                                </td>
                                                <td>
                                                    @if($issuedCrop->status == 0)
                                                        <a href="#" onclick="event.preventDefault(); App.plantCrop({{$issuedCrop->token}},{{$issuedCrop->id}});"><button class="btn btn-primary p-1" >Plant Crop</button></a>
                                                    @elseif($issuedCrop->status == 1)
                                                        <a href="#" onclick="event.preventDefault(); App.harvestCrop({{$issuedCrop->token}},{{$issuedCrop->id}});"><button class="btn btn-primary p-1" >Harvest Crop</button></a>
                                                    @elseif($issuedCrop->status == 2)
                                                        <a href="{{route('issuerecords.edit', ['id' => $issuedCrop->id])}}"><button class="btn btn-primary p-1" >Request Verify</button></a>
                                                    @elseif($issuedCrop->status == 4)
                                                        <form method="post" action="{{route('crop.track')}}">
                                                                @csrf
                                                                        <input id="token" type="hidden" class="form-control" name="token" value="{{$issuedCrop->token}}">
                                                                <input  class="btn btn-primary" type="submit" value="View Details">
                                                        </form>

                                                    @else
                                                        <a href="#" onclick="event.preventDefault(); App.shipCrop({{$issuedCrop->token}},{{$issuedCrop->id}});"><button class="btn btn-primary p-1" @if($issuedCrop->status == 5 || $issuedCrop->status == -1) disabled @endif>Ship Crop</button></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <div class="card p-3 text-center border-danger">No Records Found!!!</div>
                                        @endif
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="container">
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-12 ml-auto mr-5">
                            <div class="card">
                                <h5 class="card-header font-weight-bold">Active Crowdfarming Projects</h5>

                                <div class="card-body">
                                    @if(count($activeProjects) > 0)
                                        <div class="table-responsive">
                                            <table class="table" id="table">
                                                <thead>
                                                <tr>
                                                    <th>Project ID</th>
                                                    <th>Project Name</th>
                                                    <th>Crop Name</th>
                                                    <th>Units</th>
                                                    <th>Price (per unit)</th>
                                                    <th>Season</th>
                                                    <th>Duration</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($activeProjects as $activeProject)
                                                    <tr>
                                                        <td>#{{$activeProject->id}}</td>
                                                        <td>{{$activeProject->name}}</td>
                                                        <td>{{$activeProject->fruit}}</td>
                                                        <td>{{$activeProject->units}}</td>
                                                        <td>Rs. {{$activeProject->price}}</td>
                                                        <td>{{$activeProject->season}}</td>
                                                        <td>{{$activeProject->duration}} days</td>
                                                        <td>@if($activeProject->status == 1) Available @else Unavailable @endif</td>
                                                        <td>
                                                            <a href="{{route('projects.edit', ['id' => $activeProject->id])}}">
                                                                <button class="btn btn-primary"><i class="far fa-eye"></i></button>
                                                            </a>
                                                            <a href="{{route('projects.show', ['id' => $activeProject->id])}}">
                                                                <button class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                                            </a>
                                                            <a href="{{route('projects.destroy', ['id' => $activeProject->id])}}">
                                                                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                @else
                                                    <div class="card p-3 text-center border-danger">No Records Found!!!</div>
                                                @endif

                                            </table>
                                        </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



        <div class="row mt-5">
            <div class="col-md-12">
                <div class="text-left">
                    <h3 class="my-4 text-left">New in Crop Market</h3>
                    @if(count($crops) > 0)
                        <div class="row">
                            @foreach($crops as $crop)
                                <div class="card w-25 m-4 overflow-hidden">
                                    <div class="card-header row ">
                                        <h4 class="m-0 col"><strong>{{$crop->name}}</strong></h4>
                                        @if(!$crop->isAvailable)
                                            <button class="btn btn-warning float-right mr-2 col" disabled>Unavailable
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
                                                <button class="btn btn-success float-right ml-2">Request Crop</button>
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
