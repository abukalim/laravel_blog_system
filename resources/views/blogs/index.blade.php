<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Blog Index</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #343a40;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff !important;
        }
        .navbar-custom .nav-link:hover {
            color: #ffc107 !important;
        }
        .card-hover {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px 0;
        }
        .footer a {
            color: #ffc107;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .hero-section {
            background: url('{{ asset('assets/hero-bg.jpg') }}') no-repeat center center/cover;
            color: #ffffff;
            padding: 100px 0;
            text-align: center;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .card-title {
            font-weight: bold;
        }
        .blog-description {
            min-height: 70px; /* Ensures consistent height for blog descriptions */
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
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
            <div class="d-flex">
                @if(Auth::check())
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light me-2">Logout</button>
                    </form>
                    <a href="{{ route('blogs.create') }}" class="btn btn-success">Create New Blog</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-success">Sign Up</a>
                @endif
            </div>
        </div>
    </div>
</nav>

<!-- Blog Posts -->
<div class="container mt-5 pt-5" id="blogs">
    <h1 class="mb-4 text-center">Blog Posts</h1>
    <div class="row">
        @if($blogs->isNotEmpty())
            @foreach ($blogs as $blog)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card card-hover shadow-sm h-100">
                        <a href="{{ route('blog.show', $blog->id) }}">
                            <img class="card-img-top" src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/default-image.jpg') }}" alt="{{ $blog->title }}">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h2 class="card-title h5">{{ $blog->title }}</h2>
                            <p class="card-text blog-description">{{ Str::limit($blog->content, 150) }}</p>
                            <p class="card-text text-muted">
                                <small>
                                    By {{ $blog->author ? $blog->author->name : 'Unknown' }} on {{ $blog->created_at->format('F j, Y') }}
                                </small>
                            </p>
                            @if(Auth::check())
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-warning" href="{{ route('blogs.edit', $blog->id) }}">Edit</a>
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            @endif
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
    <div class="container text-center p-3">
        <p class="mb-0">© {{ date('Y') }} My Blog - All rights reserved.</p>
        <a href="#">Privacy Policy</a> | <a href="#">Terms & Conditions</a>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
