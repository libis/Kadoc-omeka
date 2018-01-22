<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<?php
  //only show featured records on featured page and with filter on
  $params = $_GET;
  $show_featured = false;

  if(!isset($params['page'])):
    $params['page'] = "0";
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
           > <span>Objecten</a></span>
         </p>
     </div>
   </div>

   <h1><?php echo $pageTitle;?></h1>

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

    <?php echo item_search_filters(); ?>

    <?php //echo item_search_filters(); ?>
    <?php echo pagination_links(); ?>
    <div class="row">
      <div class="col-md-12">
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
      </div>
    </div>
  </div>
</div>


<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
