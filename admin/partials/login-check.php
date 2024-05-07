<?php

if(!isset($_SESSION['user']))
{
    $_SESSION['no-login']="<div class='error'>Please Login To Acess Admin Panel</div>";
    header('location:'.SITEURL.'admin/login.php');
}

?>