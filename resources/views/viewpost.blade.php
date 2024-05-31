<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!--custom css-->
    <link rel="stylesheet" href="{{asset('admin-assets/dist/css/viewpost.css')}}">
    
</head>
<body>

<div class="container mt-4 mb-5">
    <div>
        <h1 class="text-center">Post Feed</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-primary create-post-btn">Create Post</a>

    </div>
    
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            @foreach($posts as $post)
            <div id="post-{{$post->id}}" class="feed p-2">
                <div class="bg-white border mt-2">
                    <div>
                        <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                            <div class="d-flex flex-row align-items-center feed-text px-2">
                                <img class="rounded-circle" src="{{ $post->user->profile_image ?? asset('admin-assets/dist/img/user4-128x128.jpg') }}" width="45">
                                <div class="d-flex flex-column flex-wrap ml-2">
                                    <span class="font-weight-bold">{{ $post->user ? $post->user->name : 'Unknown User' }}</span>
                                    <span class="text-black-50 time">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            @auth
                            @if(auth()->user()->id == $post->user_id)
                            <div class="feed-icon px-2">
                                <div class="dropdown">
                                    <i class="fa fa-ellipsis-v text-black-50" id="ellipsis-icon-{{$post->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="toggleEllipsisColor({{$post->id}})"></i>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton-{{$post->id}}">
                                        <a class="dropdown-item" href="{{route('posts.edit', $post->id)}}">Edit</a>
                                        <form action="{{ route('posts.delete', $post->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endauth
                        </div>
                    </div>
                    <div class="p-2 px-3"><span>{{ $post->description }}</span></div>
                    @if($post->image)
                    <div class="feed-image p-2 px-3"><img class="img-fluid img-responsive" src="{{ asset($post->image) }}"></div>
                    @endif
                    <div class="d-flex justify-content-end socials p-2 py-3">
                        <i class="fa fa-thumbs-up"></i>
                        <i class="fa fa-comments-o toggle-comments" data-post-id="{{ $post->id }}">
                            <span class="comment-count-badge">{{ $post->comments->count() }}</span>
                        </i>
                        <i class="fa fa-share"></i>
                    </div>
                </div>
                <!-- Comments Section -->
                <div class="bg-white border mt-2" id="comments-section-{{ $post->id }}" style="display: none;">
                    <div class="p-2 px-3">
                        <h6>Comments</h6>
                        @if ($post->comments->isEmpty())
                            <p>No comments</p>
                        @else
                            @foreach ($post->comments as $comment)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <p class="card-text"><strong>{{ $comment->user->name }}: </strong>{{ $comment->content }}</p>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        @auth
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="content" rows="1" placeholder="Write a comment"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Add Comment</button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript for toggling comments and ellipsisIcontoggle -->
<script src="{{ asset('admin-assets/dist/js/comments.js') }}"></script>

</body>
</html>
