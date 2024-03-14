{{-- Extends layout --}}
@extends('user-dashboard.layout')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('update.myprofile') }}" method="POST" class="form"  novalidate="novalidate">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>First Name:</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter first name" value="{{ $user->first_name }}" name="first_name"/>
                                @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter last name" value="{{ $user->last_name }}" name="last_name"/>
                                @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        
                            <div class="form-group">
                                <label>Email address:</label>
                                <input readonly type="email" name="email" class="form-control form-control-solid" placeholder="Enter email"  value="{{ $user->email }}"/>
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                        


                            
                        

                        
                            {{-- <div class="form-group">
                                <label>Password:</label>
                                <input class="form-control form-control-solid" type="password" placeholder="Password" name="password" autocomplete="off" />
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div> --}}
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            {{-- <div class="form-group">
                                <label>Confirm Password:</label>
                                <input class="form-control form-control-solid" type="password" placeholder="Confirm password" name="password_confirmation" autocomplete="off" />
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div> --}}
                            <!--end::Form group-->
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <div style="font-size: 20px">
                        Active Plan:
                        <br>
                        @if($user->active_plan)
                        <h4 class="label label-lg label-light-success label-inline font-weight-bold py-4">{{ $plan->plan_name }}</h4>
                        @else
                        <h4 class="label label-lg label-light-warning label-inline font-weight-bold py-4">Free</h4>
                        @endif
                    </div>
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
   
@endsection
