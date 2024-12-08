@extends('layouts.app-layout')

@section('title', 'Order')

@section('content')

    {{-- @dd($orders); --}}

    @foreach ($orders as $order)
    @switch($order->status_id)
        @case(1)
            @php $status = 'Received'; @endphp
            @break
        @case(2)
            @php $status = 'Confirmed'; @endphp
            @break
        @case(3)
            @php $status = 'Preparing'; @endphp
            @break
        @case(4)
            @php $status = 'Delivering'; @endphp
            @break
        @case(5)
            @php $status = 'Delivered'; @endphp
            @break
        @case(6)
            @php $status = 'Cancelled'; @endphp
            @break
        @case(7)
            @php $status = 'Refunded'; @endphp
            @break
        @case(8)
            @php $status = 'Ready for pick-up'; @endphp
            @break
        @default
            @php $status = 'Encountered some problems'; @endphp
            @break
    @endswitch

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
                <div class="progress px-1" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="step-container d-flex justify-content-between"
                    style="
                        position: relative;
                        text-align: center;
                        transform: translateY(-43%);">
                        
                    <div class="step-circle">1</div>
                    <div class="step-circle">2</div>
                    <div class="step-circle">3</div>
                    <div class="step-circle">4</div>
                    <div class="step-circle">5</div>
                </div>
                <div class="step-container d-flex justify-content-between"
                style="
                    position: relative;
                    text-align: center;
                    transform: translateY(-43%);">
                    <div class="step-text">Received</div>
                    <div class="step-text">Confirmed</div>
                    <div class="step-text">Preparing</div>
                    <div class="step-text">Delivering</div>
                    <div class="step-text">Delivered</div>
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