@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <section class="my-5">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="row">
                                <div class="col text-center mb-3">
                                    <h1>Request New Crop</h1>
                                </div>
                            </div>

                            <form method="post" action="{{route('croprequests.store')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="account" class="col-md-4 col-form-label text-md-right">Crop Name</label>

                                    <div class="col-md-8">
                                        <input id="id" type="hidden" class="form-control" name="id" value="{{$crop[0]->id}}">
                                        <input id="name" type="text" class="form-control" name="name" value="{{$crop[0]->name}}" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="quantity" class="col-md-4 col-form-label text-md-right">Select Quantity</label>
                                    <div class="col-md-8">
                                    <select class="form-control" id="quantity" name="quantity">
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="500">500</option>
                                        <option value="1000">1000</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="row justify-content-start float-right">
                                    <div class="col">
                                        <button class="btn btn-primary mt-4">Submit</button>
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
@endsection

@push('scripts')
    <script src="{{ asset('js/truffle-contract.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('js/contract.js') }}"></script>
@endpush
