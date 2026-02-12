@extends('layouts.app')

@section('content')

<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing Details</h1>
        <form action="#">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">First Name<sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="John">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Last Name<sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="Doe">
                            </div>
                        </div>
                    </div>

                    <div class="form-item w-100">
                        <label class="form-label my-3">State / Country<sup>*</sup></label>
                        <select class="form-select form-control">
                            <option value="">Trinidad</option>
                            <option value="">Tobago</option>
                            <option value="">Barbados</option>
                            <option value="">Jamaica</option>
                            <option value="">United States of America</option>
                            <option value="">United Kingdom</option>
                        </select>
                    </div>

                    <div class="form-item w-100">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        <input type="text" class="form-control mb-3" placeholder="#1 Short Street">
                        <input type="text" class="form-control" placeholder="Apartment, Suite, Unit, etc: (optional)">
                    </div>

                    <div class="form-item w-100">
                        <label class="form-label my-3">Town / City<sup>*</sup></label>
                        <input type="text" class="form-control" placeholder="Port-Of-Spain">
                    </div>

                    <div class="form-item w-100">
                        <label class="form-label my-3">Postcode / Zip<sup>*</sup></label>
                        <input type="text" class="form-control" placeholder="00000">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Mobile<sup>*</sup></label>
                                <input type="tel" class="form-control" placeholder="+1-868-123-1234">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Email Address<sup>*</sup></label>
                                <input type="email" class="form-control" placeholder="johndoe@mail.com">
                            </div>
                        </div>
                    </div>

                    <div class="form-check my-3">
                        <input class="form-check-input" type="checkbox" id="Address-1" name="Address" value="Address">
                        <label class="form-check-label" for="Address-1">Ship to a different address?</label>
                    </div>

                    <div class="form-item">
                        <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Order Notes (Optional)"></textarea>
                    </div>
                </div>

                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart_data as $data)
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="{{ $data->getImage() }}" class="img-fluid rounded-circle" style="width: 50px; height: 50px;" alt="">
                                        </div>
                                    </th>
                                    <td class="py-5">{{ $data->title }}</td>
                                    <td class="py-5">${{ app('CustomHelper')->formatPrice($data->getPrice()) }}</td>
                                    <td class="py-5">{{ $data->pivot->quantity }}</td>
                                    <td class="py-5">${{ app('CustomHelper')->formatPrice($data->getCartQuantityPrice()) }}</td>
                                </tr>
                                @endforeach

                                <tr>
                                    <th scope="row"></th>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-3">Subtotal</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">${{ app('CustomHelper')->formatPrice($cart_data->getSubtotal()) }}</p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">${{ app('CustomHelper')->formatPrice($cart_data->getTotal()) }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Transfer-1" name="optradio" value="Transfer">
                                <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                            </div>
                            <p class="text-start text-dark">Make your payment directly into our bank account. Please use your Order ID as the payment reference.</p>
                        </div>
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Payments-1" name="optradio" value="Payments">
                                <label class="form-check-label" for="Payments-1">Check Payments</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Delivery-1" name="optradio" value="Delivery">
                                <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="radio" class="form-check-input bg-primary border-0" id="Paypal-1" name="optradio" value="Paypal">
                                <label class="form-check-label" for="Paypal-1">Paypal</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Terms-1" name="Terms" value="Terms">
                                <label class="form-check-label" for="Terms-1">I have read and accept the terms and conditions</label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <x-core.stripe-ui />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
