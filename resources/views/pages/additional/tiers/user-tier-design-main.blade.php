{{-- page heading and intro text --}}
<h3 class="text-primary mb-1">My Tier Status</h3>
<p class="text-muted mb-4">Track your spending and see how close you are to the next reward tier.</p>
<hr class="border-secondary mb-4">

{{-- show a message if the user has already reached the highest tier --}}
@if (!$tier_helper->hasNextTier())
    <div class="d-flex align-items-center border border-secondary rounded p-3 mb-4">
        <i class="fas fa-trophy fa-2x text-secondary me-3"></i>
        <div>
            <strong class="text-primary">Highest Tier Achieved!</strong>
            <p class="mb-0 text-muted">You've reached the top. Thank you for your loyalty.</p>
        </div>
    </div>
@endif

{{-- show the user's current tier --}}
<div class="border border-secondary rounded p-4 mb-4">
    <p class="text-secondary mb-1"><i class="fas fa-star me-2"></i>Current Tier</p>
    <h4 class="text-primary mb-1">{{ Str::ucfirst($tier_helper->tier->title) }}</h4>
    <p class="text-muted mb-0">View tier benefits <a href="#" class="text-secondary">here.</a></p>
</div>

{{-- only show the next tier and overall progress if the user hasn't maxed out --}}
@if ($tier_helper->hasNextTier())

    {{-- how much more the user needs to spend to reach the next tier --}}
    <div class="border border-secondary rounded p-4 mb-4">
        <p class="text-secondary mb-1"><i class="fas fa-arrow-circle-up me-2"></i>Next Tier</p>
        <h4 class="text-primary mb-2">{{ Str::ucfirst($tier_helper->next_tier->title) }}</h4>
        <p class="text-muted mb-3">
            Spend <strong class="text-primary">${{ app('CustomHelper')->formatPrice($tier_helper->next_tier_amount) }}</strong> more to unlock this tier.
        </p>

        {{-- progress bar fills based on the percentage calculated in TierHelper --}}
        <div class="progress rounded-pill mb-1" style="height: 14px;">
            <div class="progress-bar bg-secondary" role="progressbar"
                style="width: {{ $tier_helper->next_tier_percent }}%"
                aria-valuenow="{{ $tier_helper->next_tier_percent }}"
                aria-valuemin="0" aria-valuemax="100">
                {{ $tier_helper->next_tier_percent }}%
            </div>
        </div>
    </div>

    {{-- shows how far along the user is toward reaching the max tier --}}
    <div class="border border-secondary rounded p-4 mb-4">
        <p class="text-secondary mb-1"><i class="fas fa-chart-line me-2"></i>Overall Progress</p>
        <p class="text-muted mb-3">
            Progress toward <strong class="text-primary">{{ $tier_helper->max_tier->title }}</strong>
            — needs <strong class="text-primary">${{ app('CustomHelper')->formatPrice($tier_helper->max_tier_amount) }}</strong> more total.
        </p>

        <div class="progress rounded-pill mb-1" style="height: 14px;">
            <div class="progress-bar bg-primary" role="progressbar"
                style="width: {{ $tier_helper->max_tier_percent }}%"
                aria-valuenow="{{ $tier_helper->max_tier_percent }}"
                aria-valuemin="0" aria-valuemax="100">
                {{ $tier_helper->max_tier_percent }}%
            </div>
        </div>
    </div>

@endif

{{-- total amount the user has spent across all paid orders --}}
<div class="border border-secondary rounded p-4 mb-4">
    <p class="text-secondary mb-1"><i class="fas fa-dollar-sign me-2"></i>Total Spending</p>
    <h4 class="text-primary mb-3">${{ app('CustomHelper')->formatPrice($tier_helper->spending) }}</h4>

    <div class="progress rounded-pill" style="height: 14px;">
        {{-- if the user still has tiers to reach, show their progress toward max; otherwise fill the bar --}}
        @if ($tier_helper->hasNextTier())
            <div class="progress-bar bg-primary" role="progressbar"
                style="width: {{ $tier_helper->max_tier_percent }}%"></div>
        @else
            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
        @endif
    </div>
</div>
