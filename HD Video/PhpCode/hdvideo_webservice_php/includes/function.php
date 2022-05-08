<?php error_reporting(0);
require_once("thumbnail_images.class.php");

function Update($table_name, $form_data, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;
 		 
    // run and return the query result
    return mysql_query($sql);
}


class k_wallpaper
{

//Category Query	
	function addCategory()
	{
		
		
		
		
		$albumimgnm=rand(0,99999)."_".$_FILES['image']['name'];
			 $pic1=$_FILES['image']['tmp_name'];
			  if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$albumimgnm;
				
				 copy($pic1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$albumimgnm;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  else
						  {
						  		 
								$cat_result=mysql_query('INSERT INTO `tbl_category` (`category_name` ,`category_image`) VALUES (  \''.addslashes($_POST['category_name']).'\',\''.$albumimgnm.'\')');
		
								
						  }

		
	}
	
	function editCategory()
	{
			 
			 
	if($_FILES['image']['name']=="")
		 {
		
		$cat_result=mysql_query('UPDATE `tbl_category` SET `category_name`=\''.addslashes($_POST['category_name']).'\' WHERE cid=\''.$_GET['cat_id'].'\'');

		}
		else
		{
		
			//Image Unlink
			
			$img_res=mysql_query('SELECT * FROM tbl_category WHERE cid=\''.$_GET['cat_id'].'\'');
			$img_row=mysql_fetch_assoc($img_res);
			
			if($img_row['category_image']!="")
			{
				unlink('images/'.$img_row['category_image']);
				unlink('images/thumbs/'.$img_row['category_image']);
			}	
		
			//Image Upload
			$albumimgnm=rand(0,99999)."_".$_FILES['image']['name'];
			 $pic1=$_FILES['image']['tmp_name'];
			   
		
			   if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$albumimgnm;
				
				 copy($pic1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$albumimgnm;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  else
						  {
						  		 
								 $cat_result=mysql_query('UPDATE `tbl_category` SET `category_name`=\''.addslashes($_POST['category_name']).'\',`category_image`=\''.$albumimgnm.'\' WHERE cid=\''.$_GET['cat_id'].'\'');
 	 
						  }
		}

			
	}
	
	function deleteCategory()
	{
		
		
		$vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE cat_id=\''.$_GET['cat_id'].'\'');
		while($vid_row=mysql_fetch_assoc($vid_res)){
		
			if($vid_row['video_url']!="")
			{
				$string=$vid_row['video_url'];
				list($a,$b)=split('videos/',$string);
				unlink('videos/'.$b);
			}
			if($vid_row['video_thumbnail']!="")
			{
				unlink('images/thumbs/'.$vid_row['video_thumbnail']);
				unlink('images/'.$vid_row['video_thumbnail']);
			}
		}
		$vid_result=mysql_query('DELETE FROM `tbl_gallery` WHERE cat_id=\''.$_GET['cat_id'].'\'');
		
		$img_res=mysql_query('SELECT * FROM tbl_category WHERE cid=\''.$_GET['cat_id'].'\'');
		$img_row=mysql_fetch_assoc($img_res);
			
			if($img_row['category_image']!="")
			{
				unlink('images/thumbs/'.$img_row['category_image']);
				unlink('images/'.$img_row['category_image']);
				 
			}	
		
		$cat_result=mysql_query('DELETE FROM `tbl_category` WHERE cid=\''.$_GET['cat_id'].'\'');
	}

 
//Image Gallery
	function addvideo()
	{
		
	if($_FILES['local_url']['name']!="")
	{	
	$video_id="000q1w2";
	$video=$_FILES['local_url']['name'];
	$vid1=$_FILES['local_url']['tmp_name'];
	if(!is_dir('videos'))
	{mkdir('videos', 0777);
	}
	$file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/videos/';
	if($_FILES['thumbnail']['name']!="")	
	{
	$thumbname=rand(0,99999)."_".$_FILES['thumbnail']['name'];
			 $thumb1=$_FILES['thumbnail']['tmp_name'];
			 if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$thumbname;
				
				 copy($thumb1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$thumbname;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  
	}
	$res=mysql_query('INSERT INTO `tbl_gallery` (`cat_id`,`video_title`,`video_url`,`video_id`,`video_thumbnail`,`video_duration`,`video_description`) VALUES (\''.$_POST['category_id'].'\',\''.addslashes($_POST['video_title']).'\',\''.$file_path.$video.'\',\''.$video_id.'\',\''.$thumbname.'\',\''.$_POST['video_duration'].'\',\''.addslashes($_POST['vid_description']).'\')');
						  
	}
	
	else if($_POST['server_url']!="")
	{
		if($_FILES['thumbnail']['name']!="")	
	{
	$thumbname=rand(0,99999)."_".$_FILES['thumbnail']['name'];
			 $thumb1=$_FILES['thumbnail']['tmp_name'];
			 if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$thumbname;
				
				 copy($thumb1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$thumbname;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						 
	}
	
		$video_id="000q1w2";
		$res=mysql_query('INSERT INTO `tbl_gallery` (`cat_id`,`video_title`,`video_url`,`video_id`,`video_thumbnail`,`video_duration`,`video_description`) VALUES (\''.$_POST['category_id'].'\',\''.addslashes($_POST['video_title']).'\',\''.$_POST['server_url'].'\',\''.$video_id.'\',\''.$thumbname.'\',\''.$_POST['video_duration'].'\',\''.addslashes($_POST['vid_description']).'\')');
	}
	else
	{
	$url = addslashes($_POST['video_url']);
	parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
	 		 	
	 $res=mysql_query('INSERT INTO `tbl_gallery` (`cat_id`,`video_title`,`video_url`,`video_id`,`video_duration`,`video_description`) VALUES (\''.$_POST['category_id'].'\',\''.$_POST['video_title'].'\',\''.$_POST['video_url'].'\',\''.$my_array_of_vars['v'].'\',\''.$_POST['video_duration'].'\',\''.addslashes($_POST['vid_description']).'\')');
						 
	}
	}
		
	function editvideo()
	{
	if(($_FILES['local_url']['name']=="") &&($_POST["video_url"]=="") &&($_POST["server_url"]==""))
	{
		if($_FILES['thumbnail']['name']!="")
	{
		$thumbname=rand(0,99999)."_".$_FILES['thumbnail']['name'];
			 $thumb1=$_FILES['thumbnail']['tmp_name'];
			 if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$thumbname;
				
				 copy($thumb1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$thumbname;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  $vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
							  $vid_row=mysql_fetch_assoc($vid_res);
							  if($vid_row['video_thumbnail']!="")
							{
							unlink('images/thumbs/'.$vid_row['video_thumbnail']);
								unlink('images/'.$vid_row['video_thumbnail']);
							}
	}
	else
	{
		$vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
		$vid_row=mysql_fetch_assoc($vid_res);
		$thumbname=$vid_row['video_thumbnail'];
	}
	$res=mysql_query('UPDATE `tbl_gallery` SET `cat_id`=\''.$_POST['category_id'].'\',`video_title`=\''.addslashes($_POST['video_title']).'\',`video_duration`=\''.$_POST['video_duration'].'\',`video_thumbnail`=\''.$thumbname.'\',`video_description`=\''.addslashes($_POST['vid_description']).'\' WHERE id=\''.$_GET['vid_id'].'\'');
	}
	
	else
	{
	if($_FILES['local_url']['name']!="")
	{	
	$video_id="000q1w2";
	$video=$_FILES['local_url']['name'];
	$vid1=$_FILES['local_url']['tmp_name'];
		if(!is_dir('videos'))
		{
			mkdir('videos', 0777);
		}
	 
	
	$file_path = 'http://'.$_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']).'/videos/';
		
	$vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
			$vid_row=mysql_fetch_assoc($vid_res);
			
			if($vid_row['video_url']!="")
			{
				$string=$vid_row['video_url'];
				list($a,$b)=split('videos/',$string);
				unlink('videos/'.$b);
			}
			
	if($_FILES['thumbnail']['name']!="")
	{
		$thumbname=rand(0,99999)."_".$_FILES['thumbnail']['name'];
			 $thumb1=$_FILES['thumbnail']['tmp_name'];
			 if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$thumbname;
				
				 copy($thumb1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$thumbname;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  $vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
							  $vid_row=mysql_fetch_assoc($vid_res);
							  if($vid_row['video_thumbnail']!="")
							{
							unlink('images/thumbs/'.$vid_row['video_thumbnail']);
								unlink('images/'.$vid_row['video_thumbnail']);
							}
	}
	else
	{
		$vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
		$vid_row=mysql_fetch_assoc($vid_res);
		$thumbname=$vid_row['video_thumbnail'];
	}
	$res=mysql_query('UPDATE `tbl_gallery` SET `cat_id`=\''.$_POST['category_id'].'\',`video_title`=\''.addslashes($_POST['video_title']).'\',`video_url`=\''.$file_path.$video.'\',`video_id`=\''.$video_id.'\',`video_thumbnail`=\''.$thumbname.'\',`video_duration`=\''.$_POST['video_duration'].'\',`video_description`=\''.addslashes($_POST['vid_description']).'\' WHERE id=\''.$_GET['vid_id'].'\'');
	}
	
	else if($_POST['server_url']!="")
	{
		$vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
			$vid_row=mysql_fetch_assoc($vid_res);
			$video_id="000q1w2";
			if($vid_row['video_url']!="")
			{
				$string=$vid_row['video_url'];
				list($a,$b)=split('videos/',$string);
				unlink('videos/'.$b);
			}
	
	
	
		if($_FILES['thumbnail']['name']!="")
	{
		$thumbname=rand(0,99999)."_".$_FILES['thumbnail']['name'];
			 $thumb1=$_FILES['thumbnail']['tmp_name'];
			 if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$thumbname;
				
				 copy($thumb1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$thumbname;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  $vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
							  $vid_row=mysql_fetch_assoc($vid_res);
							  if($vid_row['video_thumbnail']!="")
							{
							unlink('images/thumbs/'.$vid_row['video_thumbnail']);
								unlink('images/'.$vid_row['video_thumbnail']);
							}
	}
	else
	{
		$vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
		$vid_row=mysql_fetch_assoc($vid_res);
		$thumbname=$vid_row['video_thumbnail'];
	}
	$res=mysql_query('UPDATE `tbl_gallery` SET `cat_id`=\''.$_POST['category_id'].'\',`video_title`=\''.addslashes($_POST['video_title']).'\',`video_url`=\''.$_POST['server_url'].'\',`video_thumbnail`=\''.$thumbname.'\',`video_duration`=\''.$_POST['video_duration'].'\',`video_description`=\''.addslashes($_POST['vid_description']).'\' WHERE id=\''.$_GET['vid_id'].'\'');
	}
	
	else if(($_FILES['thumbnail']['name']!="")&& $_POST["video_url"]=="")
	{
	$thumbname=rand(0,99999)."_".$_FILES['thumbnail']['name'];
			 $thumb1=$_FILES['thumbnail']['tmp_name'];
			 if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$thumbname;
				
				 copy($thumb1,$tpath1);
				 
				 
					    $thumbpath='images/thumbs/'.$thumbname;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
						  else
						  {
							  $vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
							  $vid_row=mysql_fetch_assoc($vid_res);
							  if($vid_row['video_thumbnail']!="")
							{
							unlink('images/thumbs/'.$vid_row['video_thumbnail']);
								unlink('images/'.$vid_row['video_thumbnail']);
							}
							  $res=mysql_query('UPDATE `tbl_gallery` SET `cat_id`=\''.$_POST['category_id'].'\',`video_title`=\''.addslashes($_POST['video_title']).'\',`video_url`=\''.$_POST['server_url'].'\',`video_id`=\''.$video_id.'\',`video_thumbnail`=\''.$thumbname.'\',`video_duration`=\''.$_POST['video_duration'].'\',`video_description`=\''.addslashes($_POST['vid_description']).'\' WHERE id=\''.$_GET['vid_id'].'\'');
						  }
						  
	}
	else{
		$vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
			$vid_row=mysql_fetch_assoc($vid_res);
			
			if($vid_row['video_url']!="")
			{
				$string=$vid_row['video_url'];
				list($a,$b)=split('videos/',$string);
				unlink('videos/'.$b);
			}
			if($vid_row['video_thumbnail']!="")
			{
				
				unlink('images/thumbs/'.$vid_row['video_thumbnail']);
				unlink('images/'.$vid_row['video_thumbnail']);
			}
		$url = addslashes($_POST['video_url']);
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		 $thumbname="";
		$res=mysql_query('UPDATE `tbl_gallery` SET `cat_id`=\''.$_POST['category_id'].'\',`video_title`=\''.addslashes($_POST['video_title']).'\',`video_url`=\''.$_POST['video_url'].'\',`video_id`=\''.$my_array_of_vars['v'].'\',`video_duration`=\''.$_POST['video_duration'].'\',`video_description`=\''.addslashes($_POST['vid_description']).'\',`video_thumbnail`=\''. $thumbname.'\' WHERE id=\''.$_GET['vid_id'].'\'');
		 
	}}	}
	
	function deleteVideo()
	{
			$vid_res=mysql_query('SELECT * FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
			$vid_row=mysql_fetch_assoc($vid_res);
			
			if($vid_row['video_url']!="")
			{
				$string=$vid_row['video_url'];
				list($a,$b)=split('videos/',$string);
				unlink($vid_row['video_url']);
			}
			if($vid_row['video_thumbnail']!="")
			{
				unlink('images/thumbs/'.$vid_row['video_thumbnail']);
				unlink('images/'.$vid_row['video_thumbnail']);
			}
			$img_result=mysql_query('DELETE FROM `tbl_gallery` WHERE id=\''.$_GET['vid_id'].'\'');
	}	
	
	function editProfile()
 {
    
   $res=mysql_query('UPDATE `tbl_admin` SET `username`=\''.$_POST['username'].'\',`password`=\''.$_POST['password'].'\',`email`=\''.$_POST['email'].'\' WHERE id=\''.$_SESSION['id'].'\'');
 }	
 function editAds()
	{
			 
			 
	if($_FILES['ads_image']['name']=="")
		 {
		
		$ads_result=mysql_query('UPDATE `tbl_ads` SET `ads_link`=\''.addslashes($_POST['ads_link']).'\' WHERE ads_id=\'1\'');

		}
		else
		{
		
			//Image Unlink
			
			$img_res=mysql_query('SELECT * FROM tbl_ads WHERE ads_id=\'1\'');
			$img_row=mysql_fetch_assoc($img_res);
			
			if($img_row['ads_image']!="")
			{
				unlink('images/'.$img_row['ads_image']);
				 
			}	
		
			//Image Upload
			$albumimgnm=rand(0,99999)."_".$_FILES['ads_image']['name'];
			 $pic1=$_FILES['ads_image']['tmp_name'];
			   
		
			   if(!is_dir('images'))
			   {
			
			   		mkdir('images', 0777);
			   }
			  $tpath1='images/'.$albumimgnm;
				
				 copy($pic1,$tpath1);
				  		 
				  $ads_result=mysql_query('UPDATE `tbl_ads` SET `ads_link`=\''.addslashes($_POST['ads_link']).'\',`ads_image`=\''.$albumimgnm.'\' WHERE ads_id=\'1\'');
 						   
		}

	}
}


?>