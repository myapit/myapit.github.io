<?php
error_reporting(E_ALL);

$conn = mysqli_connect("10.10.0.100","root","root") or die("conection failed");

print_r($conn);
