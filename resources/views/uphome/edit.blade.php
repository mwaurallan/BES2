@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile', 'section' => 'users'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Edit Admission</h5>
                </div>
                <form method="post" action="{{ route('admin.update') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            @include('alerts.success')
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>Enter File Number</label>
                            <input type="text" name="id" class="form-control " value="{{$admin->id}}" readonly>
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>


                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>permit_no</label>
                                <input type="text" name="permit_no" class="form-control" value="{{$admin->permit_no}}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>Name Of Deceased</label>
                            <input type="text" name="name_of_deceased" class="form-control" value="{{$admin->name_of_deceased}}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>Name(Next Of Kin</label>
                            <input type="text" name="name" class="form-control" value="{{$admin->name}}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>ID_NO</label>
                            <input type="text" name="id_no" class="form-control" value="{{$admin->id_no}}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>Home_Area</label>
                            <input type="text" name="home_area" class="form-control" value="{{$admin->home_area}}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>Telephone_Number</label>
                            <input type="text" name="tel_no" class="form-control" value="{{$admin->tel_no}}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>Telephone2</label>
                            <input type="text" name="tel_no2" class="form-control" value="{{$admin->tel_no2}}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label>Realatioship</label>
                            <input type="text" name="relationship" class="form-control" value="{{$admin->relationship}}">
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
{{--                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">--}}
{{--                            <label>Telephone_Number</label>--}}
{{--                            <input type="text" name="tel_no" class="form-control" value="{{$admin->tel_no}}">--}}
{{--                            @include('alerts.feedback', ['field' => 'name'])--}}
{{--                        </div>--}}

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">Save</button>
                    </div>
                </form>
            </div>


        </div>
{{--        <div class="col-md-4">--}}
{{--            <div class="card card-user">--}}
{{--                <div class="card-body">--}}
{{--                    <p class="card-text">--}}
{{--                        <div class="author">--}}
{{--                            <div class="block block-one"></div>--}}
{{--                            <div class="block block-two"></div>--}}
{{--                            <div class="block block-three"></div>--}}
{{--                            <div class="block block-four"></div>--}}
{{--                            <a href="#">--}}
{{--                                <img class="avatar" src="{{ asset('assets/img/emilyz.jpg') }}" alt="">--}}
{{--                                <h5 class="title">{{ auth()->user()->name }}</h5>--}}
{{--                            </a>--}}
{{--                            <p class="description"></p>--}}
{{--                        </div>--}}
{{--                    </p>--}}
{{--                    <div class="card-description"></div>--}}
{{--                </div>--}}

{{--                --}}{{-- <div class="card-footer">--}}
{{--                    <div class="button-container">--}}
{{--                        <button class="btn btn-icon btn-round btn-facebook">--}}
{{--                            <i class="fab fa-facebook"></i>--}}
{{--                        </button>--}}
{{--                        <button class="btn btn-icon btn-round btn-twitter">--}}
{{--                            <i class="fab fa-twitter"></i>--}}
{{--                        </button>--}}
{{--                        <button class="btn btn-icon btn-round btn-google">--}}
{{--                            <i class="fab fa-google-plus"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div> --}}
{{--            </div>--}}
        </div>
    </div>
@endsection
