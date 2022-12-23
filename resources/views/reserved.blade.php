<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <div class="container mt-4">

        <div class="card">
            <div class="card-header text-center font-weight-bold">
                Potvrzení rezervace
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h3>Jméno</h3>
                    <div class="w-10 p-3"></div>
                    <h6> {{ $reservation->name }}</h6>
                </div>
                <div class="d-flex align-items-center">
                    <h3>Email</h3>
                    <div class="w-10 p-3"></div>
                    <h6> {{ $reservation->email }}</h6>
                </div>
                <div class="d-flex align-items-center">
                    <h3>Telefon</h3>
                    <div class="w-10 p-3"></div>
                    <h6> {{ $reservation->tel }}</h6>
                </div>
                <div class="d-flex align-items-center">
                    <h3>Poznámka</h3>
                    <div class="w-10 p-3"></div>
                    <h6> {{ $reservation->note }}</h6>
                </div>
                <br>
                <br>
                <div class="d-flex align-items-center">
                    <h3>Počet na stání</h3>
                    <div class="w-10 p-3"></div>
                    <h6> {{ $reservation->stand }}</h6>
                </div>
                <br>
                <br>
                <div class="d-flex align-items-center">
                    <h3>Sedadla</h3>
                    <div class="w-10 p-3"></div>
                    @foreach ($seats as $seat)
                        <h6> {{ $seat['alias'] }}, </h6>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</body>

</html>
