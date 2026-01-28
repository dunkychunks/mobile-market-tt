<x-mylayouts.layout-default title="Store">

    @if ($product_data->isEmpty())
        <x-core.products-empty />
    @else
        <section class="ftco-section bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-10 order-md-last">
                        <div class="row">


                            @foreach ($product_data as $data)
                                <div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
                                    <div class="product d-flex flex-column">
                                        <a href="#" class="img-prod"><img class="img-fluid" src="{{ $data->getImage() }}"
                                                alt="Colorlib Template">
                                            <span class="status">50% Off</span>
                                            <div class="overlay"></div>
                                        </a>
                                        <div class="text py-3 pb-4 px-3">
                                            <div class="d-flex">
                                                <div class="cat">
                                                    <span>{{ $data->category }}</span>
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
                                            <h3><a href="{{ $data->getLink() }}">{{ $data->title }}</a></h3>
                                            <div class="pricing">
                                                {{-- <p class="price"><span class="mr-2 price-dc">$120.00</span> --}}
                                                <span class="price-sale">${{ $data->getPrice() }}</span>
                                                </p>
                                            </div>
                                            <p class="bottom-area d-flex px-3">
                                                <a href="{{ route('cart.addfromstorepage', ['id' => $data->id]) }}"
                                                    class="add-to-cart text-center py-2 mr-1"><span>Add to cart <i
                                                            class="ion-ios-cart ml-1"></i></span></a>
                                                <a href="{{ $data->getLink() }}" class="buy-now text-center py-2">Details<span><i
                                                            class="ion-ios-information-circle ml-1 ml-1"></i></span></a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            @include('components.core.pagination-call', ['data' => $product_data])


                        </div>

                        {{-- <div class="row mt-5">
                            <div class="col text-center">
                                <div class="block-27">
                                    <ul>
                                        <li><a href="#">&lt;</a></li>
                                        <li class="active"><span>1</span></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li><a href="#">&gt;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}

                    </div>

                    <div class="col-md-4 col-lg-2">
                        <div class="sidebar">
                            <div class="sidebar-box-2">
                                <h2 class="heading">Categories</h2>
                                <div class="fancy-collapse-panel">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">Men's Shoes
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <ul>
                                                        <li><a href="#">Sport</a></li>
                                                        <li><a href="#">Casual</a></li>
                                                        <li><a href="#">Running</a></li>
                                                        <li><a href="#">Jordan</a></li>
                                                        <li><a href="#">Soccer</a></li>
                                                        <li><a href="#">Football</a></li>
                                                        <li><a href="#">Lifestyle</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                        href="#collapseTwo" aria-expanded="false"
                                                        aria-controls="collapseTwo">Women's
                                                        Shoes
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingTwo">
                                                <div class="panel-body">
                                                    <ul>
                                                        <li><a href="#">Sport</a></li>
                                                        <li><a href="#">Casual</a></li>
                                                        <li><a href="#">Running</a></li>
                                                        <li><a href="#">Jordan</a></li>
                                                        <li><a href="#">Soccer</a></li>
                                                        <li><a href="#">Football</a></li>
                                                        <li><a href="#">Lifestyle</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                        href="#collapseThree" aria-expanded="false"
                                                        aria-controls="collapseThree">Accessories
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingThree">
                                                <div class="panel-body">
                                                    <ul>
                                                        <li><a href="#">Jeans</a></li>
                                                        <li><a href="#">T-Shirt</a></li>
                                                        <li><a href="#">Jacket</a></li>
                                                        <li><a href="#">Shoes</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingFour">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                                                        href="#collapseFour" aria-expanded="false"
                                                        aria-controls="collapseThree">Clothing
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingFour">
                                                <div class="panel-body">
                                                    <ul>
                                                        <li><a href="#">Jeans</a></li>
                                                        <li><a href="#">T-Shirt</a></li>
                                                        <li><a href="#">Jacket</a></li>
                                                        <li><a href="#">Shoes</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-box-2">
                                <h2 class="heading">Price Range</h2>
                                <form method="post" class="colorlib-form-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="guests">Price from:</label>
                                                <div class="form-field">
                                                    <i class="icon icon-arrow-down3"></i>
                                                    <select name="people" id="people" class="form-control">
                                                        <option value="#">1</option>
                                                        <option value="#">200</option>
                                                        <option value="#">300</option>
                                                        <option value="#">400</option>
                                                        <option value="#">1000</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="guests">Price to:</label>
                                                <div class="form-field">
                                                    <i class="icon icon-arrow-down3"></i>
                                                    <select name="people" id="people" class="form-control">
                                                        <option value="#">2000</option>
                                                        <option value="#">4000</option>
                                                        <option value="#">6000</option>
                                                        <option value="#">8000</option>
                                                        <option value="#">10000</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif



</x-mylayouts.layout-default>
