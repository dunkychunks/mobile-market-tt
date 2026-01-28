  @if (isset($product_data) && method_exists($product_data, 'links'))
      {{ $product_data->links('components.core.pagination-default') }}
  @endif
