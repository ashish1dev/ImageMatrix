

<?php
$image_file_path = "http://www.newsonmap.in/imagematrix/images/"; 

//createThumbs('images/','images/thumbnails/',200);
	
  
  $pic_types = array("jpg", "jpeg", "gif", "png");
  $imageNameArray=array();
  
    if ($handle = opendir('./images/thumbnails/')) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
			 if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$pic_types)){
               // echo "$file\n"."<br/>";
				array_push($imageNameArray,$file);
            }
		  }
        }
		//print_r($imageNameArray);
		
		?>
		<script>
		var level=3;
		function gridChanged(){
			var grid=document.getElementById('gridChooser');
			 level=grid.options[grid.options.selectedIndex].value;
			 
		 onbodyload();
		 
		 if(document.getElementById('preview_uploaded_img')!=null){
			var previewimgsrc=document.getElementById('preview_uploaded_img').src;
			str="<a href='level.php?level="+level+"&src="+previewimgsrc+"'>"+"<img id='preview_uploaded_img' class='preview' src='"+previewimgsrc+"'/>"+"</a>";
			document.getElementById('preview').innerHTML=str;
		}
		}
		
		var jArray= <?php echo json_encode($imageNameArray ); ?>;
		
		function onbodyload(){

		
		
		var str="<table>";
		
		var i=0;
		for(var i=0;i<jArray.length;i++){
			//alert(jArray[i]);
			if(i%3==0){
				str=str+"<tr></tr>";
			}
	str=str+"<td><a href='level.php?level="+level+"&src=images/"+jArray[i]+"'><img src='images/thumbnails/"+jArray[i]+"' /></a></td>";
			
		
		}
	str=str+"</table>";
	
	
	
		document.getElementById('contentDiv').innerHTML="<p>"+str+"</p>";
		
		
		

		}
		</script>

		
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=387875671274934";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

		<center><font id='pageHeading' color='#6699ff' size='5'>ImageMatrix</font></center>
		
		<font size='5' color='#6699ff'> To play the game , Click on any image shown below.</font><br/><br/>
		<font size="4" color='#6699ff'>Select a Matrix size :</font>
		<select id='gridChooser' onChange='gridChanged();'  style='font-size:14pt;color:#6699ff'>
			<option value='2' >2x2</option>
			<option value='3' selected='selected'>3x3</option>
			<option value='4'>4x4</option>
			<option value='5'>5x5</option>
			<option value='6'>6x6</option>
			<option value='7'>7x7</option>
			<option value='8'>8x8</option>
			<option value='9'>9x9</option>
			<option value='10'>10x10</option>
			<option value='11'>11x11</option>
			<option value='12'>12x12</option>
			<option value='13'>13x13</option>
			<option value='14'>14x14</option>
			<option value='15'>15x15</option>
		</select>
		
		<div class="fb-like" data-href="http://www.newsonmap.in/game/index.php" data-send="true" data-width="225" data-show-faces="true"></div>
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.newsonmap.in/game/index.php" data-text="check out this puzzle ImgeMatrix" data-via="ashish_fagna">Tweet</a>

		<br/><br/>
		
		<!-- UPLOAD IMAGE-->
		
		<script type="text/javascript" src="./ajaximageupload/scripts/jquery.min.js"></script>
<script type="text/javascript" src="./ajaximageupload/scripts/jquery.form.js"></script>

<script type="text/javascript" >
var timeinterval;
 $(document).ready(function() {	
            $('#photoimg').live('change', function(){
			           $("#preview").html('');
			    $("#preview").html('<img src="./ajaximageupload/loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
			timeinterval=setInterval("addHyperlinkToImage()",2000);				
			});
        });
		
		
		function addHyperlinkToImage(){
			var str=document.getElementById('preview').innerHTML;
			
			if(str!=""){
				var previewimgsrc=document.getElementById('preview_uploaded_img').src;
				
				str="<a href='level.php?level="+level+"&src="+previewimgsrc+"'>"+str+"</a>";
				document.getElementById('preview').innerHTML=str;
				clearInterval(timeinterval);
				
			}
		}

</script>

<style>


.preview
{
width:200px;
border:solid 1px #dedede;
padding:5px;
}
#preview
{
color:'#6699ff';
font-size:12px
}
#contentDiv
{
background:#DDE8FF;
border:solid 4px #dedede;
overflow-y:scroll;
height:290px;
width:650px;
}
</style>
<body>



<div style="width:100%">

<form id="imageform" method="post" enctype="multipart/form-data" action='./ajaximageupload/ajaximage.php'>


<font size='4' color='#6699ff'>Upload Any Other Image : </font> <input type="file" name="photoimg" id="photoimg"  accept="image/*" size='10' style='display: inline-block;'/>
</form>
<div id='preview'>
</div>


</div>
<font size='4' color='#6699ff' style='position:relative;left:200px;'>OR</font><br/>
<script>
</script>

		
		<font size="4" color='#6699ff'>Click on any Image :</font>
		<div id='contentDiv'></div>
		<?php
		
	/*	echo "<table style='position:relative;left:10%;'>";
		$i=0;
		foreach($imageNameArray as $img){
		
				if($i%2==0){
					echo "<tr><tr/>";
				}
			echo "<td>";
			echo "<a href='level.php?level=3&src=images/$img'>";
			echo "<img src='images/thumbnails/$img' />";
			echo "</a>";
			echo "</td>";
				$i++;
		}
		echo "</table>";
		
		*/
		
		
        closedir($handle);
    }
   
   function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth )
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( strtolower($info['extension']) == 'jpg' )
    {
     // echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
  }
 

 // close the directory
  closedir( $dir );
}


?>
<style>
body{ 
 color: #000000 ;
 background: #FFFFFF;
 border-width: 10px;
 border-style: solid;
 border-color: #6699ff;
 padding:5px;
 }
</style>
<body onload='onbodyload();' >

</body>

