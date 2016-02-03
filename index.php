<link type="text/css" rel="stylesheet" href="style.css" />
<script type="text/javascript" src='https://code.jquery.com/jquery-1.12.0.min.js'></script>

<?php
	//How many images to display on each page
	$numInPage=100;
	//Folder that contains all image files
	$dir= "/home/fishcam/files/";

	// Open directory, and proceed to read its contents
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
					echo "var tmpO={name:'".$files[count($files)-$iii-1]."',date:'".date ("F d Y H:i:s.", filemtime($dir.$files[count($files)-$iii-1])-3*3600)."'};";
					echo "allFiles.push(tmpO);";
				}
			}
			
			echo '</script>';
	
			echo ($i<=1?'':'<a class="btn btn-blue" href="?start='.($i-$numInPage<1?1:$i-$numInPage).'">Prev</a>').'&nbsp;&nbsp;&nbsp;&nbsp;';
			
			echo '<a class="btn btn-blue" href="?start='.($i+$numInPage).'">Next</a>';
			
			?>


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



			closedir($dh);
		}
	}


?>


<br><br><br><br>


