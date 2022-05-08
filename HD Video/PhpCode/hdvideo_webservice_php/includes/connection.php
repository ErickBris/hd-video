<?php 
    session_start();
 
	//local db 
	
	if($_SERVER['HTTP_HOST']=="localhost")
	{
	$serverIp="localhost";
	$userName="root";
	$password="";
	$dbname="app_hdvideo";
	
	}else
	{
	//Live
	 
	$serverIp="localhost";
	$userName="viaviw56_ILTS";
	$password="Admin@2013";
	$dbname="viaviw56_hdVideo";
	}
	$cn=mysql_connect($serverIp,$userName,$password) OR Die("Couldn't Connect - ".mysql_error());
	$link=mysql_select_db($dbname,$cn)or Die("Couldn't SELCECT - ".mysql_error()); 
	

?> 
	 
 