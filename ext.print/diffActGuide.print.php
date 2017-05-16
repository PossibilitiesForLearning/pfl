<?php include_once('../wp.custom.src/xmlfuncs.php'); ?>
<html>
<head>
		<meta http-equiv="X-UA-Compatible" content="chrome=1"/> 	
   		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />	
		<link rel="stylesheet" href="../wp.custom.css/pfl.css" type="text/css">
		<link rel="stylesheet" href="../wp.custom.css/brDefaults.css" type="text/css">	
		<!--[if IE]>
		<link rel="stylesheet" href="./css/brIEOverrides.css" type="text/css">	
		<![endif]-->		
		
<STYLE TYPE="text/css">
     p.breakhere {page-break-before: always;page-break-inside: avoid;}
</STYLE>		
	</head>
	<body class="claro" style="font-family:Calibri;">	

<div style="position:absolute; left:20px; top: 10px;">
<table>
<tr>
<td valign="middle"><font style="font-size:13pt;"><b>Guide for Selecting Differentiation Strategies for High Ability Learners</b></font></td>
</tr>
</table>

<div style="position:absolute; left:750px; top: 25px;" z-index="0"><img width="175px" src="../wp.images/page.diffStratGuide/schoolsupplies.jpg"  ></div>

<br>
<div id="divIndicatorGuide" >
<table width="725px">
	<tr>
		<td valign="top">
			<b>Date:</b> 
			 <?php echo $_POST['curdate']; ?>			
			<br>
			<b>Name:</b> 
			 <?php echo $_POST['curname']; ?>			
			<br>	
			<b>Grade:</b>
			 <?php echo $_POST['curgrade']; ?>			
		</td>
	
		<td >
			<b>Suggested Strategies:</b><br>
			<?php
				//echo $_POST['topRankList']; 
				setRankedVals($_POST['topRankList']); 
			?>
		</td>	
	</tr>				
	<tr>
		<td colspan="2"><br><b>
<?php
if($_POST['curactivities']!="studIgnore"){echo 'Strengths:';}
else{echo 'Things you LOVE to learn about:';}
?>		
                 </b><br>
			<div style="padding:10px; border:1px solid gray; ">
			 <?php echo str_replace( array("\r\n","\r","\n") , '<br>' , $_POST['curinterests']); ?>
			</div> 			
		</td>
	</tr>
	<tr>
                    <?php
                        if($_POST['curactivities']!="studIgnore")
                        {  
		         echo '<td colspan="2" ><br><b>Dates and descriptions of activities observed:</b><br>';
			  echo '<div  style="padding:10px; border:1px solid gray; ">';
                           echo str_replace( array("\r\n","\r","\n") , '<br>' , $_POST['curactivities']); 
 			  echo '</div>'; 			
 		         echo '</td>';
                        }
                    ?>
	</tr>	
</table>
<br>
<table width="975px"  border="1px" id="matrixTbl" >

 <?php 
 	//chenage the path of the images
 	echo str_replace("\"./wp","\"../wp",$_POST['diffGuideTableString']); 
 ?>

</table>
</div>
<br>
<b>Other Comments:</b><br>

<textarea rows="10" cols="130">
</textarea>
<br><br><br><br>


<p CLASS="breakhere" style="width:810px;">

<?php !include_once('./diffguide/diff.behavs.php')?>
<br><br>
<?php !include_once('./diffguide/diff.strat.descs.php')?>
</p>


</div>

</body>
</html>
<!-- END OF HTML PAGE -->
<script type="text/javascript" >

	window.onload=function(){
		deleteC();	
		setFormat();
		var fulldoc=document.getElementById("matrixTbl");
		fulldoc.innerHTML=fulldoc.innerHTML.replace(/Â/," ");
		//alert(fulldoc.innerHTML);		
	}

function deleteC()
{
	var root = document.getElementById("matrixTbl");//tbody or table - correction if tbody is not present
	var allRows = root.getElementsByTagName('tr');// rows collection in the table
	//var aCells = root.childNode.getElementsByTagName('td')//cells collection in this row
	//for(var j=0;j<aCells.length;j++)
	//{
	//	if(c==aCells[j]){var q=j;break}//gets the index of this cell in this row
	//}
	allRows[0].removeChild(allRows[0].getElementsByTagName('td')[0]);
	for(var i=3;i<allRows.length;i++)
	{
		allRows[i].removeChild(allRows[i].getElementsByTagName('td')[0]);//removes the correspondent cells with the same index in their rows
	}
}

function setFormat()
{
	//alert("here");
	var root = document.getElementById("matrixTbl");//tbody or table - correction if tbody is not present
	var allRows = root.getElementsByTagName('tr');// rows collection in the table

		
		aCells=allRows[2].getElementsByTagName('img');
		//alert(aCells.length);
		for(j=0;j<aCells.length;j++)
		{
			//alert(aCells[j].style.backgroundColor);
			//if(aCells[j].style.backgroundColor=="rgb(153, 255, 153)")
			//{
				//aCells[j].innerHTML='<img src="./images/x-grey.png" width="30px" height="20px"/>';
				//aCells[j].style.backgroundColor="#cccccc";
				//aCells[j].style.backgroundColor="white";
				
			//}
			if(aCells[j].parentNode.parentNode.style.backgroundColor=="rgb(204, 255, 204)")
			{
				greyImg=aCells[j].src.replace(".png", ".grey.png");
				//alert(greyImg);
				aCells[j].src=greyImg;
				aCells[j].parentNode.parentNode.style.backgroundColor="white";
			}
			
		}

	for(var i=0;i<allRows.length;i++)
	{
		aCells=allRows[i].getElementsByTagName('td');
		for(j=0;j<aCells.length;j++)
		{
			   
			//alert(aCells[j].style.backgroundColor);
			if(aCells[j].style.backgroundColor=="rgb(153, 255, 153)")
			{
				aCells[j].innerHTML='<img src="../wp.images/page.diffStratGuide/grey.check.gif" width="30px" height="20px"/>';
				//aCells[j].style.backgroundColor="#cccccc";
				//aCells[j].innerHTML='<font style="font-size:smaller">&nbsp;</font>';
				aCells[j].style.backgroundColor="white";
				
			}
			else if(aCells[j].style.backgroundColor=="rgb(255, 255, 204)")
			{
				//alert(aCells[j].style.backgroundColor);
				//aCells[j].innerHTML='<img src="./images/grey.sqr.png" width="30px" height="20px"/>';
				aCells[j].innerHTML='<font style="font-size:smaller">x</font>';
				aCells[j].style.backgroundColor="white";
			}
			else if(aCells[j].style.backgroundColor=="rgb(204, 255, 204)")
			{
				//aCells[j].innerHTML='<img src="./images/grey.sqr.png" width="30px" height="20px"/>';
				aCells[j].style.backgroundColor="white";
				//aCells[j].innerHTML='<font style="font-size:smaller">0</font>';
			}			
			else
			{
				//alert(aCells[j].style.backgroundColor);
				//aCells[j].innerHTML=aCells[j].innerHTML.replace('&#194;','&nbsp;');
				//aCells[j].innerHTML='<font style="font-size:smaller">0</font>';
			}
			
			
		}
	}
		//alert("here");
}


</script>

<?php

	function setRankedVals($valsList) 
	{
		$diffIndDOC=loadXMLDoc("../wp.static/indicator.matrix.xml");
		$diffRootNode=$diffIndDOC->getElementsByTagName( "DIFFERENTIATION" )->item(0);
		$diffNode=$diffRootNode->getElementsByTagName( "DIFFOPT" );
		//alert("here");
		//print_r(explode(",", $valsList));		
		buildRankedValsView($diffNode,explode(",", $valsList));
	}

	function buildRankedValsView($diffNode,$valsList)
	{
		
		$listView="<ul>";	
		foreach( $diffNode  as $curDiff )
		{
			
			$id=getXMLAttrib($curDiff,"id");			

			for($i=1;$i<=count($valsList);$i++) 
			{
				if($id==$valsList[$i])
				{
					$listView=$listView."<li>";
					$listView=$listView.getXMLAttrib($curDiff,"title");
					//$listView=$listView.'<div style="padding:5px; border:1px solid gray;">'.getXMLAttrib($curDiff,'description').'</div>';
					$listView=$listView."</li>";					
					
				}
			}			
		}
		$listView=$listView."</ul>";				
		echo $listView;
	} 


?>
