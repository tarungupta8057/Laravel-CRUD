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
            <h2>Create Post</h2>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(Session::has("alert-success"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get("alert-success")}} .
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @endif
            <form style="margin-top: 20px;" method="post" action="{{route('posts.store')}}" id="form1">
                @csrf

                <div class="mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')}}">
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" rows="5" class="form-control">{{old('description')}}</textarea>
                </div>
                <div class="mb-3">
                    <label>Published</label>
                    <select name="is_published" class="form-control">
                        <option value="" disabled selected>Choose Option</option>
                        <option @selected(old('is_published')==1) value="1">True</option>
                        <option @selected(old('is_published')==0) value="0">False</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Active</label>
                    <select name="isActive" class="form-control">
                        <option value="" disabled selected>Choose Option</option>
                        <option @selected(old('isActive')==1) value="1">Yes</option>
                        <option @selected(old('isActive')==0) value="0">No</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script>
    $("#form1").parsley();
    </script>
</body>

</html>