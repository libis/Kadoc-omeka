<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title').' &middot; '.metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits', ));
?>
<style>
header {
    background: #F4F5F8 url("<?php echo WEB_PUBLIC_THEME.'/default/images/exhibits/banner_'.metadata('exhibit', 'slug').'.jpg';?>") no-repeat center center/cover;
}
</style>
<section class="exhibit-show-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='breadcrumbs'>
        <p id="simple-pages-breadcrumbs">
          <!--<span><a href="<?php echo url('/');?>">Home</a></span>
           > <span><a href="<?php echo url('exhibits/browse');?>">Exhibits</a></span>
           > --><?php echo exhibit_builder_link_to_exhibit($exhibit); ?>
           > <?php echo metadata('exhibit_page', 'title'); ?>
         </p>
    </div>

    <div id="exhibit-blocks">
      <?php exhibit_builder_render_exhibit_page(); ?>
    </div>

    <div id="exhibit-page-navigation">
        <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
        <div id="exhibit-nav-prev">
        <?php echo $prevLink; ?>
        </div>
        <?php endif; ?>
        <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
        <div id="exhibit-nav-next">
        <?php echo $nextLink; ?>
        </div>
        <?php endif; ?>
        <div id="exhibit-nav-up">
        <?php echo exhibit_builder_page_trail(); ?>
        </div>
    </div>
  </div>
</section>
<?php echo foot(); ?>
