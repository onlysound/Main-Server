var xmlhttp;

	function showlink(song_id) {
		xmlhttp=GetXmlHttpObject();
		if (xmlhttp==null){
  			alert ("Browser does not support HTTP Request");
  			return;
  		}
		var url="linker.php";
		url=url+"?ss="+song_id;
		xmlhttp.onreadystatechange=stateChanged;
		xmlhttp.open("GET",url,true);
		xmlhttp.send(null);
	}

	function stateChanged(){
		if (xmlhttp.readyState==4){
			alert(xmlhttp.responseText);
		}
	}

	function GetXmlHttpObject(){
		if (window.XMLHttpRequest){
		  	return new XMLHttpRequest();
		  }
		if (window.ActiveXObject){
		  	return new ActiveXObject("Microsoft.XMLHTTP");
		}
		return null;
	}