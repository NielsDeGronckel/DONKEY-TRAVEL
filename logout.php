<?php
session_start();
session_unset();
session_destroy();
header("Location: loginForm.php?message=You have been logged out.");
exit();

?>