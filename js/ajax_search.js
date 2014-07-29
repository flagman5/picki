/*
	This is the JavaScript file for the AJAX Suggest Tutorial

	You may use this code in your own projects as long as this 
	copyright is left	in place.  All code is provided AS-IS.
	This code is distributed in the hope that it will be useful,
 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	
	For the rest of the code visit http://www.DynamicAJAX.com
	
	Copyright 2006 Ryan Smith / 345 Technical / 345 Group.	

*/
//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject() {
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

//Our XmlHttpRequest object to get the auto suggest
var searchReq = getXmlHttpRequestObject();

//Called from keyup on the search textbox.
//Starts the AJAX request.
function searchSuggest(event) {
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		var str = escape(document.getElementById('txt1').value);
		searchReq.open("GET", 'searchSuggest.php?search=' + str, true);
		searchReq.onreadystatechange = handleSearchSuggest; 
		searchReq.send(null);
		
	}

}

//Called when the AJAX response is returned.
function handleSearchSuggest() {
	if (searchReq.readyState == 4) {
		var ss = document.getElementById('search_suggest')
		ss.innerHTML = '';
		var str = searchReq.responseText.split("\n");
		if(str == '') {
			document.getElementById('search_suggest').style.display = 'none';
		}
		else {
			ss.style.display = 'block';
		}
		for(i=0; i < str.length - 1; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearch(this.innerHTML); showPics(this.innerHTML);" ';
			suggest += 'class="suggest_link">' + str[i] + '</div>';
			ss.innerHTML += suggest;
		}
	}

}

//Mouse over function
function suggestOver(div_value) {
	var parent = document.getElementById("search_suggest");
	for (var i = 0; i < parent.childNodes.length; i++) {
		if (
			parent.childNodes[i].style.backgroundColor == "#3366cc" ||
			parent.childNodes[i].style.backgroundColor == "rgb(51, 102, 204)"
			) {
			parent.childNodes[i].style.backgroundColor = "";
		}
	}
	div_value.className = 'suggest_link_over';
}
//Mouse out function
function suggestOut(div_value) {
	div_value.className = 'suggest_link';
}
//Click function
function setSearch(value) {
	document.getElementById('txt1').value = value;
	document.getElementById('search_suggest').innerHTML = '';
	document.getElementById('search_suggest').style.display = 'none';
}
function down_arrow()
{
	var cursor = getCursor();
	var parent = document.getElementById("search_suggest");

		if (cursor != -1)
		{
			if (cursor == parent.childNodes.length) {
				parent.childNodes[0].style.backgroundColor = "#3366CC";
				document.getElementById('txt1').value = parent.childNodes[0].innerHTML;
			}
			else if (cursor < parent.childNodes.length - 1)
			{
				parent.childNodes[cursor].style.backgroundColor = "";
				parent.childNodes[cursor + 1].style.backgroundColor = "#3366CC";
				document.getElementById('txt1').value = parent.childNodes[cursor + 1].innerHTML;
			}
		}
}
function up_arrow()
{
	var cursor = getCursor();
	var parent = document.getElementById("search_suggest");

		if (cursor > 0) {
				parent.childNodes[cursor].style.backgroundColor = "";
				parent.childNodes[cursor - 1].style.backgroundColor = "#3366CC";
				document.getElementById('txt1').value = parent.childNodes[cursor - 1].innerHTML;
		}
}
function getCursor()
{
	if (document.getElementById("search_suggest").innerHTML.length == 0)
	return -1;

	var parent = document.getElementById("search_suggest");
	var current = parent.childNodes.length;

	for (var i = 0; i < parent.childNodes.length; i++) {
		if (
			parent.childNodes[i].style.backgroundColor == "#3366cc" ||
			parent.childNodes[i].style.backgroundColor == "rgb(51, 102, 204)"
			) {
			current = i;
		}
	}
	
	return current;
}