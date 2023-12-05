<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["er_msg"]);
unset($_SESSION["action"]);
header("Location: ./index.php");
die();
