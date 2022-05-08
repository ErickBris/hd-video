<?php include("includes/header.php");

	require("includes/function.php");
	$kwallpaper=new  k_wallpaper;
	
	
	//Get all Category 
	$qry="SELECT * FROM tbl_category";
	$result=mysql_query($qry);
	
	 
	 
	if(isset($_GET['vid_id']))
	{
		$img_qry="SELECT * FROM  tbl_gallery WHERE id='".$_GET['vid_id']."'";
		$img_res=mysql_query($img_qry);
		$img_row=mysql_fetch_assoc($img_res);
		 
		 
	}
	
	 if(isset($_POST['submit']) and isset($_GET['vid_id']))
	{
	 
		$kwallpaper->editvideo();
		
		 
		echo "<script>document.location='manage_gallery.php';</script>"; 
	    exit;
		
	}

?>
                
                <!-- h2 stays for breadcrumbs -->                                
                <div id="main">
                	<h2>Edit Video &raquo;</h2>
					 				                    	        				
					<form action="" method="post" class="jNice" enctype="multipart/form-data">
					
						<fieldset>
						
							<p>
								<label>Select Category:</label>
								
								 
									<select name="category_id" id="category_id">
			
										<option value="0">--Select Category--</option>
										<?php
												while($row=mysql_fetch_array($result))
												{
										 			if(isset($_POST['category']))
													{
															if($_POST['category']==$row['cid']){
															?>
															<option value="<?php echo $row['cid'];?>"  selected="selected"><?php echo $row['category_name'];?></option>								<?php }else{?>
										<option value="<?php echo $row['cid'];?>"><?php echo $row['category_name'];?></option>								
										<?php 				}?>
																
												<?php }
													else
													{
														 if($img_row['cat_id']==$row['cid']){
											 
											 ?>
										<option value="<?php echo $row['cid'];?>"  selected="selected"><?php echo $row['category_name'];?> </option>								<?php }else{?>
										<option value="<?php echo $row['cid'];?>"><?php echo $row['category_name'];?></option>								
										<?php 				}
														}
												}
										?>
									</select>
								 </p>
							 
					
							<p><label>Video Title:</label>
								<input type="text" name="video_title" id="video_title" value="<?php echo $img_row['video_title'];?>" class="text-long" placeholder="Test Video" />
							</p>
                            <p><label>Video URL:</label>
								<input type="text" name="video_url" id="video_url" value="<?php echo $img_row['video_url'];?>" class="text-long" placeholder="https://www.youtube.com/watch?v=xxxxxxxx"/>
							</p>
                             
                            <p><label>Video Duration:</label>
								<input type="text" name="video_duration" id="video_duration" value="<?php echo $img_row['video_duration'];?>" class="text-long" placeholder="3:50" />
							</p> 
                        	 <p><label>Video Description:</label>
                            	<textarea name="vid_description" id="vid_description" class="text-long"><?php echo $img_row['video_description'];?></textarea>
                            </p>
                             
                         
                            <input type="submit" name="submit" value="Edit Video" />
                        </fieldset>
                    </form>
                </div>
                <!-- // #main -->
                
                <div class="clear"></div>
            </div>
            <!-- // #container -->
        </div>	
        <!-- // #containerHolder -->
        
<?php include("includes/footer.php");?>       
