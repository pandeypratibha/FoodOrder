<?php include('./partials/header.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD FOOD</h1>
        <br><br>


        <?php

        if (isset($_SESSION['upload'])) {
            echo  $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Tiitle:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of Food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Add Description of The Food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="Price of Food">
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                            //Create php code to display categories from database
                            //Create SQL to get all active categories
                            $sql = "SELECT * FROM table_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);
                            //count rows 
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                //we have category
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $title = $row['title'];?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            //display on Dropdown
                            ?>

                        </select>
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
                        <input type="submit" name="submit" value="Add Food">
                    </td>
                </tr>
            </table>
        </form>

        <?php

        if (isset($_POST['submit'])) {
            //ad food into database

            //get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

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

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {

                    //image is selected
                    //a. rename the image

                    //get the extension of selected image 

                    $explode_result = explode('.', $image_name);
                    $ext = end($explode_result);

                    //create new name for image

                    $image_name = "Food-Name" . rand(0000, 9999) . "." . $ext;

                    //upload the image
                    //get the src path and destination path

                    //source path is the current location of the image
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/food/" . $image_name;
                    $upload = move_uploaded_file($src, $dst);
                    //check wheter image uploaded or not

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        exit(); // Add exit to stop execution after redirection
                    }
                }
            } else {
                $image_name = "";
            }
            //insert into database

            $sql2 = "INSERT INTO table_food SET 
             title='$title',
            description='$description',
             price='$price',
             image_name='$image_name',
    category_id=$category,
    featured='$featured',
    active='$active'
    
            ";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                $_SESSION['add'] = "<div class='success'>FOOD ADDED</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Food Not Added</div>";
                header('location:' . SITEURL . 'admin/add-food.php');
            }
            //redirect with message
        }
        ?>
    </div>
</div>

<?php include('./partials/footer.php')?>