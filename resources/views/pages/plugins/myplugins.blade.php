{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
    @if(count($my_plugins))
    <div class="row">
        @foreach($my_plugins as $plugin)
        <div class="col-xl-4">
            <!--begin::Stats Widget 1-->
            <div class="card card-custom bgi-no-repeat card-stretch gutter-b" style="background-position: right top; background-size: 30% auto; background-image: url({{ asset('media/svg/shapes/abstract-4.svg') }})">
                <!--begin::Body-->
                <div class="card-body" style="position: relative">
                    <div style="display: flex; align-items:center">
                        <i class="flaticon2-box-1 text-success" style="font-size: 50px;"></i>
                        <p class="text-dark-75 font-weight-bolder font-size-h5 m-0 ml-5">{{ $plugin->name }}</p>
                    </div>
                    <a href="{{ route('download.file', $plugin->id) }}" class="btn btn-light-success btn-sm js-download mt-5">
                        <i class="flaticon-download"></i>Download</a>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Stats Widget 1-->
        </div>
        @endforeach
        
    </div>
    @else
    <div class="row">
        <div class="col-12 text-center">
            <p>To Get Plugins Please Upgrade your plan!</p>
            <a href="/" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Upgrade Your Plan</a>
        </div>
    </div>
    @endif

@endsection

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
@endsection
