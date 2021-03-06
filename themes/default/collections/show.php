<?php
$collectionTitle = metadata('collection', 'display_title');
$lang = get_language();

if($lang == 'en'):
  $title = metadata('collection', array('Dublin Core', 'Alternative Title'));
  $subject = metadata('collection', array('Dublin Core', 'Source'), array('delimiter'=>", "));
  $description = metadata('collection', array('Dublin Core', 'Abstract'), array('delimiter'=>", "));
else:
  $title = metadata('collection', array('Dublin Core', 'Title'));
  $subject = metadata('collection', array('Dublin Core', 'Subject'), array('delimiter'=>", "));
  $description = metadata('collection', array('Dublin Core', 'Description'), array('delimiter'=>", "));
endif;
?>

<?php echo head(array('title'=> $title, 'bodyclass' => 'collections show')); ?>

<section class="browse-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='row breadcrumbs'>
      <div class="col-sm-12 col-12">
        <p id="simple-pages-breadcrumbs">
          <span><a href="<?php echo url('/');?>"><?php echo __("Home");?></a></span>
           > <span><a href="<?php echo url('/collections/browse');?>"><?php echo __('Collections');?></a></span>
           > <span><?php echo $title; ?></span>
         </p>
       </div>
    </div>
   <div class='row top'>
     <div class="col-md-10 col-12">
       <h1><?php echo $title; ?></h1>
       <?php if ($description): ?>
         <div class="collection-description">
             <?php echo text_to_paragraphs($description); ?>
         </div>
       <?php endif; ?>
       <?php if ($subject): ?>
         <div class="collection-description">
             <?php echo text_to_paragraphs("[".$subject."]"); ?>
         </div>
       <?php endif; ?>
       <div class="collection-description">
         <a href="<?php echo url("/geolocation/map/browse?collection=".$collection->id);?>"><i style="font-size:1rem;vertical-align:sub" class="material-icons">
map
</i><?php echo __("View the collection on the map");?></a>
       </div><br>
     </div>
   </div>
   <div class="row">
     <div class="col-sm-12">
       <?php echo pagination_links(); ?>
       <?php if (metadata('collection', 'total_items') > 0): ?>
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
                       <?php echo link_to_item(item_image('thumbnail',array('alt' => ''))); ?>
                   </div>
                 <?php endif; ?>
                 <hr>
                 <div class="card-block">
                   <div class="list-item">
                     <h3 class="star"><span><?php echo __('Featured');?></span></h3>
                     <!--<h3 class="star"><i class="material-icons">&#xE83A;</i><span><?php echo __('Featured');?></span></h3>-->
                     <?php if(metadata('item', array('Item Type Metadata', 'Verhaal titel')) && $lang == "nl"):?>
                       <h2><?php echo link_to_item(metadata('item', array('Item Type Metadata', 'Verhaal titel')), array('class'=>'permalink')); ?></h2>
                       <h3><?php echo metadata('item', array('Item Type Metadata', 'Verhaal ondertitel'));?></h3>
                     <?php elseif(metadata('item', array('Item Type Metadata', 'Story title')) && $lang == "en"): ?>
                       <h2><?php echo link_to_item(metadata('item', array('Item Type Metadata', 'Story title')), array('class'=>'permalink')); ?></h2>
                       <h3><?php echo metadata('item', array('Item Type Metadata', 'Story subtitle'));?></h3>
                     <?php elseif(metadata('item', array('Item Type Metadata', 'Title')) && $lang == "en"): ?>
                       <h3><?php echo link_to_item(metadata('item', array('Item Type Metadata', 'Title')), array('class'=>'permalink')); ?></h3>
                     <?php else:?>
                       <h3><?php echo link_to_item(metadata('item', array('Dublin Core', 'Title')), array('class'=>'permalink')); ?></h3>
                     <?php endif; ?>

                     <!--<?php if (metadata('item', 'has tags')): ?>
                       <div class="tags"></strong>
                           <?php echo tag_string('items'); ?>
                       </div>
                     <?php endif; ?>-->

                     <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
                   </div>
                 </div>
               </div>
           <?php endforeach; ?>
         </div>
         <div style="text-align:right;font-weight:bold;text-transform:uppercase;">
          <?php $totalItems = metadata('collection', 'total_items');?>
          <?php echo link_to_items_browse(__('View all objects in this collection'), array('collection' =>
          metadata('collection', 'id')), array('class' => 'view-items-link')); ?>
         </div>
        <?php else: ?>
            <p><?php echo __("There are currently no items within this collection."); ?></p>
        <?php endif; ?>
      </div>
    </div>
    <div class="plugins">
      <?php echo get_specific_plugin_hook_output('SocialBookmarking', 'public_collections_show', array('view' => $this, 'collection' => $collection)); ?>
      <?php echo get_specific_plugin_hook_output('Commenting', 'public_collections_show', array('view' => $this, 'collection' => $collection)); ?>
    </div>
  </div>
</section>

<?php echo foot(); ?>
