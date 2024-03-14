{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom example example-compact">
    <div class="card-header">
        <h3 class="card-title">
            Create Plan
        </h3>
        
    </div>
    <!--begin::Form-->
    <form action="{{ route('plan.post') }}" method="POST" class="form">
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
          <label>Plan Name:</label>
          <input name="plan_name" type="text" class="form-control" placeholder="Enter Plan Name"/>
          <span class="form-text text-muted">Please enter plan name</span>
         </div>

         <div class="form-group">
            <label>Plane Details <small>(Comma Seperate)</small>:</label>
            <textarea name="plan_details" class="form-control" placeholder="Ex: Item one, Item two ...."></textarea>
            <span class="form-text text-muted">Please enter plan details</span>
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input name="price" type="text" class="form-control" placeholder="Enter price"/>
            <span class="form-text text-muted">Please enter price</span>
        </div>

        <div class="form-group">
            <label>Stripe Payment Checkout Link:</label>
            <input name="stripe_payment_link" type="text" class="form-control" placeholder=""/>
            <span class="form-text text-muted">Please Stripe Payment Checkout Link</span>
        </div>
       
         <div class="form-group mb-0">
          <label>Active:</label>
          <div class="checkbox-list">
           <label class="checkbox checkbox-outline">
            <input type="checkbox" name="is_active" checked/>
            <span></span>
            Yes
           </label>
           
          </div>
         </div>
        </div>
        <div class="card-footer">
         <div class="row">
          <div class="col text-left">
           <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
