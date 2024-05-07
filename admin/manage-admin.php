<?php include('./partials/header.php') ?>
<!-- MAIN SECTION STARTS  -->

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ADMIN</h1>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['User-not-found'])) {
            echo $_SESSION['User-not-found'];
            unset($_SESSION['User-not-found']);
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if (isset($_SESSION['pwd-match'])) {
            echo $_SESSION['pwd-match'];
            unset($_SESSION['pwd-match']);
        }
        
        ?>
        <br>
        <br>
        <div>
            <a href="add-admin.php" class="btn-primary">ADD ADMIN</a>
        </div>
        <br>
        <table class="tble-full">
            <tr>
                <th>S.No.</th>
                <th>Full Name</th>
                <th>UserName</th>
                <th>Actions</th>
            </tr>

            <?php
            $sn = 1;
            //query to get all admin

            $sql = "SELECT * FROM table_admin";

            //execute the query 

            $res = mysqli_query($conn, $sql);

            //check whether the query is executed or not

            if ($res == TRUE) {
                //count rows to check whetherwe have data in database or not
                $data = mysqli_num_rows($res);

                //check the num
                if ($data > 0) {
                    //we have data in database
                    while ($data = mysqli_fetch_assoc($res)) {
                        //get indivisual data
                        $id = $data['id'];
                        $full_name = $data['full_name'];
                        $username = $data['username'];

                        //display the values of table

            ?>

                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $username ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $id; ?>" class="btn-primary">CHANGE PASSWORD</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>

                            </td>
                        </tr>
            <?php


                    }
                } else {
                }
            }
            ?>
        </table>
        <div class="clearfix"></div>
    </div>
</div>
<!-- MAIN SECTION ENDS -->

<?php include("./partials/footer.php") ?>