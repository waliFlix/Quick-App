@extends('layouts.dashboard.app')

@section('title', 'الرحلات الوسطيه')

@push('css')
    <style>
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
            width: 65px;
            height: 65px;
            line-height: 65px;
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

                <div dir="rtl">
                    <div id="progress" >
                        <div id="progress-bar"></div>
                        <ul id="progress-num">
                            <li class="step active" >{{ $trip->fromState->name }}</li>
                            @foreach ($trip->stations as $item)
                                <li class="step" name="mid">{{ $item['name'] }}</li>
                            @endforeach

                            <li class="step">{{ $trip->toState->name }}</li>
                        </ul>

                    </div>

                    <button id="progress-next" class="btn">تعديل المحطه</button>
                    <button id="progress-prev" class="btn" disabled></button>
                </div>

                <div class="flex-1">
                    <a href="/send-email/{{ $trip->id }}">
                        <button type="submit" class="btn btn-primary">ارسال بريد الكتروني</button>
                    </a>
                </div>


                <div>
                    <a href="/trip-invoice/{{ $trip->id }}">
                        <button type="submit" class="btn btn-primary"> PDF </button>
                    </a>
                </div>

            @endsection

            @push('js')
                <script>
                    // $(function() {
                    //     $('table#bills-table').dataTable({
                    //         ordering: false,
                    //     })
                    // });
                    const progressBar = document.getElementById("progress-bar");
                    const progressNext = document.getElementById("progress-next");
                    const progressPrev = document.getElementById("progress-prev");
                    const steps = document.querySelectorAll(".step");
                    let active = 1;


                    progressNext.addEventListener("click", () => {
                        active++;
                        if (active > steps.length) {
                            active = steps.length;
                        }
                        updateProgress();
                    });

                    progressPrev.addEventListener("click", () => {
                        active--;
                        if (active < 1) {
                            active = 1;
                        }
                        updateProgress();
                    });

                    const updateProgress = () => {
                        // toggle active class on list items
                        steps.forEach((step, i) => {
                            if (i < active) {
                                step.classList.add("active");
                            } else {
                                step.classList.remove("active");
                            }
                        });
                        // set progress bar width  
                        progressBar.style.width =
                            ((active - 1) / (steps.length - 1)) * 100 + "%";
                        // enable disable prev and next buttons
                        if (active === 1) {
                            progressPrev.disabled = true;
                        } else if (active === steps.length) {
                            progressNext.disabled = true;
                        } else {
                            progressPrev.disabled = false;
                            progressNext.disabled = false;
                        }
                    };
                </script>
            @endpush
