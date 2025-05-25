<?php

namespace App\Http\Controllers;

use App\Imports\PullImport;
use App\Models\Deposit;
use App\Models\Pull;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PullController extends Controller
{
    public function index()
    {
        $pull = Pull::orderBy('id', 'DESC')->get();
        return view('backend.pulls', compact('pull'));
    }

    public function create()
    {
        return view('backend.pull-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required',
        ]);

        $pull = new Pull();
        $pull->description   = $request->description;
        $pull->amount        = $request->amount;
        $pull->deposit_id    = $request->deposit_id;
        $pull->date          = $request->date;

        if ($pull->save()){
            $deposit = Deposit::find($pull->deposit_id);
            $commission = ($pull->amount / 100) * $deposit->expense_commission;
            $deposit->decrement('balance', $pull->amount + $commission);
        }

        $notification = array(
            'message' => '👋 Çekim Başarıyla Eklendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pulls.index')->with($notification);
    }

    public function show(Pull $pull)
    {
        //
    }

    public function edit(Pull $pull)
    {
        return view('backend.pull-edit', compact('pull'));
    }

    public function update(Request $request, Pull $pull)
    {
        $pull->description   = $request->description;
        $pull->amount        = $request->amount;
        $pull->deposit_id    = $request->deposit_id;
        $pull->date          = $request->date;
        $pull->save();

        $notification = array(
            'message' => '👋 Çekim Başarıyla Güncellendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pulls.index')->with($notification);
    }

    public function destroy(Pull $pull)
    {
        if ($pull->delete()){
            $deposit = Deposit::where('id',$pull->deposit_id)->first();
            if ($deposit){
                $commission = ($pull->amount / 100) * $deposit->expense_commission;
                $deposit->increment('balance', $pull->amount - $commission);
            }
        }

        $notification = array(
            'message' => '👋 Çekim Başarıyla Silindi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pulls.index')->with($notification);
    }

    public function pullImport()
    {
        return view('backend.pull-import');
    }

    public function pullImportPost(Request $request)
    {
        Excel::import(new PullImport(), $request->file('file')->store('temp'));

        $notification = array(
            'message' => '👋 Excel Kayıtları Çekimlere Eklendi!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.pulls.index')->with($notification);
    }
}