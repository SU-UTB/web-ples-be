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
            Rezervace
          </div>
          <div class="card-body">
            <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('api/reservations/')}}">
             @csrf
              <div class="form-group">
               

            <label for="name" class="form-label">Jméno</label>
            <input type="text" class="form-control" id="name" placeholder="Karel Svobodný">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea name="description" class="form-control" required=""></textarea>
              </div>
              <button type="submit" class="btn btn-dark">Rezervovat</button>
            </form>
          </div>
        </div>
      </div> 
    <form name="reservation-form" method="post" action="{{url('api/reservations/')}}">
        @csrf <!-- {{ csrf_field() }} -->

        <div class="mb-3">
            <label for="name" class="form-label">Jméno</label>
            <input type="name" class="form-control" id="name" placeholder="Karel Svobodný">
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" placeholder="kaja@bourak.com">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Telefon</label>
            <input type="tel" class="form-control" id="phone" placeholder="555 252 222">
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Poznámka</label>
            <textarea type="note" class="form-control" id="note" placeholder=""></textarea>
        </div>
        <div class="mb-3">
        <button type="submit" class="btn btn-dark">Rezervovat</button>
    </div>

    </form>

</body>

</html>
