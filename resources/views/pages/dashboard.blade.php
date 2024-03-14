{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<style>

    .grid-sss{
        display: flex;
        align-items: center
    }

    .grid-sss .number-tot{
        font-size: 25px;
        margin-left: 10px
    }
</style>
    {{-- Dashboard 1 --}}

    <div class="card">
        <div class="card-body">

            @php
            $authUser = Auth::user();
            @endphp
            
            @if($authUser->user_role_name == 'admin')
                <div class="row">
                    <div class="col bg-light-warning px-6 py-8 rounded-xl m-2">
                        <div class="grid-sss">
                            {{ Metronic::getSVG("media/svg/icons/Media/Equalizer.svg", "svg-icon-3x svg-icon-warning d-block my-2") }}
                            <span class="text-warning number-tot font-weight-bold font-size-h5">{{ $total_user }}</span>
                        </div>
                        <a href="#" class="text-warning font-weight-bold font-size-h6">
                            Total Users
                        </a>
                    </div>

                    <div class="col bg-light-primary px-6 py-8 rounded-xl m-2">
                        <div class="grid-sss">
                            {{ Metronic::getSVG("media/svg/icons/Communication/Add-user.svg", "svg-icon-3x svg-icon-primary d-block my-2") }}
                            <span class="number-tot text-primary font-weight-bold font-size-h5">{{ $total_order }}</span>
                        </div>
                    
                        
                        <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">
                            Total Orders
                        </a>
                    </div>

                    <div class="col bg-light-danger px-6 py-8 rounded-xl m-2">

                        <div class="grid-sss">
                            {{ Metronic::getSVG("media/svg/icons/Communication/Add-user.svg", "svg-icon-3x svg-icon-danger d-block my-2") }}
                            <span class="number-tot text-danger font-weight-bold font-size-h5">{{ $total_plan }}</span>
                        </div>
                        <a href="#" class="text-danger font-weight-bold font-size-h6 mt-2">
                            Total Plans
                        </a>
                    </div>

                    <div class="col bg-light-success px-6 py-8 rounded-xl m-2">
                        <div class="grid-sss">
                            {{ Metronic::getSVG("media/svg/icons/Communication/Add-user.svg", "svg-icon-3x svg-icon-success d-block my-2") }}
                            <span class="number-tot text-success font-weight-bold font-size-h5">{{ $total_plugin }}</span>
                        </div>
                        <a href="#" class="text-success font-weight-bold font-size-h6 mt-2">
                            Total Plugins
                        </a>
                    </div>
                    {{-- <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7">
                        {{ Metronic::getSVG("media/svg/icons/Design/Layers.svg", "svg-icon-3x svg-icon-danger d-block my-2") }}
                        <a href="#" class="text-danger font-weight-bold font-size-h6 mt-2">
                            Item Orders
                        </a>
                    </div>
                    <div class="col bg-light-success px-6 py-8 rounded-xl">
                        {{ Metronic::getSVG("media/svg/icons/Communication/Urgent-mail.svg", "svg-icon-3x svg-icon-success d-block my-2") }}
                        <a href="#" class="text-success font-weight-bold font-size-h6 mt-2">
                            Bug Reports
                        </a>
                    </div> --}}
                </div>
            @else

                <div class="row">
                    <div class="col-md-4 bg-light-warning px-6 py-8 rounded-xl m-2">
                        <div class="grid-sss">
                            {{ Metronic::getSVG("media/svg/icons/Media/Equalizer.svg", "svg-icon-3x svg-icon-warning d-block my-2") }}
                            <span class="text-warning number-tot font-weight-bold font-size-h5">{{ $active_plan_name }}</span>
                        </div>
                        <a href="#" class="text-warning font-weight-bold font-size-h6">
                            Active Plan
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
