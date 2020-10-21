<?php

session_start();
session_unset();
header('Location:/vue/user/signin.php');
die();