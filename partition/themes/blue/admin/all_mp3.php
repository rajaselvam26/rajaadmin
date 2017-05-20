<?php 
$h=$_GET['h'];
$rid1=$_GET['rid1'];
$v=mysql_query("select * from songs_english where rid='".$rid1."'");
$vr=mysql_fetch_object($vr);

if($h==1)
{

		mysql_query("update songs_english set hide='1' where rid='".$rid1."'" );
		mysql_query("update songs_tamil set hide='1' where rid='".$rid1."'" );
		
	}	
	else if($h==2)
	{
		mysql_query("update songs_english set hide='0' where rid='".$rid1."'" );
		mysql_query("update songs_tamil set hide='0' where rid='".$rid1."'" );
	}
	else if($h==3)
	{		
		mysql_query("update tbl_config set config_status=0 where config_var='show_player'");
	}
	else if($h==4)
	{
		mysql_query("update tbl_config set config_status=1 where config_var='show_player'");
	}

?>

<script type="text/javascript">
function shwsong(str)
{/*alert(str);*/
if (str=="")
  {
  document.getElementById("rep").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("rep").innerHTML=xmlhttp.responseText;
	/*var a=xmlhttp.responseText;
	alert(a);*/
    }
  }
xmlhttp.open("GET","song.php?q="+str,true);
xmlhttp.send();
}	
</script>
<?php
if(isset($_REQUEST['sub']))
{
	extract($_REQUEST);
	$up=$_FILES['up']['name'];
	
	
		if($up!='')
	{
		move_uploaded_file($_FILES['up']['tmp_name'],"../Songs/".$up);
		mysql_query("update songs_english set songs='".$up."' where sname='".$fname."'");
	mysql_query("update songs_tamil set songs='".$up."' where sname='".$fname."'");
	}
	header("location:?Theme_admin=all_mp3&MP3 Management");
}
?>
<?php
if(isset($_REQUEST['del_id'])){
$del=mysql_query("update songs_english set songs='' where rid='".$_REQUEST['del_id']."'");
echo "The Document is deleted";
}

?>  
<script>
function delete_me(id){
	if(confirm("Are you sure want to delete?")){
		document.getElementById('del_id').value=id;
		document.getElementById('del_submit').click();
	}else{
		return false;
	}
}
</script>
<form method="post"><input type="hidden" id="del_id" name="del_id" /><input type="submit" id="del_submit" style="display:none;" /></form>
<style type="text/css">
#apDiv1 {
	position: absolute;
	z-index: 1;
	left: 316px;
	background-color: #FFF;
	border-radius: 25px;
	box-shadow: 10px 10px 20px gray;
	padding: 10px;
	top: 101px;
}
</style>
<div id="container" style="overflow:auto; height:500px; width:963px !important;">
<div class="title-box">
<h2><b>All Mp3</b></h2>
</div>
<div class="dash_count"><form action="" method="post" enctype="multipart/form-data" name="form1">
<table class="dash_count_table" cellspacing="0" width="858">
<?php 
$configQuery 	=	mysql_query("select config_status from tbl_config where config_var='show_player'");
$record_set = mysql_query($configQuery, $con);
$count1	=	mysql_num_rows($van);
 ?>
<tr><td>Change Status: </td><td>
<?php if($count==$count1){  ?>
<td><a href="?Theme_admin=all_mp3&MP3 Management&h=3">Hide All Mp3</a></td><?php }else if($count!=$count1) {?>
<td><a href="?Theme_admin=all_mp3&MP3 Management&h=4">Show All Mp3</a></td><?php }?><td>Current Status : </td>
<?php if($count==$count1){  ?>
<td>Shown All Mp3</td><?php }else if($count!=$count1) {?>
<td>Hidden All Mp3</td><?php }?>
</td></tr>
<tr class="tr_th">

<!--<th>Page Location</th>-->
<th width="52">Id</th>
<th width="52">Songs Name</th>
<th width="52">Play Song</th>
<th width="52">Display Status</th>
<th width="52">Current Status</th>
<th width="32">Delete</th>
<th width="32">Edit</th>
<!--<th width="60">Edit</th>-->
</tr>
<?php //foreach(admin::admin_counts() as $name=>$count) {?>
<?php
mysql_query("set character_set_results='utf8'");
$vtb=mysql_query("select * from  songs_english where songs!=''");
while($r=mysql_fetch_object($vtb))
{
?>

<tr><td><?php echo $r->sid; ?></td>
<td><?php echo $r->sname; ?></td>

<?php if($r->songs!=''){ ?>
<td><a href="<?php echo $r->songs; ?>" >Play</a></td><?php }else{?>
<td></td><?php }?>
<?php if($r->hide==0){  ?>
<td><a href="?Theme_admin=all_mp3&MP3 Management&rid1=<?php echo $r->rid; ?>&h=1">Show</a></td><?php }else if($r->hide==1) {?>
<td><a href="?Theme_admin=all_mp3&MP3 Management&rid1=<?php echo $r->rid; ?>&h=2">Hide</a></td><?php }?>
<?php if($r->hide==0){  ?>
<td>Hide</td><?php }else if($r->hide==1) {?>
<td>Show</td><?php }?>

<?php /*?><?php if($r->page==1){ ?>
    <td>Home Page(Top Right)</td><?php } else if($r->page==2){?><td>Home Page (Bottom)</td><?php }?><?php */?>
<td><a href="javascript:void('0');" onclick="return delete_me('<?php echo $r->rid?>');">Delete</a></td>
<td align='left'><a href='?Theme_admin=all_mp3&MP3 Management&id=<?php echo $r->rid?>&n=1'>Edit</a></td></tr>
<?php } ?>
<?php //} ?>
</tr>
</table></form>
</div>
<?php
$n=$_GET['n'];
$id=$_GET['id'];
mysql_query("set character_set_results='utf8'");
$vtb1=mysql_query("select * from  songs_english where rid='$id'");
$r1=mysql_fetch_object($vtb1);
if($n==1)
{
	?>
	<div id="apDiv1" style="width:627px  !important; "><div align="right"><a href="?Theme_admin=all_mp3&MP3 Management">Close</a></div>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
  <form enctype="multipart/form-data" method="post" role="form">
  <!--<table><tr><td>Song Id</td><td></td><td>Film Id</td><td></td><td>Film Name</td></tr></table>-->
<table width="627" style="margin-top: 10px;" class="dash_count_table" cellspacing="0">
<tr class="tr_th">
<!--<th align="center">Select Page</th>-->

          <th width="100">Song Name</th>
           <th width="100">File Upload</th>
           </tr>
           <tr>
        <td align="left"><div  class="ui-widget">
  <input id="suggestionbox" name="fname" placeholder="Song Name" value="<?php echo $r1->sname; ?>" style="border-radius:5px;" onblur="shwsong(this.value);" required="required"  />
</div></td>
        <div id="rep">
                                  
                                    	
                                    </div>
                                    
                                   
       
        <td><input type="file" name="up" id="up"></td></tr>
  
   <tr><td colspan="8" align="center"> <input type="submit" name="sub" value="Update" /></td></tr>
</table>
<script>
	$(document).ready(function(){
		
		$( "#suggestionbox" ).autocomplete({
			source: "search1.php"
		});
	})
	</script>
</form>  
</div>
</td><?php } ?>


</div>
</div>    