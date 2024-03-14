{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query"/>
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                                                </span>
                                </div>
                            </div>
                            
                           
                        </div>
                    </div>
                    
                </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">SL</th>
                    <th title="Field #2">First Name</th>
                    <th title="Field #4">Email</th>
                    <th title="Field #6">Licience Key</th>
                    <th title="Field #6">Active Plan</th>
                    
                </tr>
                </thead>
                <tbody>
                    @php 
                        $i = 0;
                    @endphp
                    @foreach($all_users as $user)
                    @php 
                        $i++;
                    @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $user->first_name; }}</td>
                            <td>{{ $user->email; }}</td>
                            <td>
                                {{ $user->licience_code }}
                            </td>
                            <td align="right">
                                <span style="width: 154px;">
                                    @if($user->active_plan)
                                        <span class="label font-weight-bold label-lg  label-light-success label-inline">{{ $user->active_plan }}</span>
                                    @else
                                        <span class="label font-weight-bold label-lg  label-light-danger label-inline">{{ $user->active_plan }}</span>
                                    @endif
                                </span>
                            </td>
                            
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
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
