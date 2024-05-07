<?php

// echo "delete page";
include('../includes/config.php');
//check whether the id and iamge_nme value is set or not

if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //get the value and delete 
    // echo "get the vale";

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //emove the physical image file available

    if ($image_name != "") {

        $path = "../images/category/" . $image_name;

        $remove = unlink($path);
        //if failed to remove image the add an error message 

        if ($remove == false) {
            //set the seesion
            $_SESSION['remove'] = "<div class='error'>Failed To Remove Image</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            exit();
        }
    }
    $sql = "DELETE FROM table_category WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Category Deletion Failed</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
} else {
    header('location:' . SITEURL . 'admin/manage-category.php');
}
