<?php
function login_protection(){
if($_GET['admin'] != 'qsadmin')header('Location: https://qxx.hk');
}
add_action('login_enqueue_scripts','login_protection');
?>