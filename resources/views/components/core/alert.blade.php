@if(Session::has('message'))


<!-- Source: https://www.w3schools.com/bootstrap5/bootstrap_alerts.php -->
<div class="container my-4">
    <div class="alert alert-success">
        <strong>Success!</strong> {{ session('message') }}
    </div>
</div>

@endif
