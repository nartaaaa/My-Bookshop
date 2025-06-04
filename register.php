<?php
include('../db/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        $error = "Registration failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
<h2>Register</h2>
<form method="POST">
  <input name="username" placeholder="Username" required /><br>
  <input type="email" name="email" placeholder="Email" required /><br>
  <input type="password" name="password" placeholder="Password" required /><br>
  <button type="submit">Register</button>
</form>
<?php if (!empty($error)) echo "<p>$error</p>"; ?>
</body>
</html>