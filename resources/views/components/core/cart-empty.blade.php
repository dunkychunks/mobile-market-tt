{{-- Source: https://www.w3schools.com/bootstrap4/bootstrap_jumbotron.asp --}}

<div class="container my-4">
    <div class="jumbotron">
        <div class="row justify-content-center">

            <div
                class="col-12 col-md-3 col-lg-3 cart-wrap ftco-animate
                fadeInUp ftco-animated justify-content-center icon-jumbotron-container">
                <i class="icon icon-jumbotron icon-shopping-cart"></i>
            </div>

            <div class="col-12 col-md-8 col-lg-6 cart-wrap ftco-animate ">
                <h1>Your Cart is <b>Empty</b></h1>
                <p>Add something to your cart</p>

                <br>

                <a href="{{ route('store.index') }}" class="btn btn-primary py-3 px-4">
                    Start Shopping Here
                </a>
            </div>
        </div>
    </div>
</div>
