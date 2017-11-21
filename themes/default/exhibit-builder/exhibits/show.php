<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title').' &middot; '.metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits', ));
?>
<style>
.jumbotron {
    border-radius: 0;
    padding: 0;
    margin: 0;
    background: #fff;
    background: url("<?php echo img('banner_kadoc_1.jpg');?>") no-repeat center center/cover;
    border-top: 1px solid rgba(49, 57, 112, 0.1);
}
</style>
<section class="exhibit-show-section">
  <div id="content" class='container' role="main" tabindex="-1">
    <div class='row breadcrumbs'>
      <div class="col-sm-12 col-12">
          <p id="simple-pages-breadcrumbs">
            <span><a href="<?php echo url('/');?>">Home</a></span>
             > <span><a href="<?php echo url('browse/exhibits');?>">Exhibits</a></span>
             > <?php echo exhibit_builder_link_to_exhibit($exhibit); ?>
             > <?php echo metadata('exhibit_page', 'title'); ?>
           </p>
       </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class='row content'>
          <div class="col-12">
          
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
        </div>
      </div>
      <!--<div class="col-12 col-md-3 nav">
        <nav id="exhibit-pages">
            <?php echo exhibit_builder_page_tree($exhibit, $exhibit_page); ?>
        </nav>
      </div>-->
    </div>
  </div>
</section>
<?php echo foot(); ?>
