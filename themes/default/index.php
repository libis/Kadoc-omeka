<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col')); ?>

<section class="home">
    <div id="content" class='container' role="main" tabindex="-1">
      <div class="row">
        <div class="co col-md-6 col-sm-6 col-lg-4">
          <a class="block-link" href="<?php echo url("exhibits");?>"><h2><?php echo __('Exhibits');?></h2></a>
            <div class="col-content">
              <a class="block-link" href="<?php echo url("exhibits");?>"><img src="<?php echo img('placeholder1.jpg');?>"></a>
              <div class="summary">
                <p><?php echo __("Religie, cultuur en samenleving haken voortdurend en op de meest diverse wijze op elkaar in. Deze tentoonstellingen gaan in op enkele bijzondere aspecten van die kruisbestuiving.");?></p>
              </div>
            </div>
            <div class="col-footer">
              <a href="<?php echo url("exhibits");?>"><?php echo __('Visit our exhibits');?></a>
            </div>
        </div>
        <div class="co col-sm-6 col-md-6 col-lg-4">
          <a class="block-link" href="<?php echo url("collections");?>"><h2><?php echo __('Collections');?></h2></a>
            <div class="col-content">
              <a class="block-link" href="<?php echo url("collections");?>"><img src="<?php echo img('placeholder2.jpg');?>"></a>
              <div class="summary">
                <p><?php echo __("Het erfgoed dat KADOC bewaart, is zeer rijk en divers. Hier presenteren we enkele opmerkelijke collecties.");?></p>
              </div>
            </div>
            <div class="col-footer">
              <a href="<?php echo url("collections");?>"><?php echo __('Discover our collections');?></a>
            </div>
        </div>
        <div class="co col-md-6 col-sm-6 col-lg-4">
          <a class="block-link" href="<?php echo url("items/browse?tags=Erfgoed+in+de+kijker");?>"><h2><?php echo __('Heritage in the spotlight');?></h2></a>
            <div class="col-content">
              <a class="block-link" href="<?php echo url("items/browse?tags=Erfgoed+in+de+kijker");?>"><img src="<?php echo img('placeholder3.jpg');?>"></a>
              <div class="summary">
                <p><?php echo __("Hier stellen we verrassende ‘objecten’ voor uit het omvangrijke en – zowel naar vorm als naar inhoud – diverse erfgoed van KADOC. Zo krijgt u inzicht in een ongekend of vergeten facet van de rijke geschiedenis van Vlaanderen.");?></p>
              </div>
            </div>
            <div class="col-footer">
              <a href="<?php echo url("items/browse?tags=Erfgoed+in+de+kijker");?>"><?php echo __('Discover our heritage items');?></a>
            </div>
        </div>
      </div>
    </div>
</section>

<?php echo foot(); ?>
