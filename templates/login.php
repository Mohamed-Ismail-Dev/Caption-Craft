<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>

    <form method="post" action="login.php" autocomplete="on">
        <h1>Login</h1>
    
        <div class="textbox">
            <input type="text" placeholder="Username" name="username" required>
        </div>
    
        <div class="textbox">
            <input type="password" placeholder="Password" name="password" required>
        </div>
    
        <input type="submit" value="Login" class="btn" name="loginbtn" required>
    
        <div class="signup">
            Don't have an account ?
            <br>
            <a href="register.php">Sign Up</a>
        </div>
    </form>
    
    <?php
    
    if (isset($_POST['loginbtn'])) {
        $conn = mysqli_connect("localhost", "root", "", "login2");
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Use a prepared statement to prevent SQL injection
        // Using parameterized queries is a security measure that helps prevent SQL injection.
        $sql = "SELECT * FROM details WHERE username = ?";
        
        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);
        
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "s", $username);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $resultPassword = $row['password'];
                if ($password == $resultPassword) {
                    header('Location:Home/Home.html');
                    exit();
                } else {
                    echo "<script>alert('Login Unsuccessful');</script>";
                }
            } else {
                echo "<script>alert('Username not found');</script>";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        
        // Close the prepared statement
        mysqli_stmt_close($stmt);
        
        // Close the database connection
        mysqli_close($conn);
    }
    
    ?>
</body>

</html>


<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    min-height: 100vh;
    background: linear-gradient(to bottom right, #bddda7, #8dd25c);
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
    animation: backwards;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #1B3409;
    font-size: 28px;
    font-weight: bold;
}

.textbox {
    position: relative;
    margin: 25px 0;
}

.textbox input {
    background: #f5f5f5;
    border: none;
    outline: none;
    width: 100%;
    color: #333333;
    height: 40px;
    border-radius: 5px;
    padding: 10px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
}

.btn {
    width: 100%;
    height: 45px;
    border: none;
    outline: none;
    background: linear-gradient(to right, #437a1c, #6acc25);
    color: #ffffff;
    font-size: 16px;
    transition: 0.3s;
    border-radius: 5px;
    cursor: pointer;
}

.btn:hover {
    background: linear-gradient(to right, #48c145, #28d02b);
}

.signup {
    color: #1B3409;
    margin-top: 20px;
    text-align: center;
    font-size: 14px;
}

.signup a {
    color: #66B032;
    text-decoration: underline;
    font-weight: bold;
}

.signup a:hover {
    color: #75c575;
}

</style>