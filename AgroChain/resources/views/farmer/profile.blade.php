@extends('layouts.farmerapp')


@section('content')

    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>Profile Dashboard
                            <div class="page-title-subheading">Update personal information from here.
                            </div>
                        </div>
                    </div>
                    <div class="page-title-actions">
                        <button type="button" data-toggle="tooltip" title="Contact - 01-4439127 for any help"
                                data-placement="bottom"
                                class="btn-shadow mr-3 btn btn-dark">
                            <i class="fa fa-star"></i>
                        </button>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="container emp-profile">
                    <form method="GET" action="{{route('updateuser.edit', Auth::user()->id)}}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-img">
                                    <img src="{{url('uploads/'.Auth::user()->filename)}}" alt=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-head">
                                    <h5>
                                        {{Auth::user()->name}}
                                    </h5>
                                    <h6>
                                        @if(session('role') == 'farmer')
                                            Farmer

                                    </h6>
                                    @if($details == null || $details->verified == 0)
                                        <p class="proile-rating"><i class="fas fa-times-circle text-danger"></i> &nbsp;Unverified @if($details != null)
                                                (Currently under verification process) @else($details == null) (Please
                                                fill your farm details for verification) @endif</p>
                                    @elseif($details->verified == 1)
                                        <p class="proile-rating"><i class="fas fa-check-circle text-success"></i>&nbsp;
                                            Verified</p>
                                    @else
                                        <p class="proile-rating"><i class="fas fa-times-circle text-danger"></i>&nbsp;Rejected
                                            &nbsp; &nbsp;<a
                                                href="{{route('updatefarmer.resubmit', ['id' => Auth::user()->id])}}"
                                                class="btn btn-primary">Resubmit</a>
                                        </p>
                                    @endif
                                    @endif
                                    @if(session('role') == 'user')

                                        <p class="proile-rating"><i class="fas fa-check-circle text-success"></i>&nbsp;
                                            Crowdfarmer</p>
                                    @endif

                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                               role="tab" aria-controls="home" aria-selected="true">Personal
                                                Details</a>
                                        </li>
                                        @if(session('role') == 'farmer')
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                                   role="tab" aria-controls="profile" aria-selected="false">Farm
                                                    Details</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                            </div>
                        </div>

                        <div class="row">
                            @if(session('role') == 'farmer')
                                <div class="col-md-4">
                                    {{-- <div class="profile-work">
                                        <p>RECOGNITIONS</p>
                                        <a href="">Best Orange Producer</a><br/>
                                        <a href="">Largest Farm Owner</a><br/>
                                    </div> --}}
                                </div>
                            @endif
                                @if(session('role') == 'user')
                                    <div class="col-md-4">
                                        {{-- <div class="profile-work">
                                            <p>RECOGNITIONS</p>
                                            <a href="">Best Crowdfarmer</a><br/>
                                            <a href="">Most Tree Adopter</a><br/>
                                        </div> --}}
                                    </div>
                                @endif
                            <div class="col-md-8">
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                         aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Account Address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{Auth::user()->account}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{Auth::user()->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{Auth::user()->email}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if(session('role') == 'farmer')
                                        <div class="tab-pane fade" id="profile" role="tabpanel"
                                             aria-labelledby="profile-tab">
                                            @if($details != null)
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label>Farm Photo</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="profile-img text-left">
                                                            <img src="{{url('uploads/'.$details->filename)}}" alt=""/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Farm Name</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$details->farm_name}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Farm Location</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$details->farm_location}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Contact</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$details->farm_contact}}</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Registration Number</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>{{$details->registration}}</p>
                                                    </div>
                                                </div>
                                                {{-- <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Total Projects</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>230</p>
                                                    </div>
                                                </div> --}}
                                                {{-- <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Experience</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p>Expert</p>
                                                    </div>
                                                </div> --}}
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Farm Bio</label><br/>
                                                        <p>{{$details->description}}</p>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label>Please fill out your farm details and submit for
                                                            verification.</label>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <a class="mt-1 btn btn-primary"
                                                           href="{{route('updateuser.edit', Auth::user()->id)}}">Enter
                                                            Farm
                                                            Details</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>


        @endsection
        @push('scripts')
            <script src="{{ asset('js/truffle-contract.js') }}"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
            <script src="{{ asset('js/contract.js') }}"></script>
    @endpush
