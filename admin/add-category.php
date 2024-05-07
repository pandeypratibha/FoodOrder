<?php include('./partials/header.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD CATEGORY</h1>
        <br><br>


        <?php
         if (isset($_SESSION['add'])) {
            echo  $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo  $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        ?>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Tiitle:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of Category">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category">
                    </td>
                </tr>
            </table>
        </form>


        <?php
        if (isset($_POST['submit'])) {
            //ad category

            //get the data from form
            $title = $_POST['title'];

            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No";
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }
            //upload the image if selected
            //insert into database


            if (isset($_FILES['image']['name'])) {

                $image_name = $_FILES['image']['name'];
                 //image is selected
                    //a. rename the image

                    //get the extension of selected image 

                    $ext = end(explode('.', $image_name));

                    //create new name for image

                    $image_name = "Food-Category" . rand(0000, 9999) . "." . $ext;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/" . $image_name;
                $upload = move_uploaded_file($source_path, $destination_path);

                //check wheter image uploaded or not

                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                    header('location:' . SITEURL . 'admin/add-category
                    .php');
                    die(); // Add exit to stop execution after redirection
                }
            }

            else {
                $image_name = "";
            }
            $sql = "INSERT INTO table_category SET 
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                $_SESSION['add'] = "<div class='success'>CATEGORY ADDED</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Food Not Added</div>";
                header('location:' . SITEURL . 'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>


<?php include('./partials/footer.php') ?>