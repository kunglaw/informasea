<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> test landing page | <?=INFORMASEA_SLOGAN?></title>

<link href="<?=asset_url("img/favicon.png")?>" rel="icon" type="image/x-icon"/>    
<link rel="stylesheet" type="text/css" href="<?=asset_url("css/bootstrap.min.css")?>" />

<!-- <link rel="stylesheet" type="text/css" href="<?=asset_url("css/informasea.css")?>" /> -->
<link rel="stylesheet" type="text/css" href="<?=asset_url("css/informasea_new.css")?>" />

<?php // URUTAN INI TIDAK BOLEH BERUBAH ?>
<script type="text/javascript" src="<?=asset_url("js/jquery.min.js")?>" ></script>
<script type="text/javascript" src="<?=asset_url("js/jquery-ui-1.11.4.custom/jquery-ui.js")?>"></script>
<script type="text/javascript" src="<?=asset_url("js/bootstrap.min.js")?>" ></script>


</head>

<body>
<?php // navbar ?>

	  <?php /* <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="./">Default <span class="sr-only">(current)</span></a></li>
              <li><a href="../navbar-static-top/">Static top</a></li>
              <li><a href="../navbar-fixed-top/">Fixed top</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav> */ ?>

<div id="wrapper">
	<div id="header"> 

    <nav class="navbar navbar-inverse navbar-fixed-top" >
    
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><img alt="brand" src="<?=LOGO_INFORMASEA?>" ></a>
        </div>
    
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Link</a></li>
            
          </ul>
          
          
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
	<?php //end navbar ?>
	</div> <!-- end header -->

    <div class="row">
        <div class="container">
            This blog post shows a few different types of content that's supported and styled with Bootstrap. Basic typography, images, and code are all supported.
    
    Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.
    
        Curabitur blandit tempus porttitor. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.
    
    Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.
    Heading
    
    Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
    Sub-heading
    
    Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
    
    Example code block
    
    Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.
    Sub-heading
    
    Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
    
        Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
        Donec id elit non mi porta gravida at eget metus.
        Nulla vitae elit libero, a pharetra augue.
    
    Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.
    
        Vestibulum id ligula porta felis euismod semper.
        Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
        Maecenas sed diam eget risus varius blandit sit amet non magna.
    
    Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.
    Another blog post
    
    December 23, 2013 by Jacob
    
    Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.
    
        Curabitur blandit tempus porttitor. Nullam quis risus eget urna mollis ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.
    
    Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.
    
    Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
    New feature
    
    December 14, 2013 by Chris
    
    Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
    
        Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
        Donec id elit non mi porta gravida at eget metus.
        Nulla vitae elit libero, a pharetra augue.
    
    Etiam porta sem malesuada magna mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.
    
    Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.
    
        </div>
    </div>
    
</div>


</body>
</html>