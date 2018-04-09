 <?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <body>
  <h2>Assignment-2-Iteration 3</h2>
  
  <h1>Artist</h1>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th style="text-align:left">Name</th>
      <th style="text-align:left">Portrait</th>
	  <th style="text-align:left">Information</th>
	  <th style="text-align:left">Facts</th>
    </tr>
    <xsl:for-each select="category/artist">
    <tr>
      <td><xsl:value-of select="name"/></td>
	  <td><img height="300" width="300">
						<xsl:attribute name="src">
							<xsl:value-of select="imagePath"/>
						</xsl:attribute>
					</img></td>

	  <td><xsl:value-of select="information"/></td>
      <td><xsl:value-of select="facts"/></td>
	  
    </tr>
    </xsl:for-each>
  </table>
  
<h1>Art Work</h1>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th style="text-align:left">Title</th>
      <th style="text-align:left">Portrait</th>
	  <th style="text-align:left">Information</th>
	  <th style="text-align:left">Facts</th>
	  <th style="text-align:left">Price</th>
	  
    </tr>
    <xsl:for-each select="category/artworks">
    <tr>
      <td><xsl:value-of select="name"/></td>
	  <td><img height="300" width="300">
						<xsl:attribute name="src">
							<xsl:value-of select="imagePath"/>
						</xsl:attribute>
					</img></td>

	  <td><xsl:value-of select="shortDescription"/></td>
      <td><xsl:value-of select="longDescription"/></td>
	  <td><xsl:value-of select="price"/></td>
    </tr>
    </xsl:for-each>
  </table>
  
  <h1>Museum</h1>
  <table border="1">
    <tr bgcolor="#9acd32">
      <th style="text-align:left">Name</th>
      <th style="text-align:left">Portrait</th>
	  <th style="text-align:left">Information</th>
	  <th style="text-align:left">Facts</th>
    </tr>
    <xsl:for-each select="category/museums">
    <tr>
      <td><xsl:value-of select="name"/></td>
	  <td><img height="300" width="300">
						<xsl:attribute name="src">
							<xsl:value-of select="imagePath"/>
						</xsl:attribute>
					</img></td>

	  <td><xsl:value-of select="shortDescription"/></td>
      <td><xsl:value-of select="longDescription"/></td>
	  
    </tr>
    </xsl:for-each>
  </table>
  
  </body>
  </html>
</xsl:template>

</xsl:stylesheet> 
