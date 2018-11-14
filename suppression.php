<?php
require 'classes/util.php';
if (isset($_GET['id']) && isset($_SESSION['connect'])) {
    suppressionBase($_GET['id']);
}
header("Location: index.php");
exit();

?>