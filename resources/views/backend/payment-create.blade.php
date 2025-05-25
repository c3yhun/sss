@extends('backend.layouts.master')

@section('title', 'Yeni İşlem Ekle')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Yeni İşlem Ekle</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.payments.index') }}">Manuel İşlemler</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Yeni İşlem Ekle</h4>
                                </div>
                                <div class="card-body">

                                    @if ($errors->any())
                                        <div class="demo-spacing-0">
                                            <div class="alert alert-danger mt-1 my-1 alert-validation-msg" role="alert">
                                                <div class="alert-body">
                                                    @foreach ($errors->all() as $error)
                                                        <i data-feather="info" class="mr-50 align-middle"></i>
                                                        <span>{{ $error }}</span><br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <form action="{{ route('admin.payments.store') }}" class="form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="description">Açıklama :</label>
                                                    <input type="text" id="description" class="form-control" name="description" placeholder="Açıklama girin.">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <label for="form-label" for="date">Tarih :</label>
                                                    <input type="text" id="fp-default" name="date" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD"/>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <label class="form-label" for="amount">Miktar :</label>
                                                    <input type="text" id="amount" class="form-control" name="amount" placeholder="Miktar girin.">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <label for="type">Para Birimi :</label>
                                                    <select class="form-control" id="currency" name="currency">
                                                        <option>Türk Lirası</option>
                                                        <option>Amerikan Doları</option>
                                                        <option>Euro</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <label for="type">İşlem Türü :</label>
                                                    <select class="form-control" id="tur" name="tur">
                                                        <option>Ekleme +</option>
                                                        <option>Çıkarma -</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-1">
                                                    <label for="type">Kasa :</label>
                                                    <select class="form-control" id="deposit_id" name="deposit_id">
                                                        @if(\App\Models\Deposit::count() > 0)
                                                            @foreach(\App\Models\Deposit::all() as $item)
                                                                <option value="{{$item->id}}">{{$item->title}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Ekle</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/forms/select/select2.min.css">


    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/plugins/forms/pickers/form-pickadate.css">
@endsection

@section('js')
    {{--<script src="{{asset('/')}}backend/app-assets/js/scripts/forms/form-tooltip-valid.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script src="{{asset('/')}}backend/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>

    <script src="{{asset('/')}}backend/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/forms/form-select2.js"></script>

    <script src="{{asset('/')}}backend/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/tr.js"></script>


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

    <script>
        flatpickr('.flatpickr-basic', {
            "defaultDate": new Date(),
            "locale": 'tr',
            "enableTime": true,
            "dateFormat": "Y-m-d H:i:S",
        });
    </script>
@endsection
