@extends('backend.layouts.master')

@section('title', 'Anasayfa')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        <!-- Tarih Aralığı Formu -->
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="GET" action="{{ route('admin.dashboard') }}">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <label for="start_date">Başlangıç Tarihi:</label>
                                                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="end_date">Bitiş Tarihi:</label>
                                                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-primary">Filtrele</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Greetings Card starts -->
                        {{--<div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card card-congratulations">
                                <div class="card-body text-center">
                                    <img src="{{asset('/')}}backend/app-assets/images/elements/decore-left.png" class="congratulations-img-left" alt="card-img-left" />
                                    <img src="{{asset('/')}}backend/app-assets/images/elements/decore-right.png" class="congratulations-img-right" alt="card-img-right" />
                                    <div class="avatar avatar-xl bg-primary shadow">
                                        <div class="avatar-content">
                                            <i data-feather="award" class="font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="mb-1 text-white">Hoşgeldin {{ \Illuminate\Support\Str::ucfirst(\Illuminate\Support\Facades\Auth::user()->name) }},</h1>
                                        <p class="card-text m-auto w-75">
                                            --}}{{--You have done <strong>57.6%</strong> more sales today. Check your new badge in your profile.--}}{{--
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                        <!-- Greetings Card ends -->

                        {{--<div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather='aperture' class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{ \App\Models\Investment::sum('amount') }}₺ ({{ \App\Models\Investment::count() }})</h2>
                                    <p class="card-text">TOPLAM YATIRIM</p>
                                </div>
                                <div id="line-area-chart-1"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-success p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="credit-card" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{ \App\Models\Payment::sum('amount') }}₺ ({{ \App\Models\Payment::count() }})</h2>
                                    <p class="card-text">TOPLAM ÖDEME</p>
                                </div>
                                <div id="line-area-chart-2"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="shopping-cart" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{ \App\Models\Pull::sum('amount') }}₺ ({{ \App\Models\Pull::count() }})</h2>
                                    <p class="card-text">TOPLAM ÇEKİM</p>
                                </div>
                                <div id="line-area-chart-3"></div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header flex-column align-items-start pb-0">
                                    <div class="avatar bg-light-warning p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="package" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="font-weight-bolder mt-1">{{ \App\Models\Deposit::sum('balance') }}₺ ({{ \App\Models\Deposit::count() }})</h2>
                                    <p class="card-text">TOPLAM MEVDUAT</p>
                                </div>
                                <div id="line-area-chart-4"></div>
                            </div>
                        </div>--}}

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header text-center" style="display: block !important;">
                                    <h4 class="card-title">GENEL DURUM</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="text-center">TÜR</th>
                                            <th class="text-center">MİKTAR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center font-weight-bold">TOPLAM YATIRIM</td>
                                                <td class="text-center font-weight-bold">{{ number_format($totalInvest, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center font-weight-bold">TOPLAM ÇEKİM</td>
                                                <td class="text-center font-weight-bold">{{ number_format($totalPull, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center font-weight-bold">TOPLAM KAR</td>
                                                <td class="text-center font-weight-bold">{{ number_format($totalProfit, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center font-weight-bold">TOPLAM KAR (%)</td>
                                                <td class="text-center font-weight-bold">%{{ number_format($percentEndorsement) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center font-weight-bold">TOPLAM ÖDEME</td>
                                                <td class="text-center font-weight-bold">{{ number_format($totalPayment, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center font-weight-bold">TOPLAM KOMİSYON</td>
                                                <td class="text-center font-weight-bold">{{ number_format($totalComission, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header text-center" style="display: block !important;">
                                    <h4 class="card-title">KASALAR</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="text-center">KASA</th>
                                            <th class="text-center">MİKTAR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(\App\Models\Deposit::count() > 0)
                                            @foreach($groupedDeposits as $item)
                                                <tr>
                                                    <td class="text-center font-weight-bold">{{ $item->title }}</td>
                                                    <td class="text-center font-weight-bold">{{ number_format($item->balance, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        @if(\App\Models\Deposit::count() > 0)
                                            @foreach($ungroupedDeposits as $item)
                                                <tr>
                                                    <td class="text-center font-weight-bold">{{ $item->title }}</td>
                                                    <td class="text-center font-weight-bold">{{ number_format($item->balance, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                            <tr>
                                                <td class="text-center font-weight-bold"><b>TOPLAM</b></td>
                                                <td class="text-center font-weight-bold">{{ number_format($totalBalance, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{--<div class="col-lg-12 col-sm-6 col-12">
                            <div class="card">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span> <strong>KASA</strong></span>
                                        <span> <strong>MİKTAR</strong></span>
                                    </li>
                                    @if(\App\Models\Deposit::count() > 0)
                                        @foreach(\App\Models\Group::leftJoin(Illuminate\Support\Facades\DB::raw('(SELECT group_id, SUM(balance) AS balance FROM deposits GROUP BY group_id) as v'), 'v.group_id', '=', 'groups.id')->orderBy('balance', 'desc')->where('balance', '>', 0)->get() as $item)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span> {{ $item->title }}</span>
                                                <span class="badge badge-primary badge-pill">{{ $item->balance }}₺</span>
                                            </li>
                                        @endforeach
                                    @endif

                                    @if(\App\Models\Deposit::count() > 0)
                                        @foreach(\App\Models\Deposit::orderBy('balance','DESC')->where('balance', '>',0)->where('group_id',NULL)->get() as $item)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span> {{ $item->title }}</span>
                                                <span class="badge badge-primary badge-pill">{{ $item->balance }}₺</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>--}}

                        {{--<div class="col-lg-6 col-sm-6 col-12">
                            <div class="card">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span> <strong>GRUP</strong></span>
                                        <span> <strong>MİKTAR</strong></span>
                                    </li>

                                    @if(\App\Models\Group::count() > 0)
                                        @foreach(\App\Models\Group::orderBy('id','DESC')->get() as $item)
                                            @php($sum = \App\Models\Deposit::where('group_id',$item->id)->orderByRaw('SUM(balance) DESC')->sum('balance'))
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span> {{ $item->title }}</span>
                                                <span class="badge badge-primary badge-pill">{{ $sum }}₺</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>--}}

                        {{--<div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header align-items-start pb-0">
                                    <div>
                                        <h2 class="font-weight-bolder">{{ \App\Models\User::where('user_role','admin')->count() }}</h2>
                                        <p class="card-text">TOPLAM YÖNETİCİ</p>
                                    </div>
                                    <div class="avatar bg-light-primary p-50">
                                        <div class="avatar-content">
                                            <i data-feather='user-plus' class="font-medium-5"></i>
                                        </div>
                                    </div>
                                </div>
                                <div id="line-area-chart-5"></div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header align-items-start pb-0">
                                    <div>
                                        <h2 class="font-weight-bolder">{{ \App\Models\User::where('user_role','user')->count() }}</h2>
                                        <p class="card-text">TOPLAM KULLANICI</p>
                                    </div>
                                    <div class="avatar bg-light-success p-50">
                                        <div class="avatar-content">
                                            <i data-feather="user-check" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                </div>
                                <div id="line-area-chart-6"></div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header align-items-start pb-0">
                                    <div>
                                        <h2 class="font-weight-bolder"><a href="https://www.r10.net/profil/77365-dos.html" style="color: #5e5873">DOS</a></h2>
                                        <p class="card-text">R10.NET</p>
                                    </div>
                                    <div class="avatar bg-light-warning p-50">
                                        <div class="avatar-content">
                                            <i data-feather="mail" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                </div>
                                <div id="line-area-chart-7"></div>
                            </div>
                        </div>--}}
                    </div>
                </section>
                <!-- Dashboard Analytics end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/core/menu/menu-types/vertical-menu.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/charts/apexcharts.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/plugins/extensions/ext-component-toastr.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">

    <link rel="stylesheet" type="text/type" href="{{asset('/')}}backend/app-assets/css/plugins/charts/chart-apex.css">
@endsection

@section('js')

    <script src="{{asset('/')}}backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>

    <script src="{{asset('/')}}backend/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>

    <script src="{{asset('/')}}backend/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/cards/card-statistics.js"></script>

    @if(\Illuminate\Support\Facades\Session::has('message'))
        <script>
            var type = "{{ \Illuminate\Support\Facades\Session::get('alert-type', 'info') }}";
            switch(type){
                case 'success':
                    toastr['success']("{{ \Illuminate\Support\Facades\Session::get('message') }}", 'Tebrikler!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    break;

                case 'error':
                    toastr['error']("{{ \Illuminate\Support\Facades\Session::get('message') }}", 'Hata!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    break;
            }
        </script>
    @endif

    <script type="text/javascript">
        function deleteData(link) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            })
                .then(isClose => {
                    if (isClose) {
                        window.location = $(link).attr('action');
                    } else {
                        swal("Delete data canceled");
                    }
                });
        }
    </script>
@endsection