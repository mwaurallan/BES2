@extends('layouts.app', ['page' => 'Clients', 'pageSlug' => 'clients', 'section' => 'clients'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8">
                            <h4 class="card-title">Clients</h4>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admission.create') }}" class="btn btn-sm btn-primary">New Admission</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table  class="table table tablesorter" id="myTable" >
                            <thead class=" text-primary">
                            <tr>


                                <th>Rct_No</th>
                                <th>Name Of Deceased</th>
                                <th>Name</th>
                                <th>Order_No</th>
                                <th>Payment_Date</th>
                                <th>Actions</th>
                                <th>Clear</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                               @foreach ($bills as $bill)

                                    <tr>
                                        <td>{{$bill->id }}</td>
                                        <td>{{$bill->name_of_deceased}}</td>
                                        <td>{{$bill->name}}</td>
                                        <td>{{$bill->order_id}}</td>
                                        <td>{{ $bill->payment_date }}</td>
                                                                             <td>
                                        <a href="{{ url('print3/'.$bill->id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('print4/'.$bill->id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="tim-icons icon-settings-gear-63"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('admin.edit',$bill->id) }}"><p>{{ __('Edit') }}</p></a>
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
@endpush
