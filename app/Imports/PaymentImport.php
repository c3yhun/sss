<?php

namespace App\Imports;

use App\Models\Deposit;
use App\Models\Payment;
use Maatwebsite\Excel\Concerns\ToModel;

class PaymentImport implements ToModel
{
    public function model(array $row)
    {
        $deposit = Deposit::where('title',$row[2])->first();
        $amount = $row[1];
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]);

        if ((isset($deposit)) ? $deposit:false){
            $payment = new Payment([
                'description'       => 'Excelden Eklendi.',
                'amount'            => $amount,
                'deposit_id'        => $deposit->id,
                'date'              => $date,
                'type'              => 'payments'
            ]);

            if ($payment->save()){
                $deposit = Deposit::find($payment->deposit_id);
                //$commission = ($payment->amount / 100) * $deposit->expense_commission;
                $deposit->decrement('balance', $payment->amount);
            }

        }
    }
}