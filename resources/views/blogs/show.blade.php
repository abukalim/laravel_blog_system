<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Adjust path as needed -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">My Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs.index') }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card mb-4">
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="card-img-top img-fluid">
            @else
                <img src="{{ asset('assets/default-image.jpg') }}" alt="Default Image" class="card-img-top img-fluid">
            @endif
            
            <div class="card-body">
                <h1 class="card-title">{{ $blog->title }}</h1>
                <p class="card-text">{{ $blog->content }}</p>
                <p class="card-text"><small class="text-muted">By {{ $blog->author ? $blog->author->name : 'Unknown Author' }} on {{ $blog->created_at->format('d M Y') }}</small></p>
                <hr>

                <h3>Comments</h3>
                <div id="comments">
                    @forelse ($comments as $comment)
                        <div class="border p-2 mb-2">
                            <strong>{{ $comment->user ? $comment->user->name : 'Anonymous' }}</strong>
                            <p>{{ $comment->content }}</p>
                            <small class="text-muted">{{ $comment->created_at->format('d M Y H:i') }}</small>
                        </div>
                    @empty
                        <p>No comments yet. Be the first to comment!</p>
                    @endforelse
                </div>

                <!-- Comment Form -->
                @auth
                    <form action="{{ route('comments.store', $blog) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="comment">Leave a comment:</label>
                            <textarea id="comment" name="content" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
                    </form>
                @else
                    <p class="text-muted">You need to be logged in to leave a comment. <a href="{{ route('login') }}">Login</a></p>
                @endauth
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3">
            © {{ date('Y') }} My Blog - All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
