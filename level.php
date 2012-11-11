<?php
$level=$_GET['level'];
//echo $level;

$src=$_GET['src'];
$imageName=$src;
//echo "<br/>".$imageName; 
?>
<!DOCTYPE html>
<!-- saved from url=(0048)http://jqueryui.com/demos/draggable/default.html -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>ImageMatrix</title>

	

				
	
	<script src="./scripts/jquery-1.7.2.js"></script>
	<script src="./scripts/jquery.ui.core.js"></script>
	<script src="./scripts/jquery.ui.widget.js"></script>
	<script src="./scripts/jquery.ui.mouse.js"></script>
	<script src="./scripts/jquery.ui.draggable.js"></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=387875671274934";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

	<script>
	var divisions=0;
	var totalBoxes=0;

	var totalBoxes_x=0;
	var totalBoxes_y=0;

		function changeID(id){
		//	alert(id);
		//	document.getElementById('demoText').innerHTML="<p>"+id+"</p>";
		}


		var left_pos=null;
		var right_pos=null;
		var top_pos=null;
		var bottom_pos=null;

		// 	0	1	2
		//	3	4	5
		//	6	7	8
 
		//generic matric
		//	 0		1		2		...		(d-1)		//d stands for divisions
		// 	d		d+1		d+2		...		(2d)-1
		//	2d		2d+1		2d+2		...		(3d-1)
		//	...		...		....		....		....
		//	(d-1)d		(d-1)d+1	(d-1)d+2	...		(dd-1)		
		
		var horizontal_check=null;
		var vertical_check=null;
		
		//check horizontally
		var is_0_1_2=false;//is 0 left of 1 left of 2
		var is_3_4_5=false;
		var is_6_7_8=false;
		
		//check vertically
		var is_0_3_6=false;
		var is_1_4_7=false;
		var is_2_5_8=false;

		var str="";
		var folder_name="";
		
	function findNearMe(id){
	
	
	//	alert(id);
		var left=0;
		var top=0;
		var right=0;
		var bottom=0;
		document.getElementById("demoText").innerHTML="";

		var left_selected=0,top_selected=0,right_selected=0,bottom_selected=0;
		left_selected=parseInt(document.getElementById(id).style.left);
		top_selected=parseInt(document.getElementById(id).style.top);
		right_selected=parseInt(left_selected)+document.getElementById(id).width;
		bottom_selected=parseInt(top_selected)+document.getElementById(id).height;
		str="<br/> selected id =: "+id +" : "+left_selected+","+top_selected+","+right_selected+","+bottom_selected+";";

		var ele_id=null;
		
		for(var j=0;j<totalBoxes_y;j++){
			for(var i=0;i<totalBoxes_x;i++){
				ele_id=j+'_'+i;
				if(document.getElementById(ele_id)!=null){
					left=parseInt(document.getElementById(ele_id).style.left);
					top=parseInt(document.getElementById(ele_id).style.top);
					right=left+parseInt(document.getElementById(ele_id).width);
					bottom=top+parseInt(document.getElementById(ele_id).height);
					
				
					left_pos[j][i]=left;				
					right_pos[j][i]=right;
					top_pos[j][i]=top;
					bottom_pos[j][i]=bottom;
					
					str=str+"<br/>"+ele_id+"="+left+","+top+","+right+","+bottom+"";
					if(left_selected>=right){
						str=str+" lies on left <br/>";
					}
					if(right_selected<=left){
						str=str+" lies on right <br/>";
					}
					if(top_selected>=bottom){
						str=str+"lies on top <br/>";
					}
					if(bottom_selected<=top){
						str=str+"lies on bottom <br/>";
					}
				}
			}
		}
		//checkPosition();
		checkPosition_for_NxN(divisions);
		//document.getElementById("demoText").innerHTML=str;
	}

	function checkPosition_for_NxN(divisions){
	
	
	var final_horizontal_check=true;
	var final_vertical_check=true;
	
		//check horizontally
		var i=0;
		var j=0;
		
		for(j=0;j<divisions;j++){
			for(i=0;(i+1)<divisions;i++){
				if(right_pos[j][i]<=left_pos[j][i+1] && ( (left_pos[j][i+1] - right_pos[j][i])<60 )){
					horizontal_check[j][i]=true;
				}
				else
					horizontal_check[j][i]=false;
					
				final_horizontal_check=(final_horizontal_check && horizontal_check[j][i]);
			}
		}
				
		
		str=str+"<br/> horizontal check :";
		for(j=0;j<divisions;j++){
			for(i=0;(i+1)<divisions;i++){
				str=str+ "<br/>"+horizontal_check[j][i]+",";
			}
		}
		str=str+"<br/>final horizontal check = "+final_horizontal_check;
			
		//check vertically		
		for(i=0;i<divisions;i++){
			for(j=0;(j+1)<divisions;j++){
				if(bottom_pos[j][i]<=top_pos[j+1][i] && ( (top_pos[j+1][i] - bottom_pos[j][i])<60 ) ){
					vertical_check[j][i]=true;
				}
				else
					vertical_check[j][i]=false;
					
				final_vertical_check=final_vertical_check && vertical_check[j][i];				
			}
		}
		
		str=str+"<br/>vertical check :";
		for(i=0;i<divisions;i++){
			for(j=0;(j+1)<divisions;j++){
				str=str+"<br/>"+vertical_check[j][i];
			}			
		}

		
		str=str+"<br/> final vertical check = "+final_vertical_check;
		if(final_horizontal_check ==true && final_vertical_check==true){
			
			//initialize all array to store positions
			left_pos=new Array(divisions);
			right_pos=new Array(divisions);
			top_pos=new Array(divisions);
			bottom_pos=new Array(divisions);

			//initialize boolean check for horizntal and vertical positions
			horizontal_check=new Array(divisions);
			vertical_check=new Array(divisions);
			initializeAllBoxes();
			
			final_horizontal_check=true;
			final_vertical_check=true;
			
			xmlhttpPost_delete_directory('delete_folder.php',folder_name);
			
			alert("Thats Right , You Win ! Loading Next Level...  ");
			//alert('will now load one level higher game. Try it !');
			var sameimgName="<?php echo $imageName;?>";
			var level="<?php echo $level;?>";
			level=parseInt(level)+1;
			
			//alert(parseInt(level)+1+"&src="+sameimgName);
			var newLink="http://www.newsonmap.in/imagematrix/level.php?level="+level+"&src="+sameimgName;
			window.location.href=newLink;
	
		}
	}	


	$(function() {

	});
	
	

	</script>
</head>
<body onload="onLoad();";>
<?php
//$divisions=3;
$divisions=$level;

$source_x=0;
$source_y=0;

//$imageName="source.jpg";


list($imageWidth,$imageHeight,$type,$attr)=getimagesize($imageName);
//$imageWidth=500;
//$imageHeight=375;

//echo "type=".$type;
$source="";

//create images
if($type=='1'){
	$source=imagecreatefromgif($imageName);
}
if($type=='2'){
	$source=imagecreatefromjpeg($imageName);
}
if($type=='3'){
	$source=imagecreatefrompng($imageName);
}

if($type=='6'){
	$source=imagecreatefrombmp($imageName);
}

$width=$imageWidth/$divisions;
$height=$imageHeight/$divisions;

?>

<?php
function imagecreatefrombmp( $filename )
{
    $file = fopen( $filename, "rb" );
    $read = fread( $file, 10 );
    while( !feof( $file ) && $read != "" )
    {
        $read .= fread( $file, 1024 );
    }
    $temp = unpack( "H*", $read );
    $hex = $temp[1];
    $header = substr( $hex, 0, 104 );
    $body = str_split( substr( $hex, 108 ), 6 );
    if( substr( $header, 0, 4 ) == "424d" )
    {
        $header = substr( $header, 4 );
        // Remove some stuff?
        $header = substr( $header, 32 );
        // Get the width
        $width = hexdec( substr( $header, 0, 2 ) );
        // Remove some stuff?
        $header = substr( $header, 8 );
        // Get the height
        $height = hexdec( substr( $header, 0, 2 ) );
        unset( $header );
    }
    $x = 0;
    $y = 1;
    $image = imagecreatetruecolor( $width, $height );
    foreach( $body as $rgb )
    {
        $r = hexdec( substr( $rgb, 4, 2 ) );
        $g = hexdec( substr( $rgb, 2, 2 ) );
        $b = hexdec( substr( $rgb, 0, 2 ) );
        $color = imagecolorallocate( $image, $r, $g, $b );
        imagesetpixel( $image, $x, $height-$y, $color );
        $x++;
        if( $x >= $width )
        {
            $x = 0;
            $y++;
        }
    }
    return $image;
}
?>
<style>
body{ 
 color: #000000 ;
 background: #FFFFFF;
 border-width: 10px;
 border-style: solid;
 border-color: #6699ff;
 height:700px;;
 }
</style>
<body style="cursor: auto; ">

<center><font id='pageHeading' color='#6699ff' size='5'>ImageMatrix</font></center>

<font size="5"  color='#6699ff'><a href='index.php' style='color:#6699ff;position:absolute;left:5%;'>Menu</a></font>

<font size="5"  color='#6699ff' style="position:absolute;left:20%;color:#6699ff;">Rearrange Pieces (<?php echo $divisions."x".$divisions ?>) To Form Original Image  Matrix</font>

		<br/>
	<center><div class="fb-like" data-href="http://www.newsonmap.in/game/index.php" data-send="true" data-width="225" data-show-faces="true"></div>
	<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.newsonmap.in/game/index.php" data-text="check out this puzzle ImgeMatrix" data-via="ashish_fagna">Tweet</a></center>	
<div>
<?php
$time=time();
$i=0;
$j=0;
//$imgarray_index=0;
//$imgNameArray=array();


//create a folder for apieces with name as timestamp

if(mkdir($thisdir ."output/$time" , 0777)){
//   echo "Directory has been created successfully...";
}
else{
   echo "Failed to create directory...";
}

$folder_name=$time;

for($source_y=0;$source_y<$imageHeight && $j<$divisions ;$source_y=$source_y+($height)){
	$i=0;
	for($source_x=0;$source_x<$imageWidth  && $i<$divisions ;$source_x=$source_x+($width)){

		$new=imagecreatetruecolor($width,$height);
		//copy
		imagecopy($new,$source,0,0,$source_x,$source_y,$width,$height);
		
		//echo $time."<br/>";
		$imgName="output/$time/"."_"."$i"."_".$j.".jpeg";
		
		
		//echo $imgName."<br/>";
		imagejpeg($new,$imgName);
		
		$left=rand(20,300);
		$top=rand(50,600);
		
		echo "<img id= '".$j."_".$i."' class='ui-widget-content ui-draggable'  src='".$imgName."' border='5px' onMouseOver='changeID(this.id)' style='position:absolute;left:".$left."px;top:".$top."px;'/>";

		$i++;
	}
	$j++;
}

$totalBoxes_x=$i;
$totalBoxes_y=$j;

?>

</div>

<div id='demoText'></div>

<script>
	folder_name="<?php echo $folder_name;?>";

	function onLoad(){
	
	//startstopTimer.toggle();
	
	
		divisions="<?php echo $divisions;?>";
		//alert("Grid Size = "+divisions+"x"+divisions);

		//initialize all array to store positions
		left_pos=new Array(divisions);
		right_pos=new Array(divisions);
		top_pos=new Array(divisions);
		bottom_pos=new Array(divisions);

		//initialize boolean check for horizntal and vertical positions
		horizontal_check=new Array(divisions);
		vertical_check=new Array(divisions);
		
		initializeAllBoxes();
	}

	function initializeAllBoxes(){
		var i=0;
		var j=0;
		totalBoxes_x="<?php echo $totalBoxes_x;?>";
		totalBoxes_y="<?php echo $totalBoxes_y;?>";
		
		//alert("totalBoxes_x = "+totalBoxes_x+", totalBoxes_y="+totalBoxes_y);
		
		
		for(j=0;j<totalBoxes_y;j++){
			for(i=0;i<totalBoxes_x;i++){
				var id='#'+j+'_'+i;
				$(id).draggable({
					stop: function(event, ui) { findNearMe(this.id);},
					opacity: 0.90
				});
			}
		}
		
		
		


		for(var k=0;k<divisions;k++){
			left_pos[k]=new Array(divisions);
			right_pos[k]=new Array(divisions);
			top_pos[k]=new Array(divisions);
			bottom_pos[k]=new Array(divisions);
			
			horizontal_check[k]=new Array(divisions);
			vertical_check[k]=new Array(divisions);
			
		}
		
		for(j=0;j<divisions;j++){
			for(i=0;i<divisions;i++){			
					horizontal_check[j][i]=false;
			}
		}
		
		for(j=0;j<divisions;j++){
			for(i=0;i<divisions;i++){
				vertical_check[j][i]=false;
			}			
		}
		
		
	}

	
	 function xmlhttpPost_delete_directory(strURL,del_dir_name) {
		
		var xmlHttpReq = false;
		var self = this;
		// Mozilla/Safari
		if (window.XMLHttpRequest) {
			self.xmlHttpReq = new XMLHttpRequest();
		}
		// IE
		else if (window.ActiveXObject) {
			self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
		}
		self.xmlHttpReq.open('POST', strURL, true);
		self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		self.xmlHttpReq.onreadystatechange = function() {
			if (self.xmlHttpReq.readyState == 4) {
				//alert(self.xmlHttpReq.responseText);
				//if received '1' mean folder deleted;				
			}
		}
		self.xmlHttpReq.send("del_dir_name="+del_dir_name);
		
	}
</script>
</body>
</html>