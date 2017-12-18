<?php
  $pageTitle = __('Browse Collections');
  echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));

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
                 <span class="sort-label"><i class="material-icons">&#xE152;</i>
                    <?php echo __('Filter: '); ?></span>
                    <?php if($show_featured):?>
                      <a href="<?php echo url('items/browse');?>">
                        <?php echo __("All"); ?>
                      </a>
                    <?php else:?>
                      <a href="<?php echo url('items/browse?featured=1');?>">
                        <?php echo __("Featured"); ?>
                      </a>
                    <?php endif;?>
             </div>
         <?php endif; ?>
     </div>
   </div>


    <!--
    <?php if($show_featured):
       if($feat_records = libis_get_featured('collection')):
         foreach ($feat_records as $feat): ?>
         <div class="row">
           <div class="col-sm-12">
             <div class="feat-row">
               <div class="row">
                 <div class="col-md-12 col-lg-5">
                   <?php if ($collectionImage = record_image($feat,'fullsize')): ?>
                       <?php echo link_to_collection($collectionImage, array('class' => 'image'),'show',$feat); ?>
                   <?php else: ?>
                         <div class="dummy"></div>
                   <?php endif; ?>
                 </div>
                 <div class="col-md-12 col-lg-6">
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
   ?>-->

   <?php echo pagination_links(); ?>

   <div class="row">
     <?php foreach (loop('collections') as $collection): ?>
       <div class="col-sm-3">
          <?php
             $class = "";
             if($collection->featured):
               $class = 'featured';
             endif;
          ?>
          <div class="list-row <?php echo $class;?>">
            <?php if ($collectionImage = record_image('collection','square_thumbnail')): ?>
                <?php echo link_to_collection($collectionImage, array('class' => 'image')); ?>
            <?php else: ?>
                  <div class="dummy-box"><div class="dummy"></div></div>
            <?php endif; ?>
            <div class="list-item">
              <h3 class="star"><span><?php echo __('Featured');?></span></h3>
              <h2><i class="material-icons">&#xE3B6;</i><?php echo link_to_collection(); ?></h2>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

  </div>
</section>


<?php echo foot(); ?>
