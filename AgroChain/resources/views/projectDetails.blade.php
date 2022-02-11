@if (session('role') == 'farmer') @php($app = 'layouts.farmerapp') @else @php($app =
    'layouts.app')
@endif

@extends($app)


@section('content')
    @if (session('role') == 'farmer')
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>Project Details
                                <div class="page-title-subheading">View Project Information Here.
                                </div>
                            </div>
                        </div>
                        <div class="page-title-actions">
                            <button type="button" data-toggle="tooltip" title="Contact - 01-4439127 for any help"
                                data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                                <i class="fa fa-star"></i>
                            </button>
                        </div>
                    </div>
                </div>
    @endif

    <div class="row">
        <div class="container emp-profile">
            <div class="row">
                <div class="col-md-3">
                    <div class="profile-img">
                        <img src="{{ url('uploads/' . $details->filename) }}" class="mb-1" alt="" />
                        @if(isset($details->policy_id) && isset($details->district))
                        <a href="{{route('policy.details', ['id' => $details->policy_id, 'district' => $details->district, 'application_id' => $details->application_id])}}">
                            <button type="button" class="btn btn-primary" >
                                View Insurance
                            </button>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="profile-head">
                        <h5>
                            {{ $details->name }}
                        </h5>
                        <p >
                        @if(isset($details->insurance_status))
                        @if($details->insurance_status == 3)
                            <div class="badge badge-success">Insured</div>@endif

                                @else<div class="badge badge-danger">Not Inured</div> @endif</p>
                        <p class="proile-rating">{{ $details->description }}</p>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">Project Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Project Status</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" id="benefit-tab" data-toggle="tab" href="#benefit" role="tab" aria-controls="benefit" aria-selected="false">Contribution Benefits</a>
                                </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-6 m-auto text-right">
                            @if($details->status == 1)
                            @guest
                            <a href="{{ route('login') }}"><button class="profile-edit-btn bg-danger text-white">Contribute</button></a>
                            @endguest
                            @if(session('role') == 'user')
                            <button class="profile-edit-btn bg-danger text-white" data-toggle="modal" data-target="#contributeModal">Contribute</button>
                            @endif
                            @else
                            <span class="badge badge-danger">Cancelled</span>
                            @endif
                        </div>
                        <div class="col-md-6 m-auto">
                    <div class="page-title-actions">
                        <button type="button" data-toggle="tooltip" title="Balance in Ether"
                                data-placement="bottom"
                                class="btn-shadow mr-3 btn btn-dark">
                                <i class="fas fa-rupee-sign"></i>
                            Project Balance :  <span id="pwallet" class = "text-success font-weight-bold"></span>
                        </button>
                    </div>
                </div>



            </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    {{-- <div class="profile-work">
                        <p></p>
                        <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Basic Modal
                        </button>
                    </div> --}}
                </div>
                <div class="col-md-9">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @if ($details != null)
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Target Amount</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Rs. {{ $details->units }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Minimum Investment Amount</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Rs.{{ $details->price }}</p>
                                    </div>
                                </div>
{{--                                <div class="row">--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <label>Season</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <p>{{ $details->season }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Project Validity</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $details->duration }} years</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Total Contributors</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $details->contributors }} </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="home-tab">
                            @if ($details != null)
                            <div class="main-card mb-3 card">
                                <div class="card-body"><h5 class="card-title">Fund Progress</h5>
                                    <div class="text-center"><strong class="text-success">Rs. {{$details->balance}}</strong> of <strong>Rs. {{$details->units}}</strong></div>
                                    <div class="mb-3 progress">
                                        <div class="progress-bar bg-success progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="{{$details->balance}}" aria-valuemin="0" aria-valuemax="{{$details->units}}" style="width: {{($details->balance / $details->units) * 100}}%;"></div>
                                    </div>
                                </div>
                            </div>

                            @endif
                        </div>
                        <div class="tab-pane fade show" id="benefit" role="tabpanel" aria-labelledby="home-tab">
                            @if ($details != null)
                            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Contribution</th>
      <th scope="col">Fruits From</th>
      <th scope="col">For</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Rs {{$details->price}}</td>
      <td>2 trees</td>
      <td>2 years</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Rs {{$details->price}} to {{($details->units) / 2}}</td>
      <td>3 trees</td>
      <td>3 years</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>More than Rs {{($details->units) / 2}}</td>
      <td>5 trees</td>
      <td>5 years</td>
    </tr>
  </tbody>
</table>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('role') == 'farmer')
    <div class="row">
        <div class="col-md-10 m-auto">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Withdrawal Form</h5>
                    <div class="collapse" id="collapseExample123">

                            @if($details->balance != 0)
                            <form onsubmit="event.preventDefault(); return App.requestWithdrawal(this);">
                        {{-- <form method="post" action="{{route('withdrawals.store')}}" enctype="multipart/form-data">
                            @csrf --}}
                            <div class="position-relative form-group"><label for="amount" class="">Withdrawal Amount</label><input name="amount" id="amount" type="number" class="form-control"></div>
                            <div class="position-relative form-group"><label for="description" class="">Description</label><input name="description" id="description" placeholder="Request Description" type="text" class="form-control"></div>
                            <input type="hidden" name="recipient_id" value="{{Auth::user()->account}}">
                            <input type="hidden" name="project_Id" value="{{$details->pid}}">
                            <input type="hidden" name="projectId" value="{{$details->id}}">

                            <div class="position-relative form-group"><label for="receipt" class="">Receipt Image</label><input name="image" id="receipt" type="file" class="form-control-file">
                                <small class="form-text text-muted">Image of receipt for which the withdrawal has been requested.</small>
                            </div>
                            <button class="mt-1 btn btn-primary">Submit</button>
                        </form>
                        @else
                        <h6 class="text-danger p-3">No Balance in the project for Withdrawal. Please check back later.</h6>
                        @endif
                        </div>
                </div>
                <div class="card-footer">
                    <button type="button" data-toggle="collapse" href="#collapseExample123" class="btn btn-danger">Request Withdrawal</button>
                </div>
            </div>
        </div>
    </div>
    @endif


    </div>
    <div class="modal fade" id="contributeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form onsubmit="event.preventDefault(); return App.contribute(this);">
                {{-- <form method="post" action="{{route('contributions.store')}}">
                    @csrf --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Invest in {{$details->name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="bprojectId" value="{{$details->pid}}">
                    <input type="hidden" name="projectId" value="{{$details->id}}">
                        <div class="position-relative form-group"><label for="exampleEmail" class="">Investment</label><input name="investment" id="exampleEmail" placeholder="Min. {{$details->price}}" type="number" class="form-control" min="{{$details->price}}" required></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <script>
        $(function(){
            console.log("HELLO");
            setTimeout(function(){ App.getBalance({{$details->pid}})}, 1000);
        });
    </script>
    <script>
        if ( window.history.replaceState ) {
          window.history.replaceState( null, null, window.location.href );
        }
        </script>
@endpush
