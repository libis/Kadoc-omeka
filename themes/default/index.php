<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>

<section class="home">
    <div id="content" class='container' role="main" tabindex="-1">
      <div class="row">
        <div class="co col-md-6 col-sm-6 col-lg-4">
          <a class="block-link" href="<?php echo url("exhibits");?>"><h2><?php echo __('Exhibits');?></h2></a>
            <div class="col-content">
              <a class="block-link" href="<?php echo url("exhibits");?>"><img src="<?php echo img('placeholder3.jpg');?>"></a>
              <div class="summary">
                <p>Donec laoreet vulputate ligula at sollicitudin. Vivamus ac lorem lobortis, aliquet erat eu, faucibus odio.</p>
              </div>
            </div>
            <div class="col-footer">
              <a href="<?php echo url("exhibits");?>">Bezoek onze tentoonstellingen</a>
            </div>
        </div>
        <div class="co col-sm-6 col-md-6 col-lg-4">
          <a class="block-link" href="<?php echo url("collections");?>"><h2><?php echo __('Collections');?></h2></a>
            <div class="col-content">
              <a class="block-link" href="<?php echo url("collections");?>"><img src="<?php echo img('placeholder2.jpg');?>"></a>
              <div class="summary">
                <p>Aenean bibendum, metus nec sodales rutrum, magna purus consectetur urna, sit amet pharetra nunc ante vitae sem.</p>
              </div>
            </div>
            <div class="col-footer">
              <a href="<?php echo url("collections");?>">Meer over onze collecties</a>
            </div>
        </div>
        <div class="co col-md-6 col-sm-6 col-lg-4">
          <a class="block-link" href="<?php echo url("items");?>"><h2>Erfgoed in de kijker</h2></a>
            <div class="col-content">
              <a class="block-link" href="<?php echo url("items");?>"><img src="<?php echo img('placeholder1.jpg');?>"></a>
              <div class="summary">
                <p>Duis auctor, ante a luctus euismod, arcu ligula imperdiet sapien, tincidunt vehicula orci tellus sed ligula.</p>
              </div>
            </div>
            <div class="col-footer">
              <a href="<?php echo url("items");?>">Lees meer</a>
            </div>
        </div>
      </div>
    </div>
</section>

<?php echo foot(); ?>
