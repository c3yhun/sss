@php
$type_text = [
    'pulls' => 'Çekim Yapıldı.',
    'investments' => 'Yatırım Yapıldı.',
    'payments' => 'Ödeme Yapıldı.',
];
@endphp

@extends('backend.layouts.master')

@section('title', 'Raporlar')

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
                            <h2 class="content-header-title float-left mb-0">Raporlar</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Anasayfa</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.statements.index') }}">Raporlar</a></li>
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
                                <table class="datatables-basic table display" id="example">
                                    <thead>
                                    <tr>
                                        {{--<th>SIRA</th>--}}
                                        <th>TARİH</th>
                                        <th>KASA ADI</th>
                                        <th>YATIRIM MİKTARI</th>
                                        <th>ÇEKİM MİKTARI</th>
                                        <th>KOMİSYON MİKTARI</th>
                                        <th>ÖDEME MİKTARI</th>
                                        <th>DURUM</th>
                                        <th>AÇIKLAMA</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($statement as $key => $row)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</td>
                                            <td>{{ \App\Models\Deposit::find($row->deposit_id)->title }}</td>
                                            
                                            @if($row->type == 'investments')
                                             <td>{{ $row->amount }}</td>
                                             <td>0</td>
                                             <td>{{  ($row->amount / 100) * \App\Models\Deposit::find($row->deposit_id)->income_commission }}</td>
                                             <td>0</td>
                                            @elseif($row->type == 'pulls')
                                             <td>0</td>
                                             <td>{{ $row->amount }}</td>
                                             <td>{{  ($row->amount / 100) * \App\Models\Deposit::find($row->deposit_id)->expense_commission }}</td>
                                             <td>0</td>
                                            @else
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>{{ $row->amount }}</td>
                                            @endif
                                            <td>{{ $type_text[$row->type] }}</td>
                                            <td>{{ $row->description }}</td>
                                            {{--<td>{{  \Illuminate\Support\Str::limit(strip_tags($row->description), 150, ' ...') }}</td>
                                            <td><img src="{{asset('/')}}frontend/assets/media/{{ $row->logo }}" width="50px"></td>
                                            <td><span class="badge rounded-pill badge-light-{{ ($row->status) ? 'success' : 'danger' }}">{{ ($row->status) ? 'Aktif' : 'Pasif' }}</span></td>
                                            <td><span class="badge rounded-pill badge-light-{{ ($row->type) ? 'warning' : 'primary' }}">{{ ($row->type) ? 'Hizmette' : 'İşlemde' }}</span></td>--}}
                                            {{--<td>{{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y')  }}</td>--}}
                                        </tr>
                                       
                                    @endforeach

                                    {{--<tr>
                                        <td data-search="Tiger Nixon">T. Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td data-order="1303689600">Mon 25th Apr 11</td>
                                        <td data-order="320800">$320,800/y</td>
                                    </tr>--}}

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowgroup/1.0.2/css/rowGroup.dataTables.min.css">
    {{--<link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">--}}
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/core/menu/menu-types/vertical-menu.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/plugins/extensions/ext-component-toastr.css">

    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css">

    <style>
        table.dataTable tr.dt-hasChild td.dt-control:before {
            content: "-";
            background-color: #d33333;
        }

        table.dataTable td.dt-control:before {
            height: 1em;
            width: 1em;
            margin-top: -9px;
            display: inline-block;
            color: white;
            border: 0.15em solid white;
            border-radius: 1em;
            box-shadow: 0 0 0.2em #444;
            box-sizing: content-box;
            text-align: center;
            text-indent: 0 !important;
            font-family: "Courier New",Courier,monospace;
            line-height: 1em;
            content: "+";
            background-color: #31b131;
        }
    </style>
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
    <script src="https://cdn.datatables.net/rowgroup/1.0.2/js/dataTables.rowGroup.min.js"></script>
    {{--<script src="{{asset('/')}}backend/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>--}}
    <script src="{{asset('/')}}backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

    {{--<script src="{{asset('/')}}backend/app-assets/js/scripts/tables/table-datatables-basic.js"></script>--}}

    <script src="{{asset('/')}}backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>

    <script src="{{asset('/')}}backend/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="{{asset('/')}}backend/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>

    <script>
        function formatMyMoney(price) {
            var currency_symbol = "₺"
            var formattedOutput = new Intl.NumberFormat('tr-TR', {
                style: 'currency',
                currency: 'TRY',
                minimumFractionDigits: 1,
            });
            return formattedOutput.format(price).replace(currency_symbol, '')
        }

        $(function () {
            'use strict';
            var collapsedGroups = {};
            var dt_basic_table = $('.datatables-basic');
            if (dt_basic_table.length) {
                var dt_basic = dt_basic_table.DataTable({
                    paging: true,
                    order: [
                        [5, 'dec']
                    ],
                    rowGroup: {
                        dataSrc: 0,
                        startRender: function(rows, group) {
                            var collapsed = !!collapsedGroups[group];
                            var totalMoney = rows.data().pluck(1).reduce( function (a, b) {return a + b*1;}, 0);
                            var totalCommission = rows.data().pluck(4).reduce( function (a, b) {return a + b*1;}, 0);

                            var yatirimYapildi = rows.data().filter(function (el)
                                {
                                    return el[6] == 'Yatırım Yapıldı.';
                                }
                            );
                            var totalYatirim = yatirimYapildi.pluck(2).reduce( function (a, b) {return a + b*1;}, 0);

                            var cekimYapildi = rows.data().filter(function (el)
                                {
                                    return el[6] == 'Çekim Yapıldı.';
                                }
                            );
                            var totalCekim = cekimYapildi.pluck(3).reduce( function (a, b) {return a + b*1;}, 0);

                            var odemeYapildi = rows.data().filter(function (el)
                                {
                                    return el[6] == 'Ödeme Yapıldı.';
                                }
                            );
                            var totalOdeme = odemeYapildi.pluck(5).reduce( function (a, b) {return a + b*1;}, 0);

                            rows.nodes().each(function (r) {
                                r.style.display = 'none';
                                if (collapsed) {
                                    r.style.display = '';
                                }});

                            return $('<tr/>')
                                .append('<td colspan="1">' + group  + '</td>')
                                .append('<td colspan="1">' + 'Tüm Kasa' +'</td>')
                                .append('<td colspan="1">' + formatMyMoney(totalYatirim) +'</td>')
                                .append('<td colspan="1">' + formatMyMoney(totalCekim) +'</td>')
                                .append('<td colspan="1">' + formatMyMoney(totalCommission) +'</td>')
                                .append('<td colspan="1">' + formatMyMoney(totalOdeme)  +'</td>')
                                .append('<td colspan="1">' + 'Tamamlandı'+'</td>')
                                .append('<td colspan="1">' + 'Günlük Rapor'+'</td>')
                                .attr('data-name', group)
                                .toggleClass('collapsed', collapsed);
                        }
                    },
                    /*order: [],*/
                    dom:
                        '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    displayLength: 75,
                    lengthMenu: [7, 10, 25, 50, 75, 100],
                    buttons: [
                        {
                            extend: 'collection',
                            className: 'btn btn-outline-secondary dropdown-toggle mr-2',
                            text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
                            buttons: [
                                {
                                    extend: 'print',
                                    text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
                                    className: 'dropdown-item',
                                    /*exportOptions: { columns: [0, 1, 2, 3, 4] }*/
                                },
                                {
                                    extend: 'csv',
                                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
                                    className: 'dropdown-item',
                                    /*exportOptions: { columns: [3, 4, 5, 6, 7] }*/
                                },
                                {
                                    extend: 'excel',
                                    text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
                                    className: 'dropdown-item',
                                    /*exportOptions: { columns: [3, 4, 5, 6, 7] }*/
                                },
                                {
                                    extend: 'pdf',
                                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
                                    className: 'dropdown-item',
                                    /*exportOptions: { columns: [3, 4, 5, 6, 7] }*/
                                },
                                {
                                    extend: 'copy',
                                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
                                    className: 'dropdown-item',
                                    /*exportOptions: { columns: [3, 4, 5, 6, 7] }*/
                                }
                            ],
                            init: function (api, node, config) {
                                $(node).removeClass('btn-secondary');
                                $(node).parent().removeClass('btn-group');
                                setTimeout(function () {
                                    $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                                }, 50);
                            }
                        }
                    ],
                    language: {
                        paginate: {
                            // remove previous & next text from pagination
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    }
                });
                $('div.head-label').html('<h6 class="mb-0">Tüm İçerikleri</h6>');

                $('.datatables-basic tbody').on('click', 'tr.group-start', function() {
                    var name = $(this).data('name');
                    collapsedGroups[name] = !collapsedGroups[name];
                    dt_basic.draw(false);
                });
            }
        });

    </script>
@endsection