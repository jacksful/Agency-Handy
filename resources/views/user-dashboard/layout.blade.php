<!-- overlay -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>
    <head>
        <meta charset="utf-8"/>

        {{-- Title Section --}}
        <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

        {{-- Meta Data --}}
        <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        {{-- Favicon --}}
        <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Barlow&display=swap');
            body{
            font-family: 'Barlow', sans-serif;
            }

            a:hover{
            text-decoration: none;
            }

            .border-left{
            border-left: 2px solid var(--primary) !important;
            }


            .sidebar{
            top: 0;
            left : 0;
            z-index : 100;
            overflow-y: auto;
            }

            .overlay{
            background-color: rgb(0 0 0 / 45%);
            z-index: 99;
            }

            /* sidebar for small screens */
            @media screen and (max-width: 767px){
            
            .sidebar{
                max-width: 18rem;
                transform : translateX(-100%);
                transition : transform 0.4s ease-out;
            }
            
            .sidebar.active{
                transform : translateX(0);
            }
            
            }
        </style>

{{-- Global Theme Styles (used by all pages) --}}
@foreach(config('layout.resources.css') as $style)
<link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css"/>
@endforeach

{{-- Layout Themes (used by all pages) --}}
@foreach (Metronic::initThemes() as $theme)
<link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css"/>
@endforeach

       

        {{-- Includable CSS --}}
        @yield('styles')
    </head>

    <body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>


    <div id="sidebar-overlay" class="overlay w-100 vh-100 position-fixed d-none"></div>

    <!-- sidebar -->
    <div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
        <h1 class="text-primary d-flex my-4 justify-content-center">
            @php
            $kt_logo_image = 'logo-light.png';
            @endphp

            @if (config('layout.header.self.theme') === 'light')
                @php $kt_logo_image = 'logo-dark.png' @endphp
            @elseif (config('layout.header.self.theme') === 'dark')
                @php $kt_logo_image = 'logo-light.png' @endphp
            @endif

            {{-- @if(config('layout.aside.self.display') == false) --}}
                <div class="header-logo">
                    <a href="{{ url('/') }}">
                        <img alt="Logo" src="{{ asset('media/logos/'.$kt_logo_image) }}"/>
                    </a>
                </div>
            {{-- @endif --}}
        </h1>
        <div class="list-group rounded-0">
            @foreach(config('menu_aside.user_items') as $item)
                @if(isset($item['page']))
                    <a href="{{ $item['page'] }}" class="list-group-item list-group-item-action border-0 d-flex align-items-center {{ request()->is('user/dashboard') ? 'active' : '' }}">
                        <span class="{{ $item['bi-icon'] }}"></span>
                        <span class="ml-2">{{ $item['title'] }}</span>
                    </a>
                @else
                    <button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#{{ $item['id'] }}">
                        <div>
                            <span class="{{ $item['bi-icon'] }}"></span>
                            <span class="ml-2">{{ $item['title'] }}</span>
                        </div>
                        <span class="bi bi-chevron-down small"></span>
                    </button>
                    <div class="collapse" id="{{ $item['id'] }}" data-parent="#sidebar">
                        <div class="list-group">
                            @foreach($item['submenu'] as $sub )
                                <a href="{{ $sub['page'] }}" class="list-group-item list-group-item-action border-0 pl-5">{{ $sub['title'] }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
            {{-- <a href="#" class="list-group-item list-group-item-action border-0 align-items-center">
                <span class="bi bi-box"></span>
                <span class="ml-2">Products</span>
            </a>
            
            <button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#purchase-collapse">
                <div>
                <span class="bi bi-cart-plus"></span>
                <span class="ml-2">Purchase</span>
                </div>
                <span class="bi bi-chevron-down small"></span>
            </button>
            <div class="collapse" id="purchase-collapse" data-parent="#sidebar">
                <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action border-0 pl-5">Sellers</a>
                <a href="#" class="list-group-item list-group-item-action border-0 pl-5">Purchases</a>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="col-md-9 col-lg-10 ml-md-auto px-0 ms-md-auto">
        <!-- top nav -->
        <nav class="w-100 d-flex px-4 py-2 mb-4 shadow-sm">
            <!-- close sidebar -->
            <button class="btn py-0 d-lg-none" id="open-sidebar">
                <span class="bi bi-list text-primary h3"></span>
            </button>
            <div class="dropdown ml-auto">
                <button class="btn py-0 d-flex align-items-center" id="logout-dropdown" data-toggle="dropdown" aria-expanded="false">
                <span class="bi bi-person text-primary h4"></span>
                <span class="bi bi-chevron-down ml-1 mb-2 small"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="logout-dropdown">
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                <a class="dropdown-item" href="{{ route('my.passwordchange') }}">Change Password</a>
                </div>
            </div>
        </nav>
        <!-- main content -->
        <main class="p-4 min-vh-100">
            @yield('content')
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    @foreach(config('layout.resources.userjs') as $script)
        <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach

    {{-- Global Config (global config for global JS scripts) --}}
    <script>
        var KTAppSettings = {!! json_encode(config('layout.js'), JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) !!};
    </script>

    {{-- Global Theme JS Bundle (used by all pages)  --}}
    @foreach(config('layout.resources.js') as $script)
        <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach

    {{-- Includable JS --}}
    @yield('scripts')

    

</body>
</html>