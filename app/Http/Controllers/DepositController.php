<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Payment;
use App\Models\Pull;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DepositController extends Controller
{
    public function index()
    {
        $deposit = Deposit::orderBy('id', 'DESC')->get();
        return view('backend.deposits', compact('deposit'));
    }

    public function create()
    {
        return view('backend.deposit-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'unique:deposits,title',
            'balance' => 'required',
            'income_commission' => 'required',
            'expense_commission' => 'required',
        ]);

        $deposit = new Deposit();
        $deposit->title             = $request->title;
        $deposit->group_id          = $request->group_id;
        $deposit->balance           = $request->balance;
        $deposit->currency          = $request->currency;
        $deposit->income_commission = $request->income_commission;
        $deposit->expense_commission= $request->expense_commission;
        $deposit->save();

        $notification = array(
            'message' => '👋 Mevduat Başarıyla Eklendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.deposits.index')->with($notification);
    }

    public function show(Deposit $deposit)
    {
        //
    }

    public function edit(Deposit $deposit)
    {
        return view('backend.deposit-edit', compact('deposit'));
    }

    public function update(Request $request, Deposit $deposit)
    {
        $deposit->title             = $request->title;
        $deposit->group_id          = $request->group_id;
        $deposit->balance           = $request->balance;
        $deposit->currency          = $request->currency;
        $deposit->income_commission = $request->income_commission;
        $deposit->expense_commission= $request->expense_commission;
        $deposit->save();

        $notification = array(
            'message' => '👋 Mevduat Başarıyla Güncellendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.deposits.index')->with($notification);
    }

    public function destroy(Deposit $deposit)
    {
        $payments = Payment::where('deposit_id',$deposit->id)->delete();
        $investments = Investment::where('deposit_id',$deposit->id)->delete();
        $pulls = Pull::where('deposit_id',$deposit->id)->delete();
        $deposit->delete();

        $notification = array(
            'message' => '👋 Mevduat Başarıyla Silindi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.deposits.index')->with($notification);
    }
}
