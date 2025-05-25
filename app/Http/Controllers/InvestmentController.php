<?php

namespace App\Http\Controllers;

use App\Imports\InvestmentImport;
use App\Models\Deposit;
use App\Models\Investment;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class InvestmentController extends Controller
{
    public function index()
    {
        $investment = Investment::orderBy('id', 'DESC')->get();
        return view('backend.investments', compact('investment'));
    }

    public function create()
    {
        return view('backend.investment-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required',
        ]);

        $investment = new Investment();
        $investment->description   = $request->description;
        $investment->amount        = $request->amount;
        $investment->deposit_id    = $request->deposit_id;
        $investment->date          = $request->date;

        if ($investment->save()){
            $deposit = Deposit::find($investment->deposit_id);
            $commission = ($investment->amount / 100) * $deposit->income_commission;
            $deposit->increment('balance', $investment->amount - $commission);
        }

        $notification = array(
            'message' => '👋 Yatırım Başarıyla Eklendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.investments.index')->with($notification);
    }

    public function show(Investment $investment)
    {
        //
    }

    public function edit(Investment $investment)
    {
        return view('backend.investment-edit', compact('investment'));
    }

    public function update(Request $request, Investment $investment)
    {
        $investment->description   = $request->description;
        $investment->amount        = $request->amount;
        $investment->deposit_id    = $request->deposit_id;
        $investment->date          = $request->date;
        $investment->save();

        $notification = array(
            'message' => '👋 Yatırım Başarıyla Güncellendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.investments.index')->with($notification);
    }

    public function destroy(Investment $investment)
    {
        if ($investment->delete()){
            $deposit = Deposit::where('id',$investment->deposit_id)->first();
            if ($deposit){
                $commission = ($investment->amount / 100) * $deposit->income_commission;
                $deposit->decrement('balance', $investment->amount - $commission);
            }
        }

        $notification = array(
            'message' => '👋 Yatırım Başarıyla Silindi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.investments.index')->with($notification);
    }


    public function investImport()
    {
        return view('backend.investment-import');
    }

    public function investImportPost(Request $request)
    {
        Excel::import(new InvestmentImport(), $request->file('file')->store('temp'));

        $notification = array(
            'message' => '👋 Excel Kayıtları Yatırımlara Eklendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.investments.index')->with($notification);
    }





}
