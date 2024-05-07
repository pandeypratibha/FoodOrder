<?php
include('../includes/config.php');

?>
<html>

<head>
    <title>Login- FOOD ORDER</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <div class="login">
        <h1 class="text-center">
            LOGIN
        </h1><br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login'])) {
            echo  $_SESSION['no-login'];
            unset($_SESSION['no-login']);
        }
        ?>
        <br><br>
        <form action="" method="POST">

            <fieldset>
                <label>Username:</label>
                <input type="text" name="username" placeholder="Enter Username">
                <label>Password:</label>
                <input type="password" name="password" placeholder="Enter Password">
                <input type="submit" value="Login" name="submit" class="btn-primary">

            </fieldset>
        </form>


    </div>



    </div>
</body>

</html>


<?php
if (isset($_POST['submit'])) {
    // $username = $_POST['username'];

    $username =mysqli_real_escape_string($conn,$_POST['username']);
    // $password = md5($_POST['password']);
    $raw_password = md5($_POST['password']);
$password=mysqli_real_escape_string($conn,$raw_password);
    $sql = "SELECT * FROM table_admin WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='success'>LOGIN SUCCESSFULL.</div>";
        $_SESSION['user'] = $username;

        header('location:' . SITEURL . 'admin/');
    } else {
        $_SESSION['login'] = "<div class='error text-center'> INVALID LOGIN CRIDENTIALS</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>