<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
    
<head>
<link rel="stylesheet" href="./styles/notice_style.css">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/styles.css">
  <link rel="stylesheet" href="./styles/styles_animation.css">
	<title>View</title>
	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			min-height: 100vh;
		}
		.alb {
			width: 200px;
			height: 200px;
			padding: 5px;
		}
		.alb img {
			width: 100%;
			height: 100%;
		}
		a {
			text-decoration: none;
			color: black;
		}
	</style>
</head>
<body>
     <a href="patient-dashboard.php">&#8592;</a>
     <?php 
	 $sql = "SELECT * FROM aadhar_no INNER JOIN documents ON aadhar_no.id=documents.id;
	 $res = mysqli_query($conn,  $sql);

	 if (mysqli_num_rows($res) > 0) {
		 while ($images = mysqli_fetch_assoc($res)) { ?>
             <div class="alb">
             	<img src="uploads/<?=$documents['aadhar_no']?>">
             </div>          		
    <?php } } ?>
</body>
</html>
