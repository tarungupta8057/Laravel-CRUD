<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/parsley.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Create Post</title>
</head>

<body>

    <div class="row">
        <div class="col-md-6 offset-3 mt-5">
            <h2 class="text-center">Post View of [{{$posts->id}}]</h2>
            <!-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif -->
            @if($posts)
            <span><strong>Title</strong>: {{ $posts->title }}</span></br>
            <span><strong>Description</strong>: {{ $posts->description }}</span></br>
            <span><strong>Active</strong></span>: {{ $posts->isActive }}</br>
            <span><strong>Publish</strong>: {{ $posts->is_published }}</span>
            @else
            <h3 class="text-center text-danger mt-5"><strong>Sorry!</strong> No Data Found</h3>
            @endif
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script>
    $("#form1").parsley();
    </script>
</body>

</html>