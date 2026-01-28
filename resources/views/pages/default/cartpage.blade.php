<x-mylayouts.layout-default title="Cart">


    @if ($cart_data->isEmpty())
        <x-core.cart-empty />
    @else
        <section class="ftco-section ftco-cart pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($cart_data as $data)
                                        <tr class="text-center">
                                            <td class="product-remove">



                                                <form action="{{ route('cart.destroy', ['id' => $data->pivot->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn p-2 cart-btn" type="submit"><span
                                                            class="ion-ios-close"></span></button>
                                                </form>

                                                {{-- <a href="#"><span class="ion-ios-close"></span></a> --}}



                                            </td>

                                            <td class="image-prod">
                                                <div class="img" style="background-image:url('{{ $data->getImage() }}');">
                                                </div>
                                            </td>

                                            <td class="product-name">
                                                <h3>{{ $data->title }}</h3>
                                                <p class="text-center">
                                                    <a href="{{ $data->getLink() }}" class="btn btn-primary py-2 px-6">View
                                                        Details
                                                    </a>
                                                </p>

                                            </td>

                                            <td class="price">${{ app('CustomHelper')->formatPrice($data->getPrice()) }}</td>

                                            <td class="quantity">
                                                {{ $data->pivot->quantity }}
                                            </td>

                                            <td class="total">
                                                ${{ app('CustomHelper')->formatPrice($data->getCartQuantityPrice()) }}</td>
                                        </tr><!-- END TR-->
                                    @endforeach



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-start">
                    <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Cart Totals</h3>
                            <p class="d-flex">
                                <span>Subtotal</span>
                                <span>${{ app('CustomHelper')->formatPrice($cart_data->getSubtotal()) }}</span>
                            </p>
                            <p class="d-flex">
                                <span>Delivery</span>
                                <span>TBD</span>
                            </p>
                            <p class="d-flex">
                                <span>Discount</span>
                                <span>TBD</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>${{ app('CustomHelper')->formatPrice($cart_data->getTotal()) }}</span>
                            </p>
                        </div>
                        <p class="text-center">
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary py-3 px-4">
                                Proceed to Checkout
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </section>







    @endif
</x-mylayouts.layout-default>
