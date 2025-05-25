<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Payment;
use App\Models\Pull;
use Illuminate\Http\Request;

class StatementController extends Controller
{

    public function index()
    {
        $pull = collect(Pull::all());
        $investment = collect(Investment::all());
        $payment = collect(Payment::all());

        $one = $pull->merge($investment);
        $statement = $one->merge($payment);
        $statement = $statement->sortByDesc('date');
        return view('backend.statements', compact('statement'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}