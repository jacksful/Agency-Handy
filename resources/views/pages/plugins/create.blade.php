{{-- Extends layout --}}
@extends('layout.default')


@section('styles')
<link href="{{ asset('plugins/custom/uppy/uppy.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- Content --}}
@section('content')

<style>
    .dropzone.dropzone-default .dz-remove{
        font-size: 18px;
        z-index: 1001;
        color: red;
    }
    .dz-error-message{
        display: none !important;
    }
</style>

<div class="card card-custom example example-compact">

    <!--begin::Form-->
    <form action="{{ route('plugin.store') }}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-right">Plugin Name:</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <input name="name" type="text" class="form-control" placeholder="Enter Plugin Name" value="{{ old('name') }}"/>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-right">Plan Name:</label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <select name="plan_id" class="form-control">
                            <option value="">Select Plan</option>
                            @foreach($all_plans as $plan)
                                <option <?php if(old('plan_id') == $plan->id) echo 'selected'; ?> value="{{ $plan->id }}">{{ $plan->plan_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('plan_id'))
                            <span class="text-danger">{{ $errors->first('plan_id') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-lg-3 col-form-label text-lg-right">Upload File:</label>
                    <div class="col-lg-6">
                       <input type="file" name="file" accept=".zip,.rar,.7zip" />
                       <div></div>
                       @if ($errors->has('file'))
                            <span class="text-danger">{{ $errors->first('file') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-right"></label>
                    <div class="col-lg-4 col-md-9 col-sm-12">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </div>
                    
                </div>
            </div>
        </div>
        
       </form>
    <!--end::Form-->
</div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
@endsection