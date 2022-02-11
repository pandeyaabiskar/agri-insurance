@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/styleForDetailsPage.css') }}" rel="stylesheet">
@endpush

@section('content')
    <section class="root">
        <figure>
            <img src="https://image.flaticon.com/icons/svg/970/970514.svg" alt="">
            <figcaption>
                <h4>Tracking Details</h4>
                <h6>Token Number</h6>

            </figcaption>
        </figure>
        <div class="order-track">
            <div class="order-track-step">
                <div class="order-track-status">
                    <span class="order-track-status-dot"></span>
                    <span class="order-track-status-line"></span>
                </div>
                <div class="order-track-text">
                    <p class="order-track-text-stat">Issued</p>
                    <span class="order-track-text-sub" id="issued"></span>
                </div>
            </div>
            <div class="order-track-step">
                <div class="order-track-status">
                    <span class="order-track-status-dot"></span>
                    <span class="order-track-status-line"></span>
                </div>
                <div class="order-track-text">
                    <p class="order-track-text-stat">Planted</p>
                    <span class="order-track-text-sub" id="planted"></span>
                </div>
            </div>
                <div class="order-track-step">
                    <div class="order-track-status">
                        <span class="order-track-status-dot"></span>
                        <span class="order-track-status-line"></span>
                    </div>
                    <div class="order-track-text">
                        <p class="order-track-text-stat">Harvested</p>
                        <span class="order-track-text-sub" id="harvested"></span>
                    </div>
                </div>
                <div class="order-track-step">
                    <div class="order-track-status">
                        <span class="order-track-status-dot"></span>
                        <span class="order-track-status-line" id="issued"></span>
                    </div>
                    <div class="order-track-text">
                        <p class="order-track-text-stat">Verified</p>
                        <span class="order-track-text-sub" id="verified"></span>
                    </div>
                </div>
                <div class="order-track-step">
                    <div class="order-track-status">
                        <span class="order-track-status-dot"></span>
                        <span class="order-track-status-line"></span>
                    </div>
                    <div class="order-track-text">
                        <p class="order-track-text-stat">Shipped</p>
                        <span class="order-track-text-sub" id="shipped"></span>
                    </div>
                </div>
        </div>


    </section>@endsection

@push('scripts')
    <script src="{{ asset('js/truffle-contract.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('js/contract.js') }}"></script>


@endpush
