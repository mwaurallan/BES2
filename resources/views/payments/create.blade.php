@extends('layouts.app', ['page' => 'New Admission', 'pageSlug' => 'admission', 'section' => 'inventory'])

@section('content')
   <div>
       <div class="card-header">
           <div class="row">
               <div class="col-8">
                   <h4 class="card-title">Create Bills</h4>
               </div>
               <div class="col-4 text-right">
                   <a href="{{ route('services.index') }}" class="btn btn-sm btn-primary">All Bills</a>
               </div>
           </div>
       </div>
       <form action="{{ route("services.store") }}" method="POST">
           @csrf

           <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : '' }}">
               Customer name
               <select name="customer_name"  class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>
                   @foreach ($clients as $client)

                       <option value="{{$client->id}}" selected>{{$client->name}}</option>

                   @endforeach
               </select>

               @include('alerts.feedback', ['field' => 'home_area'])
           </div>
           <div class="form-group {{ $errors->has('customer_email') ? 'has-error' : '' }}">

               <input type="hidden" name="customer_email" class="form-control"
                      value="{{ old('customer_email') }}">
               @if($errors->has('customer_email'))
                   <em class="invalid-feedback">
                       {{ $errors->first('customer_email') }}
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
                           <th>Service</th>
                           <th>Amount</th>
                       </tr>
                       </thead>
                       <tbody>
                       <tr id="product0">
                           <td>
                               <select name="products[]" class="form-control">
                                   <option value="">-- choose service bill --</option>
                                   @foreach ($products as $product)
                                       <option value="{{ $product->id }}">
                                           {{ $product->name }} (Ksh{{ number_format($product->price, 2) }})
                                       </option>
                                   @endforeach
                               </select>
                           </td>

                           <td>
                               <input type="number" id="qty" name="quantities[]" class="form-control" value="1" />
                           </td>
                       </tr>
                       <tr id="product1"></tr>

                       </tbody>

                   </table>


                   <div class="row">
                       <div class="col-md-12">
                           <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>

                           <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                       </div>
                   </div>
               </div>
           </div>
           <div>
               <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
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


@endpush
