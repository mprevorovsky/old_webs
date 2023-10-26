<?php 
	include_once($_SERVER['DOCUMENT_ROOT'].'/../config/nastaveni.php');
	
	include_once(DIR_TEMPLATE.'_includes.php');

	// page-specific meta data
	$pagetitle = 'Nákup šperků - jak na objednávky, platby, dodací lhůty';
	$keywords = 'obchodní podmínky';
	$description = 'Seznamte se s obchodními podmínkami naší prodejní galerie. Vše o objednávkách, platbách, dodacích lhůtách a způsobech dodání. ';

	include_once(DIR_TEMPLATE.'_header.php');

	include_once(DIR_TEMPLATE.'_menu_left.php');	
?>

<!-- Hlavní obsah -->	
<div id="content_text">	
	<img src="<?php echo URL_PIC; ?>napis_obchod.png" alt="Obchodní podmínky" style="margin: 6px; width:77px; height:30px; float:right;">
	<p class="content_head">Nákup šperků - obchodní podmínky</p>
	<ul class="links">
		<li><a href="#objednavky">Jak objednávat</a></li>
		<li><a href="#platba">Platba za zboží</a></li>
		<li><a href="#lhuty">Dodací lhůty</a></li>
		<li><a href="#dodani">Způsob dodání</a> (<a href="#cenik_postovneho">poštovné a balné</a>)</li>
		<li><a href="#prani">Zvláštní přání</a></li>
		<li><a href="#reklamace">Reklamace</a></li>
		<li><a href="#vraceni">Vrácení zboží</a></li>
	</ul>	

	<p class="content_head"><a name="objednavky"></a>Jak objednávat</p>
	<p class="content">Nákup zboží nabízeného na stránkách Barevného světla můžete provést následujícími způsoby:</p>
	<ul>	
		<li class="kontakt"><b>Zasláním objednávky na e-mailovou adresu</b><br> 
			<table style="width:80%;margin:8px;"><tr><td style="text-align:right;">
				<b><a href="mailto:objednavky&#64;barevne-svetlo&#46;cz?subject=Objednávka&
				body=Z nabídky prodejní galerie Barevné světlo objednávám%0A%0AKatalogové číslo:&nbsp;%0A
				Počet kusů:&nbsp;%0A%0ADoručovací adresa (pro zásilkový prodej):&nbsp;%0A%0APoznámka:&nbsp;%0A%0A
				Potvrďte prosím obratem mou objednávku a zašlete instrukce pro provedení platby.%0A%0AS pozdravem%0A%0A">
				objednavky&#64;barevne-svetlo&#46;cz</a></b>.
			</td></tr></table>
			V objednávce, prosím, uveďte <b>katalogová čísla</b> a <b>počty kusů</b> Vámi vybraného zboží, případné doplňující <b>poznámky</b> 
			a pro zásilkový prodej <b>doručovací adresu</b>. 
			Nejpozději do druhého pracovního dne od nás obdržíte potvrzení objednávky a instrukce k úhradě ceny zboží. 
			V případě, že nebudeme moci Vašim požadavkům vyhovět (např. nedostatečný počet kusů skladem u větších objednávek), 
			Vás budeme kontaktovat a nabídneme alternativní řešení (rozdělení objednávky, výběr jiného podobného zboží, storno objednávky).</li>
		<li class="kontakt">Po předchozí dohodě si můžete zboží <b>zakoupit či vyzvednout osobně</b> v masážním salonu Duhová brána, 
			Náměstí Svatopluka Čecha 1351/6, Praha 10 - Vršovice 
			(<a href="http://www.mapy.cz/#d=firm_2615483_1&t=s&x=14.463201&y=50.069742&z=15&c=23-14-30-28-29-27" target="_blank" 
				title="Navštivte nás - interaktivní mapa okolí Duhové brány">mapa</a>).</li>
	</ul>
	
	<p class="content_head"><a name="platba"></a>Platba za zboží</p>
	<p class="content">Všechny ceny uvedené na těchto stránkách jsou koncové a platné v době objednávky. Nejsme plátci DPH. 
		K ceně zboží bude připočteno poštovné a balné dle <a href="#cenik_postovneho" title="Ceník poštovného a balného">aktuálního ceníku</a>.</p>
	<ul>	
		<li class="kontakt">U <b>zásilkového prodeje</b> je třeba uhradit příslušnou částku předem. Přijímáme platby převodem na bankovní účet, číslo objednávky slouží jako variabilní symbol. 
			Podrobné instrukce Vám zašleme při potvrzení Vaší objednávky. O připsání platby na náš účet Vás budeme informovat a posléze od nás obdržíte daňový doklad.</li>
		<li class="kontakt">Při <b>osobním odběru</b> se cena zboží hradí v hotovosti na místě (poštovné a balné neplatíte).</li>
	</ul>

	<p class="content_head"><a name="lhuty"></a>Dodací lhůty</p>
	<p class="content">Objednané zboží Vám zašleme nejpozději <b>do 5 pracovních dnů</b> od připsání platby na náš účet. O odeslání zásilky Vás budeme informovat. 
		Pokud ze závažných důvodů nebudeme schopni tento termín dodržet, budeme Vás kontaktovat a dohodneme další postup.</p>
	<p class="content">Pokud byste si rádi zakoupili zboží, které momentálně není skladem (v „poznámce“ u zboží je uvedeno “Pro dostupnost nás, prosím, kontaktujte.”), 
		<a href="/kontakt.php">napište nám</a>, vyrobíme ho pro Vás v nejkratším možném čase. Předpokládanou dobu dodání Vám vždy sdělíme předem.</p>
	<p class="content">Pozn.: Šperky z kolekce <a href="/sperky-prehled.php?kolekce=Zakázková" title="Zakázková kolekce šperků">Zakázková</a> 
		obsahují obtížně dostupné, popř. nenahraditelné materiály a jsou na stránkách Barevného 
		světla umístěny hlavně pro ilustraci naší tvorby. Pokud však toužíte po některém ze šperků z této kolekce, 
		<a href="/kontakt.php">kontaktujte nás</a>, prosím. Pokusíme se společně nalézt řešení.</p>
	
	<p class="content_head"><a name="dodani"></a>Způsob dodání</p>
	<p class="content">Zboží vždy pečlivě zabalíme do ochranných materiálů dle velikosti a charakteru výrobku (bublinková folie, popř. krabička) 
		a odešleme k Vám <b>doporučeně prostřednictvím České pošty</b>. Součástí dodávky je daňový doklad, který slouží i pro případné reklamace. 
		Při převzetí si, prosím, vždy překontrolujte neporušenost zásilky. Uvítáme, pokud nám dáte vědět, že zboží v pořádku doputovalo až k Vám.</p>
	<p class="content"><a name="cenik_postovneho"></a><b>Aktuální ceník poštovného a balného:</b></p>
	<table style="margin-left:40px;border:#679a51 1px solid;"><tr><td class="obchod"><b>Celková výše objednávky</b></td><td class="obchod"><b>Poštovné a balné</b></td></tr>
		<tr><td class="obchod">do <?php echo POSTOVNE_LIMIT - 1; ?>,- Kč včetně</td><td class="obchod"><?php echo POSTOVNE_CR; ?>,- Kč</td></tr>
		<tr><td class="obchod">od <?php echo POSTOVNE_LIMIT; ?>,- Kč</td><td class="obchod">zdarma</td></tr></table>	
	<p class="content">Při osobním odběru poštovné ani balné samozřejmě neplatíte.</p>
	<p class="content">V případě vrácení zásilky Českou poštou z důvodu nezastižení adresáta Vám při opakovaném zaslání budeme účtovat nové poštovné.</p>
	
	<p class="content_head"><a name="prani"></a>Máte zvláštní přání?&nbsp;&nbsp;Rádi Vám vyhovíme!</p>
	<p class="content">U některých výrobků můžeme na Vaše přání provést následující změny:</p>
	<ul>	
		<li class="kontakt"><b>výměna bižuterního zapínání náhrdelníků a náramků za stříbrné Ag 925</b> (50-70 Kč dle velikosti) <b>nebo magnetické</b> 
			(30 Kč; snazší manipulace při zapínání)</li>
		<li class="kontakt"><b>výměna bižuterních závěsů u náušnic za ocelové</b> (např. při alergii na barevné kovy)</li>
		<li class="kontakt"><b>úprava délky náhrdelníků a náramků</b></li>
	</ul>	
	<p class="content">Požadavky na změny uveďte, prosím, ve své objednávce. O proveditelnosti úprav a případných doplatcích Vás budeme informovat.</p>
	<p class="content"><b>Nabízíme rovněž možnost výroby šperků v exkluzivních zakázkových designech</b>. 
		Pro více informací nás, prosím, <a href="/kontakt.php">kontaktujte</a>.</p>
	
	<p class="content_head"><a name="reklamace"></a>Reklamace</p>
	<p class="content">Vyrábíme s láskou a péčí a všechny naše výrobky před odesláním kontrolujeme. 
		Pokud by se na Vámi objednaném zboží i přesto vyskytla nějaká výrobní vada, kontaktujte nás, prosím, na e-mailové adrese 
		<a href="mailto:info&#64;barevne-svetlo&#46;cz?subject=Reklamace výrobní vady&body=Reklamuji výrobek zakoupený v prodejní galerii Barevné světlo%0A%0A
		Katalogové číslo výrobku:&nbsp;%0AČíslo objednávky:&nbsp;%0APodrobný popis závady:&nbsp;%0A%0APreferuji%0A- výměnu za nový výrobek%0A- opravu výrobku%0A
		- vrácení peněz%0A%0APodtvrďte prosím obratem přijetí mé reklamace a informujte mne o dalším postupu.%0A%0AS pozdravem%0A%0A">
		info&#64;barevne-svetlo&#46;cz</a>. Do zprávy uveďte číslo objednávky a podrobný popis závady. 
		Dle dohody Vám pak zboží vyměníme, opravíme, nebo Vám vrátíme peníze. Naším cílem je spokojený zákazník, který se k nám bude rád vracet.</p>

	<p class="content_head"><a name="vraceni"></a>Vrácení zboží</p>
	<p class="content">Při zásilkovém prodeji má nakupující podle zákona č. 367/2000 (uzavírání spotřebitelských smluv pomocí prostředků komunikace na dálku) 
		právo odstoupit od smlouvy bez udání důvodu do 14 dnů od převzetí zboží.</p>
	<p class="content">Pokud se rozhodnete tohoto práva využít, dejte nám, prosím, vědět na e-mailovou adresu 
		<a href="mailto:info&#64;barevne-svetlo&#46;cz?subject=Vrácení zboží&body=V rámci odstoupení od smlouvy vracím výrobek zakoupený v prodejní galerii Barevné světlo%0A%0A
		Katalogové číslo výrobku:&nbsp;%0AČíslo objednávky:&nbsp;%0AČíslo účtu pro vrácení peněz:&nbsp;%0A%0AInformujte mne prosím obratem o dalším postupu.%0A%0AS pozdravem%0A%0A">
		info&#64;barevne-svetlo&#46;cz</a>. 
		Zboží musí být vráceno v původním obalu, nerozbalené, nepoužité a nepoškozené. Zboží je nutno odeslat v ochranném obalu doporučenou zásilkou 
		na adresu: Lenka Převorovská, Pod Strání 2156, Praha 10 - Strašnice, 100 00, Česká republika. Poštovné hradí odesilatel. 
		K vrácenému zboží je třeba přiložit i kopii dokladu o nákupu. 
		Po překontrolování stavu zboží Vám bude obratem vrácena kupní cena zboží bankovním převodem na Vámi uvedený účet. 
		Poplatky za poštovné a balné se nevracejí.</p>
	
	<p class="content">&nbsp;</p>
	<p class="content"><i>Nákupem zboží z nabídky prodejní galerie Barevné světlo vyjadřujete svůj souhlas s výše uvedenými obchodními podmínkami.</i></p>

	<?php 
		include_once(DIR_TEMPLATE.'_kam_dal.php');
		
		include_once(DIR_TEMPLATE.'_kam_dal_kontakt.php');	
	?>	
	
	</ul>	
</div>

<?php 
	include_once(DIR_TEMPLATE.'_random_product.php');	
	
	include_once(DIR_TEMPLATE.'_aktuality.php');
	
	include_once(DIR_TEMPLATE.'_footer.php');	
?>
	
