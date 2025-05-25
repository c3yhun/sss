@extends('backend.layouts.master')

@section('title', 'Profili Düzenle')

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Profili Düzenle</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.profile.edit',$profile->id) }}">Profili Düzenle</a>
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
                                    <h4 class="card-title">{{ $profile->name }}' Profilini Düzenle</h4>
                                </div>
                                <div class="card-body">

                                    <form action="{{ route('admin.profile.edit.post',$profile->id) }}" class="form" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">


                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="name">İsim Soyisim</label>
                                                    <input type="text" id="name" class="form-control" name="name" value="{{ $profile->name }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="email">E-posta</label>
                                                    <input type="email" id="email" class="form-control" name="email" value="{{ $profile->email }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="npassword">Yeni Şifre</label>
                                                    <input type="password" id="npassword" class="form-control" name="npassword" placeholder="Yeni Şifre">
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="nrpassword">Yeni Şifre Tekrarı</label>
                                                    <input type="password" id="nrpassword" class="form-control" name="nrpassword" placeholder="Yeni Şifre Tekrarı">
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-12 col-12" hidden>
                                                <div class="mb-1">
                                                    <label for="type" for="user_role">Rolü:</label>
                                                    <select class="form-control" id="user_role" name="user_role">
                                                        <option {{ $profile->user_role == 'user' ? "selected" : "1" }} value="user">User</option>
                                                        <option {{ $profile->user_role == 'admin' ? "selected" : "" }} value="admin">Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <img style="border-radius: 50%;" src="{{asset('/')}}backend/app-assets/images/portrait/small/{{ $profile->avatar }}" id="currentphoto" name="currentphoto" class="user-image img-circle elevation-2" width="100px">

                                                    <label class="form-label" for="currentphoto">Mevcut Profil Fotosu</label>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="aphoto">Profil Fotosu :</label>
                                                    <input class="form-control" type="file" name="aphoto" id="aphoto">
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

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/plugins/extensions/ext-component-toastr.css">
@endsection

@section('js')
    <script src="{{asset('/')}}backend/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>

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