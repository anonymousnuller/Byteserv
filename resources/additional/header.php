        <!-- Navbar STart -->
        <header id="topnav" class="defaultscroll sticky">
            <div class="container">
                <!-- Logo container-->
                <div>
                    <a class="logo" href="<?= $helper->Url() ?>">
                        <img src="<?= $helper->cdnUrl(); ?>images/logo-light.png" height="78" alt="">
                    </a>
                </div>     
                <?php if($user->sessionExists($_COOKIE['session_token'])){ ?>
            <div style="float: right;">
                <ul class="navigation-menu" id="navigation">
                    <li class="has-submenu">
                        <a href="javascript:void(0)"><?= $username; ?></a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="<?= $helper->url(); ?>dashboard">» MEINE DIENSTE</a></li>
							<li><a href="<?= $helper->url(); ?>payment/charge">» GUTHABEN AUFLADEN</a></li>
                            <li><a href="<?= $helper->url(); ?>payment/transactions">» TRANSAKTIONEN</a></li>
                            <li><a href="<?= $helper->url(); ?>tickets">» TICKETS</a></li>
                            <li><a href="<?= $helper->url(); ?>profile">» PROFIL</a></li>
							<hr style="background-color: white">
                            <li><a href="<?= $helper->url(); ?>logout">» LOGOUT</a></li>
                            <?php if($user->isInTeam($_COOKIE['session_token'])){ ?>
                                <hr style="background-color: white">
								<?php if($user->isAdmin($_COOKIE['session_token'])){ ?>
                                <li><a href="<?= $helper->url(); ?>team/users">» Kunden</a></li>
                                <li><a href="<?= $helper->url(); ?>team/kvms">» KVM-Server</a></li>
                                <li><a href="<?= $helper->url(); ?>team/vservers">» vServer</a></li>
                                <li><a href="<?= $helper->url(); ?>team/webspaces">» WebSpaces</a></li>
								<?php } ?>
								<li><a  href="<?= $helper->url(); ?>team/tickets">» Tickets</a></li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
        <?php } else { ?>
            <div class="buy-button">
                    <a href="<?= $helper->Url(); ?>login" target="_blank" class="btn btn-light">Anmelden</a>
                    <a href="<?= $helper->Url(); ?>register" target="_blank" class="btn btn-primary">Regestrieren</a>
                </div>
        <?php } ?>            
                <!-- End Logo container-->
                <div class="menu-extras">
                    <div class="menu-item">
                        <!-- Mobile menu toggle-->
                        <a class="navbar-toggle">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </div>
                </div>
        
                <div id="navigation">
                    <!-- Navigation Menu-->   
                    <ul class="navigation-menu">
                        <li><a href="<?= $helper->Url(); ?>">Home</a></li>
                        <li class="has-submenu">
                            <a href="javascript:void(0)">Produkte</a><span class="menu-arrow"></span>
                            <ul class="submenu megamenu">
                                <li>
                                    <ul>
                                        <li><a href="<?= $helper->Url(); ?>kvm/order">KVM Server</a></li>
                                        <li><a href="<?= $helper->Url(); ?>vserver/order">LXC Server</a></li>
                                        <li><a href="<?= $helper->Url(); ?>webspace/order">WebSpace</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li><a href="<?= $helper->Url(); ?>support">Support</a></li>
                    </ul><!--end navigation menu-->
                </div><!--end navigation-->
            </div><!--end container-->
        </header><!--end header-->
        <!-- Navbar End -->