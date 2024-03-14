{{-- Extends layout --}}
@extends('user-dashboard.layout')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
       
        <div class="card-body">
            <div class="bg-light-success rounded p-5" style="align-items: flex-end !important">
                <!--begin::Icon-->
               
                <!--begin::Title-->
                <div class="d-flex flex-column flex-grow-1 mr-2">
                    @if($plugin_code)
                        <span class="text-muted font-weight-bold font-size-lg mt-2" style="padding: 10px; font-size: 20px; border: 7px solid #b3e3e1; border-radius: 10px;">
                            
                                {{ $plugin_code }} 
                        
                        </span>
                    @endif
                </div>
                <!--end::Title-->
                <!--begin::Lable-->
                <!--end::Lable-->
            </div>
            
        </div>
    </div>

@endsection

