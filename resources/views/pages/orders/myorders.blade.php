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
                    <th title="Field #2">Plan Name</th>
                    {{-- <th title="Field #3">User Full Name</th> --}}
                    {{-- <th title="Field #4">User Email</th> --}}
                    <th title="Field #5">Payment Id</th>
                    <th title="Field #5">Payment Status</th>
                    <th title="Field #6">Invoice Url</th>
                    <th title="Field #7">Invoice Pdf</th>
                    <th title="Field #8">Order Date</th>
                </tr>
                </thead>
                <tbody>
                    @php 
                        $i = 0;
                    @endphp
                    @foreach($all_orders as $order)
                    @php 
                        $i++;
                    @endphp
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $order->plan->plan_name; }}</td>
                            {{-- <td>{{ $order->user->first_name; }} {{ $order->user->last_name; }}</td> --}}
                            {{-- <td>{{ $order->user->email; }}</td> --}}
                            <td>{{ $order->session_id; }}</td>
                            
                            <td align="right">
                                <span style="width: 154px;">
                                    @if($order->payment_status)
                                        <span class="label font-weight-bold label-lg  label-light-success label-inline">Paid</span>
                                    @else
                                        <span class="label font-weight-bold label-lg  label-light-danger label-inline">Unpaid</span>
                                    @endif
                                </span>
                            </td>

                            <td>
                               <div class="acc-btns" >
                                    <a href="{{ $order->invoice_hosted_url }}" target="_blank" class="btn btn-icon btn-outline-danger">
                                        <i class="flaticon-folder-1"></i>
                                    </a>
                               </div>
                               
                            </td>

                            <td>
                                <div class="acc-btns" >
                                     <a href="{{ $order->invoice_pdf_url }}" target="_blank" class="btn btn-icon btn-outline-danger">
                                         <i class="flaticon2-medical-records"></i>
                                     </a>
                                </div>
                                
                             </td>

                             <td>
                                {{ date('d M, Y h:m:s', strtotime($order->created_at)); }}
                                
                                
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
