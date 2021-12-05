<?php

namespace App\Http\Controllers;

use App\Account;
use App\{Customer, Invoice, Safe};
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct() {
        $this->middleware('permission:customers-create')->only(['create', 'store']);
        $this->middleware('permission:customers-read')->only(['index', 'show']);
        $this->middleware('permission:customers-update')->only(['edit', 'update']);
        $this->middleware('permission:customers-delete')->only('destroy');
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $customers = Customer::all();
        return view('dashboard.customers.index', compact('customers'));
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
        'name'      => 'required|string|max:190',
        'phone'     => 'required|string|max:30|unique:customers',
        'email'=>'required|email|unique:customers',
        'seondphone'=>'somtimes|min:9',
        ]);

        // $account = Account::newCustomer();
        $data = $request->except(['_token']);
        // $data['account_id'] = $account->id;

        $customer = Customer::create($data);
        // if($request->stores) $customer->stores()->attach($request->stores);
        session()->flash('success', 'تمت العملية بنجاح');

        return back();
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Customer  $customer
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request, Customer $customer)
    {

        return view('dashboard.customers.show', compact('customer' ));

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Customer  $customer
    * @return \Illuminate\Http\Response
    */
    public function edit(Customer $customer)
    {
        //
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Customer  $customer
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->validate([
        'name'      => 'required|string|max:190',
        'phone'     => 'required|string|max:30|unique:customers,phone,'.$customer->id,
        ]));
        if($request->stores) {
            $customer->stores()->detach();
            $customer->stores()->attach($request->stores);
        }
        session()->flash('success', 'تمت العملية بنجاح');

        return back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Customer  $customer
    * @return \Illuminate\Http\Response
    */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        session()->flash('success', 'تمت العملية بنجاح');

        return back();
    }

    public function statement(Request $request, Customer $customer){
        $invoices = $customer->invoices;
        $from_date = $request->has('from_date') ? $request->from_date : null;
        $from_date = is_null($from_date) && $invoices->count() ? $invoices->first()->created_at->format('Y-m-d') : $from_date;
        $from_date = is_null($from_date) && !$invoices->count() ? date('Y-m-d') : $from_date;
        $to_date = $request->to_date ? $request->to_date : date('Y-m-d');

        $from_date_time = $from_date . ' 00:00:00';
        $to_date_time = $to_date . ' 23:59:59';

        $invoices = $invoices->whereBetween('created_at', [$from_date_time, $to_date_time])->sortByDesc('created_at');
        // dd($invoices);
        return view('dashboard.customers.statement', compact('customer', 'invoices', 'from_date', 'to_date'));
    }
}
