{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Create User</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                
                <!--begin::Button-->
                <a href="{{ route('user.all') }}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <circle fill="#000000" cx="9" cy="15" r="6"/>
                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>All Users</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('store.user') }}" method="POST" class="form"  novalidate="novalidate">
                        @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter first name" value="{{ old('first_name') }}" name="first_name"/>
                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Last Name:</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Enter last name" value="{{ old('last_name') }}" name="last_name"/>
                            @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                       
                        <div class="form-group">
                            <label>Email address:</label>
                            <input type="email" name="email" class="form-control form-control-solid" placeholder="Enter email"  value="{{ old('email') }}"/>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>User Type:</label>
                            <select class="form-control" name="user_role_name">
                                @php 
                                    $userTypes = ['user', 'admin'];
                                @endphp
                                @foreach($userTypes as $usrType)
                                    <option <?php if(old('user_role_name') == $usrType) echo 'selected'; ?> value="{{ $usrType }}">{{ $usrType }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('user_role_name'))
                                <span class="text-danger">{{ $errors->first('user_role_name') }}</span>
                            @endif
                            
                        </div>

                        <div class="form-group">
                            <label>Active Plan:</label>
                            <select class="form-control" name="active_plan">
                                <option value="0">Free</option>
                                @foreach($all_plans as $plan)
                                    <option <?php if(old('active_plan') == $plan->id) echo 'selected'; ?> value="{{ $plan->id }}">{{ $plan->plan_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('active_plan'))
                                <span class="text-danger">{{ $errors->first('active_plan') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input class="form-control form-control-solid" type="password" placeholder="Password" name="password" autocomplete="off" />
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <!--end::Form group-->
                        <!--begin::Form group-->
                        <div class="form-group">
                            <label>Confirm Password:</label>
                            <input class="form-control form-control-solid" type="password" placeholder="Confirm password" name="password_confirmation" autocomplete="off" />
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <!--end::Form group-->
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
