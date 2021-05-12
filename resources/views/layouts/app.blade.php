<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $page }} - {{ config('app.name') }}</title>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.23.0/slimselect.min.css" rel="stylesheet">

        <!-- Icons -->
        <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />

        <!-- CSS -->
        <link href="{{ asset('assets') }}/css/white-dashboard.css?v=1.0.0" rel="stylesheet" />
        <link href="{{ asset('assets') }}/css/theme.css" rel="stylesheet" />
        <link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

        <head>
            <style>
                .center {
                    margin: auto;
                    width: 60%;
                    border: 3px solid #73AD21;
                    padding: 10px;
                    text-align: left;
                }
                .center2 {
                    margin: auto;
                    width: 60%;
                    padding: 0px;
                    text-align:right;
                }
                .right {
                    position: absolute;
                    right: 10px;
                    width: 300px;
                    padding: 0px;
                }
                .right2 {
                    position: absolute;
                    right: 0px;
                    width: 300px;
                    padding:1px;
                    margin-top: 10px;
                }
                @media print {
                    #print {
                        display: none;
                    }
                }
                input {
                    border-top-style: hidden;
                    border-right-style: hidden;
                    border-left-style: hidden;
                    border-bottom-style: groove;
                    background-color: #eee;
                }
                .no-outline:focus {
                    outline: none;
                }
                p {
                    font-size: 1.2em;
                }
                h1{
                    font-size: 1.4em;
                    color: green;
                }
                h2{
                    color: #00b290;
                }
                input[type='text']
                {
                    font-size: 20px;
                }
                textarea
                {
                    font-family:"Times New Roman", Times, serif;
                    background-color: #eee;
                    border:solid 1px #ccc;
                }
                .input:focus {
                    outline: none !important;
                    border:2px solid black;
                    box-shadow: 0 0 10px #719ECE;
                }
                .input2 {
                    outline: none !important;
                    border:1px solid red;
                    font-size: 17px;
                    box-shadow: 0 0 10px #719ECE;
                }
                .input3 {
                    border:0px solid red;
                    box-shadow: 0 0 0px #719ECE;
                    outline: none;
                }
                .myDiv{
                    border: 3px outset red;
                    background-color: lightblue;
                    text-align: center;
                }
                .myDiv2{
                    color: #00bf9a;
                    font-size: 20px;

                }
                .myDiv3{
                    border: 3px outset red;
                    background-color: lightblue;
                    text-align: center;
                }
                img {
                    border-radius: 8px;
                }
            </style>






    </head>
    <body class="white-content {{ $class ?? '' }}">
        @auth()
            <div class="wrapper">
                    @include('layouts.navbars.sidebar')
                <div class="main-panel">
                    @include('layouts.navbars.navbar')

                    <div class="content">
                        @yield('content')
                    </div>

                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            @include('layouts.navbars.navbar')
            <div class="wrapper wrapper-full-page">
                <div class="full-page {{ $contentClass ?? '' }}">
                    <div class="content">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        @endauth

        <script src="{{asset('assets/js/core/jquery.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
        <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Chart JS -->
        {{-- <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script> --}}
        <!--  Notifications Plugin    -->
        <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>

        <script src="{{ asset('assets') }}/js/white-dashboard.min.js?v=1.0.0"></script>
        <script src="{{ asset('assets') }}/js/theme.js"></script>
        <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $().ready(function() {
                    $sidebar = $('.sidebar');
                    $navbar = $('.navbar');
                    $main_panel = $('.main-panel');

                    $full_page = $('.full-page');

                    $sidebar_responsive = $('body > .navbar-collapse');
                    sidebar_mini_active = true;
                    white_color = false;

                    window_width = $(window).width();

                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                    $('.fixed-plugin a').click(function(event) {
                        if ($(this).hasClass('switch-trigger')) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (window.event) {
                                window.event.cancelBubble = true;
                            }
                        }
                    });

                    $('.fixed-plugin .background-color span').click(function() {
                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');

                        var new_color = $(this).data('color');

                        if ($sidebar.length != 0) {
                            $sidebar.attr('data', new_color);
                        }

                        if ($main_panel.length != 0) {
                            $main_panel.attr('data', new_color);
                        }

                        if ($full_page.length != 0) {
                            $full_page.attr('filter-color', new_color);
                        }

                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.attr('data', new_color);
                        }
                    });

                    $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                        var $btn = $(this);

                        if (sidebar_mini_active == true) {
                            $('body').removeClass('sidebar-mini');
                            sidebar_mini_active = false;
                            whiteDashboard.showSidebarMessage('Sidebar mini deactivated...');
                        } else {
                            $('body').addClass('sidebar-mini');
                            sidebar_mini_active = true;
                            whiteDashboard.showSidebarMessage('Sidebar mini activated...');
                        }

                        // we simulate the window Resize so the charts will get updated in realtime.
                        var simulateWindowResize = setInterval(function() {
                            window.dispatchEvent(new Event('resize'));
                        }, 180);

                        // we stop the simulation of Window Resize after the animations are completed
                        setTimeout(function() {
                            clearInterval(simulateWindowResize);
                        }, 1000);
                    });

                    $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                            var $btn = $(this);

                            if (white_color == true) {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').removeClass('white-content');
                                }, 900);
                                white_color = false;
                            } else {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').addClass('white-content');
                                }, 900);

                                white_color = true;
                            }
                    });

                    $('.light-badge').click(function() {
                        $('body').addClass('white-content');
                    });

                    $('.dark-badge').click(function() {
                        $('body').removeClass('white-content');
                    });
                });
            });
            $(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.23.0/slimselect.min.js"></script>
        @stack('js')
    </body>
</html>
