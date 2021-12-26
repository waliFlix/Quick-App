<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>بيانات الرحله</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: white !important;
            font-family: XB Riyaz;
        }

    </style>
</head>

<body dir="rtl">
    <!-- component -->

    <p class="text-lg text-center font-bold m-5">تفاصيل الرحله</p>
    <table class="rounded-t-lg m-5 w-5/6 mx-auto bg-gray-200 text-gray-800">
        <tr>
            <th style="padding: 10">من مدينة</th>
            <th style="padding: 10">الى مدينة</th>
            <th style="padding: 10">رقم اللوحة</th>
            <th style="padding: 10">السائق</th>
            <th style="padding: 10">التكلفة</th>
            <th style="padding: 10">اجمالى المنصرفات</th>
            <th style="padding: 10">صافي الرحلة</th>
            <th style="padding: 10">الملاحظات</th>
            <th style="padding: 10">العميل</th>
            <th style="padding: 10">التاريخ</th>
            <th style="padding: 10">الوقت المتوقع</th>
            <th style="padding: 10"> المحطات الوسطيه</th>
        </tr>
        <tr>

        <td style="padding: 10" style="padding: 10">{{ $trip->fromState->name }}</td>
        <td style="padding: 10">{{ $trip->toState->name }}</td>
        <td style="padding: 10">{{ $trip->car->car_number }}</td>
        <td style="padding: 10">{{ $trip->driver->name ?? null }}</td>
        <td style="padding: 10">{{ $trip->amount }}</td>
        <td style="padding: 10">{{ $trip->getExpensesAmount->sum('amount') }}</td>
        <td style="padding: 10">{{ $trip->amount - $trip->getExpensesAmount->sum('amount') }}</td>
        <td style="padding: 10">{{ $trip->note }}</td>
        <td style="padding: 10">{{ $trip->customer->name ?? null }}</td>
        <td style="padding: 10">{{ $trip->created_at->format('Y-m-d') }}</td>
        <td style="padding: 10">{{ $trip->EstimatedTime }}</td>
        <td style="padding: 10">
            @foreach ($trip->stations as $item)
                {{ $item['name'] ?? null }}
            @endforeach
        </td>
        </tr>


        <!-- each row -->

    </table>

</body>


</html>
