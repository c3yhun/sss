<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Group;
use App\Models\Investment;
use App\Models\Payment;
use App\Models\Pull;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Tarih aralığını al ve Carbon ile yerel zaman dilimine göre parse et
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $startCarbon = $startDate ? Carbon::parse($startDate)->startOfDay() : null;
            $endCarbon = $endDate ? Carbon::parse($endDate)->endOfDay() : null;

            // Genel Durum için sorgular
            $investQuery = Investment::query();
            $pullQuery = Pull::query();
            $paymentQuery = Payment::query();

            // Tarih aralığına göre filtreleme (yerel zaman dilimine göre)
            if ($startCarbon) {
                $investQuery->where('created_at', '>=', $startCarbon);
                $pullQuery->where('created_at', '>=', $startCarbon);
                $paymentQuery->where('created_at', '>=', $startCarbon);
            }
            if ($endCarbon) {
                $investQuery->where('created_at', '<=', $endCarbon);
                $pullQuery->where('created_at', '<=', $endCarbon);
                $paymentQuery->where('created_at', '<=', $endCarbon);
            }

            // Toplam değerler
            $totalInvest = $investQuery->sum('amount') ?? 0;
            $totalPull = $pullQuery->sum('amount') ?? 0;
            $totalPayment = $paymentQuery->sum('amount') ?? 0;

            // Komisyon hesaplamaları
            $commissionInvest = 0;
            foreach ($investQuery->get() as $item) {
                $deposit = Deposit::find($item->deposit_id);
                if ($deposit) {
                    $commissionInvest += ($item->amount / 100) * $deposit->income_commission;
                }
            }

            $commissionPull = 0;
            foreach ($pullQuery->get() as $item) {
                $deposit = Deposit::find($item->deposit_id);
                if ($deposit) {
                    $commissionPull += ($item->amount / 100) * $deposit->expense_commission;
                }
            }

            $commissionPayment = 0;
            foreach ($paymentQuery->get() as $item) {
                $deposit = Deposit::find($item->deposit_id);
                if ($deposit) {
                    $commissionPayment += ($item->amount / 100) * $deposit->expense_commission;
                }
            }

            $totalComission = $commissionPull + $commissionInvest;
            $totalProfit = $totalInvest - $totalPull;
            $percentEndorsement = $totalInvest > 0 ? ($totalProfit / $totalInvest * 100) : 0;

            // Kasalar için sorgular (yerel zaman dilimine göre)
            $groupedDepositsQuery = Group::select('groups.title', DB::raw('SUM(deposits.balance) as balance'))
                ->leftJoin('deposits', 'deposits.group_id', '=', 'groups.id');
            if ($startCarbon) {
                $groupedDepositsQuery->where('deposits.created_at', '>=', $startCarbon);
            }
            if ($endCarbon) {
                $groupedDepositsQuery->where('deposits.created_at', '<=', $endCarbon);
            }
            $groupedDepositsQuery->groupBy('groups.id', 'groups.title')->orderBy('balance', 'desc');
            $groupedDeposits = $groupedDepositsQuery->get();

            $ungroupedDepositsQuery = Deposit::select('title', 'balance')
                ->whereNull('group_id');
            if ($startCarbon) {
                $ungroupedDepositsQuery->where('created_at', '>=', $startCarbon);
            }
            if ($endCarbon) {
                $ungroupedDepositsQuery->where('created_at', '<=', $endCarbon);
            }
            $ungroupedDeposits = $ungroupedDepositsQuery->orderBy('balance', 'desc')->get();

            // Toplam bakiye (yerel zaman dilimine göre)
            $totalBalanceQuery = Deposit::query();
            if ($startCarbon) {
                $totalBalanceQuery->where('created_at', '>=', $startCarbon);
            }
            if ($endCarbon) {
                $totalBalanceQuery->where('created_at', '<=', $endCarbon);
            }
            $totalBalance = $totalBalanceQuery->sum('balance') ?? 0;

            // Orijinal kodda bulunan totalDeposit
            $totalDeposit = $totalBalance;

            return view('backend.dashboard', compact(
                'totalInvest',
                'totalPull',
                'totalPayment',
                'commissionInvest',
                'commissionPull',
                'commissionPayment',
                'totalDeposit',
                'totalComission',
                'totalProfit',
                'percentEndorsement',
                'groupedDeposits',
                'ungroupedDeposits',
                'totalBalance'
            ));
        } catch (\Exception $e) {
            Log::error('DashboardController index hatası: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);
            return redirect()->back()->with('error', 'Bir hata oluştu. Lütfen tekrar deneyin.');
        }
    }

    public function create() {}

    public function store() {}

    public function show() {}

    public function edit() {}

    public function update() {}

    public function destroy() {}
}