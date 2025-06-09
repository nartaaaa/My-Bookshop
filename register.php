<?php
include_once('config.php');

	if(isset($_POST['submit']))
	{

		$emri = $_POST['emri'];
		$username = $_POST['username'];
		$email = $_POST['email'];

		$tempPass = $_POST['password'];
		$password = password_hash($tempPass, PASSWORD_DEFAULT);



		$tempConfirm = $_POST['confirm_password'];
		$confirm_password = password_hash($tempConfirm, PASSWORD_DEFAULT);


		if(empty($emri) || empty($username) || empty($email) || empty($password) || empty($confirm_password))
		{
			echo "You have not filled in all the fields.";
		}
		else
		{

			$sql = "INSERT INTO users(emri,username,email,password, confirm_password) VALUES (:emri, :username, :email, :password, :confirm_password)";

			$insertSql = $conn->prepare($sql);
			

			$insertSql->bindParam(':emri', $emri);
			$insertSql->bindParam(':username', $username);
			$insertSql->bindParam(':email', $email);
			$insertSql->bindParam(':password', $password);
			$insertSql->bindParam(':confirm_password', $confirm_password);

			$insertSql->execute();

			header("Location: login.php");


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