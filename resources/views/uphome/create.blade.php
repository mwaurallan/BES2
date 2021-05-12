@extends('layouts.app', ['page' => 'New Admission', 'pageSlug' => 'admission', 'section' => 'inventory'])

@section('content')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New Admission</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('admission.index') }}" class="btn btn-sm btn-primary">Back to List</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admission.store') }}" autocomplete="off">
                            @csrf
                            <h6 class="heading-small text-muted mb-4">Admission Information</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Name_of_Deceased</label>
                                    <input type="text" name=" name_of_deceased" id="input-name_of_deceased" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name_of_Deceased" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name_of_deceased'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">Name</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">ID_NO</label>
                                    <input type="text" name="id_no" id="input-ID_NO" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="ID_NO" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'id_no'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">Home_Area</label>
                                    <input type="text" name="home_area"  class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Home_area" value="{{ old('home_area') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'id_no'])
                                </div>

{{--                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">--}}
{{--                                    <label class="form-control-label"for="input-name">Home_Area</label>--}}
{{--                                    <select name="home_area" id="home_area" class="form-select form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Home_Area" required>--}}
{{--                                        @foreach ($counties as $county)--}}

{{--                                            <option value="{{$county}}" selected>{{$county}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                    @include('alerts.feedback', ['field' => 'home_area'])--}}
{{--                                </div>--}}
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">Telephone_No</label>
                                    <input type="text" name="tel_no" id="input-Telephone_no" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Telephone_No" " required autofocus>
                                    @include('alerts.feedback', ['field' => 'tel_no'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">Telephone2</label>
                                    <input type="text" name="tel_no2" id="input-relationship" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Telephone2" }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'relationship'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">Admission_Date</label>
                                    <input type="date" name="date_admitted" id="input-Admission Date" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'date_admitted'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">Permit_No</label>
                                    <input type="text" name="permit_no" id="permit_no" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'permit_no'])
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label"for="input-name">Relationship</label>
                                    <input type="text" name="relationship" id="input-relationship" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'relationship'])
                                </div>

{{--                                <div class="row">--}}
{{--                                    <div>--}}
{{--                                        <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">--}}
{{--                                            <label class="form-control-label" for="input-stock">County</label>--}}

{{--                                            <select name="home_area" id="home_area" class="form-select2 form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>--}}

{{--                                                @foreach ($counties as $county)--}}

{{--                                                    <option value="{{$county}}" selected>{{$county}}</option>--}}

{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            @include('alerts.feedback', ['field' => 'subcounty'])--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div class="form-group{{ $errors->has('stock_defective') ? ' has-danger' : '' }}">--}}
{{--                                            <label class="form-control-label" for="input-stock_defective">Subcounties</label>--}}
{{--                                            <select name="subcounty" id="subcounty" class="form-select3 form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" required>--}}
{{--                                                @foreach ($subcounties as $subcounty)--}}

{{--                                                    <option value="{{$subcounty}}" selected>{{$subcounty}}</option>--}}

{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            @include('alerts.feedback', ['field' => 'stock_defective'])--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-4">--}}
{{--                                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">--}}
{{--                                            <label class="form-control-label" for="input-price">Home_Area</label>--}}
{{--                                            <input type="text"  name="home_area" id="home_area" class="form-control form-control-alternative" placeholder="Price" value="{{ old('home_area') }}" required>--}}
{{--                                            @include('alerts.feedback', ['field' => 'home_area'])--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </div>--}}

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
