use ExtUtils::Installed;
my ($inst) = ExtUtils::Installed->new();
my (@modules) = $inst->modules();
print "Content-type: text/html", "\n\n";
print <<END_of_Multiline_Text;
	<html>\n<body leftMargin=0 topMargin=0 marginwidth=0 marginheight=0 bgcolor=white>
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
<th>Name</th><th align=right>Version</th>
</tr>
END_of_Multiline_Text

for (my $i=0; $i<scalar(@modules); $i++) {
   my $version = $inst->version($modules[$i]) || "???";
   my $class = ($i % 2) ? "alt" : "normal";
   print "<tr class=$class><td valign=top>$modules[$i]</td>\n";
   print "<td valign=top align=right class=alt>$version</td></tr>\n";
}
print "</table></body></html>";
