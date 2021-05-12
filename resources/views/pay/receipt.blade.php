@extends('layouts.app', ['page' => 'New Admission', 'pageSlug' => 'admission', 'section' => 'inventory'])

@section('content')

   <div id="body">
       <div class="card  center" style="width:60rem;">
       <div class="card-header">
           <div class="row no-gutters">
               <div class="col-auto">
                   <img src="{{ asset('assets/img/logo10.jpeg') }}" width="300" height="300" class="img-fluid" alt="Uphome Logo">
               </div>
               <div class="col">
                   <div class="card-block px-6" align="center">
                       <p class="card-text">UPHOME FUNERAL HOME</p>
                   </div>
                   <div align="center">
                       Email:uuphome44@gmail.com
                       <div>
                           Tel:0721875392/0729544203
                       </div>
                       <div>
                           Website:www.uphomefuneral.com
                       </div>
                       <div>
                           Along Nairobi-Nakuru Highway
                       </div>
                       <div class="myDiv2">
                           <h1>Official Receipt</h1>
                       </div>
                   </div>
               </div>
           </div>
       </div>
               <div class="card-body">
                   <table align="center">
                       <tbody>
                       <tr>

                           <td> <h1>Rct Number::{{$clients->id}}</h1></td>
                           <td><h1></h1></td>
                           <td> <h1>Receipt Date:{{$bills[0]->payment_date}}</h1></td>
                       </tr>
                       </tbody>
                   </table>
                   <table class="table" id="products_table">
                       <thead style="background-color:magenta">
                       <td><h1>Received From:{{$clients->name}}</h1> </td><td><h1>Name Of Deceased:{{$clients->name_of_deceased}}::</h1></td>
                       <thead> <td><h1>Bill_Total --{{number_format($pays->bill_total,0)}}</h1></td><td><h1>Amount_Paid->{{number_format($bills[0]->amount_paid,0)}} </h1></td></thead>

                      ----
                        <p></p>
                       </thead>

                       <tbody>

                       <tr>

                       </tr>
                       <tr>


                       </tr>
                       <tr>
                           <th>Services</th>
                           <th>Amount</th>

                       </tr>

                           @foreach ($orders as $order)

                                 <tr><td>{{$order->name}}</td><td>{{number_format($order->quantity,2)}}</td></tr>


                           @endforeach
                    <tr><td><p>Receipt Total</p></td><td><p>{{number_format($total,2)}}</p></td>
                    </tr>
                       <tr>
                           <td><p>Receipt Balance</p></td>
                           <td><h1>{{number_format($pays->bill_balance,0)}}</h1></td>
                       </tr>

                       <tr id="product1"></tr>

                       </tbody>

                   </table>


                   <div class="row">
                       <button id="print" onclick="printContent('body');" >Print</button>
                   </div>

           <div>

           </div>

   </div>
           </div>
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
    <script>
        function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
        }
    </script>
@endpush
