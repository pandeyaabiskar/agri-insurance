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
                                <div class="col text-center">
                                    <h1>Add New Crop</h1>
                                    <p class="text-h3">Added crop can be viewed by all Farmers.</p>
                                </div>
                            </div>

                            <form method="post" action="{{route('crops.store')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="account" class="col-md-4 col-form-label text-md-right">Crop Name</label>

                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="Eg. Apple">

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-md-4 col-form-label text-md-right">Price (100 seeds)</label>

                                    <div class="col-md-8">
                                        <input id="price" type="number" class="form-control" name="price" placeholder="Rs." required>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="season" class="col-md-4 col-form-label text-md-right">Favourable Season</label>

                                    <div class="col-md-8">
                                        <input id="season" type="text" class="form-control{{ $errors->has('season') ? ' is-invalid' : '' }}" name="season" value="{{ old('season') }}" placeholder="Eg. Monsoon">

                                        @if ($errors->has('season'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('season') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="harvest" class="col-md-4 col-form-label text-md-right">Harvest Days</label>

                                    <div class="col-md-8">
                                        <input id="harvest" type="text" class="form-control{{ $errors->has('harvest') ? ' is-invalid' : '' }}" name="harvest" value="{{ old('harvest') }}" placeholder="Eg. 120 days">

                                        @if ($errors->has('harvest'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('harvest') }}</strong>
                                    </span>
                                        @endif
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
