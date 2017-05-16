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

</STYLE>		
</head>

<?php 
	include_once('../wp.custom.src/pfl.php');
	include_once('../wp.custom.src/pfl.survey.cmn.php');
	include_once('../wp.custom.src/pfl.survey.intro.php');
	include_once('../wp.custom.src/pfl.survey.question.parts.php');
	include_once('../wp.custom.src/pfl.survey.topics.php');
	include_once('../wp.custom.src/pfl.survey.analysis.php');
	include_once('../wp.custom.src/pfl.survey.summary.php');
	include_once('../wp.custom.src/pfl.survey.dreamsheet.php');
?>
<link rel="stylesheet" href="../wp.custom.css/pfl.css" type="text/css">

<style>
#introTable td{width:150px;}

#pflSurveyNavTbl{width:500px;}
#pflSurveyNavLeft{text-align:left;width:100px;}
#pflSurveyNavRight{text-align:right;width:100px;}

#survAnalysisTable{width:300px; border-collapse: collapse; border: 1px solid black;}
#survAnalysisTable th{ border: 2px solid black; text-align: center; padding: 5px; vertical-align:middle;}
#survAnalysisTable td{ border: 2px solid black;  padding: 0px; font-size:10px;}

#topicsLists div{width:800px; border-collapse: collapse; border: 0px solid black;}
#topicsLists #topicTitle{font-weight:bold;font-size:14pt;}
#topicsLists #topicInstr{font-style:italic;font-size:12pt;color:blue;}
#topicsLists #topicYC{font-style:underline;font-weight:bold;font-size:13pt; color:green;} 
#topicsLists #topicYCQ{font-style:italic;font-size:12pt;}


#summaryInfoDiv{ width:700px; border-collapse: collapse; border: 1px solid black; padding:10px;}
#summaryInfoDiv th{text-align: left;font-weight:bold; padding:5px;}

#summaryInfoLikesDiv{ width:700px; border-collapse: collapse; border: 1px solid black; padding:10px;}
#summaryInfoLikesDiv th{text-align: left;font-weight:bold; padding:5px;}

#summaryInfoTopicsDiv{ width:700px; border-collapse: collapse; border: 1px solid black; padding:10px;}
#summaryInfoTopicsDiv th{text-align: left;font-weight:bold; padding:5px;}

#summaryInfoDislikesDiv{ width:700px; border-collapse: collapse; border: 1px solid black; padding:10px;}
#summaryInfoDislikesDiv th{text-align: left;font-weight:bold; padding:5px;}


#rootDreamDiv{position:relative; top:-350px; left:-20px;} 

p.breakhere {page-break-before: always;page-break-inside: avoid;}

</style>

<?php
   /*if(isset($_GET['printSel']))
   {
     if($printSel=="sum"){echo '<body class="claro" style="font-family:Calibri;" onload="cleanSummarySheet();">';}
     if($printSel=="dream"){echo '<body class="claro" style="font-family:Calibri;" onload="cleanDreamSheet();">';}
   }
   else{ echo '<body class="claro" style="font-family:Calibri;">';}*/
?>
<body class="claro" style="font-family:Calibri;" onload="cleanPrint();">


<div style="position:absolute; left:20px; top: 10px;">
<span style="color:red;font-size:14pt;">POSSIBILITIES FOR LEARNING</span><br>
<table width="700px;">
 <tr>
  <td>
   <span style="font-size:10pt;">Lannie Kanevsky, Ph.D.<br>&copy; 2011 - Version 3</span>	
   <br><br>
  </td>
  <td></td>
 </tr>
</table>

<br>
<?php
 $printSel="";
 if(isset($_GET['printSel'])){$printSel=$_GET['printSel'];} 
 if($printSel=="quest")
 {
  for($survPart=0;$survPart<=5;$survPart++)
  {
   echo '<div id="surveyPartInstructions" style="width:800px;">';
   echo buildSurveyInstructionsForPrint('../wp.static/pfl.survey.partsInstructions.txt',$survPart);
   echo '</div><br><br>';

   echo '<div id="surveyPartQuestions">';
   if($survPart==0){buildoutIntro();}
   elseif($survPart==5){buildoutTopics('../wp.static/pfl.lists.txt');}
   else{buildoutQuestions($survPart,'../wp.static/pfl.questions.txt');}
   echo '</div><br><br>';  
  }
 }
 elseif($printSel=="strats"){buildoutAnalysis('../wp.static/pfl.survey.codes.txt','../wp.static/pfl.questions.txt');}
 elseif($printSel=="sum"){buildoutSummary('../wp.static/pfl.questions.txt');}
 elseif($printSel=="dream"){buildoutDreamSheet('../wp.static/pfl.questions.txt','../wp.images');}
 else
 {
   echo '<div id="surveyPartInstructions" style="width:800px;">';  
   echo 'Please return to the survey and select the item that you would like to print.'; 
   echo '</div><br><br>';
 }
?>

</div>
<script>


 function cleanPrint()
 {
   //alert(document.URL);
   if(document.URL.indexOf('printSel=sum')!=-1){cleanSummarySheet();}
   if(document.URL.indexOf('printSel=dream')!=-1){cleanDreamSheet();}
   if(document.URL.indexOf('printSel=quest')!=-1){cleanSurvey();}
 } 

 function cleanSurvey()
 {
  allInput=document.getElementsByTagName('input');
  for(i=0;i<allInput.length;i++)
  { 
    inputObj=allInput[i];
    inputObj.setAttribute("disabled", true);
  }
}


 function cleanDreamSheet()
 {
  allSelect=document.getElementsByTagName('select');
  for(i=0;i<allSelect.length;i++)
  { 
    selObj=allSelect[i];
    selObj.style.display="none";
    //alert(selObj.options[selObj.selectedIndex].text);
    curSelText=selObj.options[selObj.selectedIndex].text;
    curParentNode=selObj.parentNode;
    //curParentNode.removeChild(selObj);
    curParentNode.innerHTML=curParentNode.innerHTML+"<br>"+curSelText;
  }
 
  allTextArea=document.getElementsByTagName('textarea');
  for(i=0;i<allTextArea.length;i++)
  { 
    selObj=allTextArea[i];
    selObj.style.display="none";
    curSelText=selObj.value;
    curParentNode=selObj.parentNode;
    //curParentNode.removeChild(selObj);
    curParentNode.innerHTML=curParentNode.innerHTML+"<br>"+curSelText;
    curParentNode.style.textAlign="left";
    curParentNode.style.width="200px";
  }

  allDiv=document.getElementsByTagName('div');
  for(i=0;i<allDiv.length;i++)
  { 
    selObj=allDiv[i]; 
    clickableDiv=selObj.getAttribute('onclick');
    if(clickableDiv!=null)
    {
      //alert(clickableDiv);
      allImg=selObj.getElementsByTagName('img');
      for(j=0;j<allImg.length;j++)
      {
        allImg[j].parentNode.removeChild(allImg[j]);
      }
    }
  }  
 }


 function cleanSummarySheet()
 {
  allSelect=document.getElementsByTagName('select');
  for(i=0;i<allSelect.length;i++)
  { 
    selObj=allSelect[i];
    selObj.style.display="none";
    curSelText=selObj.options[selObj.selectedIndex].text;
    curParentNode=selObj.parentNode;
    curParentNode.innerHTML=curParentNode.innerHTML+"<br>"+'<div style="border:1px solid black;padding:5px;">'+curSelText+'</div>';
  }
  document.body.innerHTML = document.body.innerHTML.replace('Select two favorite topics, one from each dropdown list', 'My two favorite topics are:');
  document.body.innerHTML = document.body.innerHTML.replace('Select two favorite ways to learn from the dropdown list', 'My two favorite ways to learn are:');
  document.body.innerHTML = document.body.innerHTML.replace('Select two favorite ways to show your learning from the dropdown list', 'My two favorite ways to show my learning are:');
}

</script>
</body>
</html>
<!-- END OF HTML PAGE -->

<?php
function cleanForPrint($htmlStr)
{
  $cleanStr=$htmlStr;
  $cleanStr=selectToText($cleanStr);
  $cleanStr=textAreaToText($cleanStr);
  $cleanStr=removeButtons($cleanStr);
  return  $cleanStr; 
}

function selectToText($htmlStr) //turn selected value in a select box to text in a span
{
 $selArray=explode("<select",$htmlStr);
 //for(
  
 return $htmlStr;
}

function textAreaToText($htmlStr) //turn content of a text area into a formatted div
{

 return $htmlStr;
}

function removeButtons($htmlStr) //remove any button controls to disallow changing the information to print
{

 return $htmlStr;
}

?>

