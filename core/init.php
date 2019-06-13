<?php 
session_start();
require 'connect/database.php';
require 'classes/general.php';
require 'classes/bcrypt.php';
require 'classes/users.php';
require 'classes/investor.php';
require 'classes/investment.php';
require 'classes/statement.php';
require 'classes/product.php';

// error_reporting(0);

$general 		= new General();
$bcrypt 		= new Bcrypt(12);
$users 			= new Users($db);
$investors		= new Investors($db);
$investments	= new Investments($db);
$statements		= new Statements($db);
$products		= new Products($db);

$errors = array();

if ($general->logged_in() === true)  {
	$user_id 	= $_SESSION['id'];
	$user 		= $users->userdata($user_id);
}

ob_start(); // Added to avoid a common error of 'header already sent'