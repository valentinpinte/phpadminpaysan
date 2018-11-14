<?php
header("Location: index.php");
    require "classes/util.php";

if (isset($_SESSION['ndc'])) {
    session_destroy();
}


exit();

?>