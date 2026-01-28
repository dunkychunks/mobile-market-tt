<x-mylayouts.layout-default title="Checkout">

    {{-- Source: https://www.w3schools.com/bootstrap4/bootstrap_jumbotron.asp --}}
    <div class="container my-4">
        <div class="jumbotron">
            <div class="row justify-content-center">

                <div
                    class="col-12 col-md-3 col-lg-3 cart-wrap ftco-animate
                    fadeInUp ftco-animated justify-content-center icon-jumbotron-container">
                    <i class="icon icon-jumbotron icon-check_circle"></i>
                </div>

                <div class="col-12 col-md-9 col-lg-7 cart-wrap ftco-animate ">
                    <h1>Your Purchase was <b>Successful</b></h1>
                    <p>Thank you for purchasing from our store.</p>

                    <br>

                    <a href="{{ route('store.index') }}" class="btn btn-primary py-3 px-4">
                        Return to Store Page
                    </a>
                </div>
            </div>
        </div>
    </div>



</x-mylayouts.layout-default>
