<?php
include '../config.php';

session_destroy(); // Xoa session

header("Location: ".CLIENT_URL);