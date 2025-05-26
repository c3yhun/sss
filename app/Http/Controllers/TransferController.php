<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransferController extends Controller
{
    public function index()
    {
        // Tüm kasaları al (dropdown için)
        $deposits = Deposit::all();
        return view('backend.transfer.index', compact('deposits'));
    }

    public function store(Request $request)
    {
        try {
            // Formdan gelen verileri doğrula
            $request->validate([
                'from_deposit_id' => 'required|exists:deposits,id',
                'to_deposit_id' => 'required|exists:deposits,id|different:from_deposit_id',
                'amount' => 'required|numeric|min:0.01',
            ], [
                'from_deposit_id.required' => 'Lütfen transfer yapılacak kasayı seçin.',
                'to_deposit_id.required' => 'Lütfen transfer edilecek kasayı seçin.',
                'to_deposit_id.different' => 'Aynı kasaya transfer yapılamaz.',
                'amount.required' => 'Lütfen transfer miktarını girin.',
                'amount.numeric' => 'Transfer miktarı geçerli bir sayı olmalıdır.',
                'amount.min' => 'Transfer miktarı en az 0.01 olmalıdır.',
            ]);

            $fromDepositId = $request->input('from_deposit_id');
            $toDepositId = $request->input('to_deposit_id');
            $amount = $request->input('amount');

            // Transfer yapılacak kasayı ve hedef kasayı al
            $fromDeposit = Deposit::findOrFail($fromDepositId);
            $toDeposit = Deposit::findOrFail($toDepositId);

            // Bakiye kontrolü
            if ($fromDeposit->balance < $amount) {
                return redirect()->back()->with('error', 'Yetersiz bakiye! ' . $fromDeposit->title . ' kasasında sadece ' . number_format($fromDeposit->balance, 2) . ' TL mevcut.');
            }

            // Transfer işlemi
            $fromDeposit->balance -= $amount;
            $toDeposit->balance += $amount;

            // Değişiklikleri kaydet
            $fromDeposit->save();
            $toDeposit->save();

            return redirect()->route('admin.transfer.index')->with('message', 'Transfer başarıyla gerçekleştirildi!')->with('alert-type', 'success');
        } catch (\Exception $e) {
            Log::error('Transfer işlemi hatası: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);
            return redirect()->back()->with('error', 'Bir hata oluştu. Lütfen tekrar deneyin.');
        }
    }
}