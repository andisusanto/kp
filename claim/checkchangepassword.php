<?php
    if(isset($_SESSION['changepassword']) && $_SESSION['changepassword']==TRUE){
        header('location:changepasswordonlogin.php');        
    }
?>