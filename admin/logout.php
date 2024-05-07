<?php

include('../includes/config.php');
session_destroy();

header('location:'.SITEURL.'admin/login.php');
?>