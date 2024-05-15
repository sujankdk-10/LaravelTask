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
    <div class="card">
        <div class="card-body">
            <!-- Post 1 -->
            <div class="media mb-4">
                <img src="https://via.placeholder.com/64" class="mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0">Post Title 1</h5>
                    Post content goes here...
                    <!-- Comment section -->
                    <div class="mt-3">
                        <form>
                            <div class="form-group">
                                <textarea class="form-control" rows="2" placeholder="Write a comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Post 2 -->
            <div class="media mb-4">
                <img src="https://via.placeholder.com/64" class="mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0">Post Title 2</h5>
                    Post content goes here...
                    <!-- Comment section -->
                    <div class="mt-3">
                        <form>
                            <div class="form-group">
                                <textarea class="form-control" rows="2" placeholder="Write a comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add more posts as needed -->
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
