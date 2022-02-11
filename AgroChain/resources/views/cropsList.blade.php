@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12 ml-auto mr-5">
                <div class="card">
                    <div class="card-header">Crops Market</div>

                    <div class="card-body">
                        @if(count($crops) > 0)
                            <div class="table-responsive">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th>Crop Name</th>
                                        <th>Price</th>
                                        <th>Season</th>
                                        <th>Harvest Days</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($crops as $crop)
                                        <tr>
                                            <td>{{$crop->name}}</td>
                                            <td>Rs. {{$crop->price}}</td>
                                            <td>{{$crop->season}}</td>
                                            <td>{{$crop->harvest_days}}</td>
                                            <td>
                                                <a href="{{route('croprequests.edit', ['id' => $crop->id])}}">
                                                    <button class="btn btn-success">Request Crop</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
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
@endsection

@push('scripts')
    <script src="{{ asset('js/truffle-contract.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('js/contract.js') }}"></script>
@endpush
