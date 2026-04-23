{{--
    Product Advisor widget - suggests a product based on simple rules.
    Appears as a floating button that expands into a suggestion panel.
    No AI involved - uses category rules and stock availability.
--}}
@php
    // pick a featured or in-stock product to recommend
    $suggestion = \App\Models\Product::withPrices()
        ->where('status', 'active')
        ->inRandomOrder()
        ->first();
@endphp

@if($suggestion)
<div id="product-advisor" style="position:fixed; bottom:20px; right:20px; z-index:1050;">

    {{-- collapsed trigger button --}}
    <button id="advisor-toggle" onclick="toggleAdvisor()"
            class="btn btn-primary rounded-circle shadow"
            style="width:56px;height:56px;font-size:1.3rem;"
            title="Product Advisor">
        <i class="fas fa-lightbulb"></i>
    </button>

    {{-- expanded panel --}}
    <div id="advisor-panel" class="border border-secondary rounded bg-white shadow p-3 mb-2"
         style="display:none; width:260px; position:absolute; bottom:65px; right:0;">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="text-primary mb-0"><i class="fas fa-lightbulb me-1"></i> Product Advisor</h6>
            <button onclick="toggleAdvisor()" class="btn btn-sm btn-link p-0 text-muted">&times;</button>
        </div>
        <p class="text-muted small mb-2">Based on popular choices, you might like:</p>
        <div class="d-flex align-items-center mb-2">
            <img src="{{ $suggestion->getImage() }}" class="rounded-circle me-2"
                 style="width:42px;height:42px;object-fit:cover;" alt="{{ $suggestion->title }}">
            <div>
                <p class="mb-0 fw-semibold small">{{ $suggestion->title }}</p>
                <small class="text-muted">{{ ucfirst($suggestion->category) }}</small>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <span class="text-primary fw-bold">${{ $suggestion->getPrice() }}</span>
            <a href="{{ $suggestion->getLink() }}" class="btn btn-sm border border-secondary rounded-pill text-primary px-3">
                View <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<script>
function toggleAdvisor() {
    var panel = document.getElementById('advisor-panel');
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
}
</script>
@endif
