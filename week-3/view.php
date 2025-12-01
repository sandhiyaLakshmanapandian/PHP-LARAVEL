<?php
declare(strict_types=1);

require 'db.php';

$stmt = $pdo->prepare('SELECT * FROM students ORDER BY id ASC');
$stmt->execute();

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eab0b0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            max-width: 1000px;
            background-color: #d0cdc9;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #aed415;
            color: white;
            font-weight: bold;
        }

        tr {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #1d1b1b;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #aed415;
            transition: 0.3s;
        }

        a:hover {
            background-color: #ed4c1b;
            color: white;
        }
    </style>
</head>
<body>

<h2>All Students</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Sub1</th>
        <th>Sub2</th>
        <th>Sub3</th>
        <th>Sub4</th>
        <th>Sub5</th>
        <th>Total</th>
        <th>Percentage</th>
    </tr>

    <?php foreach ($students as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['subject1'] ?></td>
            <td><?= $row['subject2'] ?></td>
            <td><?= $row['subject3'] ?></td>
            <td><?= $row['subject4'] ?></td>
            <td><?= $row['subject5'] ?></td>
            <td><?= $row['total_marks'] ?></td>
            <td><?= number_format((float) $row['percentage'], 2) ?>%</td>
        </tr>
    <?php endforeach; ?>

</table>

<br>
<a href="index.php">Add New Student</a>

</body>
</html>
