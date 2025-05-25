<?php

namespace App\Http\Controllers;

use App\Imports\PaymentImport;
use App\Models\Deposit;
use App\Models\Payment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaymentController extends Controller
{

    public function index()
    {
        $payment = Payment::orderBy('id', 'DESC')->get();
        return view('backend.payments', compact('payment'));
    }

    public function create()
    {
        return view('backend.payment-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required',
            'deposit_id' => 'required',
        ]);

        $payment = new Payment();
        $payment->description   = $request->description;
        $payment->amount        = $request->amount;
        $payment->deposit_id    = $request->deposit_id;
        $tur                    = $request->tur;
        $payment->date          = $request->date;

        if ($payment->save() && $tur == 'Ekleme +'){
            $deposit = Deposit::find($payment->deposit_id);
            //$commission = ($payment->amount / 100) * $deposit->expense_commission;
            $deposit->increment('balance', $payment->amount);
        }
        if ($payment->save() && $tur == 'Çıkarma -'){
            $deposit = Deposit::find($payment->deposit_id);
            //$commission = ($payment->amount / 100) * $deposit->expense_commission;
            $deposit->decrement('balance', $payment->amount);
        }
    

        $notification = array(
            'message' => '👋 Ödeme Başarıyla Eklendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.payments.index')->with($notification);
    }

    public function show(Payment $payment)
    {
        //
    }

    public function edit(Payment $payment)
    {
        return view('backend.payment-edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $payment->description   = $request->description;
        $payment->amount        = $request->amount;
        $payment->deposit_id    = $request->deposit_id;
        $payment->date          = $request->date;
        $payment->save();

        $notification = array(
            'message' => '👋 Ödeme Başarıyla Güncellendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.payments.index')->with($notification);
    }

    public function destroy(Payment $payment)
    {
        if ($payment->delete()){
            $deposit = Deposit::where('id',$payment->deposit_id)->first();
            if ($deposit){
                //$commission = ($payment->amount / 100) * $deposit->expense_commission;
                $deposit->decrement('balance', $payment->amount);
            }
        }

        $notification = array(
            'message' => '👋 Ödeme Başarıyla Silindi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.payments.index')->with($notification);
    }

    public function paymentImport()
    {
        return view('backend.payment-import');
    }

    public function paymentImportPost(Request $request)
    {
        Excel::import(new PaymentImport(), $request->file('file')->store('temp'));

        $notification = array(
            'message' => '👋 Excel Kayıtları Ödemelere Eklendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.payments.index')->with($notification);
    }
}