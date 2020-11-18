	<html>
    <head>
	<title>Bleep Blop</title>
	<style>
	
	#input{
	width: 500px;
	height:200px;
	border: 1px solid black;
	float:left;
	//text-align:center;
    overflow:scroll;
    word-wrap: break-word;
     font-size: 16px;

	}
	
	body{
		  position: fixed;
  top: 10%;
  left: 40%;
  margin-top: -50px;
  margin-left: -100px;
		
	}
	
	#output{
	width: 500px;
	height:200px;
	background-color: white;
	border: 1px solid black;
	float:left;
    overflow:scroll;
    word-wrap: break-word;

	}
	
	
	
	</style>
	</head>
	
	<h1 style="text-align:center;">Bleep&#128584;Blop</h1>
	<body style="background-color:#C8C8C8;">
	<form action="index.php" method="post">
	<input id="input" type="text" name="mess" value="" autocomplete="off"><br>
	<input type="submit" id="mid "value="censor it">
	</form>
	
	
	<?php 
	$list=file_get_contents("profan.txt");
	$exem = array("whole", "will", "other","mother","long","fell","best","face","star","ones","horn","chin","lock","full","test","phone","head");  //false alarms 
  /*  $arr= explode("\n",$list);

    for($i=0; $i < count($arr); $i++)
    {
    if(strlen($arr[$i]) == 3)
	file_put_contents("three.txt", $arr[$i]."\n", FILE_APPEND);
    }
    ?> */
    
    $newlist=file_get_contents("three.txt");
    $exem2= explode("\n",$newlist);
    
	if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['mess']) AND !empty($_POST['mess'])){
	$mess=$_POST['mess'];
	$me=explode(" ",$mess);
    $length = count($me);
	$sensored='';
    $melow = array();
	for ($i = 0; $i < $length; $i++)
		
		{
            $melow[$i] = strtolower($me[$i]);	
			$me2[$i] = preg_replace('/[^A-Za-z0-9\-]/', '', $melow[$i]);
			if(strlen($me2[$i]) >= 4){									
			$me3[$i] = "/$me2[$i]/";
			if(preg_match($me3[$i], $list)==1){                       
			if(!in_array($me2[$i], $exem)){											
			$me[$i]="<strike><d style = opacity:20%>".$me[$i]."</d></strike>"; 
            //$me[$i] = str_repeat("*", strlen($me[$i]));
				}
				}
				} else if(in_array($me2[$i], $exem2)){
					$me[$i]="<strike><d style = opacity:20%>".$me[$i]."</d></strike>"; 
				}	
		$sensored .= "$me[$i]"." ";
		}
		
		echo "<div id=output>$sensored</div>"; 
        echo "<form action=index.php method=post>
	<input type=submit name=clean value=clear>
	</form>";
		
	}//else echo"c'mon";	
	}	
	?>
    
 

<?php
if(isset($_POST['clean']))
$sensored='';
?>		
  </body>
	</html>