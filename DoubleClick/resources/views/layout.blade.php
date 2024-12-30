<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Double Click</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    @yield('css')
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
                            <div class="tg-addnav-container">
                                <!-- Contact và Help -->
                                <div class="dropdown tg-themedropdown tg-contactdropdown">
                                    <a href="javascript:void(0);" class="tg-btnthemedropdown">
                                        <i class="icon-envelope"></i>
                                        <span>Liên hệ</span>
                                    </a>
                                </div>
                                <div class="dropdown tg-themedropdown tg-helpdropdown">
                                    <a href="javascript:void(0);" class="tg-btnthemedropdown">
                                        <i class="icon-question-circle"></i>
                                        <span>Giúp đỡ</span>
                                    </a>
                                </div>
                                <!-- Wishlist và Cart -->
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
                                    <div class="auth-button-container">
                                        <button id="authOpenLogin" class="auth-button">Đăng nhập</button>
                                        <button id="authOpenRegister" class="auth-button">Đăng ký</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Popup Login -->
                            <div class="auth-popup" id="authLoginPopup">
                                <div class="auth-popup-content">
                                    <span class="auth-close-btn" id="authCloseLogin">&times;</span>
                                    <h2>Login</h2>
                                    <form>
                                        <label for="authLoginEmail">Email:</label>
                                        <input type="email" id="authLoginEmail" placeholder="Enter your email"
                                            required>
                                        <label for="authLoginPassword">Password:</label>
                                        <input type="password" id="authLoginPassword" placeholder="Enter your password"
                                            required>
                                        <button type="submit">Đăng nhập</button>
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
                                        <input type="email" id="authRegisterEmail" placeholder="Enter your email"
                                            required>
                                        <label for="authRegisterPassword">Password:</label>
                                        <input type="password" id="authRegisterPassword"
                                            placeholder="Enter your password" required>
                                        <label for="authRegisterConfirmPassword">Confirm Password:</label>
                                        <input type="password" id="authRegisterConfirmPassword"
                                            placeholder="Confirm your password" required>
                                        <button type="submit">Đăng ký</button>
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
                            <div class="tg-logo"><a href="{{ route('user') }}"><img src="img/logoname.png"
                                        alt="DoubleClick"></a></div>
                            <div class="tg-searchbox">
                                <form class="tg-formtheme tg-formsearch">
                                    <fieldset>
                                        <input type="text" name="search" class="typeahead form-control"
                                            placeholder="Tìm kiếm theo tiêu đề, tác giả, từ khóa, ISBN...">
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
                        <div class="col-12">
                            <nav id="tg-nav" class="tg-nav">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                        data-target="#tg-navigation" aria-expanded="false">
                                        <span class="sr-only">Chuyển đổi menu</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                                    <ul class="tg-nav-list">
                                        <li class="menu-item-has-children menu-item-has-mega-menu">
                                            <a href="javascript:void(0);">Tất cả danh mục</a>
                                        </li>
                                        <li class="menu-item-has-children current-menu-item">
                                            <a href="javascript:void(0);">Trang Chủ</a>
                                            <ul class="sub-menu">
                                                <li class="current-menu-item"><a href="index-2.html">Trang Chủ V
                                                        một</a></li>
                                                <li><a href="indexv2.html">Trang Chủ V hai</a></li>
                                                <li><a href="indexv3.html">Trang Chủ V ba</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0);">Tác giả</a>
                                            <ul class="sub-menu">
                                                <li><a href="authors.html">Tác giả</a></li>
                                                <li><a href="authordetail.html">Chi tiết tác giả</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="javascript:void(0);">Tin tức mới nhất</a>
                                            <ul class="sub-menu">
                                                <li><a href="newslist.html">Danh sách tin tức</a></li>
                                                <li><a href="newsgrid.html">Lưới tin tức</a></li>
                                                <li><a href="newsdetail.html">Chi tiết tin tức</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('contact.form') }}">Liên hệ</a></li>
                                        <li class="menu-item-has-children current-menu-item">
                                            <a href="javascript:void(0);"><i class="icon-menu"></i></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item-has-children">
                                                    <a href="aboutus.html">Sản phẩm</a>
                                                    <ul class="sub-menu">
                                                        <li><a href="products.html">Sản phẩm</a></li>
                                                        <li><a href="productdetail.html">Chi tiết sản phẩm</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="aboutus.html">Về chúng tôi</a></li>
                                                <li><a href="404error.html">Lỗi 404</a></li>
                                                <li><a href="comingsoon.html">Sắp ra mắt</a></li>
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
        <div>
            @yield('content')
        </div>

        </main>
        <!--************************************
    Main End
  *************************************-->

        <!--************************************
            Box chat Start
        *************************************-->
        <div id="chat-icon" onclick="toggleChatBox()">
            <img src="img/logochatmes.png" alt="Tư vấn" />
        </div>

        <div id="chatbox" style="display: none;">
            <div id="chat-header">Tư vấn trực tuyến</div>
            <div id="chat-messages"></div>
            <div id="chat-input">
            <input type="text" id="message" placeholder="Nhập tin nhắn..." />
            <button onclick="sendMessage()">Gửi</button>
            </div>
        </div>



        <!--************************************
            Box chat End
        *************************************-->

<!--************************************
    Footer Start
  *************************************-->
        <footer id="tg-footer" class="tg-footer tg-haslayout">
            <div class="tg-footerarea">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <ul class="tg-clientservices" style="display: flex; flex-wrap: wrap; gap: 15px;">
                                <li class="tg-devlivery" style="flex: 1 1 22%; padding: 10px;">
                                    <span class="tg-clientserviceicon"><i class="icon-rocket"></i></span>
                                    <div class="tg-titlesubtitle">
                                        <h3>Giao Hàng Nhanh</h3>
                                        <p class="o">Vận chuyển toàn cầu</p>
                                    </div>
                                </li>
                                <li class="tg-discount" style="flex: 1 1 22%; padding: 10px;">
                                    <span class="tg-clientserviceicon"><i class="icon-tag"></i></span>
                                    <div class="tg-titlesubtitle">
                                        <h3>Giảm Giá Mở</h3>
                                        <p class="o">Đang áp dụng giảm giá</p>
                                    </div>
                                </li>
                                <li class="tg-quality" style="flex: 1 1 22%; padding: 10px;">
                                    <span class="tg-clientserviceicon"><i class="icon-leaf"></i></span>
                                    <div class="tg-titlesubtitle">
                                        <h3>Chất Lượng Cao</h3>
                                        <p class="o">Cung cấp sản phẩm chất lượng</p>
                                    </div>
                                </li>
                                <li class="tg-support" style="flex: 1 1 22%; padding: 10px;">
                                    <span class="tg-clientserviceicon"><i class="icon-heart"></i></span>
                                    <div class="tg-titlesubtitle">
                                        <h3>Hỗ Trợ 24/7</h3>
                                        <p class="o">Phục vụ mọi lúc mọi nơi</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="tg-threecolumns">
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="tg-footercol">
                                    <strong class="tg-logo"><a href="{{ route('user') }}"><img src="img/logoname.png"
                                                alt="Mô tả hình ảnh"></a></strong>
                                    <ul class="tg-contactinfo">
                                        <li>
                                            <i class="icon-apartment"></i>
                                            <address>65 Huỳnh Thúc Kháng , P. Bến Nghé, Q. 1, TP.HCM</address>
                                        </li>
                                        <li>
                                            <i class="icon-phone-handset"></i>
                                            <span>
                                                <em>0123456789</em>
                                            </span>
                                        </li>
                                        <li>
                                            <i class="icon-clock"></i>
                                            <span>Phục vụ 24/7</span>
                                        </li>
                                        <li>
                                            <i class="icon-envelope"></i>
                                            <span>
                                                <em><a href="mailto:support@domain.com">DoubleClick@gmail.com</a></em>
                                            </span>
                                        </li>
                                    </ul>
                                    <ul class="tg-socialicons">
                                        <li class="tg-facebook"><a href="javascript:void(0);"><i
                                                    class="fa fa-facebook"></i></a></li>
                                        <li class="tg-googleplus"><a href="javascript:void(0);"><i
                                                    class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="tg-footercol tg-widget tg-widgetnavigation">
                                    <div class="tg-widgettitle">
                                        <h3>Thông Tin Vận Chuyển Và Hỗ Trợ</h3>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <ul>
                                            <li><a href="javascript:void(0);">Điều Khoản Sử Dụng</a></li>
                                            <li><a href="javascript:void(0);">Điều Khoản Bán Hàng</a></li>
                                            <li><a href="javascript:void(0);">Chính Sách Đổi Trả</a></li>
                                            <li><a href="javascript:void(0);">Chính Sách Bảo Mật</a></li>
                                            <li><a href="javascript:void(0);">Cookies</a></li>
                                            <li><a href="javascript:void(0);">Liên Hệ Với Chúng Tôi</a></li>
                                            <li><a href="javascript:void(0);">Các Đối Tác Của Chúng Tôi</a></li>
                                            <li><a href="javascript:void(0);">Tầm Nhìn & Mục Tiêu</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="javascript:void(0);">Câu Chuyện Của Chúng Tôi</a></li>
                                            <li><a href="javascript:void(0);">Gặp Gỡ Đội Ngũ Của Chúng Tôi</a></li>
                                            <li><a href="javascript:void(0);">Câu Hỏi Thường Gặp</a></li>
                                            <li><a href="javascript:void(0);">Lời Chứng Thực</a></li>
                                            <li><a href="javascript:void(0);">Gia Nhập Đội Ngũ Của Chúng Tôi</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="tg-footercol tg-widget tg-widgettopsellingauthors">
                                    <div class="tg-widgettitle">
                                        <h3>Tác Giả Bán Chạy Nhất</h3>
                                    </div>
                                    <div class="tg-widgetcontent">
                                        <ul>
                                            <li>
                                                <figure><a href="javascript:void(0);"><img
                                                            src="img/author/imag-09.jpg" alt="Mô tả hình ảnh"></a>
                                                </figure>
                                                <div class="tg-authornamebooks">
                                                    <h4><a href="javascript:void(0);">Nguyễn Minh Tân</a></h4>
                                                    <p>21,658 Sách Đã Xuất Bản</p>
                                                </div>
                                            </li>
                                            <li>
                                                <figure><a href="javascript:void(0);"><img
                                                            src="img/author/imag-10.jpg" alt="Mô tả hình ảnh"></a>
                                                </figure>
                                                <div class="tg-authornamebooks">
                                                    <h4><a href="javascript:void(0);">Trần Chí Đạt</a></h4>
                                                    <p>20,257 Sách Đã Xuất Bản</p>
                                                </div>
                                            </li>
                                            <li>
                                                <figure><a href="javascript:void(0);"><img
                                                            src="img/author/imag-11.jpg" alt="Mô tả hình ảnh"></a>
                                                </figure>
                                                <div class="tg-authornamebooks">
                                                    <h4><a href="javascript:void(0);">Nguyễn Thị Tuyết Nhật</a></h4>
                                                    <p>15,686 Sách Đã Xuất Bản</p>
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
            <div class="tg-footerbar">
                <a id="tg-btnbacktotop" class="tg-btnbacktotop" href="javascript:void(0);"><i
                        class="icon-chevron-up"></i></a>
                <div class="container">
                    <div class="row">
                        <div class="text-align-center">
                            <span class="tg-copyright">Bản quyền &copy; DoubleClick 2024</span>
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
    <script>
        function toggleChatBox() {
            const chatBox = document.getElementById("chatbox");
            if (chatBox.classList.contains("show")) {
                chatBox.classList.remove("show");
            } else {
                chatBox.classList.add("show");
            }
        }
        function toggleChatBox() {
            const chatBox = document.getElementById("chatbox");
            const overlay = document.getElementById("overlay");

            if (chatBox.style.display === "none") {
                chatBox.style.display = "block";
                overlay.style.display = "block";
            } else {
                chatBox.style.display = "none";
                overlay.style.display = "none";
            }
        }



        function sendMessage() {
            const messageInput = document.getElementById("message");
            const chatMessages = document.getElementById("chat-messages");
            const message = messageInput.value;

            if (message.trim() !== "") {
                const newMessage = document.createElement("div");
                newMessage.textContent = "Bạn: " + message;
                newMessage.style.margin = "5px 0";
                chatMessages.appendChild(newMessage);

                messageInput.value = ""; // Clear the input

                // Giả lập phản hồi tự động
                setTimeout(() => {
                const botMessage = document.createElement("div");
                botMessage.textContent = "Tư vấn viên: Cảm ơn bạn đã nhắn tin!";
                botMessage.style.margin = "5px 0";
                botMessage.style.color = "blue";
                chatMessages.appendChild(botMessage);

                // Thêm câu hỏi và 3 tùy chọn
                setTimeout(() => {
                    const questionMessage = document.createElement("div");
                    questionMessage.textContent = "Tôi có thể giúp gì cho bạn?";
                    questionMessage.style.margin = "5px 0";
                    questionMessage.style.color = "blue";
                    chatMessages.appendChild(questionMessage);

                    // Thêm các tùy chọn
                    const options = [
                    { text: "Hỗ trợ kỹ thuật", action: () => alert("Bạn đã chọn: Hỗ trợ kỹ thuật") },
                    { text: "Thông tin sản phẩm", action: () => alert("Bạn đã chọn: Thông tin sản phẩm") },
                    { text: "Liên hệ trực tiếp", action: () => alert("Bạn đã chọn: Liên hệ trực tiếp") },
                    ];

                    const optionsContainer = document.createElement("div");
                    optionsContainer.style.margin = "10px 0";

                    options.forEach((option) => {
                    const button = document.createElement("button");
                    button.textContent = option.text;
                    button.style.margin = "5px";
                    button.style.padding = "5px 10px";
                    button.style.backgroundColor = "#0078d7";
                    button.style.color = "#fff";
                    button.style.border = "none";
                    button.style.cursor = "pointer";
                    button.style.borderRadius = "5px";
                    button.addEventListener("click", option.action);
                    optionsContainer.appendChild(button);
                    });

                    chatMessages.appendChild(optionsContainer);
                }, 1000);
                }, 1000);
            }
            }


    </script>
    @yield('js')
</body>

</html>
