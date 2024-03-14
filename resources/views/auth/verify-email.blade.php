{{-- Extends layout --}}
@extends('user-dashboard.layout')

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
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Verify Your Email Address</div>
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ $message }}
                                </div>
                            @endif
                            Before proceeding, please check your email for a verification link. If you did not receive the email,
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">click here to request another</button>.
                            </form>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection
