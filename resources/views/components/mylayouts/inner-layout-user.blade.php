<style>
    .user-layout-area2 {
        border-radius: 5px;
        min-height: 300px;
    }

    .layout-outer-left {
        border-radius: 5px 0px 0px 5px;
    }

    .user-layout-left,
    .user-layout-right {
        padding: 2rem 0rem;
    }

    @media (max-width: 767px) {
        .user-layout-area2 { min-height: unset; }
        .layout-outer-left { border-radius: 5px 5px 0 0; }
        .user-layout-left { padding: 1.5rem 0.5rem; }
        .user-layout-right { padding: 2rem 0.5rem; }
        .user-sidebar-list { display: flex; flex-wrap: wrap; width: 100%; padding: 0; justify-content: center; gap: 0.25rem; }
        .user-sidebar-list li { padding: 6px 12px; }
        .left-border { border-left: none; border-top: 1px solid rgb(49, 48, 48); }
    }



    .user-layout-area2 .tier-user-profile {
        width: 150px;
        height: 150px;
        display: block;
        text-align: center;
        margin: auto;
        border-radius: 50em;
        border: 4px solid transparent;
    }


    .user-layout-area2 .user-name {
        color: rgb(7, 7, 7);
        margin-bottom: 20px;
    }

    .user-sidebar-list {
        list-style: none;
        padding: 0px;
        display: inline-block;
        width: 80%;
        padding-left: 10%;
    }

    .user-sidebar-list li {
        text-align: left;
        color: black;
        padding: 8px 10px 8px 15px;
    }

    .user-sidebar-list li a {
        color: black;
        text-transform: uppercase;
        font-size: .9rem;
    }



    /* Only for tables out of place, add class="resize-table" */
    .resize-table {
        min-width: 100% !important;
        width: 100% !important;
    }


    .tier-gradient-bg {
        /* Gradient Colors: https://coolors.co/gradients */
        background: hsla(211, 66%, 87%, 1);

        background: linear-gradient(90deg, hsla(211, 66%, 87%, 1) 0%, hsla(348, 67%, 88%, 1) 50%, hsla(272, 26%, 72%, 1) 100%);

        background: -moz-linear-gradient(90deg, hsla(211, 66%, 87%, 1) 0%, hsla(348, 67%, 88%, 1) 50%, hsla(272, 26%, 72%, 1) 100%);

        background: -webkit-linear-gradient(90deg, hsla(211, 66%, 87%, 1) 0%, hsla(348, 67%, 88%, 1) 50%, hsla(272, 26%, 72%, 1) 100%);

        filter: progid: DXImageTransform.Microsoft.gradient(startColorstr="#C9DEF4", endColorstr="#F5CCD4", GradientType=1);
    }

    /*============= START DARK THEME =============
    user-layout-area2: area that holds everything
    layout-outer-left: To color left sidebar
    user-name: name of user li a,
    h4: sidebar text
    /*============= START DARK THEME =============


    /*============= START COLORED THEME =============*/
    .user-layout-area2 {
        border: 1px solid rgb(49, 48, 48);
    }

    .layout-outer-left {
        background-color: rgb(49, 48, 48);
    }


    .left-border {
        border-left: 1px solid rgb(49, 48, 48);
    }

    .user-layout-area2 .user-name {
        color: white;
        margin-bottom: 20px;
    }


    .user-sidebar-list li a,
    .user-sidebar-list h4 {
        color: white;
    }

    /*============= END COLORED THEME ================*/

    /*============= START LIGHT THEME ============= */
    /* .user-layout-area2 {
        border: 0px solid rgb(49, 48, 48);
    }

    .layout-outer-left {
        background-color: rgb(255, 255, 255);
    }

    .user-layout-left {
        color: white;
    }

    .left-border {
        border-left: 0px solid rgb(49, 48, 48);
    }

    .user-sidebar-list li a,
    .user-sidebar-list h4 {
        color: #6c6b6b;
    } */


    /*============= END LIGHT THEME ============= */
</style>

<div class="container my-5">

    <div class="row user-layout-area2">

        <div class="col-md-3 layout-outer-left">
            <div class="user-layout-left text-center">
                {{-- <img class="tier-user-profile mt-51" src="https://placehold.co/100x100" alt="">
                <h4 class="user-name">{{ Auth::user()->name }}</h4> --}}

                <ul class="user-sidebar-list">
                    <li><a href="{{ route('user.profile') }}" class="{{ Request::routeIs('user.profile') ? 'fw-bold text-warning' : '' }}">Profile</a></li>
                    <li><a href="{{ route('user.tiers.index') }}" class="{{ Request::routeIs('user.tiers.*') ? 'fw-bold text-warning' : '' }}">My Rewards</a></li>
                    <li><a href="{{ route('user.orders.index') }}" class="{{ Request::routeIs('user.orders.*') ? 'fw-bold text-warning' : '' }}">Order History</a></li>
                </ul>
            </div>

        </div>
        <div class="col-md-9 left-border">
            <div class="user-layout-right">
                {{ $slot }}
            </div>

        </div>


    </div>

</div>
