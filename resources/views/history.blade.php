@extends('layouts.app-layout')

@section('title', 'History')

@auth
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
            6 => 'Cancelled',
            7 => 'Refunded',
            8 => 'Ready for Pickup',
        ];
    
        $status = $statuses[$order->status_id] ?? '';
    @endphp

        <div class="card mt-5">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title m-0">{{ $status }}</h5>
                <p class="card-title m-0">Order No: {{ $order->id }}</p>
            </div>
            <div class="card-body">
                <div class="row mb-3 justify-content-end">
                    <div class="col-9">
                        <div class="row">
                            @foreach($order->orderItems as $item)
                            <div class="col-6">
                                <div class="row">
                                    <div class="col p-0">
                                        <div class="card p-3 border-0">
                                            <img src="https://via.placeholder.com/25x25?text=Image" class="card-img object-fit-cover">
                                        </div>
                                    </div>
                                    <div class="col mt-3">
                                        <h6 class="card-text">{{ $item->menuItem->name }}</h6>
                                        <p class="card-text">{{ $item->menuItem->price }}</p>
                                        <p class="card-text">Quantity: {{ $item->quantity }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-3 mt-3">
                        <p class="card-title">Total amount: </p>
                        <p><strong>{{ $order->total }} </strong></p>
                        <p class="card-title">Delivery Address: </p>
                        <p>{{ $order->address }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <h6>Order at: {{ \Carbon\Carbon::parse($order->updated_at)->format('H:i d, m, Y') }}</h6>
                    <p class="card-text"><small class="text-body-secondary">Last updated {{ \Carbon\Carbon::parse($order->updated_at)->diffForHumans() }}</small></p>
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
@endauth