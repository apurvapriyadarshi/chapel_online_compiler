<html>
 <head>
 	<title>TRY CHAPEL ONLINE</title>
 </head>
 <body>
  <div style="background-color:Silver;padding-top:0px;margin-top:0px">
    <h3 style="text-align:center">Online Chapel Compiler<h3>
    <hr>
  </div>
<h5><a href="index.php">New File</a><h5>
   <form action="index.php" id="usrform" method=POST>
      <textarea style="margin-left:40px; width:675px; height:445px" name="prog"  form="usrform" value="code" rows="30" cols="50"><?php if(isset($_POST['prog'])) echo $_POST['prog'];?></textarea>
      <input type="submit" value="Compile">
   </form>
<br>
<?php
error_reporting(E_ALL|E_STRICT); 
ini_set('display_errors', true);
$a=rand();
$name="untitled".$a;
$data=isset($_POST['prog'])?$_POST['prog']:"";
$prog=basename($name).'.chpl';
file_put_contents($prog,$data);
chmod("$prog",0777);
putenv("CHPL_HOME=/home/apurva/chapel-1.12.0");
exec('chpl -o "'.$name.'" "'.$prog.'" 2>&1',$outputcmd,$return);
$out=shell_exec('./"'.$name.'"');
//echo $out;
?>

<h5 style="padding-left:40px">OUTPUT</h5>
   <textarea style="margin-left:40px; width:675px;height:200px" name="output" value="output">
<?php if(!$return)
       { 
       echo $out; 
       }
      else 
       {
       foreach($outputcmd as $val)
         echo $val;
       }
?>
   </textarea>
<h5>Note:- Some errors are likely to be generated if you submit an empty file<h5>  
 </body>
</html>
