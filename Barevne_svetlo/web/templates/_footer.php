
	
	<!-- zápatí -->
	<div id="footer">
		<table><tr>
		<td width="478"><p>© Lenka Převorovská - <a href="http://www.barevne-svetlo.cz" 
			title="Šperky z polodrahokamů a korálků - prodejní galerie">Barevné světlo</a> 2011<br>
			Prodejní galerie ručně vyráběných šperků<br>
			<span style="font-size:7pt;">(<a href="/mapa-galerie-sperku.php" title="Mapa stránek galerie Barevné světlo">mapa stránek</a> 
				| využíváme <a href="/google-analytics.php" target="_blank"	title="O službě Google Analytics">Google Analytics)</span></p></td>
		<td><a href="http://www.duhova-kridla.cz" target="_blank" title="Udělejte něco pro své zdraví - Masáže a terapie Lenka Převorovská">
			<img src="<?php echo URL_PIC; ?>banner_duhova-kridla_468x60.jpg" alt="Masáže, terapie, zelené potraviny - Lenka Převorovská Duhová křídla" width="468" height="60"></a></td>
		<!-- vyňuňali Mik a Lajma, Londýn 2011 -->
		</tr></table>
	
		
		<!-- Facebook like button code -->
		<iframe src="http://www.facebook.com/plugins/like.php?locale=cs_CZ&amp;href=http%3A%2F%2Fwww.barevne-svetlo.cz&amp;send=false&amp;layout=button_count&amp;width=130&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=20" 
			scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:130px; height:25px; position:absolute; top:12px; left:340px;" allowTransparency="true"></iframe>
	
		<!-- Place this tag where you want the +1 button to render -->
		<table style="position: absolute; top: 40px; left: 340px;"><tr><td>
			<g:plusone size="medium" annotation="bubble" width="120" href="http://www.barevne-svetlo.cz"></g:plusone>
		</td></tr></table>

		<!-- Place this render call where appropriate -->
		<script type="text/javascript">
  			window.___gcfg = {lang: 'cs'};

  			(function() {
    			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    			po.src = 'https://apis.google.com/js/plusone.js';
    			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  			})();
		</script>		

	</div>
	</td><td width="25%"><p>&nbsp;</p></td></tr></table>
	
	<!-- preload :hover images for menus and buttons -->
	<div id="preload_images">
		<img src="<?php echo URL_PIC; ?>menu_uvod_a.jpg" width="1" height="1">
		<img src="<?php echo URL_PIC; ?>menu_o_autorce_a.jpg" width="1" height="1">
		<img src="<?php echo URL_PIC; ?>menu_obchod_a.jpg" width="1" height="1">
		<img src="<?php echo URL_PIC; ?>menu_kontakt_a.jpg" width="1" height="1">
		<img src="<?php echo URL_PIC; ?>menu_help_a.jpg" width="1" height="1">
		<img src="<?php echo URL_PIC; ?>button_hledej_a.jpg" width="1" height="1">
		<img src="<?php echo URL_PIC; ?>button_zobraz_a.jpg" width="1" height="1">
	</div>
</body>
</html>

<?php mysql_close($con); ?>