<?php 
ob_start();
include('./partials/header.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE FOOD</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql2 = "SELECT * FROM table_food WHERE id=$id";
            $res2 = mysqli_query($conn, $sql2);
            $count = mysqli_num_rows($res2);

            if ($count == 1) {
                $row2 = mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            } else {
                $_SESSION['no-food-found'] = "<div class='error'>Category Not Found</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                exit();
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-food.php');
            exit();
        }

        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="3"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="Price of Food" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image ?>" width="150px" height="150px">
                        <?php
                        } else {
                            echo "<div class='error'>Image Not Found</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM table_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id']; ?>
                                    <option <?php if ($current_category == $category_id) echo "selected"; ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" <?php if ($featured == "Yes") echo "checked"; ?> name="featured" value="Yes">Yes
                        <input type="radio" <?php if ($featured == "No") echo "checked"; ?> name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" <?php if ($active == "Yes") echo "checked"; ?> name="active" value="Yes">Yes
                        <input type="radio" <?php if ($active == "No") echo "checked"; ?> name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                        <input type="submit" name="submit" value="Update Food">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
            $active = isset($_POST['active']) ? $_POST['active'] : "No";

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    $explode_result = explode('.', $image_name);
                    $ext = end($explode_result);
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;

                    $src_path = $_FILES['image']['tmp_name'];
                    $dst_path = "../images/food/" . $image_name;
                    $upload = move_uploaded_file($src_path, $dst_path);

                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        header('location:' . SITEURL . 'admin/update-food.php?id=' . $id);
                        exit();
                    }
                    if ($current_image != "") {
                        $remove_path = "../images/food/" . $current_image;
                        if (file_exists($remove_path)) {
                            $remove = unlink($remove_path);
                            if ($remove == false) {
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location:' . SITEURL . 'admin/manage-food.php');
                                exit();
                            }
                        } else {
                            $_SESSION['failed-remove'] = "<div class='error'>Image not found.</div>";
                            header('location:' . SITEURL . 'admin/manage-food.php');
                            exit();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            $sql3 = "UPDATE table_food SET
                title='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id='$category',
                featured='$featured',
                active='$active'
                WHERE id=$id
                ";

            $res3 = mysqli_query($conn, $sql3);

            if ($res3 == true) {
                $_SESSION['update'] = "<div class='success'>Food Updated</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
                exit();
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to Update Food</div>";
                header('location:' . SITEURL . 'admin/update-food.php');
                exit();
            }
        }
        ?>

    </div>
</div>

<?php include('./partials/footer.php'); ?>
<?php ob_end_flush(); ?>
