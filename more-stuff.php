<?php include 'Generic.php'; ?>
<?php include 'controller/Gamelist.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <title><?php echo APP_NAME; ?> || PROFILE PICTURE</title>
        <?php v_includeHeader(); ?>
    </head>
    <body>
        <div id="datacontent">
            <?php
            v_sessionedTopMenu();
            ?>
            <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
            <div class="page-container container">
                <div>
                    <div class="profile">
                        <?php profileInfoGeneral($avatar, $userid); ?>
                    </div>
                    <div class="line"></div>
                    <div class="sponsor-link" style="padding: 5px;">
                        <?php sponsorRedirect("http://google.com"); ?>
                    </div>
                    <div class="wrapp-container">
                        <div class="main-content">
                            <div  id="editprofilecontainer" class="formcontainer">
                                <div class="morstuff-title condenced">More Stuff</div>
                                <div class="more-content-wrapper">
                                    <div class="more-contents">
                                        <div class="left-column"><a href="mail_invitations.php">My Mail & Invites</a> <span class="shape-circle-red pull-right">2</span></div>
                                        <div class="right-column right-text arabic"><a href="mail_invitations.php">بلدي البريد و يدعو</a></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="more-contents">
                                        <div class="left-column"><a href="#tutorial" class="scroll-top">Tutorials</a></div>
                                        <div class="right-column right-text arabic"><a href="#tutorial" class="scroll-top">الدروس</a></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="more-contents">
                                        <div class="left-column"><a href="#points-bonus" class="scroll-top">Points & Bonus</a></div>
                                        <div class="right-column right-text arabic"><a href="#points-bonus" class="scroll-top">نقاط مكافأة و</a></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="more-contents">
                                        <div class="left-column"><a href="#prize-rules" class="scroll-top">Prizes & Rules</a></div>
                                        <div class="right-column right-text arabic"><a href="#prize-rules" class="scroll-top">الجوائز و قوانين</a></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="more-contents">
                                        <div class="left-column"><a href="#contact-us" class="scroll-top">Contact Us</a></div>
                                        <div class="right-column right-text arabic"><a href="#contact-us" class="scroll-top">الاتصال بنا</a></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="more-contents">
                                        <div class="left-column"><a href="#about-us" class="scroll-top">About Us</a></div>
                                        <div class="right-column right-text arabic"><a href="#about-us" class="scroll-top">حول بنا</a></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="more-contents">
                                        <div class="left-column"><a href="">Survey</a></div>
                                        <div class="right-column right-text arabic"><a href="">مسح</a></div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="tutorial">
                                        <h3 class="text-center" style="text-decoration: underline;color: #115DFF">Tutorial</h3>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                        </p>
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). 
                                        </p>
                                    </div>
                                    <div id="points-bonus">
                                        <h3 class="text-center" style="text-decoration: underline;color: #115DFF">Points & Bonus</h3>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                        </p>
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). 
                                        </p>
                                    </div>
                                    <div id="prize-rules">
                                        <h3 class="text-center" style="text-decoration: underline;color: #115DFF">Prize & Rules</h3>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                        </p>
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). 
                                        </p>
                                    </div>
                                    <div id="contact-us">
                                        <h3 class="text-center" style="text-decoration: underline;color: #115DFF">Contact Us</h3>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                        </p>
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). 
                                        </p>
                                    </div>
                                    <div id="about-us">
                                        <h3 class="text-center" style="text-decoration: underline;color: #115DFF">About Us</h3>
                                        <p>
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                        </p>
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). 
                                        </p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="usermenu-wrapper">
            <div class="more-stuff">
                <?php sponsorClose(); ?>
            </div>
            <?php bottomSessionedMenu("", "", "", "", "shape-active", ""); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <?php v_includeFooter(); ?>
    </body>
</html>

