<?php include('./partials/header.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ADMIN</h1>
        <br><br>

        <?php
        // get the id of selected admin
        $id = $_GET['id'];
        //create sql query to get the details
        $sql = "SELECT * FROM table_admin WHERE id=$id";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //check whether the query is executed or not
        if ($res == true) {
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not

            if ($count == 1) {
                //get the details
                // echo"admin available";

                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            }
        } else {
            //redirect to manage admin page

            header('location:' . SITEURL . 'admin/manage-admin.php');
        }

        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>FULL NAME:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>USERNAME:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" class="btn-secondary" name="submit" value="Update Admin">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
//check whether the subit button is clicked or not

if (isset($_POST['submit'])) {
    //get all values from form to update

    echo $id = $_POST['id'];
    echo $full_name = $_POST['full_name'];
    echo $username = $_POST['username'];

    //create a sql query to update admin
    $sql = "UPDATE table_admin SET
    full_name='$full_name',
    username='$username'
    WHERE id = '$id'
";

    //execute the query 
    $res = mysqli_query($conn, $sql);


    //check whether the query executed successfully or not
    if ($res == true) {

        //query executed and admin updated successfully
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
        //redirect to manage admin page
        header('location:' . SITEURL . 'admin/manage-admin.php');
    } else {
        //Failed to update admin
        $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
        //redirect to manage admin page
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
}
?>
<?php include('./partials/footer.php') ?>