<?php

namespace App\Imports;

use App\Models\Deposit;
use App\Models\Investment;
use Maatwebsite\Excel\Concerns\ToModel;

class InvestmentImport implements ToModel
{
    public function model(array $row)
    {
        $deposit = Deposit::where('title',$row[2])->first();
        $amount = $row[1];
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]);

        if ((isset($deposit)) ? $deposit:false){
            $investment = new Investment([
                'description'       => 'Excelden Eklendi.',
                'amount'            => $amount,
                'deposit_id'        => $deposit->id,
                'date'              => $date,
                'type'              => 'investments'
            ]);

            if ($investment->save()){
                $deposit = Deposit::find($investment->deposit_id);
                $commission = ($investment->amount / 100) * $deposit->income_commission;
                $deposit->increment('balance', $investment->amount - $commission);
            }

        }
    }
}
