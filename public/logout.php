<?php
session_start();
require_once '../includes/auth-functions.php';

logoutUser();
header('Location: login.php');
exit;
