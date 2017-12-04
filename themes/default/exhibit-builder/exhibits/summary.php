<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>
<style>
header {
    background: #F4F5F8 url("<?php echo WEB_PUBLIC_THEME.'/default/images/exhibits/banner_'.metadata('exhibit', 'slug').'.jpg';?>") no-repeat center center/cover;
}
</style>
<section class="exhibit-show-section">
  <div id="content" class='container' role="main" tabindex="-1">

      <div class='row'>
        <div class='col-md-6 col-12'>
          <div class="summary-text">
            <h1>Inleiding</h1>
            <?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
                <div class="exhibit-credits">
                      <h3><?php echo $exhibitCredits; ?></h3>
                </div>
            <?php endif; ?>

            <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
                <div class="exhibit-description">

                    <?php echo $exhibitDescription; ?>
                </div>
            <?php endif; ?>
            <div class="start">
              <a href="<?php echo $exhibit->getFirstTopPage()->getRecordUrl();?>"><?php echo __("Start tentoonstelling");?></a>
            </div>
          </div>
        </div>
        <div class='col-md-5 col-12'>

          <div class="side">

            <div class="side-nav">
              <?php echo exhibit_builder_page_nav(); ?>
              <?php
              $pageTree = exhibit_builder_page_tree();
              if ($pageTree):
              ?>
              <nav id="exhibit-pages">
                  <?php echo $pageTree; ?>
              </nav>
            <?php endif; ?>
            </div>
          </div>
          <?php if (($exhibit->cover_image_file_id)): ?>
              <?php
                $file = get_record_by_id('File',$exhibit->cover_image_file_id);
                $cover_url = $file->getWebPath('fullsize');
              ?>
              <div class="cover-container"><img class="cover" src="<?php echo $cover_url ?>"></div>
          <?php elseif ($exhibitImage = record_image($exhibit, 'fullsize')): ?>
              <div class="cover-container"><?php echo $exhibitImage ?></div>
          <?php endif; ?>
        </div>
      </div>
  </div>
</section>
<?php echo foot(); ?>
