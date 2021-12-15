<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>

<body>
    <div class="box-body">
        <table id="bills-table" class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>من مدينة</th>
                    <th>الى مدينة</th>
                    <th>رقم اللوحة</th>
                    <th>السائق</th>
                    <th>التكلفة</th>
                    <th>الملاحظات</th>
                    <th>العميل</th>
                    <th>وقت الوصول</th>
                   <th>المحطات</th>
                    <th>التاريخ</th>
             
                 
                </tr>
            </thead>
            <tbody>
              
                    <tr>
                        <td>{{ $trip->id }}</td>
                        <td>{{ $trip->fromState->name }}</td>
                        <td>{{ $trip->toState->name }}</td>
                        <td>{{ $trip->car->car_number }}</td>
                        <td>{{ $trip->driver->name ?? null }}</td>
                        <td>{{ $trip->amount }}</td>
                        <td>{{ $trip->note }}</td>
                        <td class="mr-2">{{ $trip->customer->name ?? null }}</td>
                        <td>{{ $trip->EstimatedTime }}</td>
                     
                        <td>{{ str_replace(["[","]","\""], '',$trip->stations->pluck('name')) ?? null}}</td>  
                       
                       
                        <td>{{ $trip->created_at->format('Y-m-d') }}</td>
                  
                    </tr>
              
            
            </tbody>
        </table>
    </div>

</body>

</html>
