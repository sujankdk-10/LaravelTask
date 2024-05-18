<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Posts</h1>
    @foreach($posts as $post)
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{$post->user ? $post->user->name : 'Unknown User'}}</h5>
            <p class="card-text">{{ $post->description }}</p>
            @if($post->image)
            <img src="{{ asset($post->image) }}" class="img-fluid" alt="Post Image">
            @endif
{{-- <!--check gareko-->
<p>Authenticated User ID: {{ Auth::id() }}</p>
<p>Post Owner ID: {{ $post->user_id }}</p>

            @if(Auth::check())
                @if($post->user_id === Auth::id())
                    <p>This post belongs to the authenticated user.</p>
                @else
                    <p>This post does not belong to the authenticated user.</p>
                @endif
            @endif

<!-- --> --}}
            <!--Edit and delete button-->
            <div class="mt-3 d-flex ">
                @auth
                @if($post->user_id === Auth::id())
                    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary mr-2">Edit</a>
                    <form action="{{route('posts.delete',$post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    </form>
                @endif
                @endauth
            </div>
               
                    <!-- Comment section -->
            <div class="mt-3">
                <form>
                    <div class="form-group">
                        <textarea class="form-control" rows="1" placeholder="Write a comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Add Comment</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
