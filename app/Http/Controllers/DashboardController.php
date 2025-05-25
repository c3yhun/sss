<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Payment;
use App\Models\Pull;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInvest = Investment::sum('amount');
        $totalPull = Pull::sum('amount');
        $totalPayment = Payment::sum('amount');


        $commissionInvest = 0;
        foreach (Investment::all() as $item){
            $commissionInvest += ($item->amount / 100) * Deposit::find($item->deposit_id)->income_commission;
        }

        $commissionPull = 0;
        foreach (Pull::all() as $item){
            $commissionPull += ($item->amount / 100) * Deposit::find($item->deposit_id)->expense_commission;
        }

        $commissionPayment = 0;
        foreach (Payment::all() as $item){
            $commissionPayment += ($item->amount / 100) * Deposit::find($item->deposit_id)->expense_commission;
        }

        $totalDeposit = Deposit::sum('balance');
        
        $totalProfit = $totalInvest - $totalPull;
        
        $totalComission =  $commissionPull + $commissionInvest;

        $percentEndorsement = 0;
        if ($totalInvest > 0){
            $percentEndorsement = $totalProfit / $totalInvest * 100;
        }




        return view('backend.dashboard', compact('totalInvest','totalPull','totalPayment','commissionInvest','commissionPull','commissionPayment','totalDeposit','totalComission','percentEndorsement', 'totalProfit'));
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}