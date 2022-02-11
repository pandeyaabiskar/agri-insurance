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
                        <div>Weather Index Based Insurance
                            <div class="page-title-subheading">Insurance Form
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

            <div class="container mb-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <section class="my-5">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col text-center mb-3">
                                                @if(isset($activeProjects) && (count($activeProjects) > 0))
                                                <h1>Weather Index-based Insurance Application Form</h1>
                                                @else
                                                <h4 class="text-danger">You do not have any active projects to insure</h4>
                                                @endif
                                            </div>
                                        </div>
                                        @if(isset($activeProjects) && (count($activeProjects) > 0))
                                        <form
                                            method="post" action="{{route('insurance.store')}}"
                                              enctype="multipart/form-data"
{{--                                              onsubmit="event.preventDefault(); return App.createInsurance(this)"--}}

                                        >
                                            @csrf
                                            <div class="form-group row">
                                                <label for="name" class="col-form-label text-md-right font-weight-bold">Select
                                                    Project</label>
                                                    <select class="form-control" id="name" name="name" onchange="handleProjectChange(this)">
                                                        @foreach($activeProjects as $activeProject)
                                                        <option value="{{$activeProject->id}}">{{$activeProject->name}}</option>
                                                        @endforeach

                                                    </select>
                                            </div>


                                            <div class="form-group row">
                                                <label for="fruit" class="col-form-label text-md-right font-weight-bold">Select
                                                    Fruit</label>
                                                    <select class="form-control" id="fruit" name="fruit">
                                                        <option value="Avocado">Avocado</option>
                                                    </select>
                                            </div>

                                            <div class="form-group row">
                                                <label for="species" class="col-form-label text-md-right font-weight-bold">Select
                                                    Species</label>
                                                    <select class="form-control" id="species" name="species">
                                                        <option value="Mexican race: Hash, Ethinger, Urtaj">Mexican race: Hash, Ethinger, Urtaj</option>
                                                        <option value="Guatemalan race: Green, Red">Guatemalan race: Green, Red</option>
                                                        <option value="West Indian race: Purple">West Indian race: Purple</option>
                                                        <option value="Hybrid: Furte (cross between Guatemalan & Mexican species)">Hybrid: Furte (cross between Guatemalan & Mexican species)</option>
                                                    </select>
                                            </div>

                                            <div class="form-group row">
                                                <label for="districts" class="col-form-label text-md-right font-weight-bold">Select
                                                    District</label>
                                                <select class="form-control" id="districts" name="districts" onchange="loadLocation(this)">
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-4 p-0">
                                                    <label for="lat" class="col-form-label text-md-right font-weight-bold">Lat.</label>
                                                    <input id="lat" type="number" step="any" class="form-control" name="lat" >
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="lon" class="col-form-label text-md-right font-weight-bold">Lon.</label>
                                                    <input id="lon" type="number"  step="any" class="form-control" name="lon" >
                                                </div>

                                                <div class="col-md-4 align-bottom">
                                                    <button class="btn btn-primary mt-4" type="button" onclick="handleGetCurrentLocation()">Get Current Location</button>
                                                </div>
                                                (For fetching weather data)
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6 p-0">
                                                    <label for="area" class="col-form-label text-md-right font-weight-bold">Production Area (in Hectares)</label>
                                                    <input id="area" type="number" class="form-control"
                                                           name="area">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="cost" class="col-form-label font-weight-bold">Present Cost of Production (NPR)</label>
                                                    <input id="cost" type="number" class="form-control"
                                                           name="cost">
                                                    (As per standards provided by Ministry of Agriculture)
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <div class="col-md-6 p-0">
                                                    <label for="from-date" class="col-form-label text-md-right font-weight-bold">From Date</label>
                                                    <input id="from-date" type="date" class="form-control"
                                                           name="from-date">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="to-date" class="col-form-label text-md-right font-weight-bold">To Date</label>
                                                    <input id="to-date" type="date" class="form-control"
                                                           name="to-date">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6 p-0">
                                                    <label for="duration" class="col-form-label text-md-right font-weight-bold">Insurance
                                                        Period (in Months)</label>
                                                    <input id="duration" type="number" class="form-control"
                                                           name="duration"  required>
                                                    <div id="duration-error" class="text-danger" style="display: none">Insurance period should be greater that 1 month</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="insurance-amount" class="col-form-label text-md-right font-weight-bold">Insurance
                                                        Amount (NPR)</label>
                                                    <input id="insurance-amount" type="number" class="form-control"
                                                           name="insurance-amount" onkeyup="checkamount(this)">
                                                    <div id="insurance-amount-error" class="text-danger" style="display: none">Insurance amount cannot be greater than Cost of Production</div>

                                                </div>
                                            </div>





                                            <div class="form-group row">
                                                <label for="facilities" class="col-form-label text-md-right font-weight-bold">Facilities on Farm</label>
                                                <input id="facilities" type="text" class="form-control" name="facilities">
                                            </div>



                                            <div class="form-group row">
                                                <label for="experience" class="col-md-12 col-form-label font-weight-bold pl-0">Have you done this crop farming before?</label>
                                                <div class="form-check form-check-inline">
                                                    <input name="experience" type="radio" class="form-check-input" value="1">
                                                    <label class="form-check-label"> Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="experience" type="radio" class="form-check-input" value="0" checked>
                                                    <label class="form-check-label">No</label>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="insurance-question" style="display: none">
                                                <label for="past_insurance" class="col-md-12 col-form-label font-weight-bold pl-0">Did you have a insurance?</label>
                                                <div class="form-check form-check-inline">
                                                    <input name="past_insurance" type="radio" class="form-check-input" value="1">
                                                    <label class="form-check-label ">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="past_insurance" type="radio" class="form-check-input" value="0" checked>
                                                    <label class="form-check-label ">No</label>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="insurance-loss" style="display: none">
                                                <label for="past_loss" class="col-md-12 col-form-label font-weight-bold pl-0">Did you face any loss?</label>
                                                <div class="form-check form-check-inline">
                                                    <input name="past_loss" type="radio" class="form-check-input" value="1">
                                                    <label class="form-check-label">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="past_loss" type="radio" class="form-check-input" value="0" checked>
                                                    <label class="form-check-label">No</label>
                                                </div>
                                            </div>



                                            <div class="form-group row" id="past_loss_date" style="display: none">
                                                <label for="past_loss_date" class="col-form-label  font-weight-bold">Date of Loss</label>
                                                    <input id="past_loss_date" type="date" class="form-control" name="past_loss_date">
                                            </div>
                                            <div class="form-group row" id="past_loss_reason" style="display: none">
                                                <label for="past_loss_reason" class="col-form-label  text-md-right font-weight-bold">Reason of Loss</label>
                                                    <input id="past_loss_reason" type="number" class="form-control" name="past_loss_reason">
                                            </div>
                                            <div class="form-group row" id="past_loss_amount" style="display: none">
                                                <label for="past_loss_amount" class="col-form-label  text-md-right font-weight-bold">Loss Amount</label>
                                                    <input id="past_loss_amount" type="number" class="form-control" name="past_loss_amount">
                                            </div>




                                            <div class="row justify-content-start float-right">
                                                <div class="col">
                                                    <button class="btn btn-primary mt-4">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                        @endif
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
                Object.defineProperty(String.prototype, 'capitalize', {
                    value: function() {
                        return this.charAt(0).toUpperCase() + this.slice(1);
                    },
                    enumerable: false
                });
                const districts =     [
                    {
                        "DISTRICT": "Arghakhanchi",
                        "LAT": 27.9,
                        "LON": 83.2
                    },
                    {
                        "DISTRICT": "Baglung",
                        "LAT": 28.3,
                        "LON": 83.6
                    },
                    {
                        "DISTRICT": "Baitadi",
                        "LAT": 29.5,
                        "LON": 80.5
                    },
                    {
                        "DISTRICT": "Bajang",
                        "LAT": 29.6,
                        "LON": 81.2
                    },
                    {
                        "DISTRICT": "Banke",
                        "LAT": 28.1,
                        "LON": 81.7
                    },
                    {
                        "DISTRICT": "Bara",
                        "LAT": 27.15,
                        "LON": 84.95
                    },
                    {
                        "DISTRICT": "Bardiya",
                        "LAT": 28.45,
                        "LON": 81.3
                    },
                    {
                        "DISTRICT": "Bhaktapur",
                        "LAT": 27.7,
                        "LON": 85.5
                    },
                    {
                        "DISTRICT": "Chitawan",
                        "LAT": 27.7,
                        "LON": 84.4
                    },
                    {
                        "DISTRICT": "Dadeldhura",
                        "LAT": 29.3,
                        "LON": 80.6
                    },
                    {
                        "DISTRICT": "Dailekh",
                        "LAT": 28.8,
                        "LON": 81.7
                    },
                    {
                        "DISTRICT": "Dang",
                        "LAT": 28.05,
                        "LON": 82.4
                    },
                    {
                        "DISTRICT": "Darchula",
                        "LAT": 29.9,
                        "LON": 80.6
                    },
                    {
                        "DISTRICT": "Dhading",
                        "LAT": 27.7,
                        "LON": 85.2
                    },
                    {
                        "DISTRICT": "Dhankuta",
                        "LAT": 27,
                        "LON": 87.3
                    },
                    {
                        "DISTRICT": "Dhanusa",
                        "LAT": 26.7,
                        "LON": 85.9
                    },
                    {
                        "DISTRICT": "Dolkha",
                        "LAT": 27.6,
                        "LON": 86.2
                    },
                    {
                        "DISTRICT": "Dolpa",
                        "LAT": 29,
                        "LON": 82.9
                    },
                    {
                        "DISTRICT": "Doti",
                        "LAT": 29.3,
                        "LON": 80.95
                    },
                    {
                        "DISTRICT": "Gorkha",
                        "LAT": 28,
                        "LON": 84.6
                    },
                    {
                        "DISTRICT": "Gulmi",
                        "LAT": 28.1,
                        "LON": 83.2
                    },
                    {
                        "DISTRICT": "Humla",
                        "LAT": 30,
                        "LON": 81.8
                    },
                    {
                        "DISTRICT": "Ilam",
                        "LAT": 26.9,
                        "LON": 88
                    },
                    {
                        "DISTRICT": "Jhapa",
                        "LAT": 26.7,
                        "LON": 87.9
                    },
                    {
                        "DISTRICT": "Jumla",
                        "LAT": 29.3,
                        "LON": 82.2
                    },
                    {
                        "DISTRICT": "Kabhre",
                        "LAT": 27.6,
                        "LON": 85.6
                    },
                    {
                        "DISTRICT": "Kailali",
                        "LAT": 28.7,
                        "LON": 80.8
                    },
                    {
                        "DISTRICT": "Kanchanpur",
                        "LAT": 29,
                        "LON": 80.2
                    },
                    {
                        "DISTRICT": "Kaski",
                        "LAT": 28.2,
                        "LON": 83.9
                    },
                    {
                        "DISTRICT": "Kathmandu",
                        "LAT": 27.73,
                        "LON": 85.37
                    },
                    {
                        "DISTRICT": "Lalitpur",
                        "LAT": 27.63,
                        "LON": 85.33
                    },
                    {
                        "DISTRICT": "Lamjung",
                        "LAT": 28.3,
                        "LON": 84.4
                    },
                    {
                        "DISTRICT": "Mahottari",
                        "LAT": 26.7,
                        "LON": 85.8
                    },
                    {
                        "DISTRICT": "Makwanpur",
                        "LAT": 27.4,
                        "LON": 85
                    },
                    {
                        "DISTRICT": "Manang",
                        "LAT": 28.6,
                        "LON": 84.2
                    },
                    {
                        "DISTRICT": "Morang",
                        "LAT": 26.5,
                        "LON": 87.3
                    },
                    {
                        "DISTRICT": "Mugu",
                        "LAT": 29.5,
                        "LON": 82.1
                    },
                    {
                        "DISTRICT": "Mustang",
                        "LAT": 28.7,
                        "LON": 83.67
                    },
                    {
                        "DISTRICT": "Myagdi",
                        "LAT": 28.4,
                        "LON": 83.6
                    },
                    {
                        "DISTRICT": "Nawalparasi",
                        "LAT": 27.6,
                        "LON": 84
                    },
                    {
                        "DISTRICT": "Nuwakot",
                        "LAT": 27.85,
                        "LON": 85.25
                    },
                    {
                        "DISTRICT": "Okhaldhunga",
                        "LAT": 27.3,
                        "LON": 86.5
                    },
                    {
                        "DISTRICT": "Palpa",
                        "LAT": 27.9,
                        "LON": 83.5
                    },
                    {
                        "DISTRICT": "Panchther",
                        "LAT": 27.1,
                        "LON": 87.8
                    },
                    {
                        "DISTRICT": "Parbat",
                        "LAT": 28.2,
                        "LON": 83.7
                    },
                    {
                        "DISTRICT": "Rasuwa",
                        "LAT": 28.1,
                        "LON": 85.3
                    },
                    {
                        "DISTRICT": "Routahat",
                        "LAT": 26.8,
                        "LON": 85.3
                    },
                    {
                        "DISTRICT": "Rukum",
                        "LAT": 28.65,
                        "LON": 82.35
                    },
                    {
                        "DISTRICT": "Rupandehi",
                        "LAT": 27.57,
                        "LON": 83.47
                    },
                    {
                        "DISTRICT": "Salyan",
                        "LAT": 28.4,
                        "LON": 82.1
                    },
                    {
                        "DISTRICT": "Sankhuwasabha",
                        "LAT": 27.3,
                        "LON": 87.3
                    },
                    {
                        "DISTRICT": "Saptari",
                        "LAT": 26.6,
                        "LON": 86.8
                    },
                    {
                        "DISTRICT": "Sarlahi",
                        "LAT": 27,
                        "LON": 85.45
                    },
                    {
                        "DISTRICT": "Sindhuli",
                        "LAT": 27.2,
                        "LON": 85.9
                    },
                    {
                        "DISTRICT": "Solukhumbu",
                        "LAT": 28,
                        "LON": 86.8
                    },
                    {
                        "DISTRICT": "Sunsari",
                        "LAT": 26.75,
                        "LON": 87.3
                    },
                    {
                        "DISTRICT": "Surkhet",
                        "LAT": 28.75,
                        "LON": 81.4
                    },
                    {
                        "DISTRICT": "Syangja",
                        "LAT": 28,
                        "LON": 83.85
                    },
                    {
                        "DISTRICT": "Tanahun",
                        "LAT": 28,
                        "LON": 84.1
                    },
                    {
                        "DISTRICT": "Taplejung",
                        "LAT": 27.4,
                        "LON": 87.7
                    },
                    {
                        "DISTRICT": "Terhathum",
                        "LAT": 27.1,
                        "LON": 87.5
                    },
                    {
                        "DISTRICT": "Udayapur",
                        "LAT": 26.9,
                        "LON": 86.5
                    }
                ]

                let districtBox = document.getElementById('districts');

                for(let i = 0, l = districts.length; i < l; i++){
                    let district = districts[i].DISTRICT;
                    districtBox.options.add( new Option(district.capitalize() , district.capitalize()) );
                }
                const insuranceQuestion = document.querySelector("#insurance-question");
                const insuranceLoss = document.querySelector("#insurance-loss");
                const pastLossDate = document.querySelector("#past_loss_date");
                const pastLossReason = document.querySelector("#past_loss_reason");
                const pastLossAmount = document.querySelector("#past_loss_amount");

                $('input[type=radio][name=experience]').change(function() {
                        if (this.value == '1') {
                            insuranceQuestion.style.display = "block";
                        }
                        else if (this.value == '0') {
                            insuranceQuestion.style.display = "none";
                        }
                    });

                $('input[type=radio][name=past_insurance]').change(function() {
                    if (this.value == '1') {
                        insuranceLoss.style.display = "block";
                    }
                    else if (this.value == '0') {
                        insuranceLoss.style.display = "none";

                    }
                });

                $('input[type=radio][name=past_loss]').change(function() {
                    if (this.value == '1') {
                        pastLossDate.style.display = "block";
                        pastLossReason.style.display = "block";
                        pastLossAmount.style.display = "block";
                    }
                    else if (this.value == '0') {
                        pastLossDate.style.display = "none";
                        pastLossReason.style.display = "none";
                        pastLossAmount.style.display = "none";

                    }
                });

                const fromDate = document.querySelector("#from-date");
                const toDate = document.querySelector("#to-date");
                const insurancePeriod = document.querySelector("#duration");
                const insurancePeriodError = document.querySelector("#duration-error");

                let d1, d2 = null;
                fromDate.addEventListener("change", function(event) {
                    d1 = event.target.value;
                    if (d1 !== null && d2 !== null){
                        monthDiff(d1, d2)
                    }
                });
                toDate.addEventListener("change", function(event) {
                    d2 = event.target.value;
                    if (d1 !== null && d2 !== null){
                        monthDiff(d1, d2)
                    }
                });

                function monthDiff(date1, date2) {
                    let d1 = new Date(date1);
                    let d2 = new Date(date2);
                    var months;
                    months = (d2.getFullYear() - d1.getFullYear()) * 12;
                    months -= d1.getMonth();
                    months += d2.getMonth();
                    finalMonth = months <= 0 ? 0 : months;
                    if(finalMonth > 1) {
                        insurancePeriod.value = months <= 0 ? 0 : months;
                        insurancePeriodError.style.display = "none";
                    }else {
                        insurancePeriod.value = months <= 0 ? 0 : months;
                        insurancePeriodError.style.display = "block";
                    }
                }

                const loadLocation = (event) => {
                    document.querySelector("#lat").value = districts.filter((district) => {return district.DISTRICT === event.value})[0].LAT;
                    document.querySelector("#lon").value = districts.filter((district) => {return district.DISTRICT === event.value})[0].LON;
                }

                const checkamount = (event)  => {
                    if(parseInt(event.value) > parseInt(document.querySelector("#cost").value)){
                        document.querySelector("#insurance-amount-error").style.display = "block";
                    }else {
                        document.querySelector("#insurance-amount-error").style.display = "none";

                    }
                }



            </script>
    @endpush
