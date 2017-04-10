<nav class="navbar navbar-default navbar-fixed-top visible-xs" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="index.php" class="navbar-brand">Informasea</a>
            <!-- <div class="navbar-brand">
                <img src="assets/img/logo.png" alt="logo">
            </div> -->
            
            <ul class="nav-mobile pull-right">
                <?php if(!(isset($page) && ($page == "login" OR $page == "register" OR $page== "index"))) { ?>
                <li><a href="#"><i class="glyphicon glyphicon-search"></i></a></li>
                <li class="mobile-list-item">
                    <div class="notif-badge">10</div>
                    <a href="#"><i class="glyphicon glyphicon-envelope"></i></a>
                </li>
                <li class="mobile-list-item">
                    <div class="notif-badge">10</div>
                    <a href="notifications.php"><i class="glyphicon glyphicon-bell"></i></a>
                </li>
                
                <?php } ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                    aria-expanded="false"><i class="glyphicon glyphicon-menu-hamburger"></i></span></a>
                    <ul class="dropdown-menu dropdown-menu-blue" role="menu">
                        <?php if(!(isset($page) && ($page == "login" OR $page == "register" OR $page == "index"))) { ?>
                        <li><a href="profile.php"><img class="icon" src="assets/img/ic_profile.svg"> My Profile</a>
                        </li>
                        <li><a href="#"><img class="icon" src="assets/img/ic_home.svg"> Dashboard</a></li>
                        <?php } ?>
                        <li><a href="#"><img class="icon" src="assets/img/ic_seatizen.svg"> Seatizen</a></li>
                        <li><a href="#"><img class="icon" src="assets/img/ic_vacantsea.svg"> Vacantsea</a></li>
                        <li><a href="#"><img class="icon" src="assets/img/ic_company.svg"> Company</a></li>
                        <?php if(!(isset($page) && ($page == "login" OR $page == "register"))) { ?>
                        <li><a href="#"><img class="icon" src="assets/img/ic_logout.svg"> Log out</a></li>
                        <?php } ?>
                        <li class="divider"></li>
                        <li><a href="#">Informasea</a></li>
                        <li><a href="#">Career</a></li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Brand</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Term & Condition</a></li>
                        <li><a href="#">Security</a></li>
                    </ul>
                </li>
            </ul>
            <?php if(isset($page) && ($page == "register" || $page="index" )) { ?>
                <!-- <a href="dashboard.php" type="button" class="btn btn-login navbar-btn pull-right">Log In</a> -->
            <ul class="nav pull-right">
              <li class="dropdown" id="menuLogin">
                <a class="btn btn-login navbar-btn dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">
                    Log In</a>
                <div class="dropdown-menu" style="padding:17px;">
                  <form class="form" id="formLogin" role="form">
                    <div class="form-group">
                        <input name="username" id="username" type="text" placeholder="Username" class="form-control">
                    </div>
                    <div class="form-group"> 
                        <input name="password" id="password" type="password" placeholder="Password" class="form-control">
                    </div>
                    <span id="helpBlock" class="help-block"><a href="#">Forgot password?</a></span>
                    <button type="button" id="btnLogin" class="btn btn-primary form-control">Login</button>
                  </form>
                </div>
              </li>
            </ul>
            <?php } ?>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>