<?php
function public_nav_main_bootstrap() {
    $partial = array('common/menu-partial.phtml', 'default');
    $nav = public_nav_main();  // this looks like $this->navigation()->menu() from Zend
    $nav->setPartial($partial);
    return $nav->render();
}

function simple_nav(){
    $page = get_current_record('SimplePagesPage');
    $dienst = get_color();

    $links = simple_pages_get_links_for_children_pages();

    $html ="";
  
    if(!$links && $page->parent_id != 0):
        $links = simple_pages_get_links_for_children_pages($page->parent_id);
    elseif(!$links && $page->parent_id == 0):
        return "";
    endif;


    $html .="<div class='row'>";
    $html .="<div class='col-md-12'>";
    $html .="<div class='side-nav'>";
    $html .="<ul class='simple-nav'>";
    foreach($links as $link):
        $html .= "<li><a href='".$link['uri']."'>".$link['label']."</a></li>";
    endforeach;
    $html .="</ul></div></div></div>";

    return $html;
}

function libis_get_simple_page_content($title) {
    $page = get_record('SimplePagesPage', array('title' => $title));
    if($page):
        return $page->text;
    else:
        return false;
    endif;
}

function get_color()
{
    //colors: page id -> different css (production)
    $colors = array(
      "0" => array("naam" => "","kleur" => "grijs", "logo" => "","site" => ""),
      "10" => array("naam" => "Heron", "kleur" => "paars", "logo" => "heron_logo.png","site" => "http://heron-net.be"),//default
      "13" => array("naam" => "Lias", "kleur" => "oranje", "logo" => "lias_logo.png","site" => "http://lias.be"),
      "16" => array("naam" => "LIBISnet", "kleur" => "groen", "logo" => "LIBISnet_LOGO.png","site" => "http://libisnet.be"),
      "19" => array("naam" => "LIBISplus", "kleur" => "blauw", "logo" => "LIBISplus_LOGO.png","site" => "http://libisplus.be")
    );

    //get current page
    $current_page = get_current_record('simple_pages_page', false);
    if($current_page):
      if (array_key_exists($current_page->id, $colors)) :
          return $colors[$current_page->id];
      endif;

      //determine ancestor
      $pageAncestors = get_db()->getTable('SimplePagesPage')->findAncestorPages($current_page->id);
      foreach ($pageAncestors as $page) :
          if (array_key_exists($page->id, $colors)) :
              return $colors[$page->id];
          endif;
      endforeach;
    endif;

    return $colors['0'];
}
