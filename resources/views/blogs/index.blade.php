<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Blog Index</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .footer {
            background-color: #f8f9fa; /* Footer background color */
            padding: 20px 0; /* Padding for the footer */
        }
    </style>
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
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Blog Posts</h1>

        <!-- Create Blog Button -->
        @if(Auth::check())
            <div class="mb-4 text-center">
                <a href="{{ route('blogs.create') }}" class="btn btn-success">Create New Blog</a>
            </div>
        @endif

        <div class="row">
            @if($blogs->isNotEmpty())
                @foreach ($blogs as $blog)
                    <div class="col-lg-4 col-md-6 mb-4"> <!-- Responsive column sizing -->
                        <div class="card">
                            <a href="{{ route('blog.show', $blog->id) }}">
                                <img class="card-img-top" src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/default-image.jpg') }}" alt="{{ $blog->title }}" />
                            </a>
                            <div class="card-body">
                                <h2 class="card-title h5">{{ $blog->title }}</h2>
                                <p class="card-text">{{ Str::limit($blog->content, 150) }}</p>
                                
                                <!-- Edit and Delete buttons -->
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-warning" href="{{ route('blogs.edit', $blog->id) }}">Edit</a>
                                    
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>

                                <a class="btn btn-primary mt-3" href="{{ route('blog.show', $blog->id) }}">Read more →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p>No posts available.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center text-lg-start mt-5">
        <div class="text-center p-3">
            © {{ date('Y') }} My Blog - All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
