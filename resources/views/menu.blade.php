@extends('layouts.app-layout')

@section('title', 'Home')

@section('content')

<h1 class="my-3">Coffee Menu</h1>

{{-- @dd($cartItems) --}}

{{-- @dd($menuItems) --}}

<div class="row g-3">
    @foreach ($menuItems as $item)
    <div class="col-6"> 
        <div class="card h-100 shadow-sm" style="max-width: 540px;">
            <div class="class row g-0">
                <div class="col-md-4 p-3">
                    <div class="card h-100 position-relative">
                        <img src="https://via.placeholder.com/350x350?text=Image" class="card-img h-100 w-100 object-fit-cover">
                        <div class="position-absolute bottom-0 start-0 end-0 p-2 d-flex justify-content-center align-items-center">
                            <button class="button-minus border-0 rounded-circle d-flex justify-content-center align-items-center p-1 icon-shape icon-sm me-1" style="width: 30px; height: 30px;">-</button>
                            <span class="fw-bold mx-2">1</span>
                            <button class="button-plus border-0 rounded-circle d-flex justify-content-center align-items-center p-1 icon-shape icon-sm ms-1" style="width: 30px; height: 30px;" value="-">+</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card border-0 h-100 d-flex flex-column">
                        <div class="card-body d-flex flex-column">
                            <!-- Content -->
                            <div class="mb-3">
                                <h5 class="card-title d-flex justify-content-between align-items-center">
                                    {{ $item->name }}
                                    <span class="text-primary fw-bold">{{ $item->price }}</span>
                                </h5>
                                <p class="card-text text-muted" style="
                                    display: -webkit-box;
                                    -webkit-line-clamp: 3;
                                    -webkit-box-orient: vertical;
                                    overflow: hidden;
                                    min-height: 4.5rem;
                                ">
                                    {{ $item->description }}
                                </p>
                            </div>
                            
                            <!-- Button Section - Always at the bottom -->
                            <div class="mt-auto">
                                <form class="m-0" action="{{ route('createCartItem') }}" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="col-auto fw-bold">Size</label>
                                        <div class="col-8 d-flex justify-content-center">
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="size" id="size1" value="small" checked>
                                                <label class="btn btn-outline-secondary rounded-pill" for="size1">Small</label>
                                            </div>
                                            <div class="btn-group ms-3" role="group" aria-label="Basic radio toggle button group">
                                                <input type="radio" class="btn-check" name="size" id="size2" value="large">
                                                <label class="btn btn-outline-secondary rounded-pill" for="size2">Large</label>
                                            </div>
                                        </div>
                                    </div>
                                    @auth
                                    <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    @endauth
                                    <x-button-pill class="btn-primary w-100" type="submit">Add to Cart</x-button-pill>
                                </form>
                            </div>
                        </div>
                    </div>                                                      
                </div>
            </div>
        </div>    
    </div>
    @endforeach
</div>

@auth
@section('sidebar-main')
    <div class="container-fluid d-flex flex-column vh-100 pb-5 px-4" style="overflow-y: auto; max-height: 100vh;">
        {{-- Header --}}
        @can('add-to-cart')
        <div class="row mt-3 align-items-center">
            <h2 class="col">Cart</h2>
            
            <div class="col text-end pe-3">
                ID: {{ $cart->id }}
            </div>      
        </div>

        {{-- Option --}}
        <div class="row g-3 mt-3">
            <div class="col btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="option" id="option1" autocomplete="off" checked>
                <label class="btn btn-outline-primary rounded-pill" for="option1">Delivery</label>
            </div>
     
            <div class="col btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" name="option" id="option2" autocomplete="off">
                <label class="btn btn-outline-primary rounded-pill" for="option2">Pick Up</label>
            </div>
        </div>

        {{-- Cart items --}}
        <div class="row mt-3">
            <div class="col-12">
                <div class="card h-100">
                    @foreach ($cartItems as $cartItem)
                        <div class="card-body">
                            <div class="d-flex justify-content-end">
                                <form action="{{ route('destroyCartItem', $cartItem->id) }}" method="post" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-close" aria-label="Remove Item"></button>
                                </form>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6><strong>{{ $cartItem->name }}</strong></h6>
                                <span class="text-primary">${{ number_format($cartItem->price, 2) }}</span>
                            </div> 
                            <div class="d-flex justify-content-between">
                                <span>{{ $cartItem->size_id == 1 ? 'Small' : 'Large' }}</span>
                                <h6>Qty: {{ $cartItem->quantity }}</h6>
                            </div>
                        </div>
                    @endforeach
                    @if ($cartItems->isEmpty())
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h6>Cart is empty</h6>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
              

        {{-- Total --}}
        <div class="col-12 mt-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Tax (10%)</span>
                        <span>{{ number_format($tax, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Delivery</span>
                        <span>{{ number_format($delivery, 2) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Total</span>
                        <span>{{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Checkout --}}
        <div class="flex-row mt-3 pb-4">
            <x-button-pill class="btn-primary btn-lg">Checkout</x-button-pill>
        </div>
        @endcan
    </div>
@endsection
@endauth

@endsection