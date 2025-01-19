<?php

$conn = mysqli_connect("localhost", "root", "", "echo_db");

if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}
