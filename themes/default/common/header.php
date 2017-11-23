<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')) :?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Determine color and logo -->
    <?php $style = get_color();?>

    <?php
    $smallheader = "";
    if($style["kleur"] != 'grijs'):
      $smallheader = "small-nav";
    endif;
    ?>
    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view' => $this)); ?>

    <!-- Stylesheets -->
    <?php
      queue_css_file(array('iconfonts', 'app'));echo head_css();
      echo theme_header_background();
    ?>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,400i|Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- JavaScripts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <header role="banner">
      <section class="nav-section">
        <div class='container'>
          <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class='material-icons'>&#xE5D2;</i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <?php echo public_nav_main_bootstrap();?>
              <span class="navbar-text">
                <?php echo multi_language_nav();?>
              </span>
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn my-2 my-sm-0" type="submit"><i class="material-icons">search</i></button>
              </form>

            </div>
          </nav>
        </div>
      </section>

      <div class="jumbotron">
        <div class='container' role="main" tabindex="-1">
          <section class="jumbo-section">
            <div class="row">
              <div class="co-slogan col-md-6">
                <div class="slogan">
                  <?php
                    $description = option('description');
                  ?>
                  <?php if ( $bodyclass == 'exhibits'): ?>
                      <?php $title_exhibit = explode(' &middot; ', $title);?>
                      <p class="type"><?php echo __('Exhibit'); ?></p>
                      <p><span><?php echo $title_exhibit[1]; ?></span></p>
                  <?php elseif($description):?>
                      <p><span><?php echo $description; ?></span></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

    </header>
