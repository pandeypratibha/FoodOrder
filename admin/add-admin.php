<?php include('./partials/header.php') ?>

<div class="main-content">
    <div class="wrapper">
        

        <form action="" method="POST">
            <fieldset>
                <legend><h1>ADD ADMIN</h1></legend>
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="full_name" placeholder="Enter Your Name" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" placeholder="Your Username" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td>
                            <input type="password" name="password" placeholder="Your Password" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
</div>


<?php include("./partials/footer.php") ?>

<?php

// PROCESS THE VALUE FROM FORM AND SAVE IT TO THE DATABASE

//checked if submit button is clicked or not

if (isset($_POST['submit'])) {
    //button clicked
    //get the value

    $full_name = $_POST['full_name'];
    $password = md5($_POST['password']);  //password encryption query
    $username = $_POST['username'];

    //sql query to save the data into database

    $sql = "INSERT INTO table_admin SET 
full_name='$full_name',
username='$username',
password='$password'
";


    //execute query and save data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));


    //   check whether the data is inserted or not
    if ($res == TRUE) {
        // echo "inserted";

        $_SESSION['add'] = "<div class='success'>ADMIN ADDED SUCCESSFULLY</div>";
        //REDIRECT PAGE

        header("location:" . SITEURL . "admin/manage-admin.php");
    } else {
        // echo "not inserted";
        $_SESSION['add']="<div class='error'>FAILED TO ADD ADMIN</div>";
        //REDIRECT PAGE
    
    header("location:".SITEURL."admin/add-admin.php");
    
    }
}

?>