<x-mylayouts.layout-default title="Checkout">



    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    <div class="card border-0 mb-4 bg-light p-3 p-md-4">
                        <!-- Clickable Collapsible Header  -->
                        <div class=" p-0 border-0" id="billingHeading">
                            <button class="btn btn-block text-left collapsed p-0 rounded-0 shadow-none" type="button"
                                data-toggle="collapse" data-target="#billingCollapse" aria-expanded="false"
                                aria-controls="billingCollapse">
                                <h3 class="billing-heading px-2 py-2 ">Billing Details
                                    <span class="float-right">
                                        <i class="ion-ios-arrow-down rotate-icon"></i>
                                    </span>
                                </h3>
                            </button>
                        </div>

                        <!-- Collapsible Body -->
                        <div id="billingCollapse" class="collapse " aria-labelledby="billingHeading">
                            <div class="card-body p-0 mt-4">
                                <form action="#" class="billing-form">
                                    <div class="row align-items-end">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="firstname">First Name</label>
                                                <input type="text" class="form-control" placeholder="John">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lastname">Last Name</label>
                                                <input type="text" class="form-control" placeholder="Doe">
                                            </div>
                                        </div>
                                        <div class="w-100"></div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="country">State / Country</label>
                                                <div class="select-wrap">
                                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                    <select name="" id="" class="form-control">
                                                        <option value="">Trinidad</option>
                                                        <option value="">Tobago</option>
                                                        <option value="">Barbados</option>
                                                        <option value="">Jamaica</option>
                                                        <option value="">United States of America</option>
                                                        <option value="">United Kingdom</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-100"></div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="streetaddress">Street Address</label>
                                                <input type="text" class="form-control" placeholder="#1 Short Street">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    placeholder="Apartment, Suite, Unit, etc: (optional)">
                                            </div>
                                        </div>
                                        <div class="w-100"></div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="towncity">Town / City</label>
                                                <input type="text" class="form-control" placeholder="Port-Of-Spain">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="postcodezip">Postcode / ZIP *</label>
                                                <input type="text" class="form-control" placeholder="00000">
                                            </div>
                                        </div>
                                        <div class="w-100"></div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" placeholder="+1-868-123-1234">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="emailaddress">Email Address</label>
                                                <input type="text" class="form-control" placeholder="johndoe@mail.com">
                                            </div>
                                        </div>
                                        <div class="w-100"></div>

                                        <div class="col-md-12">
                                            <div class="form-group mt-4">
                                                <div class="radio">
                                                    <label><input type="radio" name="optradio"> Ship to different
                                                        address</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total bg-light p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Cart Total</h3>
                                <p class="d-flex">
                                    <span>Subtotal</span>
                                    <span>${{ app('CustomHelper')->formatPrice($cart_data->getSubtotal()) }}</span>
                                </p>
                                {{-- <p class="d-flex">
                                    <span>Delivery</span>
                                    <span>TBD</span>
                                </p>
                                <p class="d-flex">
                                    <span>Discount</span>
                                    <span>TBD</span>
                                </p> --}}
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span>${{ app('CustomHelper')->formatPrice($cart_data->getTotal()) }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cart-detail bg-light p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Payment Method</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" class="mr-2"> Direct Bank
                                                Tranfer</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" class="mr-2"> Stripe
                                                Checkout</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" class="mr-2"> I have read and accept
                                                the terms and conditions</label>
                                        </div>
                                    </div>
                                </div>

                                <x-core.stripe-ui />
                                {{-- <p><a href="#" class="btn btn-primary py-3 px-4">Place an order</a></p> --}}
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
            </div>
        </div>
    </section> <!-- .section -->





</x-mylayouts.layout-default>
