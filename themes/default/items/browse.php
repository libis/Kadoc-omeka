<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
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
   <div class='row top'>
     <div class="col-sm-12 col-xs-12">
         <h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>
         <?php if ($total_results > 0): ?>
             <?php
             $sortLinks[__('Title')] = 'Dublin Core,Title';
             $sortLinks[__('Creator')] = 'Dublin Core,Creator';
             $sortLinks[__('Date Added')] = 'added';
             ?>
             <div id="sort-links">
                 <span class="sort-label"><i class="material-icons">&#xE164;</i> <?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
             </div>
         <?php endif; ?>
     </div>
   </div>
    <?php echo item_search_filters(); ?>
    <?php echo pagination_links(); ?>

    <?php foreach (loop('items') as $item): ?>
      <div class="row">
        <div class="col-sm-10">
          <div class="list-row">
            <div class="row">
              <div class="col-sm-3">
                <?php if (metadata('item', 'has files')): ?>
                  <div class="item-img">
                      <?php echo link_to_item(item_image()); ?>
                  </div>
                <?php else: ?>
                      <div class="dummy"></div>
                <?php endif; ?>
              </div>
              <div class="col-sm-9">
                <div class="list-item">
                  <h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>

                  <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
                  <div class="item-description">
                      <p><?php echo $description; ?></p>
                  </div>
                  <?php endif; ?>

                  <?php if (metadata('item', 'has tags')): ?>
                  <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                      <?php echo tag_string('items'); ?></p>
                  </div>
                  <?php endif; ?>

                  <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
