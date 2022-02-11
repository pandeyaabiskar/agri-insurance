@extends('layouts.adminapp')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div>Insurance Verification
                            <div class="page-title-subheading">Verification Form
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
                                        <th class="text-center">Status</th>
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
            <div class="container mb-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <section class="my-5">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col text-center mb-3">
                                                <h1>Insurance Verification Form</h1>

                                            </div>
                                        </div>
                                        <form
                                            method="post" action="{{route('verifications.store')}}"
                                              enctype="multipart/form-data"
{{--                                              onsubmit="event.preventDefault(); return App.createInsurance(this)"--}}

                                        >
                                            @csrf

                                                <input id="application" type="hidden" class="form-control"
                                                       name="application_id" value="{{$activeInsuranceApplications[0]->id}}">

                                            <div class="form-group row">
                                                <label for="fruit" class="col-form-label text-md-right font-weight-bold">
                                                    Fruit to be Insured</label>
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
                                                <label for="facilities" class="col-form-label text-md-right font-weight-bold">Facilities on Farm</label>
                                                <input id="facilities" type="text" class="form-control" name="facilities">
                                            </div>



                                            <div class="form-group row">
                                                <label for="condition" class="col-md-12 col-form-label font-weight-bold pl-0">Are the crops in good condition?</label>
                                                <div class="form-check form-check-inline">
                                                    <input name="condition" type="radio" class="form-check-input" value="1">
                                                    <label class="form-check-label"> Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="condition" type="radio" class="form-check-input" value="0" checked>
                                                    <label class="form-check-label">No</label>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="disease_question" >
                                                <label for="disease_question" class="col-md-12 col-form-label font-weight-bold pl-0">Any history of pest or disease on the proposed crops?</label>
                                                <div class="form-check form-check-inline">
                                                    <input name="disease_question" type="radio" class="form-check-input" value="1">
                                                    <label class="form-check-label ">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="disease_question" type="radio" class="form-check-input" value="0" checked>
                                                    <label class="form-check-label ">No</label>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="disease_description" style="display: none">
                                                <label for="disease_description" class="col-form-label  text-md-right font-weight-bold">Description of disease</label>
                                                <input id="disease_description" type="text" class="form-control" name="disease_description">
                                            </div>

                                            <div class="form-group row" id="care_question" >
                                                <label for="care" class="col-md-12 col-form-label font-weight-bold pl-0">Do the crops look properly taken care of?</label>
                                                <div class="form-check form-check-inline">
                                                    <input name="care" type="radio" class="form-check-input" value="1">
                                                    <label class="form-check-label">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="care" type="radio" class="form-check-input" value="0" checked>
                                                    <label class="form-check-label">No</label>
                                                </div>
                                            </div>

                                            <div class="form-group row" id="possible_disease" >
                                                <label for="possible_disease" class="col-md-12 col-form-label font-weight-bold pl-0">Any information about diseases or pests being transmitted nearby the farm?</label>
                                                <div class="form-check form-check-inline">
                                                    <input name="possible_disease" type="radio" class="form-check-input" value="1">
                                                    <label class="form-check-label">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="possible_disease" type="radio" class="form-check-input" value="0" checked>
                                                    <label class="form-check-label">No</label>
                                                </div>
                                            </div>

                                            <div class="form-group row" >
                                                <label for="risk_description" class="col-form-label  text-md-right font-weight-bold">Describe other risk factors involved in the insurance of the proposed crop, if any.</label>
                                                <input id="risk_description" type="text" class="form-control" name="risk_description">
                                            </div>

                                            <div class="form-group row"  >
                                                <label for="risk_suggestion" class="col-md-12 col-form-label font-weight-bold pl-0">Do you suggest the insurer to bear the risk of the proposed insurance?</label>
                                                <div class="form-check form-check-inline">
                                                    <input name="risk_suggestion" type="radio" class="form-check-input" value="1">
                                                    <label class="form-check-label">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input name="risk_suggestion" type="radio" class="form-check-input" value="0" checked>
                                                    <label class="form-check-label">No</label>
                                                </div>
                                            </div>

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
                                                    <button class="btn btn-primary mt-4" id="submit" disabled>Submit</button>
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


            </script>
    @endpush
