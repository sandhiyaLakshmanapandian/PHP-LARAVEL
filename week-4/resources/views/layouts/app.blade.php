<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marks Entry</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        header {
            background: #ffcc00ff;
            color: white;
            text-align: center;
            padding: 1rem;
        }
        main {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            color: white;
            background: #ff5e00ff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn:hover {
            background: #0056b3;
        }
        .alert {
            background: #d1e7dd;
            color: #0f5132;
            border-left: 5px solid #0f5132;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ccc;
            text-align: center;
            padding: 8px;
        }
        th {
            background: #007bff;
            color: white;
        }
        form label {
            font-weight: bold;
        }
        form input {
            width: 100%;
            padding: 7px;
            margin: 5px 0 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h2>Student Marks Entry System</h2>
    </header>
    <main>
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @yield('content')
    </main>
</body>
</html>
