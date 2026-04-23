@php $paginator = $data ?? $product_data ?? null; @endphp
@if ($paginator && method_exists($paginator, 'links'))
    {{ $paginator->links('components.core.pagination-default') }}
@endif
