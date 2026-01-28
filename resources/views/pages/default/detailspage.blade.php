<x-mylayouts.layout-default title="Product Details">


    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-5 ftco-animate">
                    <a href="{{ $data->getImage() }}" class="image-popup prod-img-bg"><img src="{{ $data->getImage() }}"
                            class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-7 product-details pl-md-5 ftco-animate">
                    <h3>{{ $data->title }}</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">{{ Str::ucfirst($data->category) }} <span
                                    style="color: #bbb;">Category</span></a>
                        </p>
                    </div>
                    <p class="price"><span>${{ $data->getPrice() }}</span></p>
                    <div>
                        {{ $data->short_description }}
                    </div>


                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mt-4">
                            <div class="w-100"></div>


                            <div class="input-group col-md-6 d-flex mb-3 custom-inputs">
                                <span class="input-group-btn mr-2">
                                    <button type="button" class="quantity-left-minus btn" data-type="minus" data-field=""> <i
                                            class="ion-ios-remove"></i>
                                    </button>
                                </span>

                                <input type="number" id="quantity" name="quantity" class="quantity form-control input-number"
                                    value="1" min="1" max="10">

                                <span class="input-group-btn ml-2">
                                    <button type="button" class="quantity-right-plus btn" data-type="plus" data-field=""> <i
                                            class="ion-ios-add"></i>
                                    </button>
                                </span>
                            </div>

                            <input type="hidden" name="product_id" value="{{ $data->id }}">


                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <p style="color: #000;">
                                    Available: {{ $data->quantity }} in stock
                                </p>
                            </div>
                        </div>
                        <button class="btn btn-primary py-3 px-5 mr-2">Add to Cart</button>
                        {{-- <p><a href="cart.html" class="btn btn-black py-3 px-5 mr-2">Add to Cart</a><a
                                href="cart.html" class="btn btn-primary py-3 px-5">Buy now</a></p> --}}
                    </form>

                </div>
            </div>




            <div class="row mt-5">
                <div class="col-md-12 nav-link-wrap">
                    <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1"
                            role="tab" aria-controls="v-pills-1" aria-selected="true">Description</a>

                        <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
                            role="tab" aria-controls="v-pills-2" aria-selected="false">Manufacturer</a>

                        <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab"
                            aria-controls="v-pills-3" aria-selected="false">Reviews</a>

                    </div>
                </div>
                <div class="col-md-12 tab-wrap">

                    <div class="tab-content bg-light" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                            <div class="p-4">
                                <h3 class="mb-4">{{ $data->title }}</h3>
                                <p>{{ $data->short_description }}</p>
                                <p>{{ $data->full_description }}</p>
                                <p>
                                    Available: {{ $data->quantity }} in stock
                                    <br>
                                    Category: {{ Str::ucfirst($data->category) }}
                                </p>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
                            <div class="p-4">
                                <h3 class="mb-4">Manufactured By {{ Str::before($data->title, ' ') }}</h3>
                                <p>{{ $data->short_description }}</p>
                                <p>{{ $data->full_description }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                            <div class="row p-4">
                                <div class="col-md-7">
                                    <h3 class="mb-4">23 Reviews</h3>
                                    <div class="review">
                                        <div class="user-img"
                                            style="background-image: url({{ asset('template_default/images/person_1.jpg') }})">
                                        </div>
                                        <div class="desc">
                                            <h4>
                                                <span class="text-left">Jacob Doe</span>
                                                <span
                                                    class="text-right">{{ \Carbon\Carbon::now()->subDays(rand(0, 2))->format('d F Y') }}
                                                </span>
                                            </h4>
                                            <p class="star">
                                                <span>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star"></i>
                                                </span>
                                                <span class="text-right"><a href="#" class="reply"><i
                                                            class="icon-reply"></i></a></span>
                                            </p>
                                            <p>When she reached the first hills of the Italic Mountains, she had a last
                                                view back on the skyline of her hometown Bookmarksgrov</p>
                                        </div>
                                    </div>
                                    <div class="review">
                                        <div class="user-img"
                                            style="background-image: url({{ asset('template_default/images/person_2.jpg') }})">
                                        </div>
                                        <div class="desc">
                                            <h4>
                                                <span class="text-left">Chris Johnson</span>
                                                <span
                                                    class="text-right">{{ \Carbon\Carbon::now()->subDays(rand(3, 5))->format('d F Y') }}
                                                </span>
                                            </h4>
                                            <p class="star">
                                                <span>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star-outline"></i>
                                                </span>
                                                <span class="text-right"><a href="#" class="reply"><i
                                                            class="icon-reply"></i></a></span>
                                            </p>
                                            <p>When she reached the first hills of the Italic Mountains, she had a last
                                                view back on the skyline of her hometown Bookmarksgrov</p>
                                        </div>
                                    </div>
                                    <div class="review">
                                        <div class="user-img"
                                            style="background-image: url('{{ asset('template_default/images/person_3.jpg') }}')">
                                        </div>
                                        <div class="desc">
                                            <h4>
                                                <span class="text-left">William Smith</span>
                                                <span
                                                    class="text-right">{{ \Carbon\Carbon::now()->subDays(rand(6, 7))->format('d F Y') }}
                                                </span>
                                            </h4>
                                            <p class="star">
                                                <span>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star"></i>
                                                    <i class="ion-ios-star-outline"></i>
                                                    <i class="ion-ios-star-outline"></i>
                                                </span>
                                                <span class="text-right"><a href="#" class="reply"><i
                                                            class="icon-reply"></i></a></span>
                                            </p>
                                            <p>When she reached the first hills of the Italic Mountains, she had a last
                                                view back on the skyline of her hometown Bookmarksgrov</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="rating-wrap">
                                        <h3 class="mb-4">Give a Review</h3>
                                        <p class="star">
                                            <span>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                (57%)
                                            </span>
                                            <span>20 Reviews</span>
                                        </p>
                                        <p class="star">
                                            <span>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star-outline"></i>
                                                (29%)
                                            </span>
                                            <span>10 Reviews</span>
                                        </p>
                                        <p class="star">
                                            <span>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star-outline"></i>
                                                <i class="ion-ios-star-outline"></i>
                                                (14%)
                                            </span>
                                            <span>5 Reviews</span>
                                        </p>
                                        <p class="star">
                                            <span>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star-outline"></i>
                                                <i class="ion-ios-star-outline"></i>
                                                <i class="ion-ios-star-outline"></i>
                                                ( 0%)
                                            </span>
                                            <span>0 Reviews</span>
                                        </p>
                                        <p class="star">
                                            <span>
                                                <i class="ion-ios-star"></i>
                                                <i class="ion-ios-star-outline"></i>
                                                <i class="ion-ios-star-outline"></i>
                                                <i class="ion-ios-star-outline"></i>
                                                <i class="ion-ios-star-outline"></i>
                                                ( 0%)
                                            </span>
                                            <span>0 Reviews</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    {{-- Recommended Products --}}
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Ralated Products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">


                <div class="col-sm-12 col-md-12 col-lg-3 ftco-animate d-flex fadeInUp ftco-animated">
                    <div class="product d-flex flex-column">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="http://localhost:8000/storage/images/products/iphone1-4.jpg" alt="Colorlib Template">
                            <span class="status">50% Off</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3">
                            <div class="d-flex">
                                <div class="cat">
                                    <span>gold</span>
                                </div>
                                <div class="rating">
                                    <p class="text-right mb-0">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <h3><a href="http://localhost:8000/details/1">Iure qui debitis quia autem ut</a></h3>
                            <div class="pricing">

                                <span class="price-sale">$379.00</span>
                                <p></p>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="http://localhost:8000/cart/add/1" class="add-to-cart text-center py-2 mr-1"><span>Add
                                        to cart <i class="ion-ios-add ml-1"></i></span></a>
                                <a href="http://localhost:8000/details/1" class="buy-now text-center py-2">Details<span><i
                                            class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-12 col-lg-3 ftco-animate d-flex fadeInUp ftco-animated">
                    <div class="product d-flex flex-column">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="http://localhost:8000/storage/images/products/iphone1-4.jpg" alt="Colorlib Template">
                            <span class="status">50% Off</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3">
                            <div class="d-flex">
                                <div class="cat">
                                    <span>gold</span>
                                </div>
                                <div class="rating">
                                    <p class="text-right mb-0">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <h3><a href="http://localhost:8000/details/1">Iure qui debitis quia autem ut</a></h3>
                            <div class="pricing">

                                <span class="price-sale">$379.00</span>
                                <p></p>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="http://localhost:8000/cart/add/1" class="add-to-cart text-center py-2 mr-1"><span>Add
                                        to cart <i class="ion-ios-add ml-1"></i></span></a>
                                <a href="http://localhost:8000/details/1" class="buy-now text-center py-2">Details<span><i
                                            class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 col-md-12 col-lg-3 ftco-animate d-flex fadeInUp ftco-animated">
                    <div class="product d-flex flex-column">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="http://localhost:8000/storage/images/products/iphone1-4.jpg" alt="Colorlib Template">
                            <span class="status">50% Off</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3">
                            <div class="d-flex">
                                <div class="cat">
                                    <span>gold</span>
                                </div>
                                <div class="rating">
                                    <p class="text-right mb-0">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <h3><a href="http://localhost:8000/details/1">Iure qui debitis quia autem ut</a></h3>
                            <div class="pricing">

                                <span class="price-sale">$379.00</span>
                                <p></p>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="http://localhost:8000/cart/add/1" class="add-to-cart text-center py-2 mr-1"><span>Add
                                        to cart <i class="ion-ios-add ml-1"></i></span></a>
                                <a href="http://localhost:8000/details/1" class="buy-now text-center py-2">Details<span><i
                                            class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-3 ftco-animate d-flex fadeInUp ftco-animated">
                    <div class="product d-flex flex-column">
                        <a href="#" class="img-prod"><img class="img-fluid"
                                src="http://localhost:8000/storage/images/products/iphone1-4.jpg" alt="Colorlib Template">
                            <span class="status">50% Off</span>
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3">
                            <div class="d-flex">
                                <div class="cat">
                                    <span>gold</span>
                                </div>
                                <div class="rating">
                                    <p class="text-right mb-0">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <h3><a href="http://localhost:8000/details/1">Iure qui debitis quia autem ut</a></h3>
                            <div class="pricing">

                                <span class="price-sale">$379.00</span>
                                <p></p>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="http://localhost:8000/cart/add/1" class="add-to-cart text-center py-2 mr-1"><span>Add
                                        to cart <i class="ion-ios-add ml-1"></i></span></a>
                                <a href="http://localhost:8000/details/1" class="buy-now text-center py-2">Details<span><i
                                            class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>
    {{-- Recommended Products --}}



</x-mylayouts.layout-default>
