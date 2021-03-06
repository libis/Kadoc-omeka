<?php echo head(array('bodyid'=>'home', 'bodyclass' =>'two-col'));
$lang = get_language();
if($lang == "en"):
  $tag = "heritage+in+the+spotlight";
  $sort = "Story title";
else:
  $tag = "erfgoed+in+de+kijker";
  $sort = "Verhaal titel";
endif;
?>

<section class="home">
    <div id="content" class='container' role="main" tabindex="-1">
      <?php if($text = libis_get_simple_page_content('intro-'.$lang)):?>
        <div class="row">
          <div class="co col-md-8 col-sm-12 col-lg-8">
            <div class="summary">              
              <p><?php echo $text;?></p>
            </div>
          </div>
        </div>
      <?php endif;?>
      <div class="row">
        <div class="co col-md-6 col-sm-6 col-lg-4">
          <a class="block-link" href="<?php echo url("exhibits");?>"><h2><?php echo __('Exhibits');?></h2></a>
            <div class="col-content">
              <a class="block-link" href="<?php echo url("exhibits");?>"><img src="<?php echo img('placeholder1.jpg');?>"></a>
              <div class="summary">
                <p><?php echo __("Religion, culture and society interconnect constantly and in many different ways. These exhibitions illuminate a few exceptional aspects of cross-fertilization.");?></p>
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
                <p><?php echo __("The heritage preserved by KADOC is extremely rich and varied. Here we present a few remarkable collections.");?></p>
              </div>
            </div>
            <div class="col-footer">
              <a href="<?php echo url("collections");?>"><?php echo __('Discover our collections');?></a>
            </div>
        </div>
        <div class="co col-md-6 col-sm-6 col-lg-4">
          <a class="block-link" href="<?php echo url('items/browse?tags='.$tag.'&sort_field=Item+Type+Metadata%2C'.$sort);?>"><h2><?php echo __('Heritage in the spotlight');?></h2></a>
            <div class="col-content">
              <a class="block-link" href="<?php echo url('items/browse?tags='.$tag.'&sort_field=Item+Type+Metadata%2C'.$sort);?>"><img src="<?php echo img('placeholder3.jpg');?>"></a>
              <div class="summary">
                <p><?php echo __("Here we present surprising ‘objects’ of heritage held in KADOC's capacious collections, which are as varied in form as in content . They provide glimpses of neglected or forgotten facets of the rich history of Flanders.");?></p>
              </div>
            </div>
            <div class="col-footer">
              <a href="<?php echo url('items/browse?tags='.$tag.'&sort_field=Item+Type+Metadata%2C'.$sort);?>"><?php echo __('Discover our heritage objects');?></a>
            </div>
        </div>
      </div>
    </div>
</section>

<?php echo foot(); ?>
