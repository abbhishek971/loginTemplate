<?php
	$q = intval($_REQUEST['q']);
	$connection = mysqli_connect('localhost','root','','experiment');
  	$query = "DELETE FROM information WHERE id='$q'";
  	$result = mysqli_query($connection,$query);
?>