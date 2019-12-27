		
                </div><!-- End Main row -->
              
		<footer id="footer-content-info" role="contentinfo">
			<div class="row">
                            <div class="twelve columns">
                                <div class="footer-content">
                                    <div class="four columns">
                                        <?php dynamic_sidebar("Footer 1"); ?>
                                    </div>
                                    <div class="four columns">
                                        <?php dynamic_sidebar("Footer 2"); ?>
                                    </div>
                                    <div class="four columns">
                                        <?php dynamic_sidebar("Footer 3"); ?>
                                    </div>
                                </div>
                            </div>
			</div>
		</footer>
                
                <div id="footer-copyright">
                    <div id="copyright" class="row">
                            <div class="twelve columns">
                                <div class="six columns">
                                    <?php echo jwOpt::get_option('footer_text', ''); ?>
                                </div>
                                <div class="six columns copyright-menu">
                                    <?php wp_nav_menu( array( 'theme_location' => 'footer_navigation', 'menu_class' => 'template-footer-menu' ) ); ?>
                                </div>
                            </div>
                    </div>
                </div>
                
                </div><!-- End the template box -->
			
	</div><!-- Container End -->
        
	<?php echo jwStyle::get_bg_image(); ?>
        
        <?php if ( jwOpt::get_option('background_banner_show', '0')=='1' ) { ?>
        <div class="ad-back-image"></div>
        <?php } ?>
	
	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
	     chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7]>
		<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
	<?php if (jwOpt::is(jwOpt::get_option('google_analytics')) || jwOpt::is(jwOpt::get_option('custom_js'))) { ?>
                <script type="text/javascript">                    
                     <?php echo jwOpt::get_option('custom_js'); ?>    
                </script>
                <?php echo jwOpt::get_option('google_analytics'); ?>
        <?php } ?>
	
        
                
            <?php //PRETTYPHOTO GALERIE
            if(jwOpt::get_option('post_pp_galery','0') == '1'){ ?>
                 <script type="text/javascript" charset="utf-8">
                     jQuery(document).ready(function(){
                        jQuery(".gallery").find('a').attr('rel','prettyPhoto[gal1]');
                        jQuery(".gallery_slider").find('a').attr('rel','prettyPhoto[gal1]');
                        
                      });     
                 </script> 
            <?php } ?>    
                
                
                
                 
            

            
        <script type="text/javascript" charset="utf-8">
            
            var site_url = "<?php echo get_site_url(); ?>";
            
            var rtl = "<?php echo jwOpt::get_option('site_rtl', '0'); ?>";
            
            
             <?php if(jwOpt::get_option('totop_show_mobile','0') == '1'){ ?>
                wWidth = 10000;
                
           <?php }else{?>
                wWidth = jQuery(window).width();
           <?php }?>
               
               
            
            jQuery(document).ready(function(){
              //  open pinterrest in new tab
              jQuery(".social_button").find('a').attr('target','_blank');
              //inicializace prettyphoto
              jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools: false, default_width: 800, default_height: 500 , show_title: false});
            });
            
            
          

            
            /*facebook share*/
          (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/<?php echo jwOpt::get_option('social_comments_language', "en_GB"); ?>/all.js#xfbml=1";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));     
     </script> 
     
     <?php if(is_single()){ ?>
     
     <script type="text/javascript" charset="utf-8">
            
            
          
            
            
            /* twitter share*/
            
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");    
        
            /*google+ share */

             window.___gcfg = {lang: '<?php echo jwOpt::get_option('social_comments_language', "en_GB"); ?>'};
                (function() {
                  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                  po.src = 'https://apis.google.com/js/plusone.js';
                  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                })();
                
                
                /* stumble upon share
                (function() {
                var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
                li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
              })();*/
           
          
       </script> 
       
     <!-- Pinterest share -->
     <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
     
     <!-- Linkedin share -->
     <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
     
     <script language="JavaScript" type="text/javascript">
     <!--

     function Size(obj, s){
     document.getElementById(obj).size = s;
     }
     function cleanSize(obj) {
     document.getElementById(obj).size = 1;
     }
     </script>
        
     <?php } ?>
                          
<?php wp_footer(); ?>
</body>
</html>