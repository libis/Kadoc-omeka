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
        <h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>
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

   <?php echo pagination_links(); ?>

   <?php foreach (loop('collections') as $collection): ?>

      <div class="row">
        <div class="col-sm-10">
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
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

<?php echo foot(); ?>
