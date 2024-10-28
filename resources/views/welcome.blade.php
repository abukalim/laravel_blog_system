<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="A modern blog platform" />
    <meta name="author" content="Your Name" />
    <title>Blog Home - Your Blog Name</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa; /* Light background for better contrast */
        }

        .blog-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none; /* Remove default border */
            border-radius: 10px; /* Rounded corners */
            overflow: hidden; /* Ensure children don't overflow */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .blog-card:hover {
            transform: translateY(-5px); /* Lift effect on hover */
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Deeper shadow on hover */
        }

        .blog-image {
            height: 200px; /* Fixed height for consistency */
            object-fit: cover; /* Ensures image covers the area without distortion */
            border-top-left-radius: 10px; /* Rounded corners for the top */
            border-top-right-radius: 10px; /* Rounded corners for the top */
        }

        .card-body {
            background: linear-gradient(135deg, #ffffff, #f8f9fa); /* Subtle gradient */
            padding: 20px;
            position: relative;
            z-index: 1; /* Ensure content is above any shadows */
        }

        .card-title {
            font-weight: bold;
            color: #343a40; /* Dark text for better readability */
        }

        .card-text {
            color: #6c757d; /* Lighter text color for descriptions */
        }

        footer {
            background-color: #343a40; /* Dark footer */
            padding: 20px 0;
        }

        footer p {
            margin: 0; /* Remove default margin */
            color: white; /* Text color for footer */
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .blog-image {
                height: 150px; /* Smaller image height on mobile */
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Blog Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('blogs.index') }}">Blog</a></li>
                    @if(Auth::check())
                        <div class="nav-item d-flex gap-2">
                            <a class="btn btn-primary rounded" href="{{ route('dashboard') }}">Dashboard</a>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger rounded">Logout</button>
                            </form>
                        </div>
                    @else
                        <div class="nav-item d-flex gap-2">
                            <a class="btn btn-primary rounded" href="{{ route('login') }}">Login</a>
                            <a class="btn btn-success rounded" href="{{ route('register') }}">Sign Up</a>
                        </div>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="py-5 bg-light border-bottom mb-4" style="margin-top: 56px;">
        <div class="container text-center">
            <h1 class="fw-bolder">Welcome to Blog Home!</h1>
            <p class="lead mb-0">A modern blog platform for your next adventure</p>
        </div>
    </header>

    <main class="container">
        <div class="row">
            @if($posts->isNotEmpty())
                @foreach ($posts as $blog)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card blog-card h-100">
                            <a href="{{ route('blog.show', $blog->id) }}">
                                <img class="card-img-top blog-image" src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('assets/default-image.jpg') }}" alt="{{ $blog->title }}" />
                            </a>
                            <div class="card-body d-flex flex-column">
                                <div class="small text-muted">{{ $blog->created_at->format('F j, Y') }}</div>
                                <h2 class="card-title h5">{{ $blog->title }}</h2>
                                <p class="card-text flex-grow-1">{{ Str::limit($blog->content, 150) }}</p>
                                <a class="btn btn-primary mt-auto rounded" href="{{ route('blog.show', $blog->id) }}">Read more →</a>
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
    </main>
    

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Your Blog Name. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
