<form action="{{ route('checkout.stripe', ['payment' => 'stripe']) }}" method="POST">
    @csrf
    <button class="btn btn-primary py-3 px-4" type="submit">Checkout</button>
</form>
