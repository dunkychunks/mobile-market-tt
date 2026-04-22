<style>
    .custom-tier-area1 {
        /* Gradient Colors: https://coolors.co/gradients */
    }

    .custom-tier-area1 h2,
    .custom-tier-area1 p {
        margin-bottom: 0px;
    }

    .custom-tier-area1 .tier-user-profile {
        width: 200px;
        height: 200px;
        display: block;
        text-align: center;
        margin: auto;
        border-radius: 50em;
        border: 4px solid transparent;
    }

    .custom-tier-area1 .tier-progress {
        height: 15px;
        background-color: rgb(49, 48, 48);
        border: 1px solid #17a2b8
    }

    .custom-tier-area1 .tier-progress-bar {
        height: 15px;
        background: #17a2b8
    }
</style>

<div class="container1 my-51">
    <div class="card1 custom-tier-area1 p-3">


        {{-- <div class="card1 p-3 mb-5 text-center">
            <img class="tier-user-profile" src="https://placehold.co/600x600" alt="">
            <h2>{{ Auth::user()->name }}</h2>
        </div> --}}

        @if (!$tier_helper->hasNextTier())
        <h3>Achieved highest Tier</h3>
        <hr>
        @endif

        <div class="mb-5">
            <h4>Current: {{ Str::ucfirst($tier_helper->tier->title) }}</h4>
            <p>View tier benefits <a href="#">here.</a></p>
            {{-- <div class="progress tier-progress tier-gradient-bg">
                <div class="progress-bar tier-progress-bar" style="width:100%"></div>
            </div> --}}
        </div>


        @if ($tier_helper->hasNextTier())
        <div class="mb-5">
            <h4>Next: {{ Str::ucfirst($tier_helper->next_tier->title) }}</h4>
            <p>Spending needed for next tier: ${{ app('CustomHelper')->formatPrice($tier_helper->next_tier_amount) }}
            </p>
            <div class="progress tier-progress">
                <div class="progress-bar tier-progress-bar" style="width:{{ $tier_helper->next_tier_percent }}%">{{
                    $tier_helper->next_tier_percent }}%</div>
            </div>
        </div>


        <div class="mb-5">
            <h4>Overall Progress:</h4>
            <p>Spending needed for max tier ({{ $tier_helper->max_tier->title }}): ${{ app('CustomHelper')->formatPrice($tier_helper->max_tier_amount) }}</p>
            <div class="progress tier-progress">
                <div class="progress-bar tier-progress-bar" style="width:{{ $tier_helper->max_tier_percent }}%">
                    {{
                    $tier_helper->max_tier_percent }}%</div>
            </div>
        </div>
        @endif


        <div class="mb-5">
            <h4>Total Spending: {{ $tier_helper->spending }}</h4>
            <div class="progress tier-progress">
                @if ($tier_helper->hasNextTier())
                <div class="progress-bar tier-progress-bar" style="width:{{ $tier_helper->max_tier_percent }}%">
                    {{
                    $tier_helper->max_tier_percent }}%</div>
                @else
                <div class="progress-bar tier-progress-bar" style="width:100%"></div>
                @endif
            </div>
        </div>




    </div>
</div>
