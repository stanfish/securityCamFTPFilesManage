<?php
	require_once('../../lib/connections/db.php');
	include('../../lib/functions/functions.php');

	checkLogin('1 2');

	$getuser = getUserRecords($_SESSION['user_id']);

	$numInPage=100;
	
	$dir= "/home/fishcam/files/";

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

			echo '<center>'.$getuser[0]["username"].' - '.$size.' - '.count($files).'</center>';
			
			sort($files);

			echo '<script>';
			echo 'var allFiles=new Array();';
			for($iii=$i; $iii<$i+$numInPage&&(count($files)-$iii-1)>0;$iii++){


				if ($files[count($files)-$iii-1]!='.' && $files[count($files)-$iii-1]!='..'){
					echo "var tmpO={name:'".$files[count($files)-$iii-1]."',date:'".date ("F d Y H:i:s.", filectime($dir.$files[count($files)-$iii-1])-3*3600)."'};";
					echo "allFiles.push(tmpO);";
					//echo "allFiles.push('".$files[count($files)-$iii-1]."');";
				}
			}
			
			echo '</script>';
	
			echo ($i<=1?'':'<a class="btn btn-blue" href="?start='.($i-$numInPage<1?1:$i-$numInPage).'">Prev</a>').'&nbsp;&nbsp;&nbsp;&nbsp;';
			
			echo '<a class="btn btn-blue" href="?start='.($i+$numInPage).'">Next</a>';
			
			?>

<style>
#imageList {
    -moz-column-count:2;
    -webkit-column-count:2;
    column-count:2;
}

.highlight{
    border-style: solid;
    border-width: 5px;
    border-color: blue;
}

.nohighlight{
    border-style: solid;
    border-width: 5px;
    border-color: white;
}

.imgDiv {
    max-width: 48%;
    margin: 1px;
    display: inline-table;
    cursor: pointer;
}

img {
    max-width: 100%;
}




button {
	display: inline-block;
	color: #666;
	background-color: #eee;
	text-transform: uppercase;
	letter-spacing: 2px;
	font-size: 12px;
	padding: 10px 30px;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border: 1px solid rgba(0,0,0,0.3);
	border-bottom-width: 3px;
}

	button:hover {
		background-color: #e3e3e3;
		border-color: rgba(0,0,0,0.5);
	}
	
	button:active {
		background-color: #CCC;
		border-color: rgba(0,0,0,0.9);
	}



/* blue button */

a.btn {
	display: inline-block;
	color: #666;
	background-color: #eee;
	text-transform: uppercase;
	letter-spacing: 2px;
	font-size: 12px;
	padding: 10px 30px;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border: 1px solid rgba(0,0,0,0.3);
	border-bottom-width: 3px;
}

	a.btn:hover {
		background-color: #e3e3e3;
		border-color: rgba(0,0,0,0.5);
	}
	
	a.btn:active {
		background-color: #CCC;
		border-color: rgba(0,0,0,0.9);
	}

a.btn.btn-blue {
	background-color: #699DB6;
	border-color: rgba(0,0,0,0.3);
	text-shadow: 0 1px 0 rgba(0,0,0,0.5);
	color: #FFF;
}

	a.btn.btn-blue:hover {
		background-color: #4F87A2;
		border-color: rgba(0,0,0,0.5);
	}
	
	a.btn.btn-blue:active {
		background-color: #3C677B;
		border-color: rgba(0,0,0,0.9);
	}



</style>

<br /><br />

<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.24/browser.js"></script>
<script src="https://fb.me/react-with-addons-0.14.7.js"></script>
<script src="https://fb.me/react-dom-0.14.7.js"></script>
<div id="container"></div>



<script type="text/babel">	


var EachImage = React.createClass({
  getInitialState: function() {

    return {
      name: this.props.name,
      date: this.props.date,
      className: this.props.className
    };
  },
  imageClick: function(e) {
    this.useState = true;
    if (this.props.className != this.className) {
      this.setState({
        className: this.props.className
      });
    }
    if (this.className == 'nohighlight') {
      this.setState({
        className: 'highlight'
      });
    } else {
      this.setState({
        className: 'nohighlight'
      });
    }

    //console.log('click image '+this.state.data+' '+this.state.className);
  },

  render: function() {
    //console.log('image render props='+this.props.className+' state='+this.state.className);

    this.className = this.props.className;
    if (this.useState) {
      this.className = this.state.className;
      this.useState = false;
    }

    return (
    	<div 
    		id={this.state.name} 
		    className = {
		    	'imgDiv '+
		      this.className
		    }
		    onClick = {
		      this.imageClick
		    }
    	>
		    <img src = {
		      '../../../fishcam/' + this.state.name
		    }
		    /> 
		    <br />
		    {this.state.date}
		    <br />
		</div>
    );
  }

});


var List = React.createClass({
  getInitialState: function() {
    return {
      data: this.props.data,
      selectAll: false
    };
  },

  selectAllButtonClick: function() {
    this.setState({
      selectAll: true
    });
  },

  unSelectAllButtonClick: function() {
    this.setState({
      selectAll: false
    });
  },

  submitTo:function(targetFile){

  	<?php
  	if ($getuser[0]["username"]=='admin'){
  	?>

  	var selectedFiles=new Array();
	$('.highlight').each(function(){
		selectedFiles.push(this.id);
	});

	var theForm, newInput1, newInput2;
	// Start by creating a <form>
	theForm = document.createElement('form');
	theForm.action = targetFile;
	theForm.method = 'post';
	// Next create the <input>s in the form and give them names and values
	newInput1 = document.createElement('input');
	newInput1.type = 'hidden';
	newInput1.name = 'fileList';
	newInput1.value = selectedFiles;

	newInput2 = document.createElement('input');
	newInput2.type = 'hidden';
	newInput2.name = 'start';
	newInput2.value = '<?php echo $_GET['start'];?>';
	
	// Now put everything together...
	theForm.appendChild(newInput1);
	theForm.appendChild(newInput2);
	// ...and it to the DOM...
	document.getElementById('hidden_form_container').appendChild(theForm);
	// ...and submit it
	theForm.submit();

	//console.log('submitTo '+selectedFiles);


	<?php
	} else {
	?>

	alert('Admin user only');


	<?php
	}
	?>

  },

  deleteButtonClick: function (){
  	this.submitTo('delete.php');
  },

  moveToBinButtonClick: function (){
  	this.submitTo('recycle.php');
  },

  render: function() {
    //console.log('list render '+this.state.selectAll);

    var self = this;
    var listItems = this.state.data.map(function(item) {
      return <EachImage key = {
        item.name
      }
      date = {
      	item.date
      } 

      name = {
        item.name
      }
      className = {
        self.state.selectAll ? 'highlight' : 'nohighlight'
      }
      />
    });
    return ( < span >
      < button onClick = {
        this.selectAllButtonClick
      } > Select All < /button> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      < button onClick = {
        this.unSelectAllButtonClick
      } > Unselect All < /button>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      < button onClick = {
        this.deleteButtonClick
      } > Delete < /button>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      < button onClick = {
        this.moveToBinButtonClick
      } > Move to Recycle Bin < /button>

      <p / >
      < span id = "imageList" > {
        listItems
      } < /span> 

      <p />

      < button onClick = {
        this.selectAllButtonClick
      } > Select All < /button> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      < button onClick = {
        this.unSelectAllButtonClick
      } > Unselect All < /button>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      < button onClick = {
        this.deleteButtonClick
      } > Delete < /button>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

      < button onClick = {
        this.moveToBinButtonClick
      } > Move to Recycle Bin < /button>

      < /span>
    );
  }

});

ReactDOM.render( < List data = {
    allFiles
  }
  />,
  document.getElementById('container')
);



</script>





<div id="hidden_form_container" style="display:none;"></div>

<br /><br />

			<?php

			echo ($i<=1?'':'<a class="btn btn-blue" href="?start='.($i-$numInPage<1?1:$i-$numInPage).'">Prev</a>').'&nbsp;&nbsp;&nbsp;&nbsp;';
			
			echo '<a class="btn btn-blue" href="?start='.($i+$numInPage).'">Next</a>';


/*
			echo '<table>';

/*
			echo '<table>';

			echo '<tr><td>'.($i<=1?'':'<a href="index.php?start='.($i-$numInPage<1?1:$i-$numInPage).'">Prev</a>').'</td>';


			echo '<td><a href="index.php?start='.($i+$numInPage).'">Next</a></td></tr>';Y


			
			sort($files);
			for($iii=$i; $iii<$i+$numInPage&&(count($files)-$iii-1)>0;$iii++){
				if ($files[count($files)-$iii-1]!='.' && $files[count($files)-$iii-1]!='..'){
					if ($k%2==1){
						echo '<tr><td>';
					} else {
						echo '<td>';
					}

					echo '<img src="../../../fishcam/'.$files[count($files)-$iii-1].'"><br>'.$files[count($files)-$iii-1].'<br>'.date ("F d Y H:i:s.", filectime($dir.$files[count($files)-$iii-1])-3*3600);

//echo filectime($files[count($files)-$iii-1]);


					if ($k%2==1){
						echo '</td>';
					} else {
						echo '</td></tr>';
					}
					$k++;
				}

			}

			echo '<tr><td>'.($i<=1?'':'<a href="index.php?start='.($i-$numInPage<1?1:$i-$numInPage).'">Prev</a>').'</td><td><a href="index.php?start='.($i+$numInPage).'">Next</a></td></tr>';

			echo '</table>';

*/


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
