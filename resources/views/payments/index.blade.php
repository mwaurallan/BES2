@extends('layouts.app', ['page' => 'Clients', 'pageSlug' => 'clients', 'section' => 'clients'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Billing</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('services.create') }}" class="btn btn-sm btn-primary">New Bill</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table  class="table table tablesorter" id="myTable" >
                            <thead class=" text-primary">
                            <tr>


                                <th>Bill_ID</th>
                                <th>Name</th>
                                <th>Deceased</th>
                                <th>Bill_Total</th>
                                <th>Amount_Paid</th>
                                <th>Balance</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Actions</th>
                                <th>Delete Bill</th>
                            </tr>
                            </thead>
                            <tbody>

                               @foreach ($bills as $bill)

                                    <tr>
                                        <td>{{$bill->id }}</td>
                                        <td>{{$bill->name}}</td>
                                        <td>{{$bill->name_of_deceased}}</td>
                                        <td>{{$bill->bill_total}}</td>
                                        <td>{{$bill->amount_paid}}</td>
                                        <td>{{$bill->bill_balance}}</td>
                                        <td> </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="{{ url('print2/'.$bill->id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="Click To Pay">

                                                <i class="tim-icons icon-bank"></i>
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="tim-icons icon-settings-gear-63"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
{{--                                                    <a class="dropdown-item" href="{{ route('admin2.delete',$bill->id) }}"><p>{{ __('Delete') }}</p></a>--}}
                                                    <a class="dropdown-item"  onclick="return myFunction();" href="{{route('admin2.delete', $bill->id)}}"><p>{{ __('Delete') }}</p></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
<script>
    function myFunction() {
        if(!confirm("Are You Sure to delete this Bill"))
            event.preventDefault();
    }
</script>
@endpush
