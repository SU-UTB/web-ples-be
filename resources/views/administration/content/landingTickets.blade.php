
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


</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <div class="min-h-screen bg-gray-100">

        <x-navbar></x-navbar>
        <!-- Page Content -->
        <main>


            <div class="container mt-4">


                <div class="card-body">
                    <p class="text-xl">Contact</p>
                    <form name="add-blog-post-form" id="add-blog-post-form" method="post"
                        action="{{ route('updateContact', $data->contact->id) }}">
                        <input type="hidden" name="_method" value="put" />
                        @csrf
                        <div class="form-group mt-2">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role" name="role"
                                placeholder="Role name" value="{{ $data->contact->role }}" disabled>
                        </div>
                        <div class="form-group mt-2">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                value="{{ $data->contact->name }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{ $data->contact->email }}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone"
                                value="{{ $data->contact->phone }}">
                        </div>

                        <br>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-blue">Save</button>
                        </div>

                        <br>
                    </form>

                    <br>
                    <br>

                    <p class="text-xl">Tickets selling from date:</p>
                    <form name="add-blog-post-form" id="add-blog-post-form" method="post"
                        action="{{ url('admin/content/landing/tickets') }}">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="reservations_from" class="form-label">Date</label>
                            <input type="date" class="form-control" id="reservations_from" name="reservations_from"
                                placeholder="Date" value="{{ $data->reservations_from }}">
                        </div>


                        <br>
                        <br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-blue">Save</button>
                        </div>

                    </form>


                </div>


            </div>

        </main>
    </div>


</body>


</html>
