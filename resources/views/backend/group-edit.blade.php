@extends('backend.layouts.master')

@section('title', 'Grup Düzenle')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Grup Düzenle</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}">Gruplar</a>
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
                                    <h4 class="card-title">({{ $group->title }}) Düzenle</h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.groups.update',$group->id) }}" class="form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="title">Grup Adı :</label>
                                                    <input type="text" id="title" class="form-control" value="{{ $group->title }}" name="title" placeholder="Grup ismi girin.">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="description">Açıklama :</label>
                                                    <input type="text" id="description" class="form-control" value="{{ $group->description }}" name="description" placeholder="Grup açıklama girin.">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label for="type">Renk Seçimi :</label>
                                                    <select class="form-control" id="color" name="color">
                                                        <option {{ $group->color == 'primary' ? "selected" : "" }} value="primary" class="bg-primary" style="padding: 0.3rem 0.5rem; font-size: 125%; color: #FFF;">Primary</option>
                                                        <option {{ $group->color == 'secondary' ? "selected" : "" }} value="secondary" class="bg-secondary" style="padding: 0.3rem 0.5rem; font-size: 125%; color: #FFF;">Secondary</option>
                                                        <option {{ $group->color == 'success' ? "selected" : "" }} value="success" class="bg-success" style="padding: 0.3rem 0.5rem; font-size: 125%; color: #FFF;">Success</option>
                                                        <option {{ $group->color == 'danger' ? "selected" : "" }} value="danger" class="bg-danger" style="padding: 0.3rem 0.5rem; font-size: 125%; color: #FFF;">Danger</option>
                                                        <option {{ $group->color == 'warning' ? "selected" : "" }} value="warning" class="bg-warning" style="padding: 0.3rem 0.5rem; font-size: 125%; color: #FFF;">Warning</option>
                                                        <option {{ $group->color == 'info' ? "selected" : "" }} value="info" class="bg-info" style="padding: 0.3rem 0.5rem; font-size: 125%; color: #FFF;">Info</option>
                                                        <option {{ $group->color == 'dark' ? "selected" : "" }} value="dark" class="bg-dark" style="padding: 0.3rem 0.5rem; font-size: 125%; color: #FFF;">Dark</option>
                                                    </select>
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
