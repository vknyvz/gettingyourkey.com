<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format">
<xsl:output method="html" indent="no"/>
<xsl:strip-space elements="*"/>
	<!--MENU-->
	<xsl:template match="MENU" mode="top">
		<xsl:apply-templates select="MENU-ITEM"  mode="top"/>
	</xsl:template>

	<!--MENU-ITEM-->
	<xsl:template match="MENU-ITEM"  mode="top">
   		<xsl:choose>
           <!-- active menu with link-->
           	<xsl:when test="MENU-ITEM[@ID=/LAYOUT/@ID]" >
				<td><a href="{@HREF}"><img src="images/bullet.gif" border="0" alt=""/></a></td>
				<td width="5"></td>
				<td><a href="{@HREF}" class="amenu"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></a></td>
            </xsl:when>
            <!-- active menu without link-->
            <xsl:when test="MENU-ITEM[@ID=/LAYOUT/@ID] or @ID=/LAYOUT/@ID" >
				<td><a href="{@HREF}"><img src="images/bullet.gif" border="0" alt=""/></a></td>
				<td width="5"></td>
				<td class="amenu"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></td>
            </xsl:when>
            <xsl:otherwise>
				<td><a href="{@HREF}"><img src="images/bullet.gif" border="0" alt=""/></a></td>
				<td width="5"></td>
				<td><a href="{@HREF}" class="menu"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></a></td>
            </xsl:otherwise>
	    </xsl:choose>
		<xsl:if test="position()!=last()">
			<td width="30"><div style="width:5px; height:1px;"><spacer type="block" width="5" height="1"/></div></td>
	</xsl:if>
	</xsl:template>	

</xsl:stylesheet>
