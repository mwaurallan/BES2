@extends('layouts.app', ['page' => 'List of Products', 'pageSlug' => 'products', 'section' => 'inventory'])

@section('content')
    <div class="c-body">

        <main class="c-main content" id="content">

            <b-card>
                <b-card-header class="d-flex justify-content-between">
                    <b-card-title class="font-weight-bolder text-primary">Summary of All Disbursed Loans</b-card-title>
                    <div class="d-flex">
                        <form action="https://maricredit.com/reports/loans" method="get">
                            <input type="hidden" name="output" value="xlsx">
                            <b-button type="submit" variant="success">Download XLSX</b-button>
                        </form>
                        <form action="https://maricredit.com/reports/loans" method="get">
                            <input type="hidden" name="output" value="pdf">
                            <b-button type="submit" variant="danger">Download PDF</b-button>
                        </form>
                    </div>
                </b-card-header>
                <b-card-body class="p-2">
                    <b-row>
                        <b-col sm="12" md="6" lg="4">
                            <b-form inline method="GET" action="https://maricredit.com/reports/loans">
                                <b-form-group>
                                    <b-form-select value="" placeholder="Filter by Loan Product" name="product_id">
                                        <option value="">Filter by Loan Product</option>
                                        <option value="0">All</option>
                                        <option value="1"> MARI SHOP RENT</option>
                                        <option value="2"> MARI LANDLORD</option>
                                        <option value="3"> Construction</option>
                                        <option value="4"> FARMS</option>
                                        <option value="6"> Rent LOAN</option>
                                    </b-form-select>
                                </b-form-group>
                                <b-form-group>
                                    <b-button type="submit" variant="primary"><i class="cil-send"></i> Apply Filter</b-button>
                                </b-form-group>
                            </b-form>
                        </b-col>
                        <b-col sm="12" md="6" lg="4">
                            <b-form inline method="GET" action="https://maricredit.com/reports/loans">
                                <b-form-group>
                                    <b-form-text>Filter by Disbursement Date</b-form-text>
                                    <b-form-datepicker value="" placeholder="From" name="from"></b-form-datepicker>
                                    <b-form-datepicker value="" placeholder="To" name="to"></b-form-datepicker>
                                </b-form-group>

                                <b-form-group>
                                    <b-form-text><i class="cil-calendar"></i></b-form-text>
                                    <b-button type="submit" variant="primary"><div class=""><i class="cil-send"></i></div><div class="py-2">Filter</div></b-button>
                                </b-form-group>
                            </b-form>
                        </b-col>
                        <b-col md="6" lg="4">
                            <b-button tag="a" href="https://maricredit.com/reports/loans" class="pull-right" variant="dark"><i class="cil-exit-to-app"></i> Clear Filters</b-button>
                        </b-col>
                    </b-row>

                    <table class="w-100 table table-condensed">
                        <tbody>
                        <tr class="border-bottom">
                            <th>DISBURSED ON</th>
                            <th>BENEFICIARY</th>
                            <th>PRODUCT</th>
                            <th>DISBURSED BY</th>
                            <th class="text-right">PRINCIPAL</th>
                            <th class="text-right">AMOUNT</th>
                            <th class="text-right">PAID</th>
                            <th class="text-right">BALANCE</th>
                        </tr>
                        </tbody>
                    </table>
                </b-card-body>
            </b-card>
        </main>
    </div>

@endsection
