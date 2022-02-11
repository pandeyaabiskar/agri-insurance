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
                        <div>Create Project
                            <div class="page-title-subheading">Create a Crowdfarming Project
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
                    <div class="col-md-8">
                        <div class="card">
                            <section class="my-5">
                                <div class="row justify-content-center">
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col text-center mb-3">
                                                @if(isset($details) && ($details->verified != 0))
                                                <h1>Create New Crowdfarming Project</h1>
                                                @else
                                                <h4 class="text-danger">You should be verified to create a crowdfarming project</h4>
                                                @endif
                                            </div>
                                        </div>
                                        @if(isset($details) && ($details->verified != 0))
                                        <form method="post"
{{--                                              action="{{route('projects.store')}}"--}}
                                              enctype="multipart/form-data"
                                              onsubmit="event.preventDefault(); return App.createProject(this);"
                                        >
                                            @csrf

                                                    <input id="sku" type="text" class="form-control" name="sku" value="1" hidden>

                                            <div class="form-group row">
                                                <label for="name" class="col-md-4 col-form-label text-md-right">Project
                                                    Name</label>
                                                <div class="col-md-8">
                                                    <input id="name" type="text" class="form-control" name="name">
                                                </div>
                                            </div>

{{--                                            <div class="form-group row">--}}
{{--                                                <label for="fruit" class="col-md-4 col-form-label text-md-right">Fruit--}}
{{--                                                    Name</label>--}}
{{--                                                <div class="col-md-8">--}}
{{--                                                    <input id="fruit" type="text" class="form-control" name="fruit">--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="form-group row">
                                                <label for="fruit" class="col-md-4 col-form-label text-md-right">Select
                                                    Fruit</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" id="fruit" name="fruit">
                                                        <option value="Avocado">Avocado</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="species" class="col-md-4 col-form-label text-md-right">Select
                                                    Species</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" id="species" name="species">
                                                        <option value="Mexican race: Hash, Ethinger, Urtaj">Mexican race: Hash, Ethinger, Urtaj</option>
                                                        <option value="Guatemalan race: Green, Red">Guatemalan race: Green, Red</option>
                                                        <option value="West Indian race: Purple">West Indian race: Purple</option>
                                                        <option value="Hybrid: Furte (cross between Guatemalan & Mexican species)">Hybrid: Furte (cross between Guatemalan & Mexican species)</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="description" class="col-md-4 col-form-label text-md-right">Project
                                                    Description</label>
                                                <div class="col-md-8">
                                                    <textarea id="description" type="text" class="form-control"
                                                              name="description" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="units" class="col-md-4 col-form-label text-md-right">Targeted Amount to be Crowdfunded</label>
                                                <div class="col-md-8">
                                                    <input id="units" type="number" class="form-control" name="units" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="price" class="col-md-4 col-form-label text-md-right">Minimum Investment Amount</label>
                                                <div class="col-md-8">
                                                    <input id="price" type="number" class="form-control" name="price">
                                                </div>
                                            </div>


                                            <div class="form-group row" style="display: none">
                                                <label for="season" class="col-md-4 col-form-label text-md-right">Select
                                                    Season</label>
                                                <div class="col-md-8">
                                                    <select class="form-control" id="season" name="season">
                                                        <option value="Summer">Summer</option>
                                                        <option value="Monsoon">Monsoon</option>
                                                        <option value="Spring" selected>Spring</option>
                                                        <option value="Autumn">Autumn</option>
                                                        <option value="Winter">Winter</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="duration" class="col-md-4 col-form-label text-md-right">Project
                                                    Validity (in Years)</label>
                                                <div class="col-md-8">
                                                    <input id="duration" type="number" class="form-control"
                                                           name="duration">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="image" class="col-md-4 col-form-label text-md-right">Choose
                                                    Image</label>
                                                <div class="col-md-8">
                                                    <input id="image" type="file" class="form-control" name="image"
                                                           required>
                                                </div>
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
    @endpush
