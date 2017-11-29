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

function multi_language_nav()
{
  //check default (from config)
  $defaultCodes = Zend_Locale::getDefault();
  $code = current(array_keys($defaultCodes));

  //check session
  $langNamespace = new Zend_Session_Namespace('lang');
  if (isset($langNamespace->lang)):
    $code = $langNamespace->lang;
  endif;

  if($code != "fr"):
    return 'NL | <a href="'.url("/?lang=fr").'">FR</a>';
  else:
    return '<a href="'.url("/?lang=nl").'">NL</a> | FR';
  endif;
}

function libis_get_featured($type = 'item'){
  $records = get_records($type,array('featured'=>'1'));
  if($records):
    return $records;
  else:
    return false;
  endif;
}
