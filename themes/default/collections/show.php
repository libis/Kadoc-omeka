<?php
$collectionTitle = metadata('collection', 'display_title');
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>

<section class="browse-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='row breadcrumbs'>
      <div class="col-sm-12 col-12">
        <p id="simple-pages-breadcrumbs">
          <span><a href="<?php echo url('/');?>">Home</a></span>
           > <span><a href="<?php echo url('/collections/browse');?>"><?php echo __('Collections');?></a></span>
           > <span><?php echo $collectionTitle; ?></span>
         </p>
       </div>
    </div>
   <div class='row top'>
     <div class="col-md-10 col-12">
       <h1><?php echo $collectionTitle; ?></h1>
       <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
         <div class="collection-description">
             <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
         </div>
       <?php endif; ?>
     </div>
   </div>
   <div class="row">
     <div class="col-sm-12">
       <h2 class="items-title"><?php echo link_to_items_browse(__('Items in the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h2>
       <?php if (metadata('collection', 'total_items') > 0): ?>
         <div class="card-columns">
           <?php foreach (loop('items') as $item): ?>
             <div class="card">
               <?php if (metadata('item', 'has files')): ?>
                 <div class="item-img">
                     <?php echo link_to_item(item_image('thumbnail')); ?>
                 </div>
               <?php endif; ?>
               <hr>
               <div class="card-block">
                 <div class="list-item">
                   <h2><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h2>

                   <!--<?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>200))): ?>
                   <div class="item-description">
                       <p><?php echo $description; ?></p>
                   </div>
                   <?php endif; ?>-->

                   <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
                 </div>
               </div>
             </div>
           <?php endforeach; ?>
         </div>
        <?php else: ?>
            <p><?php echo __("There are currently no items within this collection."); ?></p>
        <?php endif; ?>
      </div>
    </div>
    <div class="plugins">
      <?php echo get_specific_plugin_hook_output('SocialBookmarking', 'public_items_show', array('view' => $this, 'collection' => $collection)); ?>
      <?php echo get_specific_plugin_hook_output('Commenting', 'public_items_show', array('view' => $this, 'collection' => $collection)); ?>
    </div>
  </div>
</section>

<?php echo foot(); ?>
