<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #eee;
        }
        .time {
            font-size: 9px !important;
        }
        .socials i {
            margin-right: 14px;
            font-size: 17px;
            color: #d2c8c8;
            cursor: pointer;
        }
        .feed-image img {
            width: 100%;
            height: auto;
        }
        
    </style>
</head>
<body>

<div class="container mt-4 mb-5">
    <h1 class="text-center">Post Feed</h1>
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            @foreach($posts as $post)
            <div class="feed p-2">
                <div class="bg-white border mt-2">
                    <div>
                        <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                            <div class="d-flex flex-row align-items-center feed-text px-2">
                                <img class="rounded-circle" src="{{ $post->user->profile_image ?? 'https://i.imgur.com/aoKusnD.jpg' }}" width="45">
                                <div class="d-flex flex-column flex-wrap ml-2">
                                    <span class="font-weight-bold">{{ $post->user ? $post->user->name : 'Unknown User' }}</span>
                                    <span class="text-black-50 time">{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
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

<!-- JavaScript for toggling comments -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.toggle-comments').forEach(function (element) {
            element.addEventListener('click', function (event) {
                event.preventDefault();
                const postId = this.getAttribute('data-post-id');
                const commentsSection = document.getElementById(`comments-section-${postId}`);
                if (commentsSection.style.display === 'none') {
                    commentsSection.style.display = 'block';
                    this.classList.add('text-dark');
                } else {
                    commentsSection.style.display = 'none';
                    this.classList.remove('text-dark')
                }
            });
        });
    });
</script>

</body>
</html>
