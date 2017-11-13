<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title>Nucleus.Vision - Token Sale</title>  
    <link rel="stylesheet" href="css/global.css?v=6.0">
    <script src="js/jquery-3.2.1.min.js?v=6.0"></script>
    <script src="js/popper.min.js?v=6.0"></script>
    <script src="js/bootstrap.min.js?v=6.0"></script>
    <script src="js/owl.carousel.js?v=6.0"></script>
    <script src="js/wow.min.js?v=6.0"></script>
    <script src="js/jquery.validate.min.js?v=6.0"></script>
    <script src="js/sweetalert.min.js?v=6.0"></script>
    <script src="js/form-scripts.js?v=6.0"></script>
    <script src="js/app.js?v=6.0"></script>
    <!--[if IE]>
      <link href="css/bootstrap-ie9.css?v=6.0" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3?v=6.0"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <link href="css/bootstrap-ie8.css?v=6.0" rel="stylesheet">
    <![endif]-->
    <link rel="icon" href="img/favicon.png?v=6.0" type="image/png" sizes="16x16">
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107563572-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-107563572-1');
    </script>
    
    <style type="text/css">
		.token-cap-slider-container{
			position: relative;
			margin: 40px auto;
			display: block;
			padding: 50px 0px;
			width:600px;
		}
		.token-cap-slider{
			height:30px;
			border-radius:25px;
			border: solid 3px #ffaa00;	
			position: absolute;	
			top: 50%;
			left: 50%;
			margin-left: -300px;
			margin-top: -15px;
			width:600px;	
			z-index: 1;
		}
		.token-cap-slider-item{
			position: absolute;			
			height: 100px;
			width: 100px;
			margin-left: -50px;
			margin-top: -50px;
			text-align: center;
			z-index: 3;
		}
		.token-cap-slider-item.soft{
			top: 50%;
			left: 20%;
		}
		.token-cap-slider-item div{
			height: 60px;
			width: 3px;
			display: block;
			margin:4px auto;
			background: #ffaa00;
		}
		.token-cap-slider-item span b{
			color: #ffaa00;
			font-size: 18px;
		}
		.token-cap-slider-item.hard{
			top: 50%;
			right: -50px;
		}
		.token-cap-slider-completed{
			height:30px;
			border-radius:25px 0px 0px 25px;
			border: solid 3px #ffaa00;
			background: #ffaa00;	
			position: absolute;	
			top: 35px;
			left: 0;			
			width:20%;
			z-index: 2;
		}
	</style>
  </head>
  <body>
    <div class="wrapper">      
      <div class="top-nav">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-8 xs-text-left md-text-left">
              <a href="index.html" class="logo"><img src="img/logo.png?v=6.0"></a>
            </div>
            <div class="col-lg-9 col-4 ie-9-height">
			<!--
              <ul class="top-nav-bg xs-hidden md-hidden">
                <li>
                  <a href="team.html">Team</a>
                  <div class="glow-dot"></div>
                  <div class="left-corners"></div>
                  <div class="right-corners"></div>                  
                </li>                
                <li class="active">
                  <a href="token-sale.html">Token Sale</a>
                  <div class="glow-dot"></div>
                  <div class="left-corners"></div>
                  <div class="right-corners"></div> 
                </li>
                <li>
                  <a href="product.html">Product</a>
                  <div class="glow-dot"></div>
                  <div class="left-corners"></div>
                  <div class="right-corners"></div> 
                </li>
                <li>
                  <a href="roadmap.html">Roadmap</a>
                  <div class="glow-dot"></div>
                  <div class="left-corners"></div>
                  <div class="right-corners"></div> 
                </li>
                <li class="dropdown">
                  <a href="index.html#home-documents">Documents</a>
                  <div class="glow-dot"></div>
                  <div class="left-corners"></div>
                  <div class="right-corners"></div>
                  <div class="dropdown-content">
                    <a href="onepager.pdf?v=6.0" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i> One Pager</a>
                    <hr>
                    <a href="mini-whitepaper.pdf?v=6.0" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i> Mini White Paper</a>
                    <hr>
                    <a href="whitepaper.pdf?v=6.0" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i> White Paper</a>
                  </div>
                </li>
              </ul>
			  -->
              <div id="nav-icon1" class="xs-visible md-visible">
                <span></span>
                <span></span>
                <span></span>
              </div>
            </div>   
          </div>
        </div>
      </div>
      <div class="m-menu-bg xs-visible md-visible">        
        <a href="team.html">Team</a>          
        <a href="token-sale.html">Token Sale</a>
        <a href="product.html">Product</a>
        <a href="roadmap.html">Roadmap</a>
        <a href="#">Documents</a>
        <a href="onepager.pdf?v=6.0" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i> One Pager</a>
        <a href="mini-whitepaper.pdf?v=6.0" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i> Mini White Paper</a>
        <a href="whitepaper.pdf?v=6.0" target="_blank"><i class="fa fa-file-text-o" aria-hidden="true"></i> White Paper</a>
      </div>
      <div class="all-sections-bg">
      <section class="inner-page">
        <div class="container text-center">
          <h1 align="center" class="heading-1 mrb15 wow fadeInDown" data-wow-delay="0.5s">nCash token, currency of future</h1>
            <p align="center" class="fs-24 yellow xs-mrb-0 wow fadeInUp" data-wow-delay="0.5s">Crowdsale Cap 200K ETH, Contribution tokens Ethereum</p>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 header-btns mrtb15 text-right xs-mrb-0 wow fadeInUp ms-mrl-15" data-wow-delay="0.8s">
                  <a class="n-btn yellow-link pdlr-10 ie9" href="#" data-toggle="modal" data-target="#getNotifyPopup">Get notified about the sale</a>
                </div>
                <div class="col-lg-5 col-md-6 pdl0 xs-pdl21 xs-mrb-15 wow fadeInUp" data-wow-delay="1s">
                  <form action="" id="subscribeForm1">  
                    <div class="input-group mrt14">
                      <input type="text" class="form-control bradius-0 text-box-64 d-inline" id="email" name="email" placeholder="Email">
                      <button type="submit" class="n-btn notify-btn ie9-btn" id="form-submit">Notify Me</button> 
                    </div>
                  </form>
                </div>
              </div>
        </div>
      </section>
	  	
      <section class="pdtb-50">
        <div class="container">
          
          <div class="row justify-content-center">
            <div class="col-lg-8 offset-2-ie9">
              <h2 class="heading-1 yellow mrb15 wow fadeInDown" data-wow-delay="0.5s" align="center">Crowdfunding</h2>
              <h2 class="heading-2 blue wow fadeInUp" data-wow-delay="0.5s" align="center">Get Ready! nCash Token crowdsale is coming soon</h2>
              
              
              <div class="token-cap-slider-container">
                    <div class="token-cap-slider-completed"></div>
                    <div class="token-cap-slider">
                        <div class="token-cap-slider-item soft">
                            <span>Soft Cap</span>
                            <div></div>
                            <span><b class="soft-cap-txt">20K ETH</b></span>
                        </div>
                        <div class="token-cap-slider-item hard">
                            <span>Hard Cap</span>
                            <div></div>
                            <span><b>200K ETH</b></span>
                        </div>
                    </div>
             </div>
              
              
              <!--
              <p align="center" class="mrt24 wow fadeInUp" data-wow-delay="1s"><img src="img/cap-graph.png?v=6.0"></p>
              -->

              <h2 class="heading-2 blue wow fadeInDown" data-wow-delay="0.5s" align="center">Contribution Currency</h2>
              <div class="row">
                <div class="col-lg-12 col-12 text-center wow fadeInUp" data-wow-delay="1s">
                  <img src="img/ethereum.png?v=6.0" class="eth-logo mrb15">
                  <p class="fs-20">Ethereum</p>
                </div>
              </div>
              <p class="fs-21 fw-300 wow fadeInUp" data-wow-delay="0.5s" align="center">Sale will happen in Q4, 2017. Final dates yet to be announced.</p>         
            </div>
          </div>
          
          
          <hr>
          <h2 class="heading-1 yellow mrt50 wow fadeInDown" data-wow-delay="0.5s" align="center">Token Sale Terms</h2>
          <div class="row mrt50">
            <div class="col-lg-6 text-right md-text-center wow fadeInUp" data-wow-delay="0.5s">
              <p><img src="img/token-sale-chart-v1.png?v=6.0"></p>
            </div>
            <div class="col-lg-6 wow fadeInUp md-mrt30" data-wow-delay="0.5s">
              <p class="fs-20 fw-300"><b class="fl-big-24 blue">50%</b> Tokens for Public Contributors who participate in distribution process</p>
              <p class="fs-20 fw-300"><b class="fl-big-24 aa-c2">25%</b> Tokens will be allocated to Company Reserve </p>
              <p class="fs-20 fw-300"><b class="fl-big-24 aa-c3">20%</b> Tokens will be allocated to founding team and advisors</p>
              <p class="fs-20 fw-300"><b class="fl-big-24 aa-c4">5%</b> Tokens for Subcontractors and Bounty Campaign Members</p>
              <p class="fs-20 fw-300 mrt50">The total pool is fixed at 10,000,000,000 (10 billion) nCash tokens.</p>
              <p class="fs-20 fw-300">To know more join us on <a href="https://t.me/joinchat/DV-_WkdWOfF7YPsP-AoLVw" class="yellow-link" target="_blank">Telegram</a></p>
            </div>            
          </div> 
        </div>
      </section>
      <footer>
        <div class="footer-countdown white-box pdtb-50">
          <div class="container"> 
            <h2 class="font-36 yellow mrb30  wow fadeInDown" data-wow-delay="0.5s" align="center">Live data feed</h2>        
            <div class="row mrt50 live-data-feed-icons"> 
              <div class="col-lg-2 col-md-4 col-6 text-center wow fadeInUp" data-wow-delay="0.1s">
                <p><b class="na-counter">10</b></p>
                <p align="center"><img src="img/live-retail-stores.png?v=6.0" class="fmax-120"></p>
                <h3 class="blue fs-18 mrb15" align="center">Live retail stores</h3>
              </div>
              <div class="col-lg-2 col-md-4 col-6 text-center wow fadeInUp" data-wow-delay="0.2s">
                <p><b class="na-counter sensors_count">0</b></p>
                <p align="center"><img src="img/ion-icon.png?v=6.0" class="fmax-120"></p>
                <h3 class="blue fs-18 mrb15" align="center">Live ION Sensors</h3>
              </div>
              <div class="col-lg-2 col-md-4 col-6 text-center wow fadeInUp" data-wow-delay="0.3s">
                <p><b class="na-counter imei_count">0</b></p>
                <p align="center"><img src="img/unique-id-icon.png?v=6.0" class="fmax-120"></p>
                <h3 class="blue fs-18 mrb15" align="center">Unique identifications</h3>
              </div>
              <div class="clearfix hidden-sm-up"></div>
              <div class="col-lg-2 col-md-4 col-6 text-center wow fadeInUp" data-wow-delay="0.4s">
                <p><b class="na-counter authorizations">0</b></p>
                <p align="center"><img src="img/orbit.png?v=6.0" class="fmax-120"></p>
                
                <h3 class="blue fs-18 mrb15" align="center">Successful authorizations</h3>
              </div>
              <div class="col-lg-2 col-md-4 col-6 text-center wow fadeInUp" data-wow-delay="0.5s">
                <p><b class="na-counter recommendations">0</b></p>
                <p align="center"><img src="img/neuron.png?v=6.0" class="fmax-120"></p>
                <h3 class="blue fs-18 mrb15" align="center">Recommendations & Offers sent</h3>
              </div>
              <div class="col-lg-2 col-md-4 col-6 text-center wow fadeInUp" data-wow-delay="0.6s">
                <p><b class="na-counter benefits_availed">0</b></p>
                <p align="center"><img src="img/uup.png?v=6.0" class="fmax-120"></p>
                <h3 class="blue fs-18 mrb15" align="center">Offers availed</h3>
              </div>
            </div>
          </div>
        </div>
        <div class="container pdt50">         
          <div class="row mrb50 md-mrb-15 xs-mrb-15">
            <div class="col-lg-6 col-md-12 md-mrb-15">
              <div class="row">
                <div class="col-lg-5 col-md-6">
                  <h4>USA</h4>
                  <p>440 N Wolfe Rd, Sunnyvale<br>
                  California USA, 94085</p>
                  <p>info@nucleus.vision</p>
                </div>
                <div class="col-lg-7 col-md-6 xs-mrb-30">
                  <h4>India</h4>
                  Nucleus Vision, 1st Floor,<br>Serenity plaza, Begumpet,<br>Hyderabad, India
                </div>
              </div>
              </div>
              <div class="col-lg-6 col-md-12">
                <h4>Social</h4>
                <div class="social-icons mrb30">
                  <a href="https://www.facebook.com/NucleusVision-1626428670765385/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
                  <a href="https://twitter.com/NucleusVision" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  <a href="https://www.linkedin.com/company/13442372/" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                  <a href="https://medium.com/@NucleusVision" target="_blank"><i class="fa fa-medium" aria-hidden="true"></i></a>  
                  <a href="https://t.me/joinchat/DV-_WkdWOfF7YPsP-AoLVw" target="_blank"><i class="fa fa-telegram" aria-hidden="true"></i></a>
                  <a href="https://github.com/NucleusVision" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a>
                  <a href="https://www.reddit.com/r/NucleusVision/" target="_blank"><i class="fa fa-reddit-alien" aria-hidden="true"></i></a>
                </div>
                <h5>Get Notified About Token Sale</h5>              
                <form action="" id="subscribeForm">  
                  <div class="input-group mrt14">
                    <input type="text" class="form-control bradius-0 text-box-64 d-inline" id="email" name="email" placeholder="Email">
                    <button type="submit" class="n-btn notify-btn" id="form-submit">Notify Me</button> 
                  </div>
                </form>
              </div>
          </div>
          <hr>
          <div class="row mrb30">
            <div class="col-lg-12 col-md-12 text-center xs-text-left">&copy; 2014 Nucleus Vision (formerly Bell Boi, Inc.)
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
    <!-- Form Popup -->
    <div class="modal" id="getNotifyPopup">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="congrats.html" id="contactForm">
              <p>Email Address<br>
              <input type="text" name="email" id="email" class="form-control"></p>
        <div class="help-block with-errors"></div>
              <p class="mrb30">Amount<br>
              <select name="amount" class="form-control" id="amount">
                <option value="100 - 1,000 USD">100 - 1,000 USD</option>
                <option value="1,001 - 10,000 USD">1,001 - 10,000 USD</option>
                <option value="10,001 - 50,000 USD">10,001 - 50,000 USD</option>
                <option value="50,001 - 100,000 USD">50,001 - 100,000 USD</option>
                <option value="100,000 USD and more">100,000 USD and more</option>
                <option value="Less than 100 USD">Less than 100 USD</option>
              </select>              
              </p>
              <button type="submit" class="btn btn-bb" id="form-submit">Submit</button> <div style="display:none;" id="form-loader"> <img src="img/form-loader.gif" /></div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div href="#" id="gotop"><i class="fa fa-angle-up"></i></div> 
    <script src="js/tracker.js?v=6.0"></script>
    <script src="js/jquery.waypoints.min.js?v=6.0"></script>
    <script src="js/jquery.counterup.js?v=6.0"></script>
    <script>
        $(document).ready(function(){
            
        });
    </script>
  </body>
</html>