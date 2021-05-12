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
                                <h1>Admission Form</h1>
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
                                <th scope="row"><h1>Adm_No</h1></th>
                                <td><div class="form-group"><h1><input type="text" class="form-control" value=""></h1></div></td>
{{--                                <td><h1>Name_Of_Deceased</h1></td>--}}
{{--                                <td><div class="form-group">--}}
{{--                                <h1><input type="text" class="form-control" value=" {{$admins->name_of_deceased}}"></h1></div></td>--}}
                            </tr>
                            <tr>
                                <td><h1>Name_Of_Deceased</h1></td>
                                <td><div class="form-group">
                                        <h1><input type="text" class="form-control" value=""></h1></div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
{{--                    <div>--}}
{{--                    <h1 style="color:red;"> Next Of Kin Details</h1>--}}
{{--                    </div>--}}
                    <div align="center" class="myDiv2">
                        <p style="color:red;">Next Of Kin Details</p>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                    <tr>
                        <th scope="row"><h1>Name</h1></th>
                        <td><div class="form-group"><h1><input type="text" class="form-control" value=""></h1></div></td>
                     </tr>
                        <tr>
                            <td><p>ID No:</p></td>
                            <td><div class="form-group">
                            <p><input type="text" class="form-control" value=""></p></div></td>
                        </tr>
                        <tr>
                            <td><label><p>Tel No:</p></label></td>
                            <td><input type="text"  class="form-control" size="40" value="" required></td>

                        </tr>
                        <tr>
                            <td><label><p>Tel No2:</p></label></td>
                            <td><input type="text"  class="form-control" size="47" value="" required></td>

                        </tr>
                </tbody>
                </table>
{{--                    <table class="table table-striped">--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">--}}
{{--                                <td><label><p>Tel No:</p></label></td>--}}
{{--                                <td><input type="text"  class="form-control" size="40" value="{{$admins->tel_no}}" required></td>--}}
{{--                                @include('alerts.feedback', ['field' => 'old_password'])--}}
{{--                            </div>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    <table class="table table-striped">--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">--}}
{{--                                <td><label><p>Tel No2:</p></label></td>--}}
{{--                                <td><input type="text"  class="form-control" size="47" value="{{$admins->tel_no2}}" required></td>--}}
{{--                                @include('alerts.feedback', ['field' => 'old_password'])--}}
{{--                            </div>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                <td><label><p>Date:</p></label></td>
                                <td><input type="text" class="form-control" size="30"  value="" required></td>
                                <td><label><p>Relationship:</p></label></td>
                                <td><input type="text" name="tel_no" class="form-control" size="60"  value="" required></td>
                                @include('alerts.feedback', ['field' => 'old_password'])
                            </div>
                        </tr>
                    </tbody>
                    </table>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                <td><label><p>Permit No:</p></label></td>
                                <td><input type="text" name="tel_no" class="form-control" size="60"  value="" required></td>
                                <td><label><p>Home_Area:</p></label></td>
                                <td><input type="text" name="tel_no" class="form-control" size="60"  value="" required></td>
                                @include('alerts.feedback', ['field' => 'old_password'])
                            </div>
                        </tr>
                        </tbody>
                    </table>
{{--                    <table class="table table-striped">--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">--}}
{{--                                <td><label><p>Relationship:</p></label></td>--}}
{{--                                <td><input type="text" name="tel_no" class="form-control" size="60"  value="{{$admins->relationship}}" required></td>--}}
{{--                                @include('alerts.feedback', ['field' => 'old_password'])--}}
{{--                            </div>--}}
{{--                        </tr>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
                    <div align="center" class="myDiv2">
                    <p style="color:red;">WITNESSED BY :CLERK AT UPHOME</p>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <textarea id="w3review" name="w3review" rows="6" cols="100" class="input2">

                                    Witness Name_____________________________Signature__________________

                                    Date Witnessed____________________________

                                </textarea>
                            </div>
                        </div>

                    </div>
                    <div align="center" class="myDiv2">
                    <p style="color:red;">IMPORTANT INSTRUCTIONS</p>
                    </div>
                    <div class="form-group">
                                <textarea  rows="5" cols="100" class="input2">
                                    1-ALL PAYMENTS,BRINGING OF CLEAN CLOTHES,COFFIN AND ORIGINAL BURIAL PERMIT
                                    TO BE PRESENTED A DAY BEFORE THE COLLECTION DAY BETWEEN MON - FRI by 4PM.
                                    NOTE:ON SUNDAYS CASHIERS OFFICE REMAIN CLOSED,KINDLY CLEAR WITH THE OFFICE ON
                                    SATURDAYS BETWEEN 7AM to 1PM.
                                </textarea>
                        <div align="center" class="myDiv2">
                            <p style="color:red;">NOTE:ANY LATE PAYMENT WILL INCUR A FINE OF 1000KSH</p>
                        </div>
                    </div>
                    <div class="myDiv3">
                    <P>I have read and understood all the terms and conditions and agreed to abide
                        by them Sign______________________________________</P>
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
