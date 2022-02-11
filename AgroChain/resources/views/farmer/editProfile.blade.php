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
                        <div>Edit Profile
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
                <div class="col-md-6 m-auto">
                    <div class="main-card mb-3 card">
                        <div class="card-body"><h5 class="card-title">Personal Details</h5>
                            <form class="" method="POST" enctype="multipart/form-data"
                                  action="{{route('updateuser.update', Auth::user()->id)}}">
                                @method('put')
                                @csrf
                                <div class="position-relative form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="profile-img text-left">
                                                <img src="{{url('uploads/'.$personal[0]->filename)}}" alt=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="position-relative form-group"><label for="Name" class="">
                                        Name*</label><input name="name" id="Name" type="text" class="form-control"
                                                            @if(count($personal) > 0)value="{{$personal[0]->name}}"
                                                            @endif required>
                                </div>
                                <div class="position-relative form-group"><label for="email"
                                                                                 class="">Email*</label><input
                                        name="email" id="email" type="text" class="form-control"
                                        @if(count($personal) > 0)value="{{$personal[0]->email}}" @endif required>
                                </div>
                                <div class="position-relative form-group">
                                    <label for="farmImage" class="">Profile Image</label><input name="image"
                                                                                                id="farmImage"
                                                                                                type="file"
                                                                                                class="form-control-file">
                                    <small class="form-text text-muted">Please provide authentic information.</small>
                                </div>
                                <button class="mt-1 btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                @if(session('role') == 'farmer')

                    <div class="col-md-6 m-auto">
                        <div class="main-card mb-3 card">
                            <div class="card-body"><h5 class="card-title">Farm Details</h5>
                                <form class="" method="post" enctype="multipart/form-data"
                                      action="{{route('updatefarmer.update', Auth::user()->id)}}">
                                    @method('put')
                                    @csrf
                                    @if(count($farm) > 0)
                                        <div class="position-relative form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="profile-img text-left">
                                                        <img src="{{url('uploads/'.$farm[0]->filename)}}" alt=""/>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="position-relative form-group"><label for="farmName" class="">Farm
                                            Name*</label><input name="name" id="farmName" type="text"
                                                                class="form-control"
                                                                @if(count($farm) > 0)value="{{$farm[0]->farm_name}}"
                                                                @endif
                                                                required>
                                    </div>
                                    <div class="position-relative form-group">
                                        <label for="districts" class="col-form-label text-md-right font-weight-bold">Select
                                            District</label>
                                        <select class="form-control" id="districts" name="location">
                                        </select>
                                    </div>
                                    <div class="position-relative form-group"><label for="registration" class="">Registration
                                            No.*
                                        </label><input name="registration" id="registration" type="text"
                                                       class="form-control"
                                                       @if(count($farm) > 0)value="{{$farm[0]->registration}}"
                                                       @endif required>
                                    </div>
                                    <div class="position-relative form-group"><label for="size" class="">Farm Size (in Hectares)
                                        </label><input name="size" id="size" type="number" class="form-control"
                                                       @if(count($farm) > 0)value="{{$farm[0]->size}}"@endif required>
                                    </div>
                                    <div class="position-relative form-group"><label for="contact" class="">Farm
                                            Contact*
                                        </label><input name="contact" id="contact" type="text" class="form-control"
                                                       @if(count($farm) > 0)value="{{$farm[0]->farm_contact}}" @endif
                                                       required>
                                    </div>
                                    <div class="position-relative form-group"><label for="description" class="">Farm
                                            Description*
                                        </label><textarea name="description" id="description"
                                                          class="form-control"
                                                          required>@if(count($farm) > 0){{$farm[0]->description}}@endif</textarea>
                                    </div>
                                    <div class="position-relative form-group">
                                        <label for="farmImage" class="">Farm Image</label><input name="image"
                                                                                                 id="farmImage"
                                                                                                 type="file"
                                                                                                 class="form-control-file">
                                        <small class="form-text text-muted">Please provide authentic
                                            information.</small>
                                    </div>
                                    <button class="mt-1 btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
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
                window.onload = () => {
                    const districts =     ['Arghakhanchi', 'Baglung', 'Baitadi', 'Bajang', 'Banke', 'Bara',
                        'Bardiya', 'Bhaktapur', 'Chitawan', 'Dadeldhura', 'Dailekh',
                        'Dang', 'Darchula', 'Dhading', 'Dhankuta', 'Dhanusa', 'Dolkha',
                        'Dolpa', 'Doti', 'Gorkha', 'Gulmi', 'Humla', 'Ilam', 'Jhapa',
                        'Jumla', 'Kabhre', 'Kailali', 'Kanchanpur', 'Kaski', 'Kathmandu',
                        'Lalitpur', 'Lamjung', 'Mahottari', 'Makwanpur', 'Manang',
                        'Morang', 'Mugu', 'Mustang', 'Myagdi', 'Nawalparasi', 'Nuwakot',
                        'Okhaldhunga', 'Palpa', 'Panchther', 'Parbat', 'Rasuwa',
                        'Routahat', 'Rukum', 'Rupandehi', 'Salyan', 'Sankhuwasabha',
                        'Saptari', 'Sarlahi', 'Sindhuli', 'Solukhumbu', 'Sunsari',
                        'Surkhet', 'Syangja', 'Tanahun', 'Taplejung', 'Terhathum',
                        'Udayapur']

                    let districtBox = document.getElementById('districts');

                    for(let i = 0, l = districts.length; i < l; i++){
                        let district = districts[i];
                        districtBox.options.add( new Option(district.capitalize() , district.capitalize()) );
                    }
                };

            </script>
    @endpush
