@if (session('success'))
    <div class="alert alert-success text-center m-3 msg">{{session('success')}}</div>
@endif
@if (session('error'))
    <div class="alert alert-danger text-center m-3 msg">{{session('error')}}</div>
@endif
