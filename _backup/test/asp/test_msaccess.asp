<%@ Language=VBScript%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<%

mes = ""
IsSuccess = false
sFile = Trim(Request.Form("txtFile"))
sUser = Trim(Request.Form("txtUser"))

if Request("__action")="TestDB" then
	TestDB()	
end if

Sub TestDB()


    sPassword = Trim(Request.Form("txtPassword"))
    
	Err.Clear()    
	on error resume next    
	FilePath = Server.MapPath(sFile)
    if len(Err.Description)=0 then

		Set objConn = Server.CreateObject("ADODB.Connection")
		if len(Err.Description)<>0 then 
			mes = " " & Err.Description & " MS Access connection can't be established!"
		else
			objConn.ConnectionString = _      
			"PROVIDER=Microsoft.Jet.OLEDB.4.0;DATA SOURCE=" & FilePath & _  
			";User ID=" & sUser & _
			";Password=" & sPassword
			objConn.Open
			if len(Err.Description)<>0 then 
				mes = " " & Err.Description & " MS Access connection can't be established!"
			else
				mes = " MS Access connection succesfull established!"
				IsSuccess = true
			end if
		end if
	else
		mes = " " & Err.Description
	end if
	Set objConn = Nothing
End sub

Sub Alert(html)
	if IsSuccess then
		Response.Write "<div class='testRelults' id='testSuccessful'><span class='testResult'>Success:</span>" & html & "</div>"
	else
		Response.Write "<div class='testRelults' id='testFailed'><span class='testResult'>Fail:</span>" & html & "</div>"
	end if
End Sub
%>
<html>
<head>
    <title>ASP test page.</title>
    <meta name=vs_targetSchema content="http://schemas.microsoft.com/intellisense/ie5">
    <link rel="stylesheet" type="text/css" href="/css/winxp.blue.css" />
    <link rel="stylesheet" type="text/css" href="/css/tabs.css" />
    <style>
    .hidden{
        display: none;
    }
    </style>
</head>
<body>
<div class="screenLayout">
    <form id="form1" action="test_msaccess.asp?__action=TestDB&tp=<%= rnd(1)*100*timer %>" method="POST" >
        <input id="__action" type="hidden" value="" />
        <!--**<HEADER>*******************************************************************************************************-->
<div class="headerContainer">
	<div class="pageHeader">
		<div>
			<a target="_blank" href="http://www.swsoft.com/plesk/" title="Plesk&trade;" class="topLogo"><img src="/img/common/logo.gif" name="logo" height="50" border="0" width="210" title="Plesk&trade;"></a>
			<div id="topTxtBlock">
			    <span id="topCopyright"><a href="http://www.swsoft.com" target="_blank">&copy; Copyright 1999-2007 SWsoft<br /> All rights reserved</a></span>
			</div>
		</div>
	</div>
</div>
        <!--**</HEADER>******************************************************************************************************-->
        <!--**<CONTENT>******************************************************************************************************-->
        <div class="contentLayout">
            <div class="contentContainer">
                <div class="pageContent">
                    <div class="pathBar">
                        <a href="/index.html">Site Home Page</a> &gt;</div>
                    <div class="screenTitle">
                        ASP possibilities test page</div>
                    <br />
                    <div id="screenTabs">
                        <div id="tabs">
					    <ul>
						    <li class="first"><a href="test_mysql.asp"><span>MySQL</span></a></li>
						    <li><a href="test_mssql.asp"><span>MSSQL</span></a></li>
						    <li id="current"><a href="test_msaccess.asp"><span>MS Access</span></a></li>
						    <li class="last"><a href="test_mail.asp"><span>E-Mail</span></a></li>
					    </ul>
				    </div>
                    </div>
                    <!-- MySQL server -->
                    <div class="tabContent">
                        <div class="formContainer">
                        <p>Here you can test the connection possibility with the Microsoft Access server.</p>
                            <% if len(mes) > 0 then	Alert(mes) end if %>
                            <fieldset>
                                <legend id="LegendName">Test MS Access Connection</legend>
                                <p>
                                        <table class="formFields" cellspacing="0" width="100%">
                                            <tr>
                                                <td class="name">
                                                    <label for="txtFile">
                                                        File</label></td>
                                                <td>
                                                    <input type = text name="txtFile" size = "25" value = "<% if len(sFile) then Response.Write(sFile) end if %>">
                                                    </td>
                                            </tr>
                                            <tr>
                                                <td class="name">
                                                    <label for="txtUser">
                                                        User name</label></td>
                                                <td>
                                                    <input type = text name="txtUser" size="25" value ="<% Response.Write(sUser) %>"></td>
                                            </tr>
                                            <tr>
                                                <td class="name">
                                                    <label for="txtPassword">
                                                        Password</label></td>
                                                <td>
                                                    <input type = password  name="txtPassword" size="25"></td>
                                            </tr>
                                        </table>
                                </p>
                            </fieldset>
                            <div class="buttonsContainer">
                                <div class="commonButton" id="DBTestButton" title="Test">
                                    <button type="submit" name="bname_ok">
                                        Test</button><span>Test</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**</CONTENT>*****************************************************************************************************-->
    </form>
<div class="footerContainer">
	<div class="footDescription">This page is autogenerated by <a target="_blank" href="http://www.swsoft.com/en/products/plesk/">Plesk</a>&trade;</div>
	<div class="poweredBy"><a target="_blank" href="http://www.swsoft.com/en/products/plesk/"><img src="/img/common/pb_plesk.gif" title="Plesk&trade;"/></a></div>
	<div class="poweredBy"><a target="_blank" href="http://www.swsoft.com/en/products/virtuozzo/"><img src="/img/common/pb_virt.gif" title="Virtuozzo&trade;"/></a></div>
</div>
</div>
</body>
</html>
