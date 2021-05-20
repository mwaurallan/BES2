@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile', 'section' => 'users'])

@section('content')

    <div id="body">


            <div class="card  center" style="width:60rem;">
                <div class="card-header">
                    <div class="row no-gutters">
                        <div class="col-auto">
                            {{-- <img src="{{ asset('assets/img/logo10.jpeg') }}" width="300" height="300" class="img-fluid" alt="Uphome Logo"> --}}
                        </div>
                        <div class="col">
                            <div class="card-block px-6" align="center">
                                <p class="card-text">BROAD EYE SERVICES LTD</p>
                            </div>
                            <div align="center">
                                Email:info@broadeyes.co.ke
                                <div>
                                    Tel:020-2352076/020-2351975
                                </div>
                                <div>
                                    Website:www.broadeyesservice.co.ke
                                </div>
                                <div>
                                    Along Nairobi-Nakuru Highway
                                </div>
                                <div class="myDiv2">
                                    <h1>Report Summary</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div>
                <table class="table">
                    <th>No</th>
                    <th>First_Name</th>
                    <th>Last_Name</th>
                    <th>Loan_Amount</th>
                    <th>Status</th>
                    <th>Client_Name</th>
                        {{-- @php
                        print_r($orders);die();
                            
                        @endphp --}}
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$order->first_name}}</td>
                            <td>{{$order->last_name}}</td>
                            <td>{{$order->loan_amount}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->name}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        {{-- <td><p>Totals</p></td>
                        <td></td>
                        <td></td>
                        <td><p>{{number_format($total,2)}}</p></td> --}}
                    </tr>
                </table>
                    </div>

                    </div>


                <div class="card-footer">
                    <button id="print" onclick="printContent('body');" >Print</button>
                </div>
            </div>



    </div>

@endsection
@push('js')
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
