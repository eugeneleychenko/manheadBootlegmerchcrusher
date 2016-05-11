function validatemail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function validateurl(url)
{
     return url.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
}

function ajaxvalue(url,data,showid)
{
    var dataString = data;
	$.ajax({
			type: "POST",
			url: "url",
			data:dataString,
			cache: false,
			beforeSend: function() 
			{
				
			},
			success: function(response) 
			{
			
			document.getElementById(showid).value=response;
			}
		   });
    
    
    
    
}
function ajaxhtml(url,data,showid)
{
    var dataString = data;
	$.ajax({
			type: "POST",
			url: "url",
			data:dataString,
			cache: false,
			beforeSend: function() 
			{
				
			},
			success: function(response) 
			{
			
			document.getElementById(showid).innerHtml=response;
			}
		   });
    
    
    
    
}
function ajaxalert(url,data)
{
    var dataString = data;
	$.ajax({
			type: "POST",
			url: "url",
			data:dataString,
			cache: false,
			beforeSend: function() 
			{
				
			},
			success: function(response) 
			{
			
			alert(response);
			}
		   });
}
function ajaxdata()
{ alert("hi");
    var datastring= '{';
   for (var i = 0; i < arguments.length; i++) 
    { if(i==0)
        { datastring= datastring.concat('"'+arguments[i]+'"');}
    else if((i%2)==0)
    { datastring=datastring.concat(',"'+arguments[i]+'"');}
       else if((i%2)==1)
       { datastring= datastring + ':"'+arguments[i]+'"';
       }
    }
    datastring= datastring+'}';
   alert(datastring);
    
    
}



