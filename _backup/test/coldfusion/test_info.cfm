<html>
<body leftMargin=0 topMargin=0 marginwidth=0 marginheight=0 bgcolor=white>
	<style type="text/css">
		table { background-color:white; color:black;font: 10pt verdana, arial; }
		table { font: 10pt verdana, arial; cellspacing:0; cellpadding:0; margin-bottom:25}
		tr.subhead { background-color:cccccc;}
		th { padding:0,3,0,3 }
		th.alt { background-color:black; color:white; padding:3,3,2,3; }
		td { padding:0,3,0,3 }
		tr.alt { background-color:eeeeee }
		h1 { font: 24pt verdana, arial; margin:0,0,0,0}
		h2 { font: 18pt verdana, arial; margin:0,0,0,0}
		h3 { font: 12pt verdana, arial; margin:0,0,0,0}
		th a { color:darkblue; font: 8pt verdana, arial; }
		a { color:darkblue;text-decoration:none }
		a:hover { color:darkblue;text-decoration:underline; }
		div.outer { width:90%; margin:15,15,15,15}
		table.viewmenu td { background-color:006699; color:white; padding:0,5,0,5; }
		table.viewmenu td.end { padding:0,0,0,0; }
		table.viewmenu a {color:white; font: 8pt verdana, arial; }
		table.viewmenu a:hover {color:white; font: 8pt verdana, arial; }
		a.tinylink {color:darkblue; font: 8pt verdana, arial;text-decoration:underline;}
		a.link {color:darkblue; text-decoration:underline;}
		div.buffer {padding-top:7; padding-bottom:17;}
		.small { font: 8pt verdana, arial }
		table td { padding-right:20 }
		table td.nopad { padding-right:5 }
	</style>
<table cellspacing="0" cellpadding="0" border="0" style="width:100%;border-collapse:collapse;">
<tr>
</tr><tr class="subhead" align="Left">
<th>Name</th><th>Value</th>
</tr>
<cfoutput><tr class=normal><td>SERVER_SOFTWARE</td><td>#CGI.SERVER_SOFTWARE#</td></tr></cfoutput>
<cfoutput><tr class=alt><td>SERVER_NAME</td><td>#CGI.SERVER_NAME#</td></tr></cfoutput>
<cfoutput><tr class=normal><td>GATEWAY_INTERFACE</td><td>#CGI.GATEWAY_INTERFACE#</td></tr></cfoutput>
<cfoutput><tr class=alt><td>SERVER_PROTOCOL</td><td>#CGI.SERVER_PROTOCOL#</td></tr></cfoutput>
<cfoutput><tr class=normal><td>SERVER_PORT</td><td>#CGI.SERVER_PORT#</td></tr></cfoutput>
<cfoutput><tr class=alt><td>REQUEST_METHOD</td><td>#CGI.REQUEST_METHOD#</td></tr></cfoutput>
<cfoutput><tr class=normal><td>PATH_INFO</td><td>#CGI.PATH_INFO#</td></tr></cfoutput>
<cfoutput><tr class=alt><td>PATH_TRANSLATED</td><td>#CGI.PATH_TRANSLATED#</td></tr></cfoutput>
<cfoutput><tr class=normal><td>SCRIPT_NAME</td><td>#CGI.SCRIPT_NAME#</td></tr></cfoutput>
<cfoutput><tr class=alt><td>QUERY_STRING</td><td>#CGI.QUERY_STRING#</td></tr></cfoutput>
<cfoutput><tr class=normal><td>REMOTE_HOST</td><td>#CGI.REMOTE_HOST#</td></tr></cfoutput>
<cfoutput><tr class=alt><td>REMOTE_ADDR</td><td>#CGI.REMOTE_ADDR#</td></tr></cfoutput>
<cfoutput><tr class=normal><td>AUTH_TYPE</td><td>#CGI.AUTH_TYPE#</td></tr></cfoutput>
<cfoutput><tr class=alt><td>REMOTE_USER</td><td>#CGI.REMOTE_USER#</td></tr></cfoutput>
<cfoutput><tr class=normal><td>AUTH_USER</td><td>#CGI.AUTH_USER#</td></tr></cfoutput>
<cfoutput><tr class=alt><td>REMOTE_IDENT</td><td>#CGI.REMOTE_IDENT#</td></tr></cfoutput>
<cfoutput><tr class=normal><td>CONTENT_TYPE</td><td>#CGI.CONTENT_TYPE#</td></tr></cfoutput>
<cfoutput><tr class=alt><td>CONTENT_LENGTH</td><td>#CGI.CONTENT_LENGTH#</td></tr></cfoutput>
<cfoutput><tr class=normal><td>HTTP_REFERER</td><td>#CGI.HTTP_REFERER#</td></tr></cfoutput>
<cfoutput><tr class=alt><td>HTTP_USER_AGENT</td><td>#CGI.HTTP_USER_AGENT#</td></tr></cfoutput>
<cfoutput><tr class=normal><td>HTTP_IF_MODIFIED_SINCE</td><td>#CGI.HTTP_IF_MODIFIED_SINCE#</td></tr></cfoutput>
</table></body>
</html>
