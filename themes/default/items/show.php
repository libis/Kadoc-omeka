<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'item show')); ?>
<?php $type = metadata('item','item_type_name');?>
<?php $lang = get_language();?>
<?php if (metadata('item', 'has files') || $type == 'Persoon'): ?>
  <section class="item-section">
      <div class="container">
        <div class='row breadcrumbs'>
            <div class="col-12">
                <p id="simple-pages-breadcrumbs">
                   <span><a href="<?php echo url('/');?>"><?php echo __("Home");?></a></span>
                   <?php if (metadata('item', array('Item Type Metadata','Verhaal')) && $lang == 'en'): ?>
                   > <span><a href="<?php echo url('items/browse?tags=heritage+in+the+spotlight&sort_field=Item+Type+Metadata%2CVerhaal%20titel');?>"><?php echo __("Heritage in the spotlight");?></a></span>
                   <?php elseif (metadata('item', array('Item Type Metadata','Verhaal')) && $lang == 'nl'): ?>
                   > <span><a href="<?php echo url('items/browse?tags=erfgoed+in+de+kijker&sort_field=Item+Type+Metadata%2CVerhaal%20titel');?>"><?php echo __("Heritage in the spotlight");?></a></span>
                   <?php elseif(metadata('item', 'Collection Name')):?>
                   > <span><a href="<?php echo url('items/browse');?>"><?php echo link_to_collection_for_item(); ?></a></span>
                   <?php endif; ?>

                   <?php if($lang=="nl" && metadata('item', array('Item Type Metadata','Verhaal'))):?>
                   > <?php echo metadata('item', array('Item Type Metadata', 'Verhaal titel')); ?>
                   <?php elseif($lang=="en" && metadata('item', array('Item Type Metadata','Story title'))):?>
                   > <?php echo metadata('item', array('Item Type Metadata', 'Story title')); ?>
                   <?php elseif($lang=="en" && metadata('item', array('Item Type Metadata','Title'))):?>
                   > <?php echo metadata('item', array('Item Type Metadata', 'Title')); ?>
                   <?php else:?>
                   > <?php echo metadata('item', array('Dublin Core', 'Title')); ?>
                   <?php endif;?>
                 </p>
             </div>
        </div>
      </div>
  </section>
<?php endif; ?>
<section class="metadata-section">
    <div id="content" class='container' role="main" tabindex="-1">
        <div class="row content">            
            <?php if(metadata($item,'has_files')):?>
              <div class="col-lg-6 col-md-12 col-12">
                <div class="item-files">
                  <div class="row file-row">
                    <?php
                      $files = $item->getFiles();?>
                      <div class="col-12 file-col">
                        <div class="slider-for">
                          <?php foreach($files as $file):?>                       
                            <div class="item-file">
                              <img src="<?php echo $file->getWebPath("fullsize");?>">
                            </div>
                          <?php endforeach;?>
                        </div>
                        <div class="slider-nav" role="toolbar" style="height:3.5rem;">
                          <?php foreach($files as $file):?>
                            <div class="beeld-nav" style="padding:0.5rem;">                                 
                                  <img src="<?php echo $file->getWebPath("square_thumbnail");?>">                                 
                            </div>
                          <?php endforeach;?>
                        </div>
                      </div>
                  </div>
                </div>
              </div>  
            <?php endif;?>
            <?php if($verhaal = metadata('item', array('Item Type Metadata','Verhaal'))):?>
                  <div class="col-lg-6 col-md-12 col-12 verhaal">
                    <?php if($lang == "nl" && metadata('item', array('Item Type Metadata', 'Verhaal titel'))):?>
                      <h1><?php echo metadata('item', array('Item Type Metadata', 'Verhaal titel')); ?></h2>
                      <h2><?php echo metadata('item', array('Item Type Metadata', 'Verhaal ondertitel'));?></h3>
                    <?php elseif($lang == "en" && metadata('item', array('Item Type Metadata', 'Story title'))): ?>
                      <h1><?php echo metadata('item', array('Item Type Metadata', 'Story title')); ?></h2>
                      <h2><?php echo metadata('item', array('Item Type Metadata', 'Story subtitle'));?></h3>
                    <?php endif; ?>
                    <?php if($lang == "nl" && $text = metadata('item', array('Item Type Metadata', 'Verhaal'))):?>
                      <?php echo $text;?>
                    <?php endif;?>
                    <?php if($lang == "en" && $text = metadata('item', array('Item Type Metadata', 'Story'))):?>
                      <?php echo $text;?>
                    <?php endif;?>
                  </div>
            <?php endif; ?>
            <div class="col-lg-6 col-md-12 col-12">
              <?php if(!metadata('item', array('Item Type Metadata','Verhaal'))):?>              
                  <?php if($lang == 'nl'):?>
                    <h1 class="section-title projecten-title"><span><?php echo metadata($item, array('Dublin Core', 'Title')); ?></span></h1>
                  <?php else:?>
                    <h1 class="section-title projecten-title"><span><?php echo metadata($item, array('Item Type Metadata', 'Title')); ?></span></h1>
                  <?php endif;?>
                  <div class="element-set">
              <?php else:?>
                <div class="element-set">
                  <!-- title -->
                  <?php if($lang== "nl" && $text = metadata('item', array('Dublin Core','Title'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Title');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- title english -->
                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Title'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Title');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>
              <?php endif; ?>
                  <!-- creators -->
                  <?php if($lang== "nl" && $text = metadata('item', array('Dublin Core','Creator'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Creator');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- creators english -->
                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Creator'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Creator');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- description -->
                  <?php if($lang== "nl" && $text = metadata('item', array('Dublin Core','Description'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Description');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- description english -->
                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Description'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Description');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Origin'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3>Provenance</h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- herkomst -->
                  <?php if($lang== "nl" && $text = metadata('item', array('Item Type Metadata','Herkomst'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3>Herkomst</h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- Copyright -->
                  <?php if($lang== "en" && $text = metadata('item', array('Item Type Metadata','Copyright'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3>Copyright</h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- jaar -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Jaar'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Date');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- signatuur -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Signatuur'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Reference code');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- missionaris -->                  
                  <?php if($text = metadata('item', array('Item Type Metadata','Missionaris'),array("delimiter" => "|"))):?>
                    <?php $text = strip_tags($text);?>
                    <div class="element">
                        <h3><?php echo __('Missionary');?></h3>
                        <div class="element-text">
                          <?php
                          $missies = explode('|',$text);
                          
                          $missies_after = array();
                          foreach($missies as $missie):
                            $results = get_records('Item', array('advanced' =>
                                array(
                                    array(
                                        'element_id' => 50,
                                        'type' => 'is exactly',
                                        'terms' => $missie
                                    )
                                )
                            ),9999);
                            
                            if($results):?>
                              <?php $missies_after[] = link_to($results[0], null, $missie);?>
                            <?php else:?>
                              <?php $missies_after[] = $missie;?>
                            <?php endif;?>
                          <?php endforeach;?>        
                          <?php echo implode('<br>',$missies_after);?>
                        </div>                
                    </div>
                  <?php endif;?>

                   <!-- beschrijving -->
                   <?php if($text = metadata('item', array('Item Type Metadata','Beschrijving'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Description');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                   <!-- Gemeente -->
                   <?php if($text = metadata('item', array('Dublin Core','Coverage'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Location');?></h3>
                        <div class="element-text">
                          <?php echo $text;?>
                          <?php if($text = metadata('item', array('Item Type Metadata','Land'),array("delimiter" => "; "))):?>
                              <?php echo ", ".$text;?>
                          <?php endif;?>
                        </div>
                    </div>
                  <?php endif;?>

                  <!-- oprichting -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Oprichtingsjaar'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Foundation year');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- kunstenaar -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Kunstenaar'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Artist');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- kunstenaar -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Draagvorm (detail)'),array("delimiter" => "; "))):?>
                    <div class="element">
                        <h3><?php echo __('Carrier');?></h3>
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  

                  <?php if($type == 'Persoon'):?>
                  <!--Geboorteplaats -->
                  <div class="element" style="margin-top:-1.5rem;">
                  <div class="element-text" style="font-family:Roboto, sans-serif;color:#444;">
                  <?php if($text = metadata('item', array('Item Type Metadata','Geboorteplaats'),array("delimiter" => "; "))):?>
                    <?php echo $text.', ';?>
                  <?php endif;?>

                  <!--Geboortedatum -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Geboortedatum'),array("delimiter" => "; "))):?>
                    °<?php echo $text;?>                    
                  <?php endif;?>

                  <!--Geboorteplaats -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Overlijdensplaats'),array("delimiter" => "; "))):?>
                      <?php echo ' - '.$text.', ';?> 
                  <?php endif;?>

                  <!--Geboortedatum -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Overlijdensdatum'),array("delimiter" => "; "))):?>
                    &#8224;<?php echo $text;?></div>
                  <?php endif;?>
                  </div>
                  </div>
                  <?php endif;?>

                  <!--Profiel-->
                  <?php if($text = metadata('item', array('Item Type Metadata','Profiel'),array("delimiter" => "; "))):?>
                    <div class="element" style="padding:1.5rem;background:#f4f5f8;margin:1.5rem 0;">     
                         <!-- klooster -->
                        <?php if($text = metadata('item', array('Item Type Metadata','Kloosternaam'),array("delimiter" => "; "))):?>
                                <div class="element-text"><?php echo $text;?></div>
                        <?php endif;?>               
                        <div class="element-text"><?php echo $text;?></div>
                    </div>
                  <?php endif;?>

                  <!-- kunstenaar -->
                  <?php if($text = metadata('item', array('Item Type Metadata','Website'))):?>
                    <div class="element">
                        <h3><?php echo __('Links');?></h3>
                        <div class="element-text">
                          <a target="_blank" href="<?php echo $text;?>"><?php echo $text;?></a>
                          <?php if($text = metadata('item', array('Item Type Metadata','Odis'))):?>                    
                            <br><a target="_blank" href="<?php echo $text;?>"><?php echo __('More information in ODIS-database');?></a>
                          <?php endif;?>  
                        </div>  
                    </div>
                  <?php endif;?>                  
                            
                  <?php if($type == 'Persoon'):?>
                    <?php if($text = metadata('item', array('Item Type Metadata','Odis'))):?>
                    <div class="element">
                        <h3><?php echo __('Links');?></h3>
                        <div class="element-text">
                          <a target="_blank" href="<?php echo $text;?>"><?php echo $text;?>
                        <?php echo __('More information in ODIS-database');?></a>                         
                        </div>  
                    </div>
                  <?php endif;?>   
                    
                    <?php                 
                      $title = metadata('item', array('Dublin Core','Title'));         
                      $objects = array();
                      $results = get_records('Item', array('advanced' =>
                          array(
                              array(
                                  'element_id' => 245,
                                  'type' => 'is exactly',
                                  'terms' => $title
                              )
                          )
                      ),9999);
                    ?>
                    <?php if($results):?>
                      
                      <div class="element">
                          <h3><?php echo __('Related objects');?></h3>
                          <div class="element-text">                            
                            <?php                         
                              foreach($results as $result):?>
                                <?php echo link_to($result, null, metadata($result, array('Dublin Core','Title'))).'<br>';?>
                              <?php endforeach;?>     
                          </div>                
                      </div>
                    <?php endif;?>
                  <?php endif;?>

                  <!-- If the item belongs to a collection, the following creates a link to that collection. -->
                  <?php if (metadata('item', 'Collection Name')): ?>
                  <div id="collection" class="element">
                      <h3><?php echo __('Collection'); ?></h3>
                      <div class="element-text"><?php echo link_to_collection_for_item(); ?></div>
                  </div>
                  <?php endif; ?>                  

                  <!-- The following prints a list of all tags associated with the item -->
                  <?php if (metadata('item', 'has tags')): ?>
                  <div id="item-tags" class="element">
                      <h3><?php echo __('Tags'); ?></h3>
                      <div class="element-text" style="word-break: break-all;"><?php echo tag_string('item'); ?></div>
                  </div>
                  <?php endif;?>

                  <?php echo libis_link_to_related_exhibits($item);?>

                  <ul>
                    <?php if ($text = metadata('item', array('Item Type Metadata','LIMO'))): ?>
                    <li>
                      <a target="_blank" href="<?php echo $text;?>"><?php echo __('Link naar LIMO');?></a>
                    </li>
                    <?php endif; ?>

                    <?php if ($text = metadata('item', array('Item Type Metadata','Teneo'))): ?>
                    <li>
                      <a target="_blank" href="<?php echo $text;?>"><?php echo __('Link naar Teneo');?></a>
                    </li>
                    <?php endif; ?>

                    <?php if ($text = metadata('item', array('Item Type Metadata','ScopeArchiv'))): ?>
                    <li>
                      <a target="_blank" href="<?php echo $text;?>"><?php echo __('Link naar ScopeArchiv');?></a>
                    </li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>              
        </div>
        <div class="row content">
            <div class="col-12">
                <?php echo get_specific_plugin_hook_output('Geolocation', 'public_items_show', array('view' => $this, 'item' => $item)); ?>

              <!--<ul class="item-pagination navigation">
                  <li id="previous-item" class="previous"><?php echo link_to_previous_item_show("&#8249; ".__("Previous")); ?></li>
                  <li id="next-item" class="next"><?php echo link_to_next_item_show(__("Next")." &#8250;"); ?></li>
              </ul>-->
            </div>
        </div>
        <div class="plugins">
          <?php echo get_specific_plugin_hook_output('SocialBookmarking', 'public_items_show', array('view' => $this, 'item' => $item)); ?>
          <?php if($type != 'Persoon'):?>              
            <?php echo get_specific_plugin_hook_output('Commenting', 'public_items_show', array('view' => $this, 'item' => $item)); ?>
          <?php endif;?>  
        </div>
    </div>
</section>
<script>
 jQuery('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  centerMode: true,
  asNavFor: '.slider-nav'
});
jQuery('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  focusOnSelect: true
});
	
</script>

	
<?php echo foot(); ?>
