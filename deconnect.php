<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["er_msg"]);
header("Location: ./index.php");
die();
