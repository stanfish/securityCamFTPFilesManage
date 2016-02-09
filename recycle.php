<?php

  require_once('config.php');

  $start=$_GET['start'];
  $fileList=$_POST['fileList'];
  $restFileList=$_POST['restFileList'];
  $fileList = explode(",", $fileList);
  $restFileList = explode(",", $restFileList);

  if ($_GET['action']=='deletePage'){

    $fileList=$_POST['fileList'];
    $restFileList=$_POST['restFileList'];
    $fileList = explode(",", $fileList);
    $restFileList = explode(",", $restFileList);

    //Delete the non-highlighted images
    foreach ($restFileList as $value) {
      $path=$RECYCLE_DIR.$value;
      if (is_file($path))
      {
          if (unlink($path)) { 
              echo ("Deleted ") . $path . "<br>";
          } else {
              echo ("cannoot delete ") . $path . "<br>";
          }
      }
    }

    //Delete the highlighted images
    foreach ($fileList as $value) {
      $path=$RECYCLE_DIR.$value;
      if (is_file($path))
      {
          if (unlink($path)) { 
              echo ("Deleted ") . $path . "<br>";
          } else {
              echo ("cannoot delete ") . $path . "<br>";
          }
      }
    }


  } else if ($_GET['action']=='delete'){

    //Delete the highlighted images
    foreach ($fileList as $value) {
      $path=$RECYCLE_DIR.$value;
      if (is_file($path))
      {
          if (unlink($path)) { 
              echo ("Deleted ") . $path . "<br>";
          } else {
              echo ("cannoot delete ") . $path . "<br>";
          }
      }
    }
  }

?>



<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style/style.css">
	<script type="text/javascript" src='lib/jquery-1.12.0.min.js'></script>
	<script type="text/javascript" src="lib/browser.js"></script>
	<script type="text/javascript" src="lib/react-with-addons-0.14.7.js"></script>
	<script type="text/javascript" src="lib/react-dom-0.14.7.js"></script>

	<script>

<?php
	
	
	// Open directory, and proceed to read its contents
	if (is_dir($RECYCLE_DIR)) {
		if ($dh = opendir($RECYCLE_DIR)) {
			$i=1;
			$j=1;
			$k=1;

			//start is parameter that indicate which files to start displaying
			if ($_GET['start']!=''){
				$i=(int)$_GET['start'];
			}

 			while ($files[] = readdir($dh));
	    $io = popen ( '/usr/bin/du -sh ' . $RECYCLE_DIR, 'r' );
	    $size = fgets ( $io, 4096);
	    $size = substr ( $size, 0, strpos ( $size, "\t" ) );
	    pclose ( $io );

			sort($files);

			//Create an Array, allFiles, to store all image filenames
			echo 'var allFiles=new Array();';
			for($iii=$i; $iii<$i+$NumberImagesInPage&&(count($files)-$iii-1)>0;$iii++){

				if ($files[count($files)-$iii-1]!='.' && $files[count($files)-$iii-1]!='..'){
					echo "var tmpO={name:'".$files[count($files)-$iii-1]."',date:'".date ("F d Y H:i:s.", filemtime($RECYCLE_DIR.$files[count($files)-$iii-1])-3*3600)."'};";
					echo "allFiles.push(tmpO);";
				}
			}
?>
	</script>
	</head>

	<body>
<?php
			closedir($dh);
	
			echo '<center>'.$size.' - '.count($files).'</center>';

			$prevButton=($i<=1?'':'<a class="btn btn-blue" href="?start='.($i-$NumberImagesInPage<1?1:$i-$NumberImagesInPage).'">Prev</a>');

			$nextButton='<a class="btn btn-blue" href="?start='.($i+$NumberImagesInPage).'">Next</a>';

			echo $prevButton.'&nbsp;&nbsp;&nbsp;&nbsp;'.$nextButton;
			
			
?>


<br /><br />
<div id="container"></div>
<br /><br />

<?php

			echo $prevButton.'&nbsp;&nbsp;&nbsp;&nbsp;'.$nextButton;
		}
	}
?>


<script type="text/babel" >	

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
  },

  render: function() {
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
		      '<?php echo $Image_Recycle_Path;?>' + this.state.name
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
  	var noSelectedFiles=new Array();
  	$('.highlight').each(function(){
  		selectedFiles.push(this.id);
  	});

  	$('.nohighlight').each(function(){
  		noSelectedFiles.push(this.id);
  	});	

  	var theForm, newInput1, newInput2, newInput3;
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
  	newInput2.name = 'restFileList';
  	newInput2.value = noSelectedFiles;	

  	newInput3 = document.createElement('input');
  	newInput3.type = 'hidden';
  	newInput3.name = 'start';
  	newInput3.value = '<?php echo $_GET['start'];?>';
  	
  	// Now put everything together...
  	theForm.appendChild(newInput1);
  	theForm.appendChild(newInput2);
  	theForm.appendChild(newInput3);
  	// ...and it to the DOM...
  	document.getElementById('hidden_form_container').appendChild(theForm);
  	// ...and submit it
  	theForm.submit();

  	//console.log('submitTo '+selectedFiles);

  },

  deleteButtonClick: function (){
  	//this.submitTo('delete.php');
    this.submitTo('recycle.php?action=delete&start=<?php echo $_GET['start'];?>');
  },

  deletePageExceptHighlight: function(){
    this.submitTo('recycle.php?action=deletePage&start=<?php echo $_GET['start'];?>');
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
        this.deletePageExceptHighlight
      } > Delete Page Except Highlight < /button>

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
        this.deletePageExceptHighlight
      } > Delete Page Except Highlight < /button>

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

<br><br><br><br>


</body>
</html>