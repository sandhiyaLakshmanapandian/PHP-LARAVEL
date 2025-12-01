<?php
declare(strict_types=1);

require 'db.php';
require 'Calculator.php';

$id    = (int) ($_POST['id'] ?? 0);
$name  = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$marks = [
    (int) ($_POST['subject1'] ?? 0),
    (int) ($_POST['subject2'] ?? 0),
    (int) ($_POST['subject3'] ?? 0),
    (int) ($_POST['subject4'] ?? 0),
    (int) ($_POST['subject5'] ?? 0),
];

if ($id <= 0 || empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
            alert('Please provide valid ID, name, and email.');
            window.history.back();
          </script>";
    exit;
}

$stmt = $pdo->prepare('SELECT COUNT(*) FROM students WHERE id = ?');
$stmt->execute([$id]);

if ($stmt->fetchColumn() > 0) {
    echo "<script>
            alert('Duplicate ID! Please use a different ID.');
            window.history.back();
          </script>";
    exit;
}

$calculator = new Calculator($marks);
$calculator->calculate();

$total      = $calculator->getTotal();
$percentage = $calculator->getPercentage();

$stmt = $pdo->prepare(
    'INSERT INTO students 
     (id, name, email, subject1, subject2, subject3, subject4, subject5, total_marks, percentage)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
);

try {
    $stmt->execute([
        $id,
        $name,
        $email,
        $marks[0],
        $marks[1],
        $marks[2],
        $marks[3],
        $marks[4],
        $total,
        $percentage,
    ]);

    echo "<script>
            alert('Student record inserted successfully!');
            window.location.href='index.php';
          </script>";
} catch (PDOException $e) {
    $error = addslashes($e->getMessage());
    echo "<script>
            alert('Error inserting record: $error');
            window.history.back();
          </script>";
}
?>
