<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Book Library</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/transitions.css">
    <link rel="stylesheet" href="css/homeuser.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>

<body class="tg-home tg-homeone">

    <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
        <!--************************************
				Header Start
		*************************************-->
        <header id="tg-header" class="tg-header tg-haslayout">
            <div class="tg-topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <ul class="tg-addnav">
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="icon-envelope"></i>
                                        <em>Contact</em>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <i class="icon-question-circle"></i>
                                        <em>Help</em>
                                    </a>
                                </li>
                            </ul>
                            <div class="dropdown tg-themedropdown tg-currencydropdown">
                                <a href="javascript:void(0);" id="tg-currenty" class="tg-btnthemedropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-earth"></i>
                                    <span>Currency</span>
                                </a>
                                <ul class="dropdown-menu tg-themedropdownmenu" aria-labelledby="tg-currenty">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <i>£</i>
                                            <span>British Pound</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <i>$</i>
                                            <span>Us Dollar</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <i>€</i>
                                            <span>Euro</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="auth-button-container">
                                <button id="authOpenLogin" class="auth-button">Login</button>
                                <button id="authOpenRegister" class="auth-button">Register</button>
                            </div>

                            <!-- Popup Login -->
                            <div class="auth-popup" id="authLoginPopup">
                                <div class="auth-popup-content">
                                    <span class="auth-close-btn" id="authCloseLogin">&times;</span>
                                    <h2>Login</h2>
                                    <form>
                                        <label for="authLoginEmail">Email:</label>
                                        <input type="email" id="authLoginEmail" placeholder="Enter your email" required>
                                        <label for="authLoginPassword">Password:</label>
                                        <input type="password" id="authLoginPassword" placeholder="Enter your password" required>
                                        <button type="submit">Login</button>
                                    </form>
                                </div>
                            </div>

                            <!-- Popup Register -->
                            <div class="auth-popup" id="authRegisterPopup">
                                <div class="auth-popup-content">
                                    <span class="auth-close-btn" id="authCloseRegister">&times;</span>
                                    <h2>Register</h2>
                                    <form>
                                        <label for="authRegisterEmail">Email:</label>
                                        <input type="email" id="authRegisterEmail" placeholder="Enter your email" required>
                                        <label for="authRegisterPassword">Password:</label>
                                        <input type="password" id="authRegisterPassword" placeholder="Enter your password" required>
                                        <label for="authRegisterConfirmPassword">Confirm Password:</label>
                                        <input type="password" id="authRegisterConfirmPassword" placeholder="Confirm your password" required>
                                        <button type="submit">Register</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--*****************************
					tg-middlecontainer
		*****************************-->

            <div class="tg-middlecontainer">
                <div class="container">
                    <div class="row" style="display: flex;">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-logo"><a href="homeuser.html"><img src="img/logoname.png" alt="tên công ty tại đây"></a></div>

                            <div class="tg-wishlistandcart">
                                <div class="dropdown tg-themedropdown tg-wishlistdropdown">
                                    <a href="javascript:void(0);" class="tg-btnthemedropdown">
                                        <span class="tg-themebadge">3</span>
                                        <i class="icon-heart"></i>
                                        <span>Yêu thích</span>
                                    </a>
                                </div>
                                <div class="dropdown tg-themedropdown tg-minicartdropdown">
                                    <a href="javascript:void(0);" class="tg-btnthemedropdown">
                                        <span class="tg-themebadge">3</span>
                                        <i class="icon-cart"></i>
                                    </a>
                                </div>
                            </div>



                            <div class="tg-searchbox">
                                <form class="tg-formtheme tg-formsearch">
                                    <fieldset>
                                        <input type="text" name="search" class="typeahead form-control" placeholder="Tìm kiếm theo tiêu đề, tác giả, từ khóa, ISBN...">
                                        <button type="submit"><i class="icon-magnifier"></i></button>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            <div class="tg-navigationarea">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <nav id="tg-nav" class="tg-nav">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                                    <ul>
                                        <li class="menu-item-has-children menu-item-has-mega-menu">
                                            <a href="javascript:void(0);">All Categories</a>
                                            <div class="mega-menu">
                                                <ul class="tg-themetabnav" role="tablist">
                                                    <li role="presentation" class="active">
                                                        <a href="#artandphotography" aria-controls="artandphotography" role="tab" data-toggle="tab">Art &amp; Photography</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#biography" aria-controls="biography" role="tab" data-toggle="tab">Biography</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#childrensbook" aria-controls="childrensbook" role="tab" data-toggle="tab">Children’s Book</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#craftandhobbies" aria-controls="craftandhobbies" role="tab" data-toggle="tab">Craft &amp; Hobbies</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#crimethriller" aria-controls="crimethriller" role="tab" data-toggle="tab">Crime &amp; Thriller</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#fantasyhorror" aria-controls="fantasyhorror" role="tab" data-toggle="tab">Fantasy &amp; Horror</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#fiction" aria-controls="fiction" role="tab" data-toggle="tab">Fiction</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#fooddrink" aria-controls="fooddrink" role="tab" data-toggle="tab">Food &amp; Drink</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#graphicanimemanga" aria-controls="graphicanimemanga" role="tab" data-toggle="tab">Graphic, Anime &amp; Manga</a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#sciencefiction" aria-controls="sciencefiction" role="tab" data-toggle="tab">Science Fiction</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content tg-themetabcontent">
                                                    <div role="tabpanel" class="tab-pane active" id="artandphotography">
                                                        <ul>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Architecture</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Tough As Nails</a></li>
                                                                    <li><a href="products.html">Pro Grease Monkey</a>
                                                                    </li>
                                                                    <li><a href="products.html">Building Memories</a>
                                                                    </li>
                                                                    <li><a href="products.html">Bulldozer Boyz</a></li>
                                                                    <li><a href="products.html">Build Or Leave On Us</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Art Forms</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Consectetur
                                                                            adipisicing</a></li>
                                                                    <li><a href="products.html">Aelit sed do eiusmod</a>
                                                                    </li>
                                                                    <li><a href="products.html">Tempor incididunt
                                                                            labore</a></li>
                                                                    <li><a href="products.html">Dolore magna aliqua</a>
                                                                    </li>
                                                                    <li><a href="products.html">Ut enim ad minim</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>History</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Veniam quis nostrud</a>
                                                                    </li>
                                                                    <li><a href="products.html">Exercitation</a></li>
                                                                    <li><a href="products.html">Laboris nisi ut
                                                                            aliuip</a></li>
                                                                    <li><a href="products.html">Commodo conseat</a></li>
                                                                    <li><a href="products.html">Duis aute irure</a></li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                        </ul>
                                                        <ul>
                                                            <li>
                                                                <figure><img src="img/img-01.png" alt="image description"></figure>
                                                                <div class="tg-textbox">
                                                                    <h3>More Than<span>12,0657,53</span>Books Collection
                                                                    </h3>
                                                                    <div class="tg-description">
                                                                        <p>Consectetur adipisicing elit sed doe eiusmod
                                                                            tempor incididunt laebore toloregna aliqua
                                                                            enim.</p>
                                                                    </div>
                                                                    <a class="tg-btn" href="products.html">view all</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="biography">
                                                        <ul>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>History</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Veniam quis nostrud</a>
                                                                    </li>
                                                                    <li><a href="products.html">Exercitation</a></li>
                                                                    <li><a href="products.html">Laboris nisi ut
                                                                            aliuip</a></li>
                                                                    <li><a href="products.html">Commodo conseat</a></li>
                                                                    <li><a href="products.html">Duis aute irure</a></li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Architecture</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Tough As Nails</a></li>
                                                                    <li><a href="products.html">Pro Grease Monkey</a>
                                                                    </li>
                                                                    <li><a href="products.html">Building Memories</a>
                                                                    </li>
                                                                    <li><a href="products.html">Bulldozer Boyz</a></li>
                                                                    <li><a href="products.html">Build Or Leave On Us</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Art Forms</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Consectetur
                                                                            adipisicing</a></li>
                                                                    <li><a href="products.html">Aelit sed do eiusmod</a>
                                                                    </li>
                                                                    <li><a href="products.html">Tempor incididunt
                                                                            labore</a></li>
                                                                    <li><a href="products.html">Dolore magna aliqua</a>
                                                                    </li>
                                                                    <li><a href="products.html">Ut enim ad minim</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                        </ul>
                                                        <ul>
                                                            <li>
                                                                <figure><img src="img/img-01.png" alt="image description"></figure>
                                                                <div class="tg-textbox">
                                                                    <h3>More Than<span>12,0657,53</span>Books Collection
                                                                    </h3>
                                                                    <div class="tg-description">
                                                                        <p>Consectetur adipisicing elit sed doe eiusmod
                                                                            tempor incididunt laebore toloregna aliqua
                                                                            enim.</p>
                                                                    </div>
                                                                    <a class="tg-btn" href="products.html">view all</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="childrensbook">
                                                        <ul>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Architecture</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Tough As Nails</a></li>
                                                                    <li><a href="products.html">Pro Grease Monkey</a>
                                                                    </li>
                                                                    <li><a href="products.html">Building Memories</a>
                                                                    </li>
                                                                    <li><a href="products.html">Bulldozer Boyz</a></li>
                                                                    <li><a href="products.html">Build Or Leave On Us</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Art Forms</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Consectetur
                                                                            adipisicing</a></li>
                                                                    <li><a href="products.html">Aelit sed do eiusmod</a>
                                                                    </li>
                                                                    <li><a href="products.html">Tempor incididunt
                                                                            labore</a></li>
                                                                    <li><a href="products.html">Dolore magna aliqua</a>
                                                                    </li>
                                                                    <li><a href="products.html">Ut enim ad minim</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>History</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Veniam quis nostrud</a>
                                                                    </li>
                                                                    <li><a href="products.html">Exercitation</a></li>
                                                                    <li><a href="products.html">Laboris nisi ut
                                                                            aliuip</a></li>
                                                                    <li><a href="products.html">Commodo conseat</a></li>
                                                                    <li><a href="products.html">Duis aute irure</a></li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                        </ul>
                                                        <ul>
                                                            <li>
                                                                <figure><img src="img/img-01.png" alt="image description"></figure>
                                                                <div class="tg-textbox">
                                                                    <h3>More Than<span>12,0657,53</span>Books Collection
                                                                    </h3>
                                                                    <div class="tg-description">
                                                                        <p>Consectetur adipisicing elit sed doe eiusmod
                                                                            tempor incididunt laebore toloregna aliqua
                                                                            enim.</p>
                                                                    </div>
                                                                    <a class="tg-btn" href="products.html">view all</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="craftandhobbies">
                                                        <ul>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>History</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Veniam quis nostrud</a>
                                                                    </li>
                                                                    <li><a href="products.html">Exercitation</a></li>
                                                                    <li><a href="products.html">Laboris nisi ut
                                                                            aliuip</a></li>
                                                                    <li><a href="products.html">Commodo conseat</a></li>
                                                                    <li><a href="products.html">Duis aute irure</a></li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Architecture</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Tough As Nails</a></li>
                                                                    <li><a href="products.html">Pro Grease Monkey</a>
                                                                    </li>
                                                                    <li><a href="products.html">Building Memories</a>
                                                                    </li>
                                                                    <li><a href="products.html">Bulldozer Boyz</a></li>
                                                                    <li><a href="products.html">Build Or Leave On Us</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Art Forms</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Consectetur
                                                                            adipisicing</a></li>
                                                                    <li><a href="products.html">Aelit sed do eiusmod</a>
                                                                    </li>
                                                                    <li><a href="products.html">Tempor incididunt
                                                                            labore</a></li>
                                                                    <li><a href="products.html">Dolore magna aliqua</a>
                                                                    </li>
                                                                    <li><a href="products.html">Ut enim ad minim</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                        </ul>
                                                        <ul>
                                                            <li>
                                                                <figure><img src="img/img-01.png" alt="image description"></figure>
                                                                <div class="tg-textbox">
                                                                    <h3>More Than<span>12,0657,53</span>Books Collection
                                                                    </h3>
                                                                    <div class="tg-description">
                                                                        <p>Consectetur adipisicing elit sed doe eiusmod
                                                                            tempor incididunt laebore toloregna aliqua
                                                                            enim.</p>
                                                                    </div>
                                                                    <a class="tg-btn" href="products.html">view all</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="crimethriller">
                                                        <ul>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Architecture</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Tough As Nails</a></li>
                                                                    <li><a href="products.html">Pro Grease Monkey</a>
                                                                    </li>
                                                                    <li><a href="products.html">Building Memories</a>
                                                                    </li>
                                                                    <li><a href="products.html">Bulldozer Boyz</a></li>
                                                                    <li><a href="products.html">Build Or Leave On Us</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Art Forms</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Consectetur
                                                                            adipisicing</a></li>
                                                                    <li><a href="products.html">Aelit sed do eiusmod</a>
                                                                    </li>
                                                                    <li><a href="products.html">Tempor incididunt
                                                                            labore</a></li>
                                                                    <li><a href="products.html">Dolore magna aliqua</a>
                                                                    </li>
                                                                    <li><a href="products.html">Ut enim ad minim</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>History</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Veniam quis nostrud</a>
                                                                    </li>
                                                                    <li><a href="products.html">Exercitation</a></li>
                                                                    <li><a href="products.html">Laboris nisi ut
                                                                            aliuip</a></li>
                                                                    <li><a href="products.html">Commodo conseat</a></li>
                                                                    <li><a href="products.html">Duis aute irure</a></li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                        </ul>
                                                        <ul>
                                                            <li>
                                                                <figure><img src="img/img-01.png" alt="image description"></figure>
                                                                <div class="tg-textbox">
                                                                    <h3>More Than<span>12,0657,53</span>Books Collection
                                                                    </h3>
                                                                    <div class="tg-description">
                                                                        <p>Consectetur adipisicing elit sed doe eiusmod
                                                                            tempor incididunt laebore toloregna aliqua
                                                                            enim.</p>
                                                                    </div>
                                                                    <a class="tg-btn" href="products.html">view all</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="fantasyhorror">
                                                        <ul>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>History</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Veniam quis nostrud</a>
                                                                    </li>
                                                                    <li><a href="products.html">Exercitation</a></li>
                                                                    <li><a href="products.html">Laboris nisi ut
                                                                            aliuip</a></li>
                                                                    <li><a href="products.html">Commodo conseat</a></li>
                                                                    <li><a href="products.html">Duis aute irure</a></li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Architecture</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Tough As Nails</a></li>
                                                                    <li><a href="products.html">Pro Grease Monkey</a>
                                                                    </li>
                                                                    <li><a href="products.html">Building Memories</a>
                                                                    </li>
                                                                    <li><a href="products.html">Bulldozer Boyz</a></li>
                                                                    <li><a href="products.html">Build Or Leave On Us</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Art Forms</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Consectetur
                                                                            adipisicing</a></li>
                                                                    <li><a href="products.html">Aelit sed do eiusmod</a>
                                                                    </li>
                                                                    <li><a href="products.html">Tempor incididunt
                                                                            labore</a></li>
                                                                    <li><a href="products.html">Dolore magna aliqua</a>
                                                                    </li>
                                                                    <li><a href="products.html">Ut enim ad minim</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                        </ul>
                                                        <ul>
                                                            <li>
                                                                <figure><img src="img/img-01.png" alt="image description"></figure>
                                                                <div class="tg-textbox">
                                                                    <h3>More Than<span>12,0657,53</span>Books Collection
                                                                    </h3>
                                                                    <div class="tg-description">
                                                                        <p>Consectetur adipisicing elit sed doe eiusmod
                                                                            tempor incididunt laebore toloregna aliqua
                                                                            enim.</p>
                                                                    </div>
                                                                    <a class="tg-btn" href="products.html">view all</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="fiction">
                                                        <ul>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Architecture</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Tough As Nails</a></li>
                                                                    <li><a href="products.html">Pro Grease Monkey</a>
                                                                    </li>
                                                                    <li><a href="products.html">Building Memories</a>
                                                                    </li>
                                                                    <li><a href="products.html">Bulldozer Boyz</a></li>
                                                                    <li><a href="products.html">Build Or Leave On Us</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Art Forms</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Consectetur
                                                                            adipisicing</a></li>
                                                                    <li><a href="products.html">Aelit sed do eiusmod</a>
                                                                    </li>
                                                                    <li><a href="products.html">Tempor incididunt
                                                                            labore</a></li>
                                                                    <li><a href="products.html">Dolore magna aliqua</a>
                                                                    </li>
                                                                    <li><a href="products.html">Ut enim ad minim</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>History</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Veniam quis nostrud</a>
                                                                    </li>
                                                                    <li><a href="products.html">Exercitation</a></li>
                                                                    <li><a href="products.html">Laboris nisi ut
                                                                            aliuip</a></li>
                                                                    <li><a href="products.html">Commodo conseat</a></li>
                                                                    <li><a href="products.html">Duis aute irure</a></li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                        </ul>
                                                        <ul>
                                                            <li>
                                                                <figure><img src="img/img-01.png" alt="image description"></figure>
                                                                <div class="tg-textbox">
                                                                    <h3>More Than<span>12,0657,53</span>Books Collection
                                                                    </h3>
                                                                    <div class="tg-description">
                                                                        <p>Consectetur adipisicing elit sed doe eiusmod
                                                                            tempor incididunt laebore toloregna aliqua
                                                                            enim.</p>
                                                                    </div>
                                                                    <a class="tg-btn" href="products.html">view all</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="fooddrink">
                                                        <ul>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>History</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Veniam quis nostrud</a>
                                                                    </li>
                                                                    <li><a href="products.html">Exercitation</a></li>
                                                                    <li><a href="products.html">Laboris nisi ut
                                                                            aliuip</a></li>
                                                                    <li><a href="products.html">Commodo conseat</a></li>
                                                                    <li><a href="products.html">Duis aute irure</a></li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Architecture</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Tough As Nails</a></li>
                                                                    <li><a href="products.html">Pro Grease Monkey</a>
                                                                    </li>
                                                                    <li><a href="products.html">Building Memories</a>
                                                                    </li>
                                                                    <li><a href="products.html">Bulldozer Boyz</a></li>
                                                                    <li><a href="products.html">Build Or Leave On Us</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Art Forms</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Consectetur
                                                                            adipisicing</a></li>
                                                                    <li><a href="products.html">Aelit sed do eiusmod</a>
                                                                    </li>
                                                                    <li><a href="products.html">Tempor incididunt
                                                                            labore</a></li>
                                                                    <li><a href="products.html">Dolore magna aliqua</a>
                                                                    </li>
                                                                    <li><a href="products.html">Ut enim ad minim</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                        </ul>
                                                        <ul>
                                                            <li>
                                                                <figure><img src="img/img-01.png" alt="image description"></figure>
                                                                <div class="tg-textbox">
                                                                    <h3>More Than<span>12,0657,53</span>Books Collection
                                                                    </h3>
                                                                    <div class="tg-description">
                                                                        <p>Consectetur adipisicing elit sed doe eiusmod
                                                                            tempor incididunt laebore toloregna aliqua
                                                                            enim.</p>
                                                                    </div>
                                                                    <a class="tg-btn" href="products.html">view all</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="graphicanimemanga">
                                                        <ul>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Architecture</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Tough As Nails</a></li>
                                                                    <li><a href="products.html">Pro Grease Monkey</a>
                                                                    </li>
                                                                    <li><a href="products.html">Building Memories</a>
                                                                    </li>
                                                                    <li><a href="products.html">Bulldozer Boyz</a></li>
                                                                    <li><a href="products.html">Build Or Leave On Us</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Art Forms</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Consectetur
                                                                            adipisicing</a></li>
                                                                    <li><a href="products.html">Aelit sed do eiusmod</a>
                                                                    </li>
                                                                    <li><a href="products.html">Tempor incididunt
                                                                            labore</a></li>
                                                                    <li><a href="products.html">Dolore magna aliqua</a>
                                                                    </li>
                                                                    <li><a href="products.html">Ut enim ad minim</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>History</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Veniam quis nostrud</a>
                                                                    </li>
                                                                    <li><a href="products.html">Exercitation</a></li>
                                                                    <li><a href="products.html">Laboris nisi ut
                                                                            aliuip</a></li>
                                                                    <li><a href="products.html">Commodo conseat</a></li>
                                                                    <li><a href="products.html">Duis aute irure</a></li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                        </ul>
                                                        <ul>
                                                            <li>
                                                                <figure><img src="img/img-01.png" alt="image description"></figure>
                                                                <div class="tg-textbox">
                                                                    <h3>More Than<span>12,0657,53</span>Books Collection
                                                                    </h3>
                                                                    <div class="tg-description">
                                                                        <p>Consectetur adipisicing elit sed doe eiusmod
                                                                            tempor incididunt laebore toloregna aliqua
                                                                            enim.</p>
                                                                    </div>
                                                                    <a class="tg-btn" href="products.html">view all</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane" id="sciencefiction">
                                                        <ul>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>History</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Veniam quis nostrud</a>
                                                                    </li>
                                                                    <li><a href="products.html">Exercitation</a></li>
                                                                    <li><a href="products.html">Laboris nisi ut
                                                                            aliuip</a></li>
                                                                    <li><a href="products.html">Commodo conseat</a></li>
                                                                    <li><a href="products.html">Duis aute irure</a></li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Architecture</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Tough As Nails</a></li>
                                                                    <li><a href="products.html">Pro Grease Monkey</a>
                                                                    </li>
                                                                    <li><a href="products.html">Building Memories</a>
                                                                    </li>
                                                                    <li><a href="products.html">Bulldozer Boyz</a></li>
                                                                    <li><a href="products.html">Build Or Leave On Us</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                            <li>
                                                                <div class="tg-linkstitle">
                                                                    <h2>Art Forms</h2>
                                                                </div>
                                                                <ul>
                                                                    <li><a href="products.html">Consectetur
                                                                            adipisicing</a></li>
                                                                    <li><a href="products.html">Aelit sed do eiusmod</a>
                                                                    </li>
                                                                    <li><a href="products.html">Tempor incididunt
                                                                            labore</a></li>
                                                                    <li><a href="products.html">Dolore magna aliqua</a>
                                                                    </li>
                                                                    <li><a href="products.html">Ut enim ad minim</a>
                                                                    </li>
                                                                </ul>
                                                                <a class="tg-btnviewall" href="products.html">View
                                                                    All</a>
                                                            </li>
                                                        </ul>
                                                        <ul>
                                                            <li>
                                                                <figure><img src="img/img-01.png" alt="image description"></figure>
                                                                <div class="tg-textbox">
                                                                    <h3>More Than<span>12,0657,53</span>Books Collection
                                                                    </h3>
                                                                    <div class="tg-description">
                                                                        <p>Consectetur adipisicing elit sed doe eiusmod
                                                                            tempor incididunt laebore toloregna aliqua
                                                                            enim.</p>
                                                                    </div>
                                                                    <a class="tg-btn" href="products.html">view all</a>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="menu-item-has-children current-menu-item">
                                            <a href="javascript:void(0);">Home</a>
                                            <ul class="sub-menu">
                                                <li class="current-menu-item"><a href="index-2.html">Home V one</a></li>
                                                <li><a href="indexv2.html">Home V two</a></li>
                                                <li><a href="indexv3.html">Home V three</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0);">Authors</a>
                                            <ul class="sub-menu">
                                                <li><a href="authors.html">Authors</a></li>
                                                <li><a href="authordetail.html">Author Detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="products.html">Best Selling</a></li>
                                        <li><a href="products.html">Weekly Sale</a></li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0);">Latest News</a>
                                            <ul class="sub-menu">
                                                <li><a href="newslist.html">News List</a></li>
                                                <li><a href="newsgrid.html">News Grid</a></li>
                                                <li><a href="newsdetail.html">News Detail</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contactus.html">Contact</a></li>
                                        <li class="menu-item-has-children current-menu-item">
                                            <a href="javascript:void(0);"><i class="icon-menu"></i></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item-has-children">
                                                    <a href="aboutus.html">Products</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="products.html">Products</a></li>
                                                        <li><a href="productdetail.html">Product Detail</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="aboutus.html">About Us</a></li>
                                                <li><a href="404error.html">404 Error</a></li>
                                                <li><a href="comingsoon.html">Coming Soon</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--************************************
				Header End
		*************************************-->


        <!-- <h1 class="nhat">Content</h1></br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </hr>
        </hr> -->
        <div>
            @yield('content')
        </div>
        <!--************************************
					Latest News End
			*************************************-->
        <!-- </main> -->
        <!--************************************
				Main End
		*************************************-->
        <!--************************************
				Footer Start
		*************************************-->
        <footer id="tg-footer" class="tg-footer tg-haslayout">
            <div class="tg-footerarea">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <ul class="tg-clientservices">
                                <li class="tg-devlivery">
                                    <span class="tg-clientserviceicon"><i class="icon-rocket"></i></span>
                                    <div class="tg-titlesubtitle">
                                        <h3>Fast Delivery</h3>
                                        <p>Shipping Worldwide</p>
                                    </div>
                                </li>
                                <li class="tg-discount">
                                    <span class="tg-clientserviceicon"><i class="icon-tag"></i></span>
                                    <div class="tg-titlesubtitle">
                                        <h3>Open Discount</h3>
                                        <p>Offering Open Discount</p>
                                    </div>
                                </li>
                                <li class="tg-quality">
                                    <span class="tg-clientserviceicon"><i class="icon-leaf"></i></span>
                                    <div class="tg-titlesubtitle">
                                        <h3>Eyes On Quality</h3>
                                        <p>Publishing Quality Work</p>
                                    </div>
                                </li>
                                <li class="tg-support">
                                    <span class="tg-clientserviceicon"><i class="icon-heart"></i></span>
                                    <div class="tg-titlesubtitle">
                                        <h3>24/7 Support</h3>
                                        <p>Serving Every Moments</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tg-threecolumns">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="tg-footercol">
                                    <strong class="tg-logo"><a href="/homeuser.html"><img src="img/logoname.png" alt="image description"></a></strong>
                                    <ul class="tg-contactinfo">
                                        <li>
                                            <i class="icon-apartment"></i>
                                            <address>Suit # 07, Rose world Building, Street # 02, AT246T Manchester
                                            </address>
                                        </li>
                                        <li>
                                            <i class="icon-phone-handset"></i>
                                            <span>
                                                <em>0800 12345 - 678 - 89</em>
                                                <em>+4 1234 - 4567 - 67</em>
                                            </span>
                                        </li>
                                        <li>
                                            <i class="icon-clock"></i>
                                            <span>Serving 7 Days A Week From 9am - 5pm</span>
                                        </li>
                                        <li>
                                            <i class="icon-envelope"></i>
                                            <span>
                                                <em><a href="mailto:support@domain.com">support@domain.com</a></em>
                                                <em><a href="mailto:info@domain.com">info@domain.com</a></em>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="tg-socialicons">
                                        <li class="tg-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                        <li class="tg-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                        <li class="tg-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                        <li class="tg-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                        <li class="tg-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="tg-footercol tg-widget tg-widgetnavigation">
                                    <div class="tg-widgettitle">
                                        <h3>Shipping And Help Information</h3>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <ul>
                                            <li><a href="javascript:void(0);">Terms of Use</a></li>
                                            <li><a href="javascript:void(0);">Terms of Sale</a></li>
                                            <li><a href="javascript:void(0);">Returns</a></li>
                                            <li><a href="javascript:void(0);">Privacy</a></li>
                                            <li><a href="javascript:void(0);">Cookies</a></li>
                                            <li><a href="javascript:void(0);">Contact Us</a></li>
                                            <li><a href="javascript:void(0);">Our Affiliates</a></li>
                                            <li><a href="javascript:void(0);">Vision &amp; Aim</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="javascript:void(0);">Our Story</a></li>
                                            <li><a href="javascript:void(0);">Meet Our Team</a></li>
                                            <li><a href="javascript:void(0);">FAQ</a></li>
                                            <li><a href="javascript:void(0);">Testimonials</a></li>
                                            <li><a href="javascript:void(0);">Join Our Team</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="tg-footercol tg-widget tg-widgettopsellingauthors">
                                    <div class="tg-widgettitle">
                                        <h3>Top Selling Authors</h3>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <ul>
                                            <li>
                                                <figure><a href="javascript:void(0);"><img src="img/author/imag-09.jpg" alt="image description"></a>
                                                </figure>
                                                <div class="tg-authornamebooks">
                                                    <h4><a href="javascript:void(0);">Jude Morphew</a></h4>
                                                    <p>21,658 Published Books</p>
                                                </div>
                                            </li>
                                            <li>
                                                <figure><a href="javascript:void(0);"><img src="img/author/imag-10.jpg" alt="image description"></a>
                                                </figure>
                                                <div class="tg-authornamebooks">
                                                    <h4><a href="javascript:void(0);">Shaun Humes</a></h4>
                                                    <p>20,257 Published Books</p>
                                                </div>
                                            </li>
                                            <li>
                                                <figure><a href="javascript:void(0);"><img src="img/author/imag-11.jpg" alt="image description"></a>
                                                </figure>
                                                <div class="tg-authornamebooks">
                                                    <h4><a href="javascript:void(0);">Kathrine Culbertson</a></h4>
                                                    <p>15,686 Published Books</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tg-newsletter">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <h4>Signup Newsletter!</h4>
                            <h5>Consectetur adipisicing elit sed do eiusmod tempor incididunt.</h5>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <form class="tg-formtheme tg-formnewsletter">
                                <fieldset>
                                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email ID">
                                    <button type="button"><i class="icon-envelope"></i></button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tg-footerbar">
                <a id="tg-btnbacktotop" class="tg-btnbacktotop" href="javascript:void(0);"><i class="icon-chevron-up"></i></a>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <span class="tg-paymenttype"><img src="img/paymenticon.png" alt="image description"></span>
                            <span class="tg-copyright">2017 All Rights Reserved By &copy; Book Library</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--************************************
				Footer End
		*************************************-->
    </div>
    <!--************************************
			Wrapper End
	*************************************-->
    <script src="js/vendor/jquery-library.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.vide.min.js"></script>
    <script src="js/countdown.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/parallax.js"></script>
    <script src="js/countTo.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/gmap3.js"></script>
    <script src="js/main.js"></script>
    <script>
        // Open and close popup
        document.getElementById('authOpenLogin').addEventListener('click', function() {
            document.getElementById('authLoginPopup').style.display = 'flex';
        });

        document.getElementById('authCloseLogin').addEventListener('click', function() {
            document.getElementById('authLoginPopup').style.display = 'none';
        });

        document.getElementById('authOpenRegister').addEventListener('click', function() {
            document.getElementById('authRegisterPopup').style.display = 'flex';
        });

        document.getElementById('authCloseRegister').addEventListener('click', function() {
            document.getElementById('authRegisterPopup').style.display = 'none';
        });

    </script>
</body>

</html>