@extends('backend.layouts.master')

@section('title', 'Kullanıcılar')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Kullanıcılar</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Kullanıcılar</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="datatables-basic table">
                                    <thead>
                                    <tr>
                                        <th>SIRA</th>
                                        <th>İSİM SOYİSİM</th>
                                        <th>E-POSTA</th>
                                        <th>ROL</th>
                                        <th>RESİM</th>
                                        <th>KAYIT TARİHİ</th>
                                        <th>İŞLEMLER</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user as $key => $row)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ \Illuminate\Support\Str::ucfirst($row->name) }}</td>
                                            <td>{{ \Illuminate\Support\Str::ucfirst($row->email) }}</td>
                                            <td>{{ \Illuminate\Support\Str::ucfirst($row->user_role) }}</td>
                                            <td><img src="{{asset('/')}}backend/app-assets/images/portrait/small/{{ $row->avatar }}" width="50px"></td>
                                            <td>{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</td>
                                            {{--<td>{{  \Illuminate\Support\Str::limit(strip_tags($row->description), 150, ' ...') }}</td>
                                            <td><img src="{{asset('/')}}frontend/assets/media/{{ $row->logo }}" width="50px"></td>
                                            <td><span class="badge rounded-pill badge-light-{{ ($row->status) ? 'success' : 'danger' }}">{{ ($row->status) ? 'Aktif' : 'Pasif' }}</span></td>
                                            <td><span class="badge rounded-pill badge-light-{{ ($row->type) ? 'warning' : 'primary' }}">{{ ($row->type) ? 'Hizmette' : 'İşlemde' }}</span></td>--}}
                                            {{--<td>{{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y')  }}</td>--}}
                                            <td>
                                                <form action="{{ route('admin.users.destroy',$row->id) }}" method="POST">
                                                    <a href="{{ route('admin.profile.edit', $row->id) }}" class="item-edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-6"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a>
                                                    @csrf
                                                    <a href="#" title="Delete" data-toggle="tooltip" onclick="this.closest('form').submit();return false;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-6 me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/core/menu/menu-types/vertical-menu.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/plugins/extensions/ext-component-toastr.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">
@endsection

@section('js')
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

    <script src="{{asset('/')}}backend/app-assets/js/scripts/tables/table-datatables-basic.js"></script>

    <script src="{{asset('/')}}backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>

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
