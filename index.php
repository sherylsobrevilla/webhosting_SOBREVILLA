
<html>
	<head>
		<meta charset="utf-8">
		<title>Login Page</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">

	</head>
    
	<body>
    
		<div class="login">
        


			<h1>Login</h1>
			<form action="index.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
</p>
	</body>
</html>

<?php
session_start();
include("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

   
        $sql = "SELECT * FROM tbl_users WHERE username = ?";
        $sec = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($sec, "s", $username);
        mysqli_stmt_execute($sec);
        $result = mysqli_stmt_get_result($sec);
        
        if(mysqli_num_rows($result)== 1){
            $row = mysqli_fetch_assoc($result);
            IF($username === $row['username'] && password_verify($password,$row['password'])){
                $_SESSION['user'] = $row['username'];
                $_SESSION['user_id'] = $row['id'];
                header('Location: homepage.php');

            }
            else{
                header('Location: index.php?error= Invalid Account');
            }
            
        }

}

?>