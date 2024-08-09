<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
</head>

<body>

    <form action="register.php" method="POST" autocomplete="on">
        <h1>Register</h2>

        <div class="form-group">
            <input type="text" name="username" required placeholder="Username">
        </div>

         <div class="form-group">
             <input type="password" name="password" required placeholder="Password">
        </div>

        <div class="form-group">
            <input type="password" name="confirm_password" required placeholder="Confirm_Password">
        </div>

        <div class="form-group">
             <input type="email" name="email" required placeholder="Email">
        </div>

        <div class="form-group">
             <input type="tel" name="phone" required placeholder="Phone">
        </div>

            <input type="submit" value="Register">

        <div class="signin">
            Already have an account ?
            <br>
            <a href="login.php">Sign In</a>
        </div>

    </form>

</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
 

    $con = mysqli_connect("localhost", "root", "", "login2");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $query = "INSERT INTO details(username, password, email, phone) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $username, $password, $email, $phone);

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "User registered successfully!";
        header('Location:login.php');
    } else {
        echo "Error: " . mysqli_error($con);
    }


    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>


<style>

    * {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  min-height: 100vh;
  background:linear-gradient(to bottom right, #bddda7, #8dd25c);
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0;
}

form {
  background: #ffffff;
  width: 350px;
  height: auto;
  padding: 40px 30px;
  border-radius: 10px;
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  margin-bottom: 30px;
  color: #333333;
  font-size: 28px;
  font-weight: bold;
}

.form-group {
  position: relative;
  margin: 25px 0;
}

input[type="text"],
input[type="password"],
input[type="email"],
input[type="tel"] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #ffffff;
  font-size: 16px;
  color: #333333;
  transition: border-color 0.3s, box-shadow 0.3s;
}

input[type="text"]:focus,
input[type="password"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus {
  border-color: #6A82FB;
  box-shadow: 0px 0px 10px rgba(106, 130, 251, 0.2);
}

input[type="submit"] {
  width: 100%;
  height: 45px;
  border: none;
  outline: none;
  background: linear-gradient(to right, #437a1c, #6acc25);
  color: white;
  font-size: 16px;
  transition: 0.3s;
  border-radius: 5px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background: linear-gradient(to right, #48c145, #28d02b);
  
}

.signin {
  color: #333333;
  margin-top: 20px;
  text-align: center;
  font-size: 14px;
}

.signin a {
  color: #66B032;
  text-decoration: underline;
  font-weight: bold;
}
.signin a:hover{
  color: #75c575;
}
</style>