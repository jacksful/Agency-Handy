{{-- Extends layout --}}
@extends('user-dashboard.layout')

@section('content')

    {{-- <section class="row">
        <div class="col-md-6 col-lg-4">
            <article class="p-4 rounded shadow-sm border-left
            mb-4">
                <a href="#" class="d-flex align-items-center">
                <span class="bi bi-box h5"></span>
                <h5 class="ml-2">Products</h5>
                </a>
            </article>
        </div>
        <div class="col-md-6 col-lg-4">
            <article class="p-4 rounded shadow-sm border-left mb-4">
                <a href="#" class="d-flex align-items-center">
                <span class="bi bi-person h5"></span>
                <h5 class="ml-2">Customers</h5>
                </a>
            </article>
        </div>
        <div class="col-md-6 col-lg-4">
            <article class="p-4 rounded shadow-sm border-left mb-4">
                <a href="#" class="d-flex align-items-center">
                <span class="bi bi-person-check h5"></span>
                <h5 class="ml-2">Sellers</h5>
                </a>
            </article>
        </div>
    </section> --}}
    @php
        $className = 'warning';
        if($active_plan_name != 'Free'){
            $className = 'success';
        }
    @endphp
    <div class="jumbotron jumbotron-fluid rounded bg-white border-0 shadow-sm text-center px-4">
        <div class="container">
            <h2 class="display-4 mb-2 text-primary">Hello, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h2>
            <p class="lead text-muted">Welcome Back</p>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 bg-light-{{ $className }} px-6 py-8 rounded-xl m-2">
                    <div class="grid-sss">
                        {{ Metronic::getSVG("media/svg/icons/Media/Equalizer.svg", "svg-icon-3x  d-block my-2 svg-icon-".$className) }}
                        
                        <span class="text-{{ $className }} number-tot font-weight-bold font-size-h5">You are in <strong style="font-size: 20px">{{ $active_plan_name }}</strong></span>
                    </div>
                    <a href="{{ url('/') }}#pricing" class="font-weight-bold font-size-h6 btn btn-info mt-5">
                        Upgrade Plan
                    </a>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>

@endsection