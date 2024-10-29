<?php
$conn = mysqli_connect('localhost', 'admin', 'admin24', 'feedback_db');

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
