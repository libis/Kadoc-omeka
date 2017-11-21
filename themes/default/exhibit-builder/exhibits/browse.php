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
         <h1><?php echo $title; ?> <?php echo __('(%s total)', $total_results); ?></h1>
     </div>
   </div>

  <?php if (count($exhibits) > 0): ?>
  <?php echo pagination_links(); ?>

  <?php $exhibitCount = 0; ?>
  <?php foreach (loop('exhibit') as $exhibit): ?>
      <?php $exhibitCount++; ?>
      <div class="row <?php if ($exhibitCount%2==1) echo ' even'; else echo ' odd'; ?>">
        <div class="col-sm-10">
          <div class="list-row">
            <div class="row">
              <div class="col-sm-3">
                <?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail')): ?>
                    <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
                <?php endif; ?>
              </div>
              <div class="col-sm-9">
                <div class="list-item">
                  <h2><?php echo link_to_exhibit(); ?></h2>
                  <?php if ($exhibitCredits = metadata('exhibit', 'credits')): ?>
                  <div class="credits"><p><?php echo $exhibitCredits; ?></p></div>
                  <?php endif; ?>
                  <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true,'snippet'=>'400'))): ?>
                  <div class="description"><p><?php echo $exhibitDescription; ?></p></div>
                  <?php endif; ?>
                  <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
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
    <?php endforeach; ?>

    <?php echo pagination_links(); ?>

    <?php else: ?>
    <p><?php echo __('There are no exhibits available yet.'); ?></p>
    <?php endif; ?>

  </div>
</section>
<?php echo foot(); ?>
