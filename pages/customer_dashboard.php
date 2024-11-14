<?php
session_start();
include(__DIR__ . '/../dbconnect.php');
include('../Headers\customerHeader.php');

if (!isset($_SESSION['userid'])) {
    header('Location: ../Forms/login.php');
    exit;
}
