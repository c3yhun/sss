<?php

namespace App\Imports;

use App\Models\Deposit;
use App\Models\Pull;
use Maatwebsite\Excel\Concerns\ToModel;

class PullImport implements ToModel
{
    public function model(array $row)
    {
        $deposit = Deposit::where('title',$row[2])->first();
        $amount = $row[1];
        $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]);

        if ((isset($deposit)) ? $deposit:false){
            $pull = new Pull([
                'description'       => 'Excelden Eklendi.',
                'amount'            => $amount,
                'deposit_id'        => $deposit->id,
                'date'              => $date,
                'type'              => 'pulls'
            ]);

            if ($pull->save()){
                $deposit = Deposit::find($pull->deposit_id);
                $commission = ($pull->amount / 100) * $deposit->expense_commission;
                $deposit->decrement('balance', $pull->amount + $commission);
            }
        }
    }
}