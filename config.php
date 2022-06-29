<?php
    if (!isset($_SESSION)) { session_start(); }
    setlocale(LC_ALL, 'hr_HR.utf8');
    
	ini_set('display_errors', 0);
    
    require_once 'config/env.php';
    require_once 'functions.php';

	// DB Connection
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    $conn->set_charset("utf8");
    

    $cacheBuster = time();
?>