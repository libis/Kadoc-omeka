<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'item show')); ?>
<?php $type = metadata('item','item_type_name');?>
<?php $lang = get_language();?>
<?php if (metadata('item', 'has files') && $type != 'News'): ?>
  <section class="item-section">
      <div class="container">
        <div class='row breadcrumbs'>
            <div class="col-12">
                <p id="simple-pages-breadcrumbs">
                  <span><a href="<?php echo url('/');?>">Home</a></span>
                  <?php if (metadata('item', 'Collection Name')): ?>
                   > <span><a href="<?php echo url('items/browse');?>"><?php echo link_to_collection_for_item(); ?></a></span>
                  <?php endif; ?>
                   > <span><a href="<?php echo url('items/browse');?>"><?php echo __('Items');?></a></span>
                   > <?php echo metadata('item', array('Dublin Core', 'Title')); ?>
                 </p>
             </div>
        </div>
        <!-- The following returns all of the files associated with an item. -->
        <div class="item-files">
          <?php echo item_image_gallery(array('wrapper'=> array('class' => 'row'),'linkWrapper' => array('wrapper' => 'null','class' => 'col-sm-6 col-md-3 col-12 image'),'link'=>array('data-lightbox'=>'lightbox')),'thumbnail'); ?>
        </div>
      </div>
  </section>
<?php endif; ?>
<section class="metadata-section">
    <div id="content" class='container' role="main" tabindex="-1">
        <?php if ($type == 'News'): ?>
          <div class='row breadcrumbs'>
            <div class="col-12">
                <p id="simple-pages-breadcrumbs">
                  <span><a href="<?php echo url('/');?>">Home</a></span>
                   > <span><a href="<?php echo $type;?>"><?php echo $type;?></a></span>
                   > <?php echo metadata('item', array('Dublin Core', 'Title')); ?>
                 </p>
             </div>
          </div>
        <?php endif; ?>
        <div class="row content">
            <?php if (metadata('item', 'has files') && $type == 'News'): ?>
              <div class="col-sm-3 col-12">
                <div id="itemfiles" class="element">
                    <div class="element-text"><?php echo item_image_gallery(array('linkWrapper' => array('wrapper' => null,'class' => 'col-sm-2 col-xs-12 image')),'thumbnail'); ?></div>
                </div>
              </div>
              <div class="col-sm-9 col-12">
            <?php else:?>
              <div class="col-lg-8 col-md-12 col-12">
            <?php endif; ?>
            <?php if ($type != ''): ?>
              <!--<h3 class="type-title"><?php echo $type;?></h3>-->
            <?php endif; ?>

            <?php if($lang == 'nl'):?>
              <h1 class="section-title projecten-title"><span><?php echo metadata('item', array('Dublin Core', 'Title')); ?></span></h1>
            <?php else:?>
              <h1 class="section-title projecten-title"><span><?php echo metadata('item', array('Item Type Metadata', 'Title')); ?></span></h1>
            <?php endif;?>

            <?php if ($type != 'News'): ?>
                <div class="element-set">
                  <!-- creators -->
                  <?php if($lang== "nl" && $text = metadata('item', array('Dublin Core','Creator'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Creator');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- creators english -->
                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Creator'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Creator');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- description -->
                  <?php if($lang== "nl" && $text = metadata('item', array('Dublin Core','Description'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Description');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- description english -->
                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Description'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Description');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- herkomst -->
                  <?php if($lang== "nl" && $text = metadata('item', array('Item Type Metadata','Herkomst'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3>Herkomst</h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- Copyright -->
                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Copyright'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3>Copyright</h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- jaar -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Jaar'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Date');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- signatuur -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Signatuur'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Call number');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- If the item belongs to a collection, the following creates a link to that collection. -->
                  <?php if (metadata('item', 'Collection Name')): ?>
                  <div id="collection" class="element">
                      <h3><?php echo __('Collection'); ?></h3>
                      <div class="element-text"><?php echo link_to_collection_for_item(); ?></div>
                  </div>
                  <?php endif; ?>

                  <!-- The following prints a list of all tags associated with the item -->
                  <?php if (metadata('item', 'has tags')): ?>
                  <div id="item-tags" class="element">
                      <h3><?php echo __('Tags'); ?></h3>
                      <div class="element-text"><?php echo tag_string('item'); ?></div>
                  </div>
                  <?php endif;?>

                  <ul>
                    <?php if ($text = metadata('item', array('Item Type Metadata','LIMO'))): ?>
                    <li>
                      <a target="_blank" href="<?php echo $text;?>"><?php echo __('Link naar LIMO');?></a>
                    </li>
                    <?php endif; ?>

                    <?php if ($text = metadata('item', array('Item Type Metadata','Teneo'))): ?>
                    <li>
                      <a target="_blank" href="<?php echo $text;?>"><?php echo __('Link naar Teneo');?></a>
                    </li>
                    <?php endif; ?>

                    <?php if ($text = metadata('item', array('Item Type Metadata','ScopeArchiv'))): ?>
                    <li>
                      <a target="_blank" href="<?php echo $text;?>"><?php echo __('Link naar ScopeArchiv');?></a>
                    </li>
                    <?php endif; ?>
                  </ul>
                </div>
            <?php else:?>
                  <p class="date"><?php echo metadata('item', array('Dublin Core', 'Date')); ?></p>
                  <p class="description"><?php echo metadata('item', array('Dublin Core', 'Description')); ?></p>
            <?php endif; ?>
          </div>
          <div class="col-lg-4 col-md-12 col-12">
            <?php echo get_specific_plugin_hook_output('Geolocation', 'public_items_show', array('view' => $this, 'item' => $item)); ?>
          </div>
        </div>
        <div class="row content">
            <div class="col-12">
              <ul class="item-pagination navigation">
                  <li id="previous-item" class="previous"><?php echo link_to_previous_item_show("&#8249; Previous"); ?></li>
                  <li id="next-item" class="next"><?php echo link_to_next_item_show('Next &#8250;'); ?></li>
              </ul>
            </div>
        </div>
        <div class="plugins">
          <?php echo get_specific_plugin_hook_output('SocialBookmarking', 'public_items_show', array('view' => $this, 'item' => $item)); ?>

          <?php echo get_specific_plugin_hook_output('Commenting', 'public_items_show', array('view' => $this, 'item' => $item)); ?>

        </div>
    </div>
</section>
<?php echo foot(); ?>
