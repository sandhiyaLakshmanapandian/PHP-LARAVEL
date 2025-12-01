<?php
date_default_timezone_set('Asia/Kolkata');

$errors = [];
$maxFileSize = 2 * 1024 * 1024; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['firstName']) || !preg_match('/^[A-Za-z\s]+$/', $_POST['firstName'])) {
        $errors[] = "First name is required ";
    } else {
        $firstname = htmlspecialchars(trim($_POST['firstName']));
    }
    if (empty($_POST['lastName']) || !preg_match('/^[A-Za-z\s]+$/', $_POST['lastName'])) {
        $errors[] = "Last name is required ";
    } else {
        $lastname = htmlspecialchars(trim($_POST['lastName']));
    }
    if (empty($_POST['mobile']) || !preg_match('/^[0-9]{10}$/', $_POST['mobile'])) {
        $errors[] = "Mobile number must be 10 digits.";
    } else {
        $mobile = htmlspecialchars(trim($_POST['mobile']));
    }
    if (empty($_POST['dob'])) {
        $errors[] = "Date of Birth is required.";
    } else {
        $dob = htmlspecialchars(trim($_POST['dob']));
    }
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    } else {
        $email = htmlspecialchars(trim($_POST['email']));
    }
    if (empty($_POST['address'])) {
        $errors[] = "Address is required.";
    } else {
        $address = htmlspecialchars(trim($_POST['address']));
    }
    if (!isset($_FILES['profileImage']) || $_FILES['profileImage']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Profile image upload error.";
    } else {
        $file = $_FILES['profileImage'];
        if ($file['size'] > $maxFileSize) {
            $errors[] = "File size exceeds 2MB limit.";
        }
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            $errors[] = "Only JPG, PNG, or GIF images are allowed.";
        }
    }
    if (empty($errors)) {
        $uploadDir = __DIR__ . '/uploads';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = uniqid('img_') . '.' . $ext;
        $targetPath = $uploadDir . '/' . $newName;
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $success = true;
        } else {
            $errors[] = "Failed to save uploaded image.";
            $success = false;
        }
    }
} else {
    $errors[] = "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Form Submission Result</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background:orange;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }
  .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: white;
    width: 100%;
    max-width: 800px;
    border-radius: 12px;
    box-shadow: 0px 4px 20px rgba(187, 212, 24, 0.1);
    padding: 30px;
    text-align: center;
    margin:40px auto;
   
  }
  h2 {
    margin-bottom: 20px;
    color: black;
  }
  table {
    width: 80%;
    border-collapse: collapse;
    margin-top: 20px;
    
  }
  th {
    background-color: #9ed42aff;
    text-align: left;
    padding: 12px;
    font-size: 16px;
  }
  td {
    background-color: #fafafa;
    padding: 12px;
    border-top: 1px solid #978686ff;
    font-size: 15px;
    vertical-align: middle;
  }
  img.profile {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
  }
  .button {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #0078d7;
    color: white;
    border-radius: 5px;
    text-decoration: none;
    transition: 0.3s;
  }
  .button:hover {
    background-color: #005a9e;
  }
  .error-list {
    color: #c0392b;
    text-align: left;
  }
</style>
</head>
<body>
  <div class="container">
    <?php if (!empty($success) && $success === true): ?>
      <h2>Form Submitted Successfully </h2>
      <table>
        <tr>
          <th>Name</th>
          <th>DOB</th>
          <th>Address</th>
          <th>Email</th>
          <th>Mobile</th>
        </tr>
        <tr>
          <td>
            <img src="uploads/<?= htmlspecialchars($newName) ?>" class="profile" alt="Profile Image">
            <?= $firstname . ' ' . $lastname ?>
          </td>
          <td><?= $dob ?></td>
          <td><?= $address ?></td>
          <td><?= $email ?></td>
          <td><?= $mobile ?></td>
        </tr>
      </table>
      <a href="book.html" class="button">Submit Another</a>
    <?php else: ?>
      <h2>Submission Failed </h2>
      <ul class="error-list">
        <?php foreach ($errors as $error): ?>
          <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
      </ul>
      <a href="book.html" class="button">Go Back</a>
    <?php endif; ?>
  </div>
</body>
</html>
