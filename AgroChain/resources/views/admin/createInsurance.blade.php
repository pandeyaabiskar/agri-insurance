@extends('layouts.farmerapp')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div>Insurance Approval
                            <div class="page-title-subheading">Policy Creation Form
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
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Insurance Details for {{$activeInsuranceApplications[0]->projects->name}}
                            <div class="btn-actions-pane-right">

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-border border-light">
                                <thead class="border-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"><strong>Submitted Details</strong></th>
                                    <th scope="col"><strong>Verified Details</strong></th>
                                    <th scope="col"><strong>Result</strong></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Crop Name</th>
                                    <td>{{$activeInsuranceApplications[0]->projects->fruit}}</td>
                                    <td>{{$verifiedInsuranceApplications[0]->fruit}}</td>
                                    <td>@if($activeInsuranceApplications[0]->projects->fruit == $verifiedInsuranceApplications[0]->fruit)<i class="fas fa-check text-success"></i>@else<i class="fas fa-times text-danger"></i>@endif</td>
                                </tr>
                                <tr>
                                    <th scope="row">Species</th>
                                    <td>{{$verifiedInsuranceApplications[0]->species}}</td>
                                    <td>{{$verifiedInsuranceApplications[0]->species}}</td>
                                    <td>@if($verifiedInsuranceApplications[0]->species == $verifiedInsuranceApplications[0]->species)<i class="fas fa-check text-success"></i>@else<i class="fas fa-times text-danger"></i>@endif</td>
                                </tr>
                                <tr>
                                    <th scope="row">Production Area (in Hectares)</th>
                                    <td>{{$activeInsuranceApplications[0]->area}}</td>
                                    <td>{{$verifiedInsuranceApplications[0]->area}}</td>
                                    <td>@if($activeInsuranceApplications[0]->area == $verifiedInsuranceApplications[0]->area)<i class="fas fa-check text-success"></i>@else<i class="fas fa-times text-danger"></i>@endif</td>
                                </tr>
                                <tr>
                                    <th scope="row">Cost of Production (in NPR)</th>
                                    <td>{{$activeInsuranceApplications[0]->cost}}</td>
                                    <td>{{$verifiedInsuranceApplications[0]->cost}}</td>
                                    <td>@if($activeInsuranceApplications[0]->cost == $verifiedInsuranceApplications[0]->cost)<i class="fas fa-check text-success"></i>@else<i class="fas fa-times text-danger"></i>@endif</td>
                                </tr>

                                <tr>
                                    <th scope="row">Are the crops in good condition?</th>
                                    <td></td>
                                    <td></td>
                                    <td>@if($verifiedInsuranceApplications[0]->condition == "1")<i class="fas fa-check text-success"></i>@else<i class="fas fa-times text-danger"></i>@endif</td>
                                </tr>
                                <tr>
                                    <th scope="row">Are there any diseases or pests on the crops?</th>
                                    <td></td>
                                    <td></td>
                                    <td>@if($verifiedInsuranceApplications[0]->disease == "1")<i class="fas fa-check text-success"></i>@else<i class="fas fa-times text-danger"></i>@endif</td>
                                </tr>
                                @if($verifiedInsuranceApplications[0]->disease == "1")
                                <tr>
                                    <td colspan="4"><strong>Disease Description</strong><br/> {{$verifiedInsuranceApplications[0]->disease_description}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th scope="row">Do the crops look like being taken good care of?</th>
                                    <td></td>
                                    <td></td>
                                    <td>@if($verifiedInsuranceApplications[0]->care == "1")<i class="fas fa-check text-success"></i>@else<i class="fas fa-times text-danger"></i>@endif</td>
                                </tr>
                                <tr>
                                    <th scope="row">Are there any diseases or pests spreading nearby?</th>
                                    <td></td>
                                    <td></td>
                                    <td>@if($verifiedInsuranceApplications[0]->future_disease == "1")<i class="fas fa-check text-success"></i>@else<i class="fas fa-times text-danger"></i>@endif</td>
                                </tr>
                                @if($verifiedInsuranceApplications[0]->risk != "")
                                    <tr>
                                        <td colspan="4"><strong>Any Other Risk Factors</strong><br/> {{$verifiedInsuranceApplications[0]->risk}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th scope="row">Recommendation for approval of the insurance</th>
                                    <td></td>
                                    <td></td>
                                    <td>@if($verifiedInsuranceApplications[0]->status == "1")<i class="fas fa-check text-success"></i>@else<i class="fas fa-times text-danger"></i>@endif</td>
                                </tr>
                                <tr>
                                    <th scope="row">Verified By</th>
                                    <td></td>
                                    <td></td>
                                    <td>{{$verifiedInsuranceApplications[0]->users->name}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="main-card mb-3 card">--}}
{{--                        <div class="card-header">Farmer's Insurance Details--}}
{{--                            <div class="btn-actions-pane-right">--}}

{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="table-responsive">--}}
{{--                            @if(count($activeInsuranceApplications) > 0)--}}
{{--                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th class="text-center">#</th>--}}
{{--                                        <th>Project Name</th>--}}
{{--                                        <th class="text-center">Initial Cost</th>--}}
{{--                                        <th class="text-center">Area Insured</th>--}}
{{--                                        <th class="text-center">Start Date</th>--}}
{{--                                        <th class="text-center">End Date</th>--}}
{{--                                        <th class="text-center">Insurance Period</th>--}}
{{--                                        <th class="text-center">Insurance Amount</th>--}}
{{--                                        <th class="text-center">Status</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($activeInsuranceApplications as $activeInsuranceApplication)--}}
{{--                                        <tr>--}}
{{--                                            <td class="text-center text-muted">#{{$activeInsuranceApplication->id}}</td>--}}
{{--                                            <td>--}}
{{--                                                <div class="widget-content p-0">--}}
{{--                                                    <div class="widget-content-left flex2">--}}
{{--                                                        <div>{{$activeInsuranceApplication->projects->name}}</div>--}}
{{--                                                        --}}{{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td class="text-center">Rs. {{$activeInsuranceApplication->cost}}</td>--}}
{{--                                            <td class="text-center">{{$activeInsuranceApplication->area}} hectares</td>--}}
{{--                                            <td class="text-center">{{$activeInsuranceApplication->fromDate}}</td>--}}
{{--                                            <td class="text-center">{{$activeInsuranceApplication->toDate}}</td>--}}
{{--                                            <td class="text-center">{{$activeInsuranceApplication->duration}} month(s)</td>--}}
{{--                                            <td class="text-center">Rs. {{$activeInsuranceApplication->amount}}</td>--}}
{{--                                            <td class="text-center">--}}
{{--                                                @if($activeInsuranceApplication->status == 2)--}}
{{--                                                    <div class="badge badge-success">Approved</div>@endif--}}
{{--                                                @if($activeInsuranceApplication->status == 1)--}}
{{--                                                    <div class="badge badge-success">Verified</div>@endif--}}
{{--                                                @if($activeInsuranceApplication->status == 0)--}}
{{--                                                    <div class="badge badge-warning">Pending</div>@endif--}}
{{--                                                @if($activeInsuranceApplication->status == -1)--}}
{{--                                                    <div class="badge badge-danger">Rejected</div>@endif--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            @else--}}
{{--                                <div class="card p-3 text-center border-danger">No Records Found!!!</div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="main-card mb-3 card">--}}
{{--                        <div class="card-header">Verified Insurance Details--}}

{{--                        </div>--}}
{{--                        <div class="table-responsive">--}}
{{--                            @if(count($activeInsuranceApplications) > 0)--}}
{{--                                <table class="align-middle mb-0 table table-borderless table-striped table-hover">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th class="text-center">#</th>--}}
{{--                                        <th>Project Name</th>--}}
{{--                                        <th class="text-center">Initial Cost</th>--}}
{{--                                        <th class="text-center">Area Insured</th>--}}
{{--                                        <th class="text-center">Start Date</th>--}}
{{--                                        <th class="text-center">End Date</th>--}}
{{--                                        <th class="text-center">Insurance Period</th>--}}
{{--                                        <th class="text-center">Insurance Amount</th>--}}
{{--                                        <th class="text-center">Status</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($activeInsuranceApplications as $activeInsuranceApplication)--}}
{{--                                        <tr>--}}
{{--                                            <td class="text-center text-muted">#{{$activeInsuranceApplication->id}}</td>--}}
{{--                                            <td>--}}
{{--                                                <div class="widget-content p-0">--}}
{{--                                                    <div class="widget-content-left flex2">--}}
{{--                                                        <div>{{$activeInsuranceApplication->projects->name}}</div>--}}
{{--                                                        --}}{{--                                                            <div class="widget-subheading opacity-7">Juicy Oranges</div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td class="text-center">Rs. {{$activeInsuranceApplication->cost}}</td>--}}
{{--                                            <td class="text-center">{{$activeInsuranceApplication->area}} hectares</td>--}}
{{--                                            <td class="text-center">{{$activeInsuranceApplication->fromDate}}</td>--}}
{{--                                            <td class="text-center">{{$activeInsuranceApplication->toDate}}</td>--}}
{{--                                            <td class="text-center">{{$activeInsuranceApplication->duration}} month(s)</td>--}}
{{--                                            <td class="text-center">Rs. {{$activeInsuranceApplication->amount}}</td>--}}
{{--                                            <td class="text-center">--}}
{{--                                                @if($activeInsuranceApplication->status == 2)--}}
{{--                                                    <div class="badge badge-success">Approved</div>@endif--}}
{{--                                                @if($activeInsuranceApplication->status == 1)--}}
{{--                                                    <div class="badge badge-success">Verified</div>@endif--}}
{{--                                                @if($activeInsuranceApplication->status == 0)--}}
{{--                                                    <div class="badge badge-warning">Pending</div>@endif--}}
{{--                                                @if($activeInsuranceApplication->status == -1)--}}
{{--                                                    <div class="badge badge-danger">Rejected</div>@endif--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            @else--}}
{{--                                <div class="card p-3 text-center border-danger">No Records Found!!!</div>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="tab-pane fade show" id="trend" role="tabpanel" aria-labelledby="trend-tab">


                <canvas id="myChart1" width="400" height="200"></canvas>
                <canvas id="myChart2" width="400" height="200" class="mt-4"></canvas>

                {{--                            <button class="btn btn-primary text-white" data-toggle="modal" data-target="#chartModal" style="width:100px; float:right">View Fullscreen</button>--}}
            </div>
            <div class="container mb-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <section class="my-5">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col text-center mb-3">
                                                <h1>Insurance Policy Form</h1>

                                            </div>
                                        </div>
                                        <form
{{--                                            method="post" action="{{route('policies.store')}}"--}}
                                              enctype="multipart/form-data"
                                              onsubmit="event.preventDefault(); return App.createInsurance(this)"

                                        >
                                            @csrf

                                                <input id="application" type="hidden" class="form-control"
                                                       name="application_id" value="{{$activeInsuranceApplications[0]->id}}">
                                            <input id="verification" type="hidden" class="form-control"
                                                   name="verification_id" value="{{$verifiedInsuranceApplications[0]->id}}">

                                            <input id="farmer" type="hidden" class="form-control"
                                                   name="farmer_id" value="{{$activeInsuranceApplications[0]->users->account}}">

                                            <div class="form-group row">
                                                <div class="col-md-6 p-0">
                                                    <label for="amount" class="col-form-label text-md-right font-weight-bold">Amount to be Insured</label>
                                                    <input id="amount" type="number" class="form-control"
                                                           name="amount" value="{{$activeInsuranceApplications[0]->amount}}" onkeyup="handlePremiumCalculation(this)">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="premium" class="col-form-label font-weight-bold">Insurance Premium</label>
                                                    <input id="premium" type="number" class="form-control" value="{{5/100 * $activeInsuranceApplications[0]->amount}}"
                                                           name="premium">
                                                    (5% of Amount to be Insured)
                                                </div>
                                            </div>
                                            <input id="starttime" type="hidden" class="form-control"
                                                   name="starttime" value="{{$activeInsuranceApplications[0]->fromDate}}">
                                            <input id="endtime" type="hidden" class="form-control"
                                                   name="endtime" value="{{$activeInsuranceApplications[0]->toDate}}">


                                            <div class="form-group row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck" name="declaration">
                                                    <label class="form-check-label" for="gridCheck">
                                                        I hereby declare that all the information provided are correct and I will bear the responsibility if any provided information are found to be incorrect.
                                                    </label>
                                                </div>
                                            </div>




                                            <div class="row justify-content-start float-right">
                                                <div class="col">
                                                    <a href="{{route('insurance.reject', ['id' => $activeInsuranceApplications[0]->id])}}">
                                                        <button class="btn btn-danger mt-4" type="button">Reject</button>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row justify-content-start float-right  mr-1">
                                                <div class="col">

                                                    <button class="btn btn-primary mt-4" id="submit" disabled>Approve</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </section>
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
            <script type="text/javascript">
                const diseaseDescription = document.querySelector("#disease_description");
                const submit = document.querySelector("#submit");
                const premium = document.querySelector("#premium");
                $('input[type=radio][name=disease_question]').change(function() {
                        if (this.value == '1') {
                            diseaseDescription.style.display = "block";
                        }
                        else if (this.value == '0') {
                            diseaseDescription.style.display = "none";
                        }
                    });

                $('input[type=checkbox][name=declaration]').change(function() {
                    if (this.checked) {
                        submit.disabled = false;
                    }
                    else {
                        submit.disabled = true;
                    }
                });

                function handlePremiumCalculation(event) {
                    premium.value = 5/100 * Number(event.value);
                }


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
                                text: 'SPI Trend of {{$activeInsuranceApplications[0]->district}}'
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
                                text: 'SPI Trend of {{$activeInsuranceApplications[0]->district}}'
                            }
                        }
                    }
                });

            </script>
    @endpush
