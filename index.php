<html>
 <head>
        <title>TRY CHAPEL ONLINE</title>
         <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
 <nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Online Chapel Compiler</a>
    </div>
  </div>
</nav>
<h5 style="padding:10px;padding-left:40px"><a href="index.php">New File</a><h5>
   <form action="index.php" id="usrform" method=POST>
      <textarea style="margin-left:40px; width:675px; height:445px;resize:none;" spellcheck="false" name="prog"  form="usrform" value="code" rows="30" cols="50"><?php if(isset($_POST['prog'])) echo $_POST['prog'];?></textarea>
    <input style="padding:2px" type="submit" value="Compile">
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
putenv("CHPL_HOME=/home/ubuntu/chapel-1.12.0");
exec('chpl -o "'.$name.'" "'.$prog.'" 2>&1',$outputcmd,$return);
$out=shell_exec('./"'.$name.'"');
//echo $out;
?>

<h5 style="padding-left:40px">OUTPUT</h5>
   <textarea style="margin-left:40px; width:675px;height:200px;resize:none;" name="output" value="output" disabled>
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
            
