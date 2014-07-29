function showPics(str)
{
if (str.length==0)
  { 
  document.getElementById("results").innerHTML="";
  return;
  }
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
var url="getpics.php";
url=url+"?q="+str;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}

function stateChanged() 
{ 
if (xmlHttp.readyState==4)
{ 
	document.getElementById("results").innerHTML=xmlHttp.responseText;
}
 else {
	document.getElementById("results").innerHTML='<img src="images/working.gif"><br/> Searching...';
  }
}

function sign() {

	 var content = document.getElementById("signin_box");

       if (content.style.display == "none") content.style.display = "block";

		else content.style.display = "none";

}