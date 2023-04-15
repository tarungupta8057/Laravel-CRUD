<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/parsley.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <style>
        #outer
        {
            text-align: center;
        }
        .inner
        {
            display: inline-block;
        }
    </style>
    <title>All Posts</title>
</head>

<body>

    <div class="row">
        <div class="col-md-6 offset-3 mt-5">
            <h2 class="text-center">Display Post</h2>
            <a class ="btn btn-info mb-3" href="{{ route('posts.create') }}">Create Post</a>
            @if(count($posts)>0)
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Published</th>
                        <th scope="col">Active</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{ Str::limit($post->description,10,'...')}}</td>
                        <td>{{$post->is_published == 1 ? 'Yes' : 'No'}}</td>
                        <td>{{$post->isActive == 1 ? 'Yes' : 'No'}}</td>
                        <td id="outer">
                            <a href="{{ route('posts.show',$post->id) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                            <form class="inner" method="post" action=" {{route('posts.destroy',$post->id)}} ">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                            @if($post->trashed())
                            <a href="{{ route('posts.softDelete',$post->id) }}" class="btn btn-warning"><i class="fa fa-undo"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div>
                <h2 class="text-center text-danger mt-5">
                    No Data Found.
                </h2>
            </div>
            @endif
            <!-- {{$posts->render()}} -->
            {{$posts->links();}}
        </div>
    </div>
        <script src="{{asset('assets/js/toastr.min.js')}}"></script>
        <script>
            toastr.options = {
                "closeButton": true,
                "timeout": 4000,
                "preventDuplicates": false,
                "positionClass": "toast-top-left",
            }
        </script>
        <script>
            @if(Session::has("alert-success"))
                toastr["success"]("{{Session::get('alert-success')}}");
            @endif
            @if(Session::has("alert-info"))
                toastr["info"]("{{Session::get('alert-info')}}");
            @endif
            @if(Session::has("alert-danger"))
                toastr["error"]("{{Session::get('alert-danger')}}");
            @endif
            @if(Session::has("undo"))
                toastr["undo"]("{{ Session::get('alert-success')}}");
            @endif
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script>
    $("#form1").parsley();
    </script>
</body>

</html>