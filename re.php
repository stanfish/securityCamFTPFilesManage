<?php
	$numInPage=100;
	
	$dir= "/home/fishcam/backfiles/";


	// Open a known directory, and proceed to read its contents
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			$i=1;
			$j=1;
			$k=1;
			if ($_GET['start']!=''){
				$i=(int)$_GET['start'];
			}

			while ($files[] = readdir($dh));
		    $io = popen ( '/usr/bin/du -sh ' . $dir, 'r' );
		    $size = fgets ( $io, 4096);
		    $size = substr ( $size, 0, strpos ( $size, "\t" ) );
		    pclose ( $io );

			echo '<center>'.$size.' - '.count($files).'</center>';

			echo '<table>';

			echo '<tr><td>'.($i<=1?'':'<a href="?start='.($i-$numInPage<1?1:$i-$numInPage).'">Prev</a>').'</td>';


			echo '<td><a href="?start='.($i+$numInPage).'">Next</a></td></tr>';


			
			sort($files);
			for($iii=$i-1; $iii<$i+$numInPage&&(count($files)-$iii-1)>0;$iii++){
				if ($files[count($files)-$iii-1]!='.' && $files[count($files)-$iii-1]!='..'){
					if ($k%2==1){
						echo '<tr><td>';
					} else {
						echo '<td>';
					}

					echo '<img src="../../../fishcamback/'.$files[count($files)-$iii-1].'"><br>'.$files[count($files)-$iii-1].'<br>'.date ("F d Y H:i:s.", filemtime($dir.$files[count($files)-$iii-1])-3*3600);

//echo filectime($files[count($files)-$iii-1]);


					if ($k%2==1){
						echo '</td>';
					} else {
						echo '</td></tr>';
					}
					$k++;
				}

			}

			echo '<tr><td>'.($i<=1?'':'<a href="?start='.($i-$numInPage<1?1:$i-$numInPage).'">Prev</a>').'</td><td><a href="?start='.($i+$numInPage).'">Next</a></td></tr>';

/*
			while ($j<$i+$numInPage && ($file = readdir($dh)) !== false) {
				if ($j>=$i && $file!='.' && $file!='..'){
					if ($k%2==1){
						echo '<tr><td>';
					} else {
						echo '<td>';
					}
					echo $k.'<img src="locky_cam/'.$file.'"><br>';
					if ($k%2==1){
						echo '</td>';
					} else {
						echo '</td></tr>';
					}
					$k++;
				}
				$j++;
			}

*/

			echo '</table>';
			closedir($dh);
		}
	}


?>


<br><br><br><br>


<form action="http://www.google.com" id="cse-search-box">
  <div>
    <input type="hidden" name="cx" value="partner-pub-3988120136065168:2020801463" />
    <input type="hidden" name="ie" value="UTF-8" />
    <input type="text" name="q" size="55" />
    <input type="submit" name="sa" value="Search" />
  </div>
</form>

<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&amp;lang=en"></script>



<script type="text/javascript"><!--
google_ad_client = "ca-pub-3988120136065168";
/* large ads */
google_ad_slot = "5715008668";
google_ad_width = 728;
google_ad_height = 15;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>



<script type="text/javascript"><!--
google_ad_client = "ca-pub-3988120136065168";
/* Homepage */
google_ad_slot = "1124557460";
google_ad_width = 728;
google_ad_height = 15;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:inline-block;width:970px;height:90px"
     data-ad-client="ca-pub-3988120136065168"
     data-ad-slot="8668475063"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<br><br>
<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- try -->
<ins class="adsbygoogle"
     style="display:inline-block;width:200px;height:90px"
     data-ad-client="ca-pub-3988120136065168"
     data-ad-slot="5113868661"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>


<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- hugh -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-3988120136065168"
     data-ad-slot="9544068261"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>




<script type="text/javascript"><!--
google_ad_client = "ca-pub-3988120136065168";
/* medium */
google_ad_slot = "6451001063";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- sky -->
<ins class="adsbygoogle"
     style="display:inline-block;width:160px;height:600px"
     data-ad-client="ca-pub-3988120136065168"
     data-ad-slot="7927734266"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>



<script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- leaderboard -->
<ins class="adsbygoogle"
     style="display:inline-block;width:970px;height:90px"
     data-ad-client="ca-pub-3988120136065168"
     data-ad-slot="1887873868"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>


<script type="text/javascript"><!--
google_ad_client = "ca-pub-3988120136065168";
/* banner */
google_ad_slot = "3364607064";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<script type="text/javascript"><!--
google_ad_client = "ca-pub-3988120136065168";
/* large leaderboard */
google_ad_slot = "6318073463";
google_ad_width = 970;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>




<script type="text/javascript" src='http://adn.ebay.com/files/js/min/jquery-1.6.2-min.js'></script>
<script type="text/javascript" src='http://adn.ebay.com/files/js/min/ebay_activeContent-min.js'></script>
<script charset="utf-8" type="text/javascript">
document.write('\x3Cscript type="text/javascript" charset="utf-8" src="http://adn.ebay.com/cb?programId=1&campId=5337804620&toolId=10026&keyword=electronic&width=728&height=90&font=1&textColor=000000&linkColor=0000AA&arrowColor=8BBC01&color1=709AEE&color2=[COLORTWO]&format=ImageLink&contentType=TEXT_AND_IMAGE&enableSearch=y&usePopularSearches=n&freeShipping=n&topRatedSeller=n&itemsWithPayPal=n&descriptionSearch=n&showKwCatLink=n&excludeCatId=&excludeKeyword=&catId=&disWithin=200&ctx=n&autoscroll=y&flashEnabled=' + isFlashEnabled + '&pageTitle=' + _epn__pageTitle + '&cachebuster=' + (Math.floor(Math.random() * 10000000 )) + '">\x3C/script>' );
</script>
