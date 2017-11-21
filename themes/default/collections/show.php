<?php
$collectionTitle = metadata('collection', 'display_title');
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>

<section class="browse-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='row breadcrumbs'>
      <div class="col-sm-12 col-xs-12">
        <p id="simple-pages-breadcrumbs">
          <span><a href="<?php echo url('/');?>">Home</a></span>
           > <span><a href="<?php echo url('/collections/browse');?>"><?php echo __('Collections');?></a></span>
           > <span><?php echo $collectionTitle; ?></span>
         </p>
       </div>
    </div>
   <div class='row top'>
     <div class="col-md-10 col-xs-12">
       <h1><?php echo $collectionTitle; ?></h1>
       <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
         <div class="collection-description">
             <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
         </div>
       <?php endif; ?>
     </div>
   </div>
   <div class="row">
     <div class="col-sm-10">
       <h2><?php echo link_to_items_browse(__('Items in the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h2>
       <?php if (metadata('collection', 'total_items') > 0): ?>
         <?php foreach (loop('items') as $item): ?>
           <?php $itemTitle = metadata('item', 'display_title'); ?>
           <div class="list-row">
             <div class="row">
               <div class="col-sm-3">
                 <?php if (metadata('item', 'has thumbnail')): ?>
                 <div class="item-img">
                     <?php echo link_to_item(item_image(null, array('alt' => $itemTitle))); ?>
                 </div>
                 <?php endif; ?>
               </div>
               <div class="col-sm-9">
                 <div class="list-item">

                   <h3><?php echo link_to_item($itemTitle, array('class'=>'permalink')); ?></h3>
                   <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
                      <div class="item-description">
                          <p><?php echo $description; ?></p>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
            <p><?php echo __("There are currently no items within this collection."); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
