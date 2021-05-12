@extends('layouts.app', ['page' => 'New Admission', 'pageSlug' => 'admission', 'section' => 'inventory'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New Clearance</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('admission.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('clearance.store') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Admission Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Name_of_Deceased</label>
                                    <input type="text" name=" name_of_deceased"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{$bills[0]->name_of_deceased}}" required  readonly>
                                    @include('alerts.feedback', ['field' => 'name_of_deceased'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Admission Number</label>
                                    <input type="text" name="adm_no"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{$bills[0]->id}}" required  readonly>
                                    @include('alerts.feedback', ['field' => 'adm_no'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Name</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{$bills[0]->name}}" required  readonly>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">ID_NO</label>
                                    <input type="text" name="id_no"  class="form-control form-control-alternative{{ $errors->has('id_no') ? ' is-invalid' : '' }}" placeholder="Name" value="{{$bills[0]->id_no}}" required  readonly>
                                    @include('alerts.feedback', ['field' => 'id_no'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">Payment Receipt No</label>
                                    <input type="text" name="rct_no" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{$rct_id}}" readonly>
                                    @include('alerts.feedback', ['field' => 'id_no'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">Disposal Permit No</label>
                                    <input type="text" name="permit_no"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{$bills[0]->permit_no}}" required readonly>
                                    @include('alerts.feedback', ['field' => 'permit_no'])
                                </div>
{{--                                <div class="row">--}}
{{--                                    <div>--}}
{{--                                        <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">--}}
{{--                                            <label class="form-control-label" for="input-stock">County</label>--}}

{{--                                            <select name="county"  class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"  required>--}}

{{--                                                @foreach ($counties as $county)--}}

{{--                                                    <option value="{{$county}}" selected>{{$county}}</option>--}}

{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            @include('alerts.feedback', ['field' => 'subcounty'])--}}
{{--                                            <label class="form-control-label"for="input-name">County</label>--}}
{{--                                            <input type="text" name="county"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{$bills[0]->permit_no}}" required readonly>--}}
{{--                                            @include('alerts.feedback', ['field' => 'permit_no'])--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div class="form-group{{ $errors->has('stock_defective') ? ' has-danger' : '' }}">--}}
{{--                                            <label class="form-control-label" for="input-stock_defective">Subcounties</label>--}}
{{--                                            <select name="subcounty" id="subcounty" class="form-select2 form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>--}}
{{--                                                @foreach ($subcounties as $subcounty)--}}

{{--                                                    <option value="{{$subcounty}}" selected>{{$subcounty}}</option>--}}

{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            @include('alerts.feedback', ['field' => 'stock_defective'])--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">--}}
{{--                                            <label class="form-control-label" for="input-price">Location</label>--}}
{{--                                            <input type="text"  name="location" class="form-control form-control-alternative" placeholder="Location" value="{{ old('home_area') }}" required autofocus >--}}
{{--                                            @include('alerts.feedback', ['field' => 'home_area'])--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
                                <div class="row">
                                    <div>
                                        <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-price">County</label>
                                            <input type="text"  name="county" class="form-control form-control-alternative" placeholder="County" value="{{ old('home_area') }}" required autofocus >
                                            @include('alerts.feedback', ['field' => 'home_area'])
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group{{ $errors->has('stock_defective') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-price">Subcounty</label>
                                            <input type="text"  name="subcounty" class="form-control form-control-alternative" placeholder="Subcounty" value="{{ old('home_area') }}" required autofocus >
                                            @include('alerts.feedback', ['field' => 'home_area'])
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-price">Location</label>
                                            <input type="text"  name="location" class="form-control form-control-alternative" placeholder="Location" value="{{ old('home_area') }}" required autofocus >
                                            @include('alerts.feedback', ['field' => 'home_area'])
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-price">Village</label>
                                        <input type="text"  name="village" class="form-control form-control-alternative" placeholder="village" value="{{ old('home_area') }}" required>
                                        @include('alerts.feedback', ['field' => 'village'])
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-price">Nearest Shopping Centre</label>
                                            <input type="text"  name="nearest_centre" class="form-control form-control-alternative" placeholder="nearest_centre" value="{{ old('nearest_centre') }}" required>
                                            @include('alerts.feedback', ['field' => 'nearest_centre'])
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-price">nearest_police</label>
                                            <input type="text"  name="nearest_police" class="form-control form-control-alternative" placeholder="nearest_police" value="{{ old('nearest_police') }}" required>
                                            @include('alerts.feedback', ['field' => 'nearest_police'])
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">Witness Name</label>
                                    <input type="text" name="witness" id="input-Telephone_no" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Witness Name" value="{{ old('Witness Name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'Witness Name<'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">Witness ID Number</label>
                                    <input type="text" name="witness_id" id="input-Admission Date" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Witness ID Number" value="{{ old('Witness ID Number') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'date_admitted'])
                                </div>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-price">Authorizing Officer</label>
                                        <input type="text"  name="auth_officer" class="form-control form-control-alternative" placeholder="auth_officer" value="{{ old('') }}" required>
                                        @include('alerts.feedback', ['field' => 'auth_officer'])
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-price">Uphome Release Officer</label>
                                            <input type="text"  name="release_officer" class="form-control form-control-alternative" placeholder="nearest_centre" value="{{ old('Release Officer') }}" required>
                                            @include('alerts.feedback', ['field' => 'release_officer'])
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                            <label class="form-control-label" for="input-price">Body Release Date</label>
                                            <input type="date"  name="release_date" class="form-control form-control-alternative" placeholder="nearest_police" value="{{ \Carbon\Carbon::now() }}" required>
                                            @include('alerts.feedback', ['field' => 'release_date'])
                                        </div>
                                    </div>

                                </div>




                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
            select: '.form-select3'
        })
    </script>
@endpush
