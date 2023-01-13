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
        <div class="card-header text-center font-weight-bold">
            Landing
        </div>

        <div class="card-body">


            @foreach ($data->contents as $c)
                <form name="add-blog-post-form" id="add-blog-post-form" method="post"
                    action="{{ route('updateLandingContent', $c->id) }}">
                    <input type="hidden" name="_method" value="put" />
                    @csrf
                    <div class="form-group mt-2">
                        <label for="name" class="form-label">Section</label>
                        <input type="name" class="form-control" id="name" name="name"
                            placeholder="Section name" value="{{ $c->title }}" disabled>
                    </div>
                    <div class="form-group mt-2">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" name="content" placeholder="Content..." rows="6">{{ $c->content }}</textarea>
                    </div>
                    <br>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                    <br>
                    <br>
                    <br>
                </form>
            @endforeach


        </div>


    </div>

</body>

</html>
