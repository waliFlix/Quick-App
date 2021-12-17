<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>بيانات الرحله</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

</head>

<body>


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Form</th>
                <th scope="col">To</th>
                <th scope="col">C-Number</th>
                <th scope="col">D-Name</th>
                <th scope="col"> Cost</th>
                <th scope="col"> E-Amount</th>
                <th scope="col"> Note</th>
                <th scope="col"> c-Name</th>
                <th scope="col"> E-Time</th>
                <th scope="col"> M-tations</th>
                <th scope="col"> Date</th>

            </tr>
        </thead>

        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>{{ $trip->fromState->name }}</td>
                <td>{{ $trip->toState->name }}</td>
                <td>{{ $trip->car->car_number }}</td>
                <td>{{ $trip->driver->name ?? null }}</td>
                <td>{{ $trip->amount }}</td>
                <td>{{ $trip->getExpensesAmount->sum('amount') }}</td>
                <td>{{ $trip->note }}</td>
                <td>{{ $trip->customer->name ?? null }}</td>
                <td>{{ $trip->EstimatedTime }}</td>
                <td>{{ str_replace(['[', ']', "\""], '', $trip->stations->pluck('name')) ?? null }}</td>
                <td>{{ $trip->created_at->format('Y-m-d') }}</td>
            </tr>

            </tr>
        </tbody>
    </table>
</body>

</html>

</html>
