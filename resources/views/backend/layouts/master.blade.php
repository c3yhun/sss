<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    <link rel="apple-touch-icon" href="{{asset('/')}}backend/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/')}}backend/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    @yield('css')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">

        <ul class="nav navbar-nav align-items-center ml-auto">
            {{--<li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="javascript:void(0);" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="javascript:void(0);" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="javascript:void(0);" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="javascript:void(0);" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div>
            </li>--}}
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
            {{--<li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>--}}


            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span><span class="user-status">{{ \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Facades\Auth::user()->user_role) }}</span></div><span class="avatar"><img class="round" src="{{asset('/')}}backend/app-assets/images/portrait/small/{{ \Illuminate\Support\Facades\Auth::user()->avatar }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                    {{--<a class="dropdown-item" href="page-profile.html">
                        <i class="mr-50" data-feather="user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="app-email.html">
                        <i class="mr-50" data-feather="mail"></i> Inbox</a>
                    <a class="dropdown-item" href="app-todo.html">
                        <i class="mr-50" data-feather="check-square"></i> Task
                    </a>
                    <a class="dropdown-item" href="app-chat.html">
                        <i class="mr-50" data-feather="message-square"></i> Chats
                    </a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    <a class="dropdown-item" href="{{ route('admin.profile.edit',\Illuminate\Support\Facades\Auth::id()) }}">
                        <i class="mr-50" data-feather="settings"></i> Settings
                    </a>
                    {{--<a class="dropdown-item" href="page-pricing.html">
                        <i class="mr-50" data-feather="credit-card"></i> Pricing
                    </a>
                    <a class="dropdown-item" href="page-faq.html">
                        <i class="mr-50" data-feather="help-circle"></i> FAQ
                    </a>--}}
                    <a class="dropdown-item" href="{{ route('signout') }}">
                        <i class="mr-50" data-feather="power"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">

            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('admin.dashboard') }}"><span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg></span>
                    <h2 class="brand-text">Finans</h2>
                </a></li>

            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ (Route::currentRouteName() == 'admin.dashboard') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Anasayfa</span>{{--<span class="badge badge-light-warning badge-pill ml-auto mr-1">2</span>--}}</a></li>

            <li class=" navigation-header">
                <span data-i18n="Apps &amp; Pages">TRANSFER İŞLEMLERİ</span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class="nav-item {{ (Route::currentRouteName() == 'admin.pulls.create' || Route::currentRouteName() == 'admin.pulls.index') ? 'has-sub open' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i class="mr-50" data-feather='figma'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Çekimler</span>
                </a>

                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'admin.pulls.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.pulls.index') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Çekimler</span>
                        </a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.pulls.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.pulls.create') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Yeni Çekim Ekle</span>
                        </a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.pull.import.get') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.pull.import.get') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Excel Yükle</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item {{ (Route::currentRouteName() == 'admin.investments.create' || Route::currentRouteName() == 'admin.investments.index') ? 'has-sub open' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i class="mr-50" data-feather='framer'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Yatırımlar</span>
                </a>

                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'admin.investments.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.investments.index') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Yatırımlar</span>
                        </a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.investments.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.investments.create') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Yeni Yatırım Ekle</span>
                        </a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.investment.import.get') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.investment.import.get') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Excel Yükle</span>
                        </a>
                    </li>
                </ul>
            </li>
            
         

            @if(\Illuminate\Support\Facades\Auth::user()->user_role == 'admin')
            <li class=" nav-item {{ (Route::currentRouteName() == 'admin.payments.create' || Route::currentRouteName() == 'admin.payments.index') ? 'has-sub open' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i class="mr-50" data-feather="credit-card"></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Manuel İşlemler</span>
                </a>

                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'admin.payments.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.payments.index') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Manuel İşlemler</span>
                        </a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.payments.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.payments.create') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">İşlem Ekle</span>
                        </a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.payment.import.get') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.payment.import.get') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Excel Yükle</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" navigation-header">
                <span data-i18n="Apps &amp; Pages">KASA İŞLEMLERİ</span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class=" nav-item {{ (Route::currentRouteName() == 'admin.deposits.create' || Route::currentRouteName() == 'admin.deposits.index') ? 'has-sub open' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i class="mr-50" data-feather='slack'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Mevduatlar</span>
                </a>

                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'admin.deposits.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.deposits.index') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Mevduatlar</span>
                        </a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.deposits.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.deposits.create') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Yeni Mevduat Ekle</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ (Route::currentRouteName() == 'admin.groups.create' || Route::currentRouteName() == 'admin.groups.index') ? 'has-sub open' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i class="mr-50" data-feather='layers'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Gruplar</span>
                </a>

                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'admin.groups.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.groups.index') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Gruplar</span>
                        </a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.groups.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.groups.create') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Yeni Grup Ekle</span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- Transfer -->
            <li class="nav-item {{ (Route::currentRouteName() == 'admin.transfer.index') ? 'has-sub open' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i class="mr-50" data-feather="refresh-cw"></i>
                    <span class="menu-title text-truncate" data-i18n="Transfer">Virmanlar</span>
                </a>
                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'admin.transfer.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.transfer.index') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="TransferIndex">Kasalar Arası Transfer</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header">
                <span data-i18n="Apps &amp; Pages">KULLANICI İŞLEMLERİ</span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class="nav-item {{ (Route::currentRouteName() == 'admin.users.create' || Route::currentRouteName() == 'admin.users.index') ? 'has-sub open' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i class="mr-50" data-feather='users'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Kullanıcılar</span>
                </a>

                <ul class="menu-content">
                    <li class="{{ (Route::currentRouteName() == 'admin.users.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.users.index') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Kullanıcılar</span>
                        </a>
                    </li>
                    <li class="{{ (Route::currentRouteName() == 'admin.users.create') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.users.create') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Yeni Kullanıcı Ekle</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ (Route::currentRouteName() == 'admin.statements.index') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.statements.index') }}">
                    <i class="mr-50" data-feather='activity'></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">Raporlar</span>
                </a>
            </li>
            @endif
















            {{--<li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather='codesandbox'></i>
                    <span class="menu-title text-truncate" data-i18n="Invoice">Ürünler <span class="badge bg-warning">{{ \App\Models\Product::count() }}</span></span>
                </a>

                <ul class="menu-content">

                    <li>
                        <a class="d-flex align-items-center" href="{{ route('admin.products.create') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Yeni Ürün Ekle</span>
                        </a>
                    </li>

                    <li>
                        <a class="d-flex align-items-center" href="{{ route('admin.products.index') }}">
                            <i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">Ürünleri Görüntüle</span>
                        </a>
                    </li>

                </ul>
            </li>--}}


            {{--<li class=" nav-item {{ (Route::currentRouteName() == 'admin.slider.edit') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.slider.edit') }}">
                    <i data-feather="image"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Slider Düzenle</span>
                </a>
            </li>

            <li class=" nav-item {{ (Route::currentRouteName() == 'admin.about.edit') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.about.edit') }}">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Hakkımızda Düzenle</span>
                </a>
            </li>

            <li class=" nav-item {{ (Route::currentRouteName() == 'admin.footer.edit') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.footer.edit') }}">
                    <i data-feather="feather"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Footer Düzenle</span>
                </a>
            </li>

            <li class=" nav-item {{ (Route::currentRouteName() == 'admin.contacts.index') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.contacts.index') }}">
                    <i class="ficon" data-feather="mail"></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Mesajlar <span class="badge bg-warning">{{ \App\Models\Contact::count() }}</span></span>
                </a>
            </li>--}}

            {{--<li class=" navigation-header">
                <span data-i18n="Apps &amp; Pages">Genel Ayarlar</span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li class=" nav-item {{ (Route::currentRouteName() == 'admin.home.edit') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.home.edit') }}">
                    <i data-feather='trello'></i>
                    <span class="menu-title text-truncate" data-i18n="Email">Anasayfa Ayarları</span>
                </a>
            </li>

            <li class=" nav-item {{ (Route::currentRouteName() == 'admin.social.edit') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.social.edit') }}">
                    <i data-feather='credit-card'></i>
                    <span class="menu-title text-truncate" data-i18n="Email">SosyalMedya Ayarları</span>
                </a>
            </li>--}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
@yield('content')
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
{{--<p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ml-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>--}}
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->

<!-- BEGIN: Vendor JS-->
<script src="{{asset('/')}}backend/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->



<!-- BEGIN: Theme JS-->
<script src="{{asset('/')}}backend/app-assets/js/core/app-menu.js"></script>
<script src="{{asset('/')}}backend/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
@yield('js')
<!-- END: Page JS-->



<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
</body>
<!-- END: Body-->
</html>