<div class="sidebar">
    <div class="sidebar-wrapper">
        <ul class="nav">
            {{-- <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-bar-32"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li @if ($pageSlug == 'clients') class="active " @endif>
                {{-- <a href="{{ route('admission.index') }}"> --}}
                    {{-- <a href="{{url('paymentShedule')}}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Admission</p>
                </a>
            </li>
            <li @if ($pageSlug == 'payments') class="active " @endif>
                <a href="{{ route('services.index') }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Billing</p>
                </a>
            </li>

            <li @if ($pageSlug == 'providers') class="active " @endif>
                <a href="{{ route('providers.index') }}">
                    <i class="tim-icons icon-delivery-fast"></i>
                    <p>Clearance</p>
                </a>
            </li>
            <li @if ($pageSlug == 'reports') class="active " @endif>
                <a href="{{ route('report.index') }}">
                    <i class="tim-icons icon-delivery-fast"></i>
                    <p>All Receipts</p>
                </a>
            </li> --}} --}}

{{--            <li @if ($pageSlug == 'methods') class="active " @endif>--}}
{{--                <a href="{{ route('methods.index') }}">--}}
{{--                    <i class="tim-icons icon-wallet-43"></i>--}}
{{--                    <p>REPORTS SUMMARY</p>--}}
{{--                </a>--}}
{{--            </li>--}}


            <!-- <li>
                <a data-toggle="collapse" href="#clients">
                    <i class="tim-icons icon-single-02" ></i>
                    <span class="nav-link-text">Clients</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="clients">
                    <ul class="nav pl-4">
                        {{-- <li @if ($pageSlug == 'clients-list') class="active " @endif>
                            <a href="{{ route('clients.index')  }}"> --}}
                                <i class="tim-icons icon-notes"></i>
                                <p>Administrar Clients</p>
                            </a>
                        </li>
                        {{-- <li @if ($pageSlug == 'clients-create') class="active " @endif>
                            <a href="{{ route('clients.create')  }}"> --}}
                                <i class="tim-icons icon-simple-add"></i>
                                <p>New Client</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->

            <li>
                <a data-toggle="collapse" href="#users" {{ $section == 'users' ? 'aria-expanded=true' : '' }}>
                    <i class="tim-icons icon-badge" ></i>
                    <p>REPORTS SUMMARY</p>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'users' ? 'aria-expanded=true' : '' }}" id="users">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'methods') class="active " @endif>
                            <a href="{{ route('methods.index') }}">
                                <i class="tim-icons icon-wallet-43"></i>
                                <p>Payments Summary</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'methods') class="active " @endif>
                            <a href="{{ route('methods.index') }}">
                                <i class="tim-icons icon-wallet-43"></i>
                                <p>Payments Summary2</p>
                            </a>

                        </li>
                        <li @if ($pageSlug == 'clients') class="active " @endif>
                            <a href="{{url('paymentShedule')}}">
                                <i class="tim-icons icon-wallet-43"></i>
                                <p>Payments Summary3</p>
                            </a>
                        </li>
                        {{-- <li @if ($pageSlug == 'users-list') class="active " @endif>
                            <a href="{{ route('users.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users-create') class="active " @endif>
                            <a href="{{ route('users.create')  }}">
                                <i class="tim-icons icon-simple-add"></i>
                                <p>New user</p>
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </li>



            {{-- <li>
                <a data-toggle="collapse" href="#users" {{ $section == 'users' ? 'aria-expanded=true' : '' }}>
                    <i class="tim-icons icon-badge" ></i>
                    <p>Users</p>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'users' ? 'aria-expanded=true' : '' }}" id="users">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-badge"></i>
                                <p>My profile</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users-list') class="active " @endif>
                            <a href="{{ route('users.index')  }}">
                                <i class="tim-icons icon-notes"></i>
                                <p>Manage Users</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users-create') class="active " @endif>
                            <a href="{{ route('users.create')  }}">
                                <i class="tim-icons icon-simple-add"></i>
                                <p>New user</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
        </ul>
    </div>
</div>
