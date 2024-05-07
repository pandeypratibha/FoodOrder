<?php

// echo "delete page";
include('../includes/config.php');
//check whether the id and iamge_nme value is set or not

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    //get the value and delete 
    // echo "get the vale";

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image file available

    if ($image_name != "") {

        $path = "../images/food/" . $image_name;

        $remove = unlink($path);
        //if failed to remove image the add an error message 

        if ($remove == false) {
            //set the seesion
            $_SESSION['upload'] = "<div class='error'>Failed To Remove Image</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            exit();
        }
    }
    $sql = "DELETE FROM table_food WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Category Deletion Failed</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    $_SESSION['unauthorized']="<div class='error'>Unauthorized Access.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
