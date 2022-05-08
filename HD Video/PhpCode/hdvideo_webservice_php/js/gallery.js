function checkValidation()
{
	 
	if(document.getElementById('category_id').value=="")
	{
		alert("Please Select Category.!");
		 
		document.getElementById('category_id').focus();		 
		return false;
	}
	if(document.getElementById('video_title').value=="")
	{
		alert("Please enter video title!");
		 
		document.getElementById('video_title').focus();
		document.getElementById('video_title').select();		 
		return false;
	}
	if(document.getElementById('video_url').value=="")
	{
		alert("Please enter video url!");
		 
		document.getElementById('video_url').focus();
		document.getElementById('video_url').select();
		 
		return false;
	}
	if(document.getElementById('video_duration').value=="")
	{
		alert("Please enter video duration!");
		 
		document.getElementById('video_duration').focus();
		document.getElementById('video_duration').select();
		 
		return false;
	}
	if(document.getElementById('vid_description').value=="")
	{
		alert("Please enter video description!");
		 
		document.getElementById('vid_description').focus();	
		document.getElementById('vid_description').select();	 
		return false;
	}
	if(document.getElementById('vid_description').value.length<20)
	{
		alert("Please enter video description at least 20 characters.!");
		 
		document.getElementById('vid_description').focus();
		document.getElementById('vid_description').select();
		return false;
	}
	
	 
	return true;
} 