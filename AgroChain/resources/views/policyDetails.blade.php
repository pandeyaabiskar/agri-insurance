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
                            <div>Policy Details
                                <div class="page-title-subheading">View Policy Information Here.
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
                        <img src="{{ url('img/weather-insurance.jpg') }}" alt="" class="mb-1" />
                        <a href="{{route('projects.show', ['id' => $policy->verifications->applications->projects->id])}}">
                            <button type="button" class="btn btn-primary" >
                                View Project
                            </button>
                        </a>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="profile-head">
                        <h5>
                            {{ $policy->verifications->applications->projects->name }}
                        </h5>
{{--                        <h6>--}}
{{--                            {{ $policy->verifications->applications->projects->fruit }}--}}
{{--                        </h6>--}}
                        <p >
                        @if(isset($policy->spi3))
                            @if($policy->spi3 >= 1.0)
                                <div class="badge badge-warning">Flood Detected</div>@endif
                            @if($policy->spi3 <= -1.0)
                                <div class="badge badge-warning">Drought Detected</div>@endif
                        @else
                            @if($policy->status == 3)
                                <div class="badge badge-success">Active</div>@endif
                            @if($policy->status == 2)
                                <div class="badge badge-warning">Premium Pending</div>@endif
                            @if($policy->status == 1)
                                <div class="badge badge-success">Verified</div>@endif
                            @if($policy->status == 0)
                                <div class="badge badge-warning">Pending</div>@endif
                            @if($policy->status == -1)
                                <div class="badge badge-danger">Rejected</div>@endif
                        @endif

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @if(isset($policy->spi3))
                                <li class="nav-item">
                                    <a class="nav-link active" id="claim-tab" data-toggle="tab" href="#claim" role="tab"
                                       aria-controls="home" aria-selected="true">Claim Details</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="@if(isset($policy->spi3))false @else true @endif">Insurance Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Current Weather</a>
                                </li>
                            <li class="nav-item">
                                <a class="nav-link" id="trend-tab" data-toggle="tab" href="#trend" role="tab" aria-controls="trend" aria-selected="false">Climate Trend</a>
                            </li>
                                <li class="nav-item">
                                <a class="nav-link" id="benefit-tab" data-toggle="tab" href="#benefit" role="tab" aria-controls="benefit" aria-selected="false">Payout Details</a>
                                </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3" style="position: absolute; right:0px">
                    <div class="row">
                        <div class="col-md-12 m-auto">
                    <div class="page-title-actions">
                        <button type="button" data-toggle="tooltip" title="Balance in Ether"
                                data-placement="bottom"
                                class="btn-shadow mr-3 btn btn-dark">
                                <i class="fas fa-rupee-sign"></i>
                            Policy Balance :  <span id="pwallet" class = "text-success font-weight-bold"></span>
                        </button>
                    </div>
                </div>



            </div>

                </div>
            </div>

            <div class="row">
{{--                <div class="col-md-3">--}}
{{--                    <div class="profile-work">--}}
{{--                        <a href="{{route('projects.show', ['id' => $policy->verifications->applications->projects->id])}}">--}}
{{--                        <button type="button" class="btn mr-2 mb-2 btn-primary" >--}}
{{--                            View Project--}}
{{--                        </button>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-12">
                    <div class="tab-content profile-tab" id="myTabContent">
                        @if($policy->spi3)
                            <div class="tab-pane fade show active" id="claim" role="tabpanel" style="margin-left: 300px" aria-labelledby="home-tab">
                                @if ($policy != null)

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Calculated Standarized Precipitation Index</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $policy->spi3}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Severity</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>@if($policy->spi3 > 1.0)
                                                    @if($policy->spi3 > 1.0 && $policy->spi3 < 2.0)
                                                        Moderate Flood
                                                        @else Extreme Flood
                                                    @endif

                                                @elseif($policy->spi3 < -1.0)
                                                        @if($policy->spi3 < -1.0 && $policy->spi3 > -2.0)
                                                            Moderate Drought
                                                        @else Extreme Drought
                                                    @endif

                                                @endif</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Eligible Payout Percent</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>@if($policy->spi3 > 1.0)
                                                    @if($policy->spi3 > 1.0 && $policy->spi3 < 2.0)
                                                        50%
                                                    @else 100%
                                                    @endif

                                                @elseif($policy->spi3 < -1.0)
                                                        @if($policy->spi3 < -1.0 && $policy->spi3 > -2.0)
                                                            50%
                                                        @else 100%
                                                    @endif

                                                @endif</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Eligible Payout Amount</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Rs. @if($policy->spi3 > 1.0)
                                                    @if($policy->spi3 > 1.0 && $policy->spi3 < 2.0)
                                                {{50/100 * $policy->amount}}
                                                    @else {{100/100 * $policy->amount}}
                                                @endif
                                                    @elseif($policy->spi3 < -1.0)
                                                        @if($policy->spi3 < -1.0 && $policy->spi3 > -2.0)
                                                            {{50/100 * $policy->amount}}
                                                        @else {{100/100 * $policy->amount}}
                                                    @endif
                                                        @endif</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Action</label>
                                        </div>
                                        <div class="col-md-6">
                                            @if($policy->claim_status == 0)
                                            <form onsubmit="event.preventDefault(); return App.claimInsurance(this);">
                                                <input type="hidden" name="notification_id" value="{{$policy->notification_id}}">
                                                <input type="hidden" name="policy_id" value="{{$policy->id}}">

                                                @if($policy->spi3 > 1.0)
                                                    <input type="hidden" name="timestamp" value="1">
                                                    @if($policy->spi3 > 1.0 && $policy->spi3 < 2.0 )
                                                        <input type="hidden" name="result" value="2">
                                                    @else
                                                        <input type="hidden" name="result" value="3">
                                                    @endif
                                                    <input type="hidden" name="isFlood" value="true">
                                                    <input type="hidden" name="isDrought" value="false">

                                                @elseif($policy->spi3 < -1.0)
                                                    <input type="hidden" name="timestamp" value="1">
                                                    @if($policy->spi3 < -1.0 && $policy->spi3 > -2.0 )
                                                        <input type="hidden" name="result" value="2">
                                                    @else
                                                        <input type="hidden" name="result" value="3">
                                                    @endif
                                                    <input type="hidden" name="isFlood" value="false">
                                                    <input type="hidden" name="isDrought" value="true">
                                                    @endif

                                                <button class="mt-1 btn btn-primary">Claim Insurance</button>
                                            </form>
                                            @else
                                                <button class="mt-1 btn btn-warning" disabled>Insurance Claimed</button>
                                            @endif
                                        </div>
                                    </div>


                                @endif
                            </div>
                            @endif
                        <div class="tab-pane fade show" id="home" role="tabpanel" style="margin-left: 300px" aria-labelledby="home-tab">
                            @if ($policy != null)
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Location</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $policy->verifications->applications->district }} (Lat : {{ $policy->verifications->applications->lat }}, Lon : {{ $policy->verifications->applications->lon }})</p>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Area Insured (in Hectares)</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $policy->verifications->applications->area }}</p>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Initial Cost of Production</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Rs. {{ $policy->verifications->applications->cost }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Insurance Amount</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Rs. {{ $policy->amount }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Premium (5% of Insurance Amount)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Rs. {{ $policy->premium }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Insurance Coverage Period</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>{{ $policy->verifications->applications->fromDate }} - {{ $policy->verifications->applications->toDate }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Insurance Type</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Weather Index Based</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Insurance Coverage Type</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Flood, Drought and Frost</p>
                                    </div>
                                </div>

                            @endif
                        </div>
                        <div class="tab-pane fade show" id="profile" role="tabpanel" style="margin-left: 300px" aria-labelledby="home-tab">
{{--                            @if ($details != null)--}}
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-md-8 col-sm-12 col-xs-12">
                                        <div class="card text-white" style=" border-radius: 15px;
    color: #6f707d">
                                            <div class="div1 p-4 p-md-5 " style="background: url('https://i.imgur.com/sTfvzrM.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: local;
    border-radius: 16px 16px 0 0">
                                                <h5>{{ $policy->verifications->applications->district }}</h5>
                                                <h1 style="font-size: 65px" id="temp"></h1>
                                                <p class="my-0" style="color: white">Feels like <span id="feels-like"></span></p>
                                                <h4 class="my-0" style="color: white" id="description"></h4>
                                            </div>
                                            <div class="div2" style="height: 30px;
    background-color: #9fe0fa;
    border-radius: 0 0 15px 15px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

{{--                            @endif--}}
                        </div>
                        <div class="tab-pane fade show" id="trend" role="tabpanel" aria-labelledby="trend-tab">


                            <canvas id="myChart1" width="400" height="200"></canvas>
                            <canvas id="myChart2" width="400" height="200" class="mt-4"></canvas>

                            {{--                            <button class="btn btn-primary text-white" data-toggle="modal" data-target="#chartModal" style="width:100px; float:right">View Fullscreen</button>--}}
                        </div>
                        <div class="tab-pane fade show" id="benefit" role="tabpanel" style="margin-left: 300px"  aria-labelledby="home-tab">
                            <h2>Flood & Drought</h2>
                            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Standarized Precipitation Index</th>
      <th scope="col">Interpretation</th>
      <th scope="col">Payout</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>2.00 and above</td>
      <td>Extremely Wet</td>
      <td>100%</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>1.50 - 1.99</td>
      <td>Severely Wet</td>
      <td>50%</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>1.00 - 1.49</td>
      <td>Moderately Wet</td>
      <td>0%</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>-0.99 - 0.99</td>
        <td>Near Normal</td>
        <td>0%</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>-1.00 - -1.49</td>
        <td>Moderate Drought</td>
        <td>0%</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>-1.50 - -1.99</td>
        <td>Severe Drought</td>
        <td>50%</td>
    </tr>
    <tr>
        <th scope="row">3</th>
        <td>-2.00 and less</td>
        <td>Extreme Drought</td>
        <td>100%</td>
    </tr>
  </tbody>
</table>
                            <h2>Frost</h2>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Temperature</th>
                                    <th scope="col">Interpretation</th>
                                    <th scope="col">Payout</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Below -5&deg; C</td>
                                    <td>Extreme Frost</td>
                                    <td>100%</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>-5&deg; C to 2&deg; C </td>
                                    <td>Severe Frost</td>
                                    <td>50%</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
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
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function(){
            setTimeout(function(){ App.getPolicyBalance({{$policy->id}})}, 2000);
        });

    </script>
                    <script>
                        $(function(){
                            fetch('http://api.weatherapi.com/v1/current.json?key=f2134f7f7bcb4eae9e4165332220402 &q=' + {{ $policy->verifications->applications->lat }} + ',' + {{ $policy->verifications->applications->lon }} + '&aqi=no')
                                .then(response => response.json())
                                .then(data => {
                                    $('#temp').html(data.current.temp_c + '<sup style="font-size: 17px;\n' +
                                        '    position: relative;\n' +
                                        '    top: -2rem">°C </sup> ');
                                    $('#feels-like').text(data.current.feelslike_c);
                                    $('#description').text(data.current.condition.text);
                                    console.log(data)
                                });
                        });

                    </script>
                    <script>
                        const data = @json($spi_data);
                        const ctx = document.getElementById('myChart1');
                        const ctx1 = document.getElementById('myChart2');
                        const myChart1 = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data[1],
                                datasets: [{
                                    label: '# Standarized Precipitation Index 1',
                                    data: data[6],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'SPI Trend of {{$policy->verifications->applications->district}}'
                                    }
                                }
                            }
                        });
                        const myChart2 = new Chart(ctx1, {
                            type: 'line',
                            data: {
                                labels: data[1],
                                datasets: [{
                                    label: '# Standarized Precipitation Index 3',
                                    data: data[7],
                                    backgroundColor: [
                                        'rgba(54, 162, 235, 0.2)',
                                    ],
                                    borderColor: [
                                        'rgba(54, 162, 235, 1)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'SPI Trend of {{$policy->verifications->applications->district}}'
                                    }
                                }
                            }
                        });

                    </script>
@endpush
