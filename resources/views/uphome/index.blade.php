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
                        <div class="col-8 text-right">
{{--                            <a href="{{ route('admission.print2') }}" class="btn btn-sm btn-primary">Form</a>--}}
{{--                            <a href="{{ route('admission.print2'}}"  class="btn btn-sm btn-primary">Form</a>--}}
                            <a href="{{ url('print7') }}" class="btn btn-sm btn-primary">PrintForm</a>
                            <a href="{{ route('admission.create') }}" class="btn btn-sm btn-primary">New Admission</a>
                        </div>
{{--                        <div class="col-4 text-center">--}}
{{--                            <a href="{{ route('admission.create') }}" class="btn btn-sm btn-primary">New Admission</a>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts.success')

                    <div class="">
                        <table  class="table table tablesorter" id="myTable" >
                            <thead class=" text-primary">
                            <tr>

                                <th>AdmNo</th>
                                <th>Name</th>
                                <th>Name of Deceased</th>
                                <th>ID NO</th>
                                <th>Telephone</th>
                                <th>Burial_Permit</th>
                                <th>Date_Admitted</th>
                                <th>Actions</th>
                                <th>Clear</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                               @foreach ($clients as $client)

                                    <tr>
                                        <td>{{ $client->id}}</td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{$client->name_of_deceased}}</td>
                                        <td>{{ $client->id_no }}</td>
                                        <td> {{ $client->tel_no}}</td>
                                        <td>{{$client->permit_no }}</td>
                                        <td>{{$client->date_admitted}}</td>
                                        <td>
                                        <a href="{{ url('print/'.$client->id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                            <i class="tim-icons icon-zoom-split"></i>
                                        </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('print4/'.$client->id) }}" class="btn btn-link" data-toggle="tooltip" data-placement="bottom" title="More Details">
                                                <i class="tim-icons icon-zoom-split"></i>
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="tim-icons icon-settings-gear-63"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('admin.edit',$client->id) }}"><p>{{ __('Edit') }}</p></a>
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
