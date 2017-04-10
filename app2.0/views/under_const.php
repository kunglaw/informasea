<!DOCTYPE html>
<html lang="en">

<head>
     
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <meta http-equiv="Content-Style-Type" content="text/css"/>
      <title>Underconstruction | <?=WEBSITE?> - <?=INFORMASEA_SLOGAN?></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <?php
        
        
        $this->load->view("meta.php",$data);
       
         
      ?>
    <link href="<?=asset_url("img/favicon.png")?>" rel="icon" type="image/x-icon"/>  
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo asset_url('underconst/css/bootstrap.css') ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo asset_url('underconst/css/stylish-portfolio.css') ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo asset_url('underconst/font-awesome-4.1.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>-->
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   <!--[endif]-->

</head>

<body>
    <!-- Navigation -->
    
    <div class="modal" id="lowongan-informasea" tabindex="-1" style="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
        
          <div class="modal-header bg-primary">
           	  <p>Lowongan Pekerjaan Informasea November 2015
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button></p>
          </div>
          <div class="modal-body">
            <a href="<?=base_url("about")?>">
            	<img src="<?=asset_url("img/lowongan-informasea.jpg")?>" width="100%" height="100%" />
            </a>
          </div>
          
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
     </div><!-- /.modal -->
    
    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
    <nav id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
            <li class="sidebar-brand">
                <a href="#top">informasea</a>
            </li>
            <form action="<?=base_url("users/users_process/login_universal")?>" id="lgn_frm" role="form" method="post">
            <li style="margin-bottom:8px;">
                <input type="text" name="username" id="username" placeholder="username" class="form-control" required>

            </li>
            <li>
                <input type="password" name="password" id="password" placeholder="password" class="form-control" required>
            </li>
            <li>
                <input type="submit" value="log in" class="btn btn-default">
            </li>
            </form>
            <!--<li>
                <a href="#portfolio">Portfolio</a>
            </li>
            <li>
                <a href="#contact">Contact</a>
            </li>-->
        </ul>
        
        <div>
        
        </div>
        
    </nav>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1 style="color:#FFF !important">informasea</h1>
            <h3 style="color:#FFF !important">Welcome On Board</h3>
            <br>
            <a href="#about" class="btn btn-dark btn-lg">this page is under construction. we'll see you again in the future</a>
        </div>
    </header>

    <!-- About -->
    <!--<section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                  <h2>About Us</h2>
                    <p class="lead">We are informasea, a company for both seatizen and agentsea.</p>
                    <p class="lead">We serve seatizen, agentsea and shipping company online.</p>
                    <p class="lead">We gather Indonesian seatizen in order to provide their needs to promote themselves at finding jobs.</p>
                    <p class="lead">We also develop a fiture for agentsea to help them do their job more effectively.</p>
                </div>
            </div>
            <!-- /.row -->
        <!--</div>-->
        <!-- /.container -->
   <!-- </section>-->

    <!-- Services -->
    <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
<!--    <section id="services" class="services bg-primary">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Our Services</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-cloud fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                <strong>Seatizen</strong> </h4>
                                <p>Be our seatizen then you can finds any jobs suite you and communicate with other seaferer.</p>
<!--                                <a href="#" class="btn btn-light">Learn More</a>
-->                           <!-- </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-compass fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Vacantsea</strong>
                                </h4>
                                <p>Search any jobs suite you as seatizen.</p>
<!--                                <a href="#" class="btn btn-light">Learn More</a>
-->                           <!-- </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-flask fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Agentsea</strong>
                                </h4>
                                <p>Help you to arrange your seatizen schedule, your seatizen profile and paper.</p>-->
<!--                                <a href="#" class="btn btn-light">Learn More</a>
-->                            <!--</div>
                        </div>-->
                        <!--<div class="col-md-3 col-sm-6">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-shield fa-stack-1x text-primary"></i>
                            </span>
                                <h4>
                                    <strong>Forum</strong>
                                </h4>
                                <p>Keep in touch with your collegea from our seatizen list.</p>
                                <a href="#" class="btn btn-light">Learn More</a>
                            </div>
                        </div>-->
                    <!--</div>-->
                    <!-- /.row (nested) -->
<!--                </div>
-->                <!-- /.col-lg-10 -->
<!--            </div>
-->            <!-- /.row -->
<!--        </div>
-->        <!-- /.container -->
<!--    </section>-->
    <!-- Callout -->
<!--    <aside class="callout">
        <div class="text-vertical-center">
            <h1>Vertically Centered Text</h1>
        </div>
    </aside>

    <!-- Portfolio -->
<!--    <section id="portfolio" class="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h2>Our Work</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portfolio-item">
                                <a href="#">
                                    <img class="img-portfolio img-responsive" src="img/portfolio-1.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
                                <a href="#">
                                    <img class="img-portfolio img-responsive" src="img/portfolio-2.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
                                <a href="#">
                                    <img class="img-portfolio img-responsive" src="img/portfolio-3.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portfolio-item">
                                <a href="#">
                                    <img class="img-portfolio img-responsive" src="img/portfolio-4.jpg">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                    <!--<a href="#" class="btn btn-dark">View More Items</a>
                </div>
                <!-- /.col-lg-10 -->
            <!--</div>
            <!-- /.row -->
<!--        </div>
-->        <!-- /.container -->
<!--    </section>---->
    <!-- Call to Action -->
<!--    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>The buttons below are impossible to resist.</h3>
                    <a href="#" class="btn btn-lg btn-light">Click Me!</a>
                    <a href="#" class="btn btn-lg btn-dark">Look at Me!</a>
                </div>
            </div>
        </div>
    </aside>
-->
    <!-- Map -->
<!--    <section id="contact" class="map">
        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe>
        <br />
        <small>
            <a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a>
        </small>
        </iframe>
    </section>
-->
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>informasea</strong>
                    </h4>
                    <p>Jakarta - Indonesia</p>
                    <ul class="list-unstyled">
<!--                   <li><i class="fa fa-phone fa-fw"></i> (123) 456-7890</li>
-->                        
                    </ul>
                    <br>
                    <!--<ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul>-->
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; informasea 2014</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?php echo asset_url('underconst/js/jquery.js') ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo asset_url('underconst/js/bootstrap.min.js') ?>"></script>
	
    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>
    
    <script>
		$(document).ready(function(e) {
            $("#lowongan-informasea").modal({
				show:true
			});
        });
	</script>

</body>

</html>
