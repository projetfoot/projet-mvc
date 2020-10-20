<?php

session_start();
session_unset();
header('Location:/user/signin.php');
die();