@extends('backend.layouts.master')

@section('title', 'Transfer')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Transfer İşlemi</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Transfer</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Mesajları Göster (HTML Alert) -->
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Transfer Form -->
                <section id="transfer-form">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Kasalar Arası Transfer</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.transfer.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-1">
                                            <label for="from_deposit_id" class="form-label">Transfer Yapılacak Kasa</label>
                                            <select name="from_deposit_id" id="from_deposit_id" class="form-select" required>
                                                <option value="">Kasa Seçin</option>
                                                @foreach($deposits as $deposit)
                                                    <option value="{{ $deposit->id }}" data-balance="{{ $deposit->balance }}">{{ $deposit->title }} ({{ number_format($deposit->balance, 2) }} TL)</option>
                                                @endforeach
                                            </select>
                                            @error('from_deposit_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-1">
                                            <label for="to_deposit_id" class="form-label">Hedef Kasa</label>
                                            <select name="to_deposit_id" id="to_deposit_id" class="form-select" required>
                                                <option value="">Kasa Seçin</option>
                                                @foreach($deposits as $deposit)
                                                    <option value="{{ $deposit->id }}">{{ $deposit->title }} ({{ number_format($deposit->balance, 2) }} TL)</option>
                                                @endforeach
                                            </select>
                                            @error('to_deposit_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-1">
                                            <label for="amount" class="form-label">Transfer Miktarı (TL)</label>
                                            <input type="number" name="amount" id="amount" class="form-control" step="0.01" min="0.01" required>
                                            @error('amount')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary">Transfer Yap</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fromDepositSelect = document.getElementById('from_deposit_id');
            const amountInput = document.getElementById('amount');

            fromDepositSelect.addEventListener('change', function () {
                const selectedOption = fromDepositSelect.options[fromDepositSelect.selectedIndex];
                const maxBalance = parseFloat(selectedOption.getAttribute('data-balance')) || 0;

                // Maksimum miktarı belirle
                amountInput.max = maxBalance;

                // Eğer girilen miktar maksimumdan büyükse, sıfırla
                if (parseFloat(amountInput.value) > maxBalance) {
                    amountInput.value = '';
                }
            });

            amountInput.addEventListener('input', function () {
                const maxBalance = parseFloat(fromDepositSelect.options[fromDepositSelect.selectedIndex].getAttribute('data-balance')) || 0;
                if (parseFloat(amountInput.value) > maxBalance) {
                    amountInput.value = maxBalance;
                }
            });
        });
    </script>

    <!-- Toastr Mesajları -->
    @if(\Illuminate\Support\Facades\Session::has('message') || \Illuminate\Support\Facades\Session::has('error'))
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
                    toastr['error']("{{ \Illuminate\Support\Facades\Session::get('error') ?? \Illuminate\Support\Facades\Session::get('message') }}", 'Hata!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    break;
            }
        </script>
    @endif
@endsection