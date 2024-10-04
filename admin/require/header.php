<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['user']['role_id'] == "2"){
 	 header("location:../indexx.php");
 }elseif(!isset($_SESSION['user'])){
    header("location:../indexx.php");
 }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Panel</title>
	
	<!-- bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- bootstrap -->

	<!-- sidebar -->
	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
   <link href="sidebars/sidebars.css" rel="stylesheet">
   <!-- sidebar -->
   
    <!-- datatable -->
   <link rel="stylesheet" type="text/css" href="Files/dataTables.dataTables.css">
	<script type="text/javascript" src="Files/jquery-3.7.1.js"></script>
    <!-- datatable -->
   
   <!-- validations -->
   <script src="admin_validations.js"> </script>
   <!-- validations -->
   

    <style>
		body{
			background-color: teal;
		}
	
	</style>
</head>
<body>
   <?php include_once("navbar.php"); ?>
   
