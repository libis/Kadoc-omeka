    <footer role="contentinfo">
      <section class="home">
        <div class="container footer-container">
            <div id="footer-text">
              <div class="footer-row">
                <?php echo get_theme_option('Footer Text'); ?>
                <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
                    <p><?php echo $copyright; ?></p>
                <?php endif; ?>
                <div class="logo-kadoc">
                  <a href="https://kadoc.kuleuven.be/"><img src="<?php echo img("kadoc.jpg");?>"></a>
                </div>
                <div class="col-content">
                  <p>
                    Documentatie- en onderzoekscentrum voor religie, cultuur en samenleving<br>
                    Vlamingenstraat 39 | 3000 Leuven | +32 16 32 35 00<br>
                    postmaster@kadoc.kuleuven.be | <a href="http://kadoc.kuleuven.be">kadoc.kuleuven.be</a>
                  </p>
                  <!--<ul>
                    <li><a href="<?php echo url("route");?>">Routebeschrijving</a></li>
                    <li><a href="<?php echo url("contact");?>">Contact</a></li>
                  </ul>-->
                </div>
              </div>
              <div class="footer-row">
                <div class="col-content">    
                  <img src="<?php echo img("ErkendCultArch.jpg");?>">
                  <img src="<?php echo img("_erkendeerfbib.gif");?>">
                  <a href="http://www.ditisvlaanderen.be/"><img src="<?php echo img("vlaanderen.png");?>"></a>
                  <div class="copyright">© KADOC</div>
                </div>
              </div>
            </div>
            <?php fire_plugin_hook('public_footer', array('view' => $this)); ?>
        </div>
      </section>
    </footer><!-- end footer -->

    <script>

      jQuery('.navbar-toggler').click(function(e) {
        e.preventDefault();
        jQuery('.navbar-toggler').toggleClass('toggled');
        if(jQuery('.navbar-toggler').hasClass('toggled')){
          jQuery('.navbar-toggler').html("<i class='material-icons'>&#xE5CD;</i>");
        }else{
          jQuery('.navbar-toggler').html("<i class='material-icons'>&#xE5D2;</i>");
        }
      });

      jQuery(function () {
        jQuery('a[href="#search"]').on('click', function(event) {
            event.preventDefault();
            jQuery('#search').addClass('open');
            jQuery('#search > form > input[type="search"]').focus();
        });

        jQuery('#search, #search button.close').on('click keyup', function(event) {
            if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                $(this).removeClass('open');
            }
        });

    });

    </script>
</body>

</html>
