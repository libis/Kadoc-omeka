<?php
$pageTitle = __('Browse Collections');
echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));
?>

<section class="browse-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='row breadcrumbs'>
      <div class="col-sm-12 col-xs-12">
        <p id="simple-pages-breadcrumbs">
          <span><a href="<?php echo url('/');?>">Home</a></span>
           > <span><?php echo __('Collections');?></a></span>
         </p>
     </div>
   </div>
   <div class='row top'>
     <div class="col-sm-12 col-xs-12">
        <h1><?php echo $pageTitle; ?></h1>
         <?php if ($total_results > 0): ?>
             <?php
             $sortLinks[__('Title')] = 'Dublin Core,Title';
             $sortLinks[__('Date Added')] = 'added';
             ?>
             <div id="sort-links">
                 <span class="sort-label"><i class="material-icons">&#xE164;</i> <?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
             </div>
         <?php endif; ?>
     </div>
   </div>

   <?php
     //only show featured records on featured page and with filter on
     $params = $_GET;
     $show_featured = false;
     if ($this->pageCount > 1):
         $page = $params['page'];
     else:
         $page = 0;
     endif;

     if(isset($params['featured'])):
       if($params['featured']=="no" && $page == 0):
           $show_featured = true;
       endif;
     endif;

     if($show_featured):
       if($feat_records = libis_get_featured('collection')):
         foreach ($feat_records as $feat): ?>
         <div class="row">
           <div class="col-sm-12">
             <div class="feat-row">
               <div class="row">
                 <div class="col-sm-5">
                   <?php if ($collectionImage = record_image($feat,'fullsize')): ?>
                       <?php echo link_to_collection($collectionImage, array('class' => 'image'),'show',$feat); ?>
                   <?php else: ?>
                         <div class="dummy"></div>
                   <?php endif; ?>
                 </div>
                 <div class="col-sm-6">
                   <div class="list-item">
                     <h3><span><?php echo __('Featured');?></span></h3>
                     <h2><?php echo link_to_collection(metadata($feat, array('Dublin Core', 'Title')),array(),'show',$feat); ?></h2>

                     <?php if ($description = metadata($feat, array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
                     <div class="item-description">
                         <p><?php echo $description; ?></p>
                     </div>
                     <?php endif; ?>

                     <?php if ($feat->hasContributor()): ?>
                       <div class="collection-contributors">
                           <p>
                           <strong><?php echo __('Contributors'); ?>:</strong>
                           <?php echo metadata($feat, array('Dublin Core', 'Contributor'), array('all'=>true, 'delimiter'=>', ')); ?>
                           </p>
                       </div>
                     <?php endif; ?>

                   </div>
                   <div class="list-footer">
                     <?php echo link_to_items_browse(__('View the items in %s', metadata($feat, array('Dublin Core', 'Title'))), array('collection' => metadata($feat, 'id'))); ?>
                   </div>
                 </div>
               </div>
             </div>
         </div>
       </div>
       <?php endforeach;
       endif;
     endif;
   ?>

   <?php echo pagination_links(); ?>

   <div class="row">
     <div class="col-sm-10">
       <?php foreach (loop('collections') as $collection): ?>
          <div class="list-row">
            <div class="row">
              <div class="col-sm-3">
                <?php if ($collectionImage = record_image('collection')): ?>
                    <?php echo link_to_collection($collectionImage, array('class' => 'image')); ?>
                <?php else: ?>
                      <div class="dummy"></div>
                <?php endif; ?>
              </div>
              <div class="col-sm-9">
                <div class="list-item">
                  <h2><?php echo link_to_collection(); ?></h2>
                  <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
                    <div class="collection-description">
                        <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
                    </div>
                  <?php endif; ?>

                  <?php if ($collection->hasContributor()): ?>
                    <div class="collection-contributors">
                        <p>
                        <strong><?php echo __('Contributors'); ?>:</strong>
                        <?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all'=>true, 'delimiter'=>', ')); ?>
                        </p>
                    </div>
                  <?php endif; ?>

                  <p class="view-items-link"><?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))), array('collection' => metadata('collection', 'id'))); ?></p>

                  <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

<?php echo foot(); ?>
