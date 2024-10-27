<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Part 1: My Blog -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">My Blog</a>

            <!-- Part 2: Navigation Menu -->
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blogs.index')}}"> blog </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> about </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> contact </a>
                    </li>
                </ul>
            </div>

            <!-- Part 3: Logout Button and Create Blog Button -->
            <div class="d-flex">                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger mr-2">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Welcome to Your Dashboard
            <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm ml-3">Create Blog</a> <!-- Create Blog Button -->
        </h1>
        <p>You are logged in!</p>
    </div>
    
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
