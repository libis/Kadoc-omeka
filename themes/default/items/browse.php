<?php
  $pageTitle = __('Browse Items');
  echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
  $lang = get_language();

  //only show featured records on featured page and with filter on
  $params = $_GET;
  $show_featured = false;$erfgoed = false;

  if(!isset($params['page'])):
    $params['page'] = "0";
  endif;

  if(isset($params['tags'])):
    if($params['tags']=="Erfgoed in de kijker"):
        $erfgoed = true;
    endif;
  endif;

  if(isset($params['featured'])):
    if($params['featured']=="1"):
        $show_featured = true;
    endif;
  endif;
?>

<section class="browse-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='row breadcrumbs'>
      <div class="col-sm-12 col-xs-12">
        <p id="simple-pages-breadcrumbs">
          <span><a href="<?php echo url('/');?>">Home</a></span>
          <?php if($erfgoed):?>
           > <span><?php echo __("Heritage in the spotlight");?></span>
          <?php else:?>
           > <span><?php echo __("Objects");?></span>
          <?php endif;?>
         </p>
     </div>
   </div>

   <?php if($erfgoed):?>
     <h1><?php echo __("Heritage in the spotlight");?></h1>
   <?php else:?>
     <h1><?php echo $pageTitle;?></h1>
   <?php endif;?>

   <?php if ($total_results > 0): ?>
       <?php
       $sortLinks[__('Title')] = 'Dublin Core,Title';
       $sortLinks[__('Creator')] = 'Dublin Core,Creator';
       $sortLinks[__('Date Added')] = 'added';
       ?>
       <div id="sort-links">
           <span class="sort-label"><i class="material-icons">&#xE164;</i> <?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
           <span class="sort-label"><i class="material-icons">&#xE152;</i>
           <?php echo __('Filter:');?></span>
           <ul id="sort-links-list">
             <li><a href="<?php echo url('items/browse');?>"><?php echo __("Show all");?></a></li>
              <?php if(!$show_featured):?>
                <li>
                  <a href="<?php echo url('items/browse?featured=1');?>">
                    <?php echo __("Featured"); ?>
                  </a>
                </li>
              <?php endif;?>
            </ul>
       </div>
    <?php endif; ?>

    <?php if(!$erfgoed):?>
      <?php echo item_search_filters(); ?>
    <?php endif; ?>
    <?php //echo item_search_filters(); ?>
    <?php echo pagination_links(); ?>

    <?php if($erfgoed):?>
        <?php foreach (loop('items') as $item): ?>
          <div class="row kijker">
            <div class="col-md-6 col-12">
                <?php if (metadata('item', 'has files')): ?>
                  <div class="img-kijker">
                      <?php echo link_to_item(item_image('fullsize')); ?>
                  </div>
                <?php endif; ?>

                <section class="metadata-section">
                  <?php if($lang == 'nl'):?>
                    <h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>
                  <?php else:?>
                    <h2><?php echo link_to_item(metadata('item', array('Item Type Metadata', 'Title')), array('class'=>'permalink')); ?></h2>
                  <?php endif;?>

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
                </section>
                <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
            </div>
            <div class="col-md-6 col-12">
              <?php if($lang == "nl" && $text = metadata('item', array('Item Type Metadata', 'Verhaal'))):?>
                <?php echo $text;?>
              <?php endif;?>
              <?php if($lang == "en" && $text = metadata('item', array('Item Type Metadata', 'Story'))):?>
                <?php echo $text;?>
              <?php endif;?>
            </div>
          </div>
        <?php endforeach;?>
    <?php else:?>
      <div class="card-columns">
        <?php foreach (loop('items') as $item): ?>
            <?php
              $class = "";
              if($item->featured):
                $class = 'featured';
              endif;
            ?>
            <div class="card <?php echo $class;?>">
              <?php if (metadata('item', 'has files')): ?>
                <div class="item-img">
                    <?php echo link_to_item(item_image('thumbnail')); ?>
                </div>
              <?php endif; ?>
              <hr>
              <div class="card-block">
                <div class="list-item">
                  <!--<h3 class="star"><i class="material-icons">&#xE83A;</i><span><?php echo __('Featured');?></span></h3>-->
                  <h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>

                  <?php if (metadata('item', 'has tags')): ?>
                    <div class="tags"></strong>
                        <?php echo tag_string('items'); ?>
                    </div>
                  <?php endif; ?>

                  <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
                </div>
              </div>
            </div>
        <?php endforeach; ?>
      </div>
    <?php endif;?>


  </div>
</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
