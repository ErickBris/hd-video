<?php include("includes/header.php");

	require("includes/function.php");
	$kwallpaper=new  k_wallpaper;
	
	
	//Get all Category 
	$qry="SELECT * FROM tbl_category";
	$result=mysql_query($qry);
	
	 	
	if(isset($_POST['submit']) and isset($_GET['add']))
	{	
		 
		$kwallpaper->addvideo();
		
		echo "<script>document.location='manage_gallery.php';</script>"; 
	    exit;
		
	}	
	 
?>
<script src="js/gallery.js" type="text/javascript"></script>
  

                  
                <!-- h2 stays for breadcrumbs -->                                
                <div id="main">                	
					 <h2><a href="home.php">Dashboard</a> &raquo; <a href="#" class="active"></a></h2>
                     <h3>Add Video</h3>                   	
					
					<form action="" method="post" class="jNice" enctype="multipart/form-data" onsubmit="return checkValidation(this);">
						<fieldset>
						
							<p>
								<label>Select Category:</label>
								
								 
									<select name="category_id" id="category_id">
			
										<option value="">--Select Category--</option>
										<?php
												while($row=mysql_fetch_array($result))
												{
										?>
										<?php if($_POST['category']==$row['cid']){?>
										<option value="<?php echo $row['cid'];?>"  selected="selected"><?php echo $row['category_name'];?> </option>								<?php }else{?>
										<option value="<?php echo $row['cid'];?>"><?php echo $row['category_name'];?></option>								
										<?php }?>
										<?php
											}
										?>
									</select>
									  </p>
							  
							<p><label>Video Title:</label>
								<input type="text" name="video_title" id="video_title" value="" class="text-long" placeholder="Test Video" />
							</p>
                            <p><label>Video URL:</label>
								<input type="text" name="video_url" id="video_url" value="" class="text-long" placeholder="https://www.youtube.com/watch?v=xxxxxxxx"/>
							</p>
                             
                            <p><label>Video Duration:</label>
								<input type="text" name="video_duration" id="video_duration" value="" class="text-long" placeholder="3:50" />
							</p> 
                            <p><label>Video Description:</label>
                            	<textarea name="vid_description" id="vid_description"></textarea>
                            </p>
							 
                            <input type="submit" name="submit" value="Add Video" />
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
