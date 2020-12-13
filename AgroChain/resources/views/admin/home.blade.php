@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{count($crops)}}</h5>
                        <p class="card-text">Total Crops</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$availableCrops}}</h5>
                        <p class="card-text">Available</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title" id="issuedCrops">{{$issuedCrops}}</h5>
                        <p class="card-text">Issued</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$farmers}}</h5>
                        <p class="card-text">Total Farmers</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-5">
            <div class="col-md-12">
                <div class="text-left">
                    <h3 class="my-4 text-left">Request For Crops</h3>
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
                        <div class="card p-5 text-center">
                            <h3 class="m-0">No Records Found!!!</h3>
                        </div>@endif
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="text-left">
                    <h3 class="my-4 text-left">Request for Verification</h3>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 ml-auto">
                        <div class="card">
                            <div class="card-header">Crops List</div>

                            <div class="card-body">
                                @if(count($verificationRequests) > 0)
                                    <table class="table" id="table">
                                        <tr>
                                            <th>Crop Token</th>
                                            <th>Crop Name</th>
                                            <th>Farmer ID</th>
                                            <th>Requested Date</th>
                                            <th>Actions</th>
                                        </tr>
                                        @foreach($verificationRequests as $verificationRequest)
                                            <tr>
                                                <td>{{$verificationRequest->token}}</td>

                                                <td>{{$verificationRequest->requests->crops->name}}</td>
                                                <td>{{$verificationRequest->users->account}}</td>
                                                <td>{{$verificationRequest->created_at}}</td>
                                                <td>
                                                    <a href="#" onclick="event.preventDefault(); App.verifyCrop({{$verificationRequest->token}},{{$verificationRequest->id}});">
                                                        <button class="btn btn-success mr-2" type="submit">Verify</button>
                                                    </a>
                                                    <a href="{{route('issuerecords.reject', ['id' => $verificationRequest->id])}}">
                                                        <button type="button" class="btn btn-danger ">Reject</button>
                                                    </a>

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
                <div class="text-left">
                    <h3 class="my-4 text-left">Recent Crops</h3>
                    @if(count($crops) > 0)
                        <div class="row">
                            @foreach($crops as $crop)
                                <div class="card w-25 m-2 overflow-hidden">
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
