<?php
$title = __('Browse Exhibits');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>
<section class="exhibit-show-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='row breadcrumbs'>
      <div class="col-sm-12 col-xs-12">
        <p id="simple-pages-breadcrumbs">
          <span><a href="<?php echo url('/');?>">Home</a></span>
           > <span><?php echo __("Exhibits");?></span>
         </p>
     </div>
   </div>
   <div class='row top'>
     <div class="col-sm-12 col-xs-12">
         <h1><?php echo $title; ?></h1>
     </div>
   </div>
<!--
   <?php
     //only show featured records on featured page and with filter on
     $params = $_GET;
     $show_featured = false;

     if(!isset($params['page'])):
       $params['page'] = "0";
     endif;

     if(isset($params['featured']) && isset($params['page'])):
       if($params['featured']=="0" && ($params['page'] == 0 || $params['page'] == 1)):
           $show_featured = true;
       endif;
     endif;


     if($show_featured):
       if($feat_records = libis_get_featured('exhibit')):
         foreach ($feat_records as $exhibit): ?>
         <div class="row">
           <div class="col-sm-12">
             <div class="feat-row exhibits-feat">
               <div class="row">
                 <div class="col-md-12 col-lg-5">
                   <?php if ($exhibitImage = record_image($exhibit, 'fullsize')): ?>
                       <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
                   <?php endif; ?>
                 </div>
                 <div class="col-md-12 col-lg-6">
                   <div class="list-item">
                     <h3><span><?php echo __('Featured');?></span></h3>
                     <h2><?php echo exhibit_builder_link_to_exhibit($exhibit,metadata($exhibit,'title')); ?></h2>
                     <?php if ($exhibitCredits = metadata($exhibit, 'credits')): ?>
                     <div class="credits"><p><?php echo $exhibitCredits; ?></p></div>
                     <?php endif; ?>
                     <?php if ($exhibitDescription = metadata($exhibit, 'description', array('no_escape' => true,'snippet'=>'400'))): ?>
                     <div class="description"><p><?php echo $exhibitDescription; ?></p></div>
                     <?php endif; ?>
                     <?php if ($exhibitTags = tag_string($exhibit, 'exhibits')): ?>
                     <p class="tags"><?php echo $exhibitTags; ?></p>
                     <?php endif; ?>
                   </div>
                   <div class="list-footer">
                     <?php echo exhibit_builder_link_to_exhibit($exhibit, __("Start tentoonstelling")); ?>
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

  <?php if (count($exhibits) > 0): ?>
  <?php echo pagination_links(); ?>

  <?php $exhibitCount = 0; $exhibit = $exhibits[0]; array_shift($exhibits);?>
  <div class="feat-row exhibits-feat">
    <div class="row">
      <div class="col-md-12 col-lg-3">
        <?php if ($exhibitImage = record_image($exhibit, 'thumbnail')): ?>
            <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
        <?php endif; ?>
      </div>
      <div class="col-md-12 col-lg-8">
        <div class="list-item">
          <h3><span><?php echo __('Featured');?></span></h3>
          <h2><?php echo exhibit_builder_link_to_exhibit($exhibit,metadata($exhibit,'title')); ?></h2>
          <?php if ($exhibitCredits = metadata($exhibit, 'credits')): ?>
          <div class="credits"><p><?php echo $exhibitCredits; ?></p></div>
          <?php endif; ?>
          <?php if ($exhibitDescription = metadata($exhibit, 'description', array('no_escape' => true,'snippet'=>'300'))): ?>
          <div class="description"><p><?php echo $exhibitDescription; ?></p></div>
          <?php endif; ?>
          <?php if ($exhibitTags = tag_string($exhibit, 'exhibits')): ?>
          <p class="tags"><?php echo $exhibitTags; ?></p>
          <?php endif; ?>
        </div>
        <div class="list-footer">
          <?php echo exhibit_builder_link_to_exhibit($exhibit, __("Start tentoonstelling")); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
  <?php foreach ($exhibits as $exhibit): ?>
      <?php $exhibitCount++; ?>
      <div class="col-md-3">
        <div class="list-row">
          <?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail')): ?>
              <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
          <?php endif; ?>
          <div class="list-item">
              <h2><?php echo exhibit_builder_link_to_exhibit($exhibit,metadata($exhibit,'title')); ?></h2>
              <?php if ($exhibitCredits = metadata($exhibit, 'credits')): ?>
              <div class="credits"><p><?php echo $exhibitCredits; ?></p></div>
              <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php else: ?>
    <p><?php echo __('There are no exhibits available yet.'); ?></p>
  <?php endif; ?>

  </div>
</section>
<?php echo foot(); ?>
