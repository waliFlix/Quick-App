<?php

namespace App\Http\Controllers;

use App\{Expense, Bill, ExpensesType, Invoice};
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function __construct() {
        $this->middleware('permission:expenses-create')->only(['create', 'store']);
        $this->middleware('permission:expenses-read')->only(['index', 'show']);
        $this->middleware('permission:expenses-update')->only(['edit', 'update']);
        $this->middleware('permission:expenses-delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        $expenses_types = ExpensesType::all();
        return view('dashboard.expenses.index', compact('expenses', 'expenses_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required | numeric',
            'details' => 'required | string',
            'safe_id' => 'required | numeric',
        ]);
        // dd($request->all());
        $expense = Expense::create($request->except('_token', '_method'));
        
        session()->flash('success', 'تمت العملية بنجاح');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(expense $expense)
    {
        $expenses_types = ExpensesType::all();
        return view('dashboard.expenses.show', compact('expense', 'expenses_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Expense  $expense)
    {

        $request->validate([
            'amount' => 'required | numeric',
            'details' => 'required | string',
            'safe_id' => 'required | numeric',
        ]);

        $expense->update($request->all());

        if(isset($expense->entry)) {
            $expense->entry->update([
                'amount' => $request['amount'],
                'details' => $request['details']
            ]);
        }

        
        if($expense->bill) $expense->bill->refresh();
        if($expense->invoice) $expense->invoice->refresh();

        session()->flash('success', 'تمت العملية بنجاح');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(expense $expense)
    {
        
        $expense->delete();

        session()->flash('success', 'تمت العملية بنجاح');

        return back();

    }
}
