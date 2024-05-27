@extends('admin.main-layout')

@section('content-header')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">User Profile</li>
        </ol>
      </div>
    </div>
  </div>
</div>
@endsection

@section('body')
<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle" src="{{asset('admin-assets/dist/img/user4-128x128.jpg')}}" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
        <p class="text-muted text-center">Software Engineer</p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Followers</b> <a class="float-right">1,322</a>
          </li>
          <li class="list-group-item">
            <b>Following</b> <a class="float-right">543</a>
          </li>
          <li class="list-group-item">
            <b>Friends</b> <a class="float-right">13,287</a>
          </li>
        </ul>

        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
      </div>
    </div>

    <!-- About Me Box -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">About Me</h3>
      </div>
      <div class="card-body">
        <strong><i class="fas fa-book mr-1"></i> Education</strong>
        <p class="text-muted">B.S. in Computer Science from the University of Tennessee at Knoxville</p>
        <hr>
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
        <p class="text-muted">Malibu, California</p>
        <hr>
        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
        <p class="text-muted">
          <span class="tag tag-danger">UI Design</span>
          <span class="tag tag-success">Coding</span>
          <span class="tag tag-info">Javascript</span>
          <span class="tag tag-warning">PHP</span>
          <span class="tag tag-primary">Node.js</span>
        </p>
        <hr>
        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
      </div>
    </div>
  </div>

  <div class="col-md-9">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#postfeed" data-toggle="tab">Post Feed</a></li>
          <li class="nav-item"><a class="nav-link" href="#createpost" data-toggle="tab">Create Post</a></li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="active tab-pane" id="postfeed">
            <!-- Post -->
            @foreach($posts as $post)
            <div class="post">
              <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{ $post->user->profile_image ?? asset('admin-assets/dist/img/user1-128x128.jpg') }}" alt="user image">
                <span class="username">
                  <a href="#">{{ $post->user->name ?? 'Unknown User' }}</a>
                  @if($post->user_id === Auth::id())
                  <a href="#" class="float-right btn-tool" onclick="event.preventDefault(); document.getElementById('delete-post-form-{{ $post->id }}').submit();">
                    <i class="fas fa-times"></i>
                  </a>
                  <form id="delete-post-form-{{ $post->id }}" action="{{ route('posts.delete', $post->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                  </form>
                  @endif
                </span>
                <span class="description">Posted {{ $post->created_at->diffForHumans() }}</span>
              </div>
              <!-- /.user-block -->
              <p>{{ $post->description }}</p>
              @if($post->image)
              <div class="row mb-3">
                <div class="col-sm-12">
                  <img class="img-fluid w-25" src="{{ asset($post->image) }}" alt="Photo" >
                </div>
              </div>
              @endif
              <!-- /.row -->
              <p>
                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                <span class="float-right">
                  <a href="#" class="link-black text-sm toggle-comments" data-post-id="{{$post->id}}">
                    <i class="far fa-comments mr-1"></i> Comments ({{ $post->comments->count() }})
                  </a>
                </span>
              </p>
              <div class="comments-section" id="comments-section-{{$post->id}}" style="display: none;">
                <div class="mt-3">
                  <h6>Comments</h6>
                  @foreach ($post->comments as $comment)
                  <div class="card mb-2">
                    <div class="card-body">
                      <p class="card-text"><strong>{{ $comment->user->name }}: </strong>{{ $comment->content }}</p>
                    </div>
                  </div>
                  @endforeach
                  @auth
                  <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <input class="form-control form-control-sm" type="text" name="content" placeholder="Type a comment">
                      <input type="hidden" name="post_id" value="{{ $post->id }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Add Comment</button>
                  </form>
                  @endauth
                </div>
              </div>
            </div>
            <!-- /.post -->
            @endforeach
          </div>
          <div class="tab-pane" id="createpost">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create Post</h3>
              </div>
              <form>
                <div class="card-body">
                  <div class="form-group">
                      <label for="description">What's in your mind?</label>
                      <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                  </div>
                  <div class="form-group">
                      <label for="image">Image:</label>
                      <div class="input-group">
                          <div class="custom-file">
                              <!-- Add name and type attributes here -->
                              <input type="file" class="custom-file-input" id="image" name="image">
                              <label class="custom-file-label" for="image">Choose file</label>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
            </div>
          </div>
        </div>
        <!-- /.tab-content -->
        
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
@endsection

@section('scripts')
<script src="{{ asset('admin-assets/dist/js/comments.js') }}">
$.widget.bridge('uibutton', $.ui.button)
</script>
@endsection