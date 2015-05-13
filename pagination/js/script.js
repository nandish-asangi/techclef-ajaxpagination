function getData(page)
{
	if (window.XMLHttpRequest)
  		var x = new XMLHttpRequest();
	else
  		var x = new ActiveXObject("Microsoft.XMLHTTP");

	x.onreadystatechange=function()
  	{
  		if (x.readyState==4 && x.status==200)
    		{
    			document.getElementById("content").innerHTML=x.responseText;
    		}
  	}
  x.open("GET","serverData.php?val="+page,true);
  x.send();
}