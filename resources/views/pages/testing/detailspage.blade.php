<x-mylayouts.layout-default>


    <h1>Details Page</h1>

    <div class="row">
        <div class="col-md-4">
            <img style="width: 200px; height: 200px" src="{{ $data->getImage() }}" alt="image">
            <p>{{ $data->title }}</p>
            <p>${{ $data->price }}</p>
            <p>${{ $data->getPrice() }}</p>
            <p>{{ $data->short_description }}</p>
            <p>{{ $data->full_description }}</p>
            <p>{{ $data->quantity }}</p>
            <p><a href="{{ route('shop.details', ['id' => $data->id]) }}">View</a></p>


            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="number" name="quantity" value="1">
                <input type="submit" value="Add to cart">
                <input type="hidden" name="product_id" value="{{ $data->id }}">
            </form>


            <br>
            <br>
            <br>
            <br>


        </div>
    </div>


</x-mylayouts.layout-default>
