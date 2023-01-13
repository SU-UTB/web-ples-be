<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')


        <!-- Page Content -->
        <main>


            <div class="container mt-4">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Jmeno</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tel</th>
                            <th scope="col">Poznamka</th>
                            <th scope="col">Pocet na stani</th>
                            <th scope="col">Cena celkem</th>
                            <th scope="col">Datum platby</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <th scope="row">{{ $reservation['id'] }}</th>
                                <td>{{ $reservation['name'] }}</td>
                                <td>{{ $reservation['email'] }}</td>
                                <td>{{ $reservation['tel'] }}</td>
                                <td>{{ $reservation['note'] }}</td>
                                <td>{{ $reservation['stand'] }}</td>
                                <td>{{ $reservation['price_all'] }}</td>
                                <td>{{ $reservation['date_payment'] }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td scope="row">Sedadla</td>
                                <td>@json($reservation['seats'])</td>
                            </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>

        </main>
    </div>


</body>


</html>
