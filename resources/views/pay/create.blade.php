@extends('layouts.app', ['page' => 'New Admission', 'pageSlug' => 'admission', 'section' => 'inventory'])

@section('content')
   <div>
       <div class="card-header">
           <div class="row">
               <div class="col-8">
                   <h4 class="card-title">Pay Bill</h4>
               </div>
               <div class="col-4 text-right">
                   <a href="{{ route('services.index') }}" class="btn btn-sm btn-primary">All Bills</a>
               </div>
           </div>
       </div>
       <form action="{{ route("pay.store") }}" method="POST">
           @csrf


           <div class="form-group {{ $errors->has('customer_email') ? 'has-error' : '' }}">
               Clients Name
               <input type="text" name="customer_email" class="form-control"
                      value="{{$admins->customer_name}}">
               @if($errors->has('customer_name'))
                   <em class="invalid-feedback">
                       {{ $errors->first('customer_email') }}
                   </em>
               @endif
           </div>
           <div class="form-group {{ $errors->has('customer_email') ? 'has-error' : '' }}">
               <input type="hidden" name="customer_email" class="form-control"
                      value="{{$admins->customer_email}}">
               @if($errors->has('customer_name'))
                   <em class="invalid-feedback">
                       {{ $errors->first('customer_email') }}
                   </em>
               @endif
           </div>
           <div class="form-group {{ $errors->has('order_id') ? 'has-error' : '' }}">

               <input type="hidden" name="order_id" class="form-control"
                      value="{{$admins->id}}">
               @if($errors->has('order_id'))
                   <em class="invalid-feedback">
                       {{ $errors->first('order_id') }}
                   </em>
               @endif
           </div>

           <div class="form-group {{ $errors->has('payment_date') ? 'has-error' : '' }}">
               Date Paid
               <input type="text" name="payment_date" id="dato" class="form-control" value="@php echo date('d-m-Y'); @endphp"/>
               @if($errors->has('payment_date'))
                   <em class="invalid-feedback">
                       {{ $errors->first('order_id') }}
                   </em>
               @endif
           </div>
           <div class="form-group {{ $errors->has('bill_total') ? 'has-error' : '' }}">
               Total Bill
               <input type="text" name="bill_total" class="form-control"
                      value="{{ $admins->bill_balance}}">
               @if($errors->has('bill_total'))
                   <em class="invalid-feedback">
                       {{ $errors->first('bill_total')}}
                   </em>
               @endif
           </div>
           <div class="form-group {{ $errors->has('amount_paid') ? 'has-error' : '' }}">
               Amount Paid
               <input type="text" name="amount_paid" class="form-control"
                      value="{{$admins->bill_balance}}">
               @if($errors->has('amount_paid'))
                   <em class="invalid-feedback">
                       {{ $errors->first('amount_paid') }}
                   </em>
               @endif
           </div>
           {{-- ... customer name and email fields --}}

           <div class="card">
               <div class="card-header">
              Services
               </div>

               <div class="card-body">
                   <table class="table" id="products_table">
                       <thead>
                       <tr>
                           <th>Services</th>
                           <th>Amount</th>
                       </tr>
                       </thead>
                       <tbody>


                           @foreach ($bills as $bill)

                                 <tr><td>{{$bill->name}}</td><td>{{$bill->quantity}}</td></tr>


                           @endforeach

                       <tr id="product1"></tr>

                       </tbody>

                   </table>


                   <div class="row">
                       <input class="btn btn-danger" type="submit">
                   </div>
               </div>
           </div>
           <div>

           </div>
       </form>
   </div>
@endsection

@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
        new SlimSelect({
            select: '.form-select2'
        })
        new SlimSelect({
            select: '.form-select4'
        })
    </script>
    <script>
        $(document).ready(function(){
            let row_number = 1;
            $("#add_row").click(function(e){
                e.preventDefault();
                let new_row_number = row_number - 1;
                $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
                $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
                row_number++;
            });

            $("#delete_row").click(function(e){
                e.preventDefault();
                if(row_number > 1){
                    $("#product" + (row_number - 1)).html('');
                    row_number--;
                }
            });
    });
    </script>
    <script>
        $(document).ready(function(){

            //iterate through each textboxes and add keyup
            //handler to trigger sum event
            $("#qty").each(function() {

                $(this).keyup(function(){
                    //calculateSum();
                   console.log('yes');
                });
            });

        });
    </script>

<script>
    $(document).ready(function(){
        $("#dato").datepicker({
            format: "dd-M-yyyy"
        });
    });
</script>
@endpush
