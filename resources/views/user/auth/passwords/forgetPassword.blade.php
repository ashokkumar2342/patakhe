@extends('user.layout.auth')
<!-- Main Content -->
@section('content')
<div class="container" id="app">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <router-view></router-view>            
        </div>
    </div>
</div>
@endsection
