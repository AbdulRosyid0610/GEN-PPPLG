<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "tiket_konser";

$men = new mysqli($host, $user, $pass, $db);

if ($men->connect_error) {
    die("koneksi gagal: " . $men->connect_error);
} 