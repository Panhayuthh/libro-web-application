@extends('layouts.app-layout')

@section('title', 'Order')

@section('content')

    {{-- @dd($orders); --}}

    @foreach ($orders as $order)
    @php
        $statuses = [
            1 => 'Received',
            2 => 'Confirmed',
            3 => 'Preparing',
            4 => 'Delivering',
            5 => 'Delivered',
        ];

        $status = $statuses[$order->status_id] ?? 'Encountered some problems';
        $progressPercentage = min(($order->status_id / 5) * 100, 100);
    @endphp

    <div class="card mt-5">
        <div class="row">
            <div class="col-6">
                <div class="card-body border-end m-3">
                    <h6>Your Order is</h6>
                    <h1><strong> {{ $status }} </strong></h1>
                    <h6>Order at: {{ \Carbon\Carbon::parse($order->updated_at)->format('H:i d, m, Y') }}</h6>
                    <p class="card-text"><small class="text-body-secondary">Last updated {{ \Carbon\Carbon::parse($order->updated_at)->diffForHumans() }}</small></p>
                </div>
            </div>
            <div class="col-6">
                <div class="card-body m-3">                       
                    <h5 class="card-title">Order No: </h5>
                    <p class="card-text">{{ $order->id }}</p>
    
                    <h5 class="cart-title">Delivery Address: </h5>
                    <p class="card-text">123, Jalan ABC, 12345, Kuala Lumpur</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title mx-3"> Tracking History </h5>

            <div id="container" class="container mt-5">
                <div class="progress" style="height: 5px;">
                    <div class="progress-bar bg-success" role="progressbar" 
                    style="width: {{ $progressPercentage }}%;" 
                    aria-valuenow="{{ $progressPercentage }}" 
                    aria-valuemin="0" 
                    aria-valuemax="100">
               </div>
                </div>
                <div class="step-container d-flex justify-content-between"
                    style="
                        position: relative;
                        text-align: center;
                        transform: translateY(-33%);">
                    
                    @foreach ($statuses as $id => $text)
                        <div class="step-outer d-flex flex-column align-items-center">
                            @if ($order->status_id >= $id)
                                <div class="step-circle step-success">
                                    <i class="cil-check-alt text-light"></i>
                                </div>
                            @else
                                @switch($id)
                                    @case(1)
                                        <div class="step-circle">
                                            <i class="cil-clipboard"></i>
                                        </div>
                                        @break
                                    @case(2)
                                        <div class="step-circle">
                                            <i class="cil-check-circle"></i>
                                        </div>
                                        @break
                                    @case(3)
                                        <div class="step-circle">
                                            <i class="cil-cog"></i>
                                        </div>
                                        @break
                                    @case(4)
                                        <div class="step-circle">
                                            <i class="cil-truck"></i>
                                        </div>
                                        @break
                                    @case(5)
                                        <div class="step-circle">
                                            <i class="cil-location-pin"></i>
                                        </div>
                                        @break
                                    @default
                                        <div class="step-circle">
                                            <i class="cil-ban"></i>
                                        </div>
                                @endswitch
                            @endif
                            <div class="step-text">{{ $text }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@section('sidebar-main')
    <div class="container-fluid d-flex flex-column vh-100 pb-5 px-4" style="overflow-y: auto; max-height: 100vh;">
        <h3 class="mt-5"><strong>Order Summary</strong></h3>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">Customer Name: </h5>
                <p class="card-text">{{ Auth::user()->name; }}</p>

                <h5 class="card-title">Customer Contact: </h5>
                <p class="card-text">012892633</p>
            </div>
        </div>
    </div>
@endsection