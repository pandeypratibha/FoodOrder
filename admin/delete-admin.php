<?php
 include('../includes/config.php');
//get the id of admin to be deleted

$_id= $_GET['id'];

//create sql query to delete admin

$sql= "DELETE FROM table_admin WHERE id=$_id";

//execute the query

$res=mysqli_query($conn,$sql);

//check whether the query wxwcuted successfully or not

if($res==true){
//successfully deleted

// echo " ADMIN DELETED SUCCESSFULLY";

$_SESSION['delete']="<div class='success'>ADMIN DELETED SUCCESSFULLY</div>";

header('location:'.SITEURL.'admin/manage-admin.php');
}
else{
   //failed to delete admin
//    echo " admin don not deleted";

$_SESSION['delete']="<div class='error'>FAILED TO DELETE THE ADMIN. Try Again Later.</div>";

header('location:'.SITEURL.'admin/manage-admin.php');

}
?>