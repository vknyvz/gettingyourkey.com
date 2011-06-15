<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format">
<xsl:output method="html" indent="no"/>
<xsl:strip-space elements="*"/>

<xsl:template match="MENU" mode="top">
	<xsl:apply-templates select="MENU-ITEM"  mode="top"/>
</xsl:template>

<xsl:template match="MENU-ITEM"  mode="top">
	<xsl:choose>
		<xsl:when test="MENU-ITEM[@ID=/LAYOUT/@ID]">
			<td><a href="{@HREF}" class="amenu"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></a></td>
		</xsl:when>
		
		<xsl:when test="MENU-ITEM[@ID=/LAYOUT/@ID] or @ID=/LAYOUT/@ID">
			<td class="amenu"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></td>
		</xsl:when>	

		<xsl:otherwise>
			<td><a href="{@HREF}" class="menu"><xsl:value-of select="@TITLE" disable-output-escaping="yes"/></a></td>
		</xsl:otherwise>
	</xsl:choose>
	<xsl:if test="position()!=last()">
		<td style="padding: 2 19 0 18;"><img src="images/bullet.gif" width="6" height="8" alt="" border="0"/></td>
	</xsl:if>
</xsl:template>
</xsl:stylesheet>	
	
