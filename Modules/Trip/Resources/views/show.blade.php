@extends('layouts.dashboard.app', ['datatable' => true])

@section('title', 'الرحلات')

@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        .well {
            margin: 15px 0px;
            font-size: 13px;
            padding: 8px;
        }

        .form-inline .form-control {
            padding: 0px 8px;
        }

        #progress {
            position: relative;
            margin-bottom: 30px;
        }

        #progress-bar {
            position: absolute;
            background: lightseagreen;
            height: 5px;
            width: 0%;
            top: 50%;
            left: 0;
        }

        #progress-num {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: space-between;
        }

        #progress-num::before {
            content: "";

            #progress-num .step {
                border: 3px solid lightgray;
                border-radius: 100%;
                width: 25px;
                height: 25px;
                line-height: 25px;
                text-align: center;
                background-color: #fff;
                font-family: sans-serif;
                font-size: 14px;
                position: relative;
                z-index: 1;
            }

            #progress-num .step.active {
                border-color: lightseagreen;
                background-color: lightseagreen;
                color: #fff;
            }

            background-color: lightgray;
            position: absolute;
            top: 50%;
            left: 0;
            height: 5px;
            width: 100%;
            z-index: -1;
        }

        #progress-num .step {
            border: 3px solid lightgray;
            border-radius: 100%;
            width: 25px;
            height: 25px;
            line-height: 25px;
            text-align: center;
            background-color: #fff;
            font-family: sans-serif;
            font-size: 14px;
            position: relative;
            z-index: 1;
        }

        #progress-num .step.active {
            border-color: lightseagreen;
            background-color: lightseagreen;
            color: #fff;
        }

        .container {
            align-items: center;
            justify-content: center;
            display: flex;

        }

    </style>
@endpush

@section('content')
    @component('partials._breadcrumb')
        @slot('title', ['الرحلات'])
            @slot('url', ['#'])
                @slot('icon', ['list'])
                @endcomponent

                <div class="box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">
                            <i class="fa fa-list-alt"></i>
                            <span>بيانات الرحلة</span>
                        </h4>
                    </div>
                    <div class="box-body">
                        <table id="bills-table" class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>من مدينة</th>
                                    <th>الى مدينة</th>
                                    <th>رقم اللوحة</th>
                                    <th>السائق</th>
                                    <th>التكلفة</th>
                                    <th>اجمالى المنصرفات</th>
                                    <th>صافي الرحلة</th>
                                    <th>الملاحظات</th>
                                    <th>العميل</th>
                                    <th>التاريخ</th>
                                    <th>الوقت المتوقع</th>
                                    <th> المحطات الوسطيه</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $trip->fromState->name }}</td>
                                    <td>{{ $trip->toState->name }}</td>
                                    <td>{{ $trip->car->car_number }}</td>
                                    <td>{{ $trip->driver->name ?? null }}</td>
                                    <td>{{ $trip->amount }}</td>
                                    <td>{{ $trip->getExpensesAmount->sum('amount') }}</td>
                                    <td>{{ $trip->amount - $trip->getExpensesAmount->sum('amount') }}</td>
                                    <td>{{ $trip->note }}</td>
                                    <td>{{ $trip->customer->name ?? null }}</td>
                                    <td>{{ $trip->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $trip->EstimatedTime }}</td>
                                    <td>
                                        @foreach ($trip->stations as $item)
                                            {{ $item['name'] ?? null }}
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">
                            <i class="fa fa-list-alt"></i>
                            <span>منصرفات الرحلة</span>
                        </h4>
                    </div>
                    <div class="box-body">
                        <table id="bills-table" class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>رقم الرحلة</th>
                                    <th>المنصرف</th>
                                    <th>نوع المنصرف</th>
                                    <th>ملاحظات</th>
                                    <th>التاريح</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenses as $expense)
                                    <tr>
                                        <td>{{ $expense->trip_id }}</td>
                                        <td>{{ $expense->amount }}</td>
                                        <td>{{ $expense->expense_type }}</td>
                                        <td>{{ $expense->notes }}</td>
                                        <td>{{ $expense->created_at->format('Y-m-d') }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="container">
                    <a href="/station/{{ $trip->id }}">
                        <button type="submit" class="btn btn-primary container-a "> تعديل المحطه </button>
                    </a>
                </div>


            @endsection

            @push('js')
                <script>
                    $(function() {
                        $('table#bills-table').dataTable({
                            ordering: false,
                        })
                    });
                    };
                </script>
            @endpush
