<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Marks Entry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fffffb;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            background-color: #e59618;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 420px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px 0;
            background-color: #aed415;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        input[type="submit"]:hover {
            background-color: #ed4c1b;
            transform: scale(1.02);
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #4CAF50;
        }

        @media (max-width: 480px) {
            form {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>
    <form action="validate.php" method="post">
        <h2>Enter Student Marks</h2>

        <label for="id">ID</label>
        <input type="number" name="id" id="id" min="1" required>

        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="subject1">Subject 1</label>
        <input type="number" name="subject1" id="subject1" min="0" max="100" required>

        <label for="subject2">Subject 2</label>
        <input type="number" name="subject2" id="subject2" min="0" max="100" required>

        <label for="subject3">Subject 3</label>
        <input type="number" name="subject3" id="subject3" min="0" max="100" required>

        <label for="subject4">Subject 4</label>
        <input type="number" name="subject4" id="subject4" min="0" max="100" required>

        <label for="subject5">Subject 5</label>
        <input type="number" name="subject5" id="subject5" min="0" max="100" required>

        <input type="submit" value="Submit">
        <a href="view.php">View All Students</a>
    </form>
</body>
</html>
