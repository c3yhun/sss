@extends('backend.layouts.master')

@section('title', 'Mevduat Düzenle')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Mevduat Düzenle</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.deposits.index') }}">Mevduatlar</a>
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
                                    <h4 class="card-title">({{ $deposit->title }}) Düzenle</h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.deposits.update',$deposit->id) }}" class="form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="title">Mevduat Adı :</label>
                                                    <input type="text" id="title" class="form-control" value="{{ $deposit->title }}" name="title" placeholder="Mevduat ismi girin.">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="balance">Bakiye :</label>
                                                    <input type="text" id="balance" class="form-control" value="{{ $deposit->balance }}" name="balance" placeholder="Bakiye girin. Örnek: 500">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label for="type">Grup Seçimi :</label>
                                                    <select class="form-control" id="group_id" name="group_id">
                                                                <option value="">Boş Bırak</option>
                                                        @if(\App\Models\Group::count() > 0)
                                                            @foreach(\App\Models\Group::all() as $item)
                                                                <option {{ $deposit->group_id == $item->id ? "selected" : "" }} value="{{$item->id}}">{{$item->title}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label for="type">Para Birimi :</label>
                                                    <select class="form-control" id="currency" name="currency">
                                                        <option {{ $deposit->currency == 'Türk Lirası' ? "selected" : "" }}>Türk Lirası</option>
                                                        <option {{ $deposit->currency == 'Amerikan Doları' ? "selected" : "" }}>Amerikan Doları</option>
                                                        <option {{ $deposit->currency == 'Euro' ? "selected" : "" }}>Euro</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="income_commission">Gelir Komisyon (%) :</label>
                                                    <input type="text" id="income_commission" class="form-control" value="{{ $deposit->income_commission }}" name="income_commission" placeholder="Sadece rakam girin.">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="expense_commission">Gider Komisyon (%) :</label>
                                                    <input type="text" id="expense_commission" class="form-control" value="{{ $deposit->expense_commission }}" name="expense_commission" placeholder="Sadece rakam girin.">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
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
@endsection

@section('js')
    {{--<script src="{{asset('/')}}backend/app-assets/js/scripts/forms/form-tooltip-valid.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script src="{{asset('/')}}backend/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>

    <script src="{{asset('/')}}backend/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/forms/form-select2.js"></script>


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
@endsection
