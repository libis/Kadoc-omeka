    <footer role="contentinfo">
      <section class="home">
        <div class="container footer-container">
            <div id="footer-text">
                <?php echo get_theme_option('Footer Text'); ?>
                <?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
                    <p><?php echo $copyright; ?></p>
                <?php endif; ?>
                <div class="row">
                  <div class="co col-md-8 col-lg-8">
                    <h2>Kadoc</h2>
                    <div class="col-content">
                      <p>
                        Documentatie- en onderzoekscentrum voor religie, cultuur en samenleving<br>
                        Vlamingenstraat 39 | 3000 Leuven | +32 16 32 35 00<br>
                        postmaster@kadoc.kuleuven.be | <a href="http://kadoc.kuleuven.be">kadoc.kuleuven.be</a>
                      </p>
                      <ul>
                        <li><a href="<?php echo url("route");?>">Routebeschrijving</a></li>
                        <li><a href="<?php echo url("contact");?>">Contact</a></li>
                      </ul>
                      <img src="<?php echo img("kadoc.jpg");?>">
                      <img src="<?php echo img("ErkendCultArch.jpg");?>">
                      <img src="<?php echo img("_erkendeerfbib.gif");?>">
                      <img src="<?php echo img("vlaanderen.png");?>">
                      <img src="<?php echo img("uitpas-leuven.png");?>">
                    </div>
                  </div>
                  <div class="co col-md-6 col-lg-4">
                    <div class="col-content gebouw">
                      <img src="<?php echo img('kadoc_gebouw.jfif');?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-xl-12">
                        <div class="copyright">© KADOC</div>
                    </div>
                </div>
            </div>
            <?php fire_plugin_hook('public_footer', array('view' => $this)); ?>
        </div>
      </section>
    </footer><!-- end footer -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="<?php echo WEB_PUBLIC_THEME;?>/default/javascripts/bootstrap.min.js"></script>
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
