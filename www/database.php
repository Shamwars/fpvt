<?php
	
	$connect=mysqli_connect('localhost','root','root','fpvt');
	
	if(mysqli_connect_errno($connect))
	{
		echo 'Failed to connect';
		}
?>