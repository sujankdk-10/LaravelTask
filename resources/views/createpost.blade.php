<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin-assets/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/dist/css/adminlte.css')}}">
    
</head>
<body>
<form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
@csrf
<div class="container mt-5">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Post</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="description">What's in your mind?</label>
                <textarea class="form-control" id="description" name="description" rows="6"></textarea>
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
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>      
    </div>
</div>
</form>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass('selected').html(fileName);
        });
    });
</script>

</body>
</html>
