{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card-title">
                        <h3 class="card-label">{{ $paymentSettings->name }}</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    <form action="{{ route('create.paymentsetting') }}"  method="POST" class="form"  novalidate="novalidate">
                        @csrf
                        <div class="form-group">
                            <label>Secret Key</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter Secret Key" value="{{ $paymentSettings->secret_key }}" name="secret_key"/>
                            @if ($errors->has('secret_key'))
                                <span class="text-danger">{{ $errors->first('secret_key') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Public Key</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter Public Key" value="{{ $paymentSettings->public_key }}" name="public_key"/>
                            @if ($errors->has('public_key'))
                                <span class="text-danger">{{ $errors->first('secret_key') }}</span>
                            @endif
                        </div>
                    
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}" type="text/javascript"></script>
@endsection
