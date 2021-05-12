{{-- @extends('admin.adminlayouts.adminlayout') --}}
{{-- @extends('layouts.app', ['page' => 'New Method', 'pageSlug' => 'methods-summary2', 'section' => 'transactions']) --}}
@extends('layouts.app', ['page' => 'Clients', 'pageSlug' => 'clients', 'section' => 'clients'])

@section('head')

    <style>

        @media print {
            .no-print, .no-print * {
                display: none !important;
            }
        }
    </style>
@stop


@section('mainarea')

    <!-- BEGIN PAGE HEADER-->
    <div class="page-head">
        <div class="page-title no-print">
            <h1>
                Show Payments Shedule Summary
            </h1>
        </div>
        <div class="page-toolbar no-print">
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-fit-height red-sunglo dropdown-toggle" data-toggle="dropdown"
                        data-hover="dropdown" data-delay="1000" data-close-others="true">
                    @lang("core.actions") <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li>
                        <a href="javascript:;" onclick="window.print()"><i class="fa fa-print"></i> @lang("core.print")
                        </a>
                    </li>
                    @if(isset($services))
                    <li>
                        {{-- <a href="{{ url('admin/downloadSummary').'/'.$m.'/'.$y }}"><i class="fa fa-print"></i> Download To Excel --}}
                        </a>
                    </li>
                    @endif
                    {{--				<li>--}}
                    {{--					<a   href="{{ route('admin.payrolls.edit',$payroll->id)}}" ><i class="fa fa-edit"></i> @lang('core.edit')</a>--}}
                    {{--				</li>--}}

                    {{--				<li class="divider">--}}
                    {{--				</li>--}}
                    {{--				<li>--}}
                    {{--					<a   href="{{ route('admin.payrolls.downloadpdf',$payroll->id)}}" ><i class="fa fa-download"></i> @lang('core.btnDownload') PDF</a>--}}
                    {{--				</li>--}}
                </ul>
            </div>
        </div>
    </div>
{{--    <div class="page-bar">--}}
{{--        <ul class="page-breadcrumb breadcrumb">--}}
{{--            <li>--}}
{{--                <a onclick="loadView('{{route('admin.dashboard.index')}}')">@lang("core.dashboard")</a>--}}
{{--                <i class="fa fa-circle"></i>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a class="no-print" href="{{ route('admin.payrolls.index') }}">@lang("pages.payroll.indexTitle")</a>--}}
{{--                <i class="fa fa-circle"></i>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <span class="active">Show Summary</span>--}}
{{--            </li>--}}
{{--        </ul>--}}


{{--    </div>--}}
<br>
<br>
    <div class="portlet light bordered no-print">
        <div class="portlet-body">
            <div class="table-toolbar">
                <form method="post" action="{{ url('paymentShedule') }}">
                    @csrf
                    <div class="row ">
                        <div class="col-md-2 col-md-offset-3">
                            {{-- <div class="form-group">
                                <label>Month</label>
                                <select name="month" class="form-control" required>
                                    @if($services)
                                        @foreach($services as $service)
                                            <option value={{ $service}}</option>

                                        @endforeach
                                    @endif
                                </select>
                            </div> --}}
                      
                        <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                            <label class="form-control-label" for="input-stock"><p>Service Type</p></label>
                            <select name="service" id="home_area" class="form-select2 form-control" required>
                                @foreach ($services as $service)

                                    <option value="{{$service->id}}" selected>{{$service->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Year</label>
                                {{-- <select name="year" class="form-control" required>
                                    @if($years)
                                        @foreach($years as $month)
                                            <option value="{{ $month }}">{{ $month }}</option>
                                        @endforeach
                                    @endif
                                </select> --}}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 27px">Search
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @if(isset($services))
    <div class="portlet light">
        <div class="portlet-body">
            @include('methods.summary-view2')
        </div>
    </div>
    @endif
@stop

@section('footerjs')
<script>
    $.fn.select2.defaults.set("theme", "bootstrap");
    $('.select2me').select2({
        placeholder: "Select",
        width: '100%',
        allowClear: false
    });
</script>
@stop
