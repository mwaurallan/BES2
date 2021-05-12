@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile', 'section' => 'users'])

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
                                <h1>Clearance Form</h1>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <form method="post" action="" autocomplete="off">

                    <div class="card-body">
                        <div class="myDiv">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><p>Adm No:</p></td>
                                    <td><div class="form-group">
                                    <p><input type="text" class="form-control" value=""></p></div></td>
                                </tr>
                                <tr>
                                    <th scope="row"><p>Deceased Name</p></th>
                                    <td><div class="form-group"><p><input type="text" class="form-control" value=""></p></div></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="myDiv2">
                        <p style="color:red;">(Relatives to check and comfirm name tag and body before removing)</p>
                        </div>
{{--                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">--}}
{{--                            <label  class="form-control-label" for="input-name"><p>Next Of Kin</p></label>--}}
{{--                            <input type="text" name="next_of_kin" class="form-control" placeholder="Name" value="{{$clients ?? ''->next_of_kin}}" readonly>--}}
{{--                            @include('alerts.feedback', ['field' => 'name'])--}}
{{--                        </div>--}}
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <td><p>Next Of Kin</p></td>
                                    <td><input type="text" name="tel_no" class="form-control" placeholder="" value="" required></td>
                                    @include('alerts.feedback', ['field' => 'old_password'])
                                </div>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <td><p>ID Number  :</p></td>
                                    <td><input type="text" name="tel_no" class="form-control" placeholder="" value="" required></td>
                                    @include('alerts.feedback', ['field' => 'old_password'])
                                </div>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <td><p>Receipt No:</p></td>
                                    <td><input type="text" name="tel_no" class="form-control" placeholder="" value="" required></td>
                                    @include('alerts.feedback', ['field' => 'old_password'])
                                </div>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <td><p>Permit   No     :</p></td>
                                    <td><input type="text" name="tel_no" class="form-control" placeholder="" value="" required></td>
                                    @include('alerts.feedback', ['field' => 'old_password'])
                                </div>
                            </tr>
                            </tbody>
                        </table>

                      <div class="myDiv">
                        <p style="color:red;">BODY DESTINATION</p>
                        </div>

                        <div class="row">
                            <div>
                                <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                   <p style="color:blue;">County</p>
                                    <input type="text" name="county" id="home_area" class="form-control" value=""readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                    <p style="color:blue;">SubCounty</p>
                                    <input type="text"  name="subcounty" id="home_area" class="form-control" value="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                    <p style="color:blue;">Location</p>
                                    <input type="text"  name="location" id="home_area" class="form-control" value="" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div>
                                <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                                    <p style="color:blue;">Village</p>
                                    <input type="text" name="village" id="home_area" class="form-control" value=""readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                    <p style="color:blue;">Nearest Shopping Centre</p>
                                    <input type="text"  name="nearest_centre" class="form-control" value="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                    <p style="color:blue;">Nearest Police</p>
                                    <input type="text"  name="nearest_police"  class="form-control" value="" readonly>
                                </div>
                            </div>

                        </div>
                        <div>
                            -
                        </div>
                        <div>
                           <h1 style="color:orangered;"> SIGNED__________________________   DATE__________________________________</h1>
                        </div>
                        <div class="myDiv">
                        <p style="color:red;">WITNESSES</p>
                        </div>
                        <div>
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                        <td><h2>Witness:</h2></td>
                                        <td><input type="text" name="tel_no" class="form-control" placeholder="" value="" required></td>
                                        @include('alerts.feedback', ['field' => 'old_password'])
                                    </div>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
{{--                            <div class="col-4">--}}
{{--                                 <div class="form-group">--}}
{{--                                   <h1 style="color:blue;">Witness</h1>--}}
{{--                                    <input type="text"  name="nearest_police"  class="form-control" value="{{$clients ?? ''->witness}}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-4">
                                <div class="form-group">
                                    <h1 style="color:blue;">Witness ID</h1>
                                    <input type="text"  name="witness_id"  class="form-control" value="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                   <h1 style="color:blue;">Signature</h1></label>
                                    <input type="text"  name="witness_id"  class="form-control" value="______________________________________________" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="myDiv">
                        <p style="color:red;">Uphomes Official Details</p>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-price"><p>Authorising Officer</p></label>
                                    <input type="text"  name="nearest_police"  class="form-control" value="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-price"><p>Releasing Officer</p></label>
                                    <input type="text"  name="witness_id"  class="form-control" value="" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-price"><p>Date Released</p></label>
                                    <input type="text"  name="witness_id"  class="form-control" value="" readonly>
                                </div>
                            </div>

                        </div>


                    </div>

                </form>
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
