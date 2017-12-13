<?php
$position = isset($options['file-position'])
    ? html_escape($options['file-position'])
    : 'left';
$size = isset($options['file-size'])
    ? html_escape($options['file-size'])
    : 'fullsize';
$captionPosition = isset($options['captions-position'])
    ? html_escape($options['captions-position'])
    : 'center';
?>
<div class='row content'>
  <div class="col-12 col-md-6">
    <div class='row'>
      <div class="col-12">
          <hr align="left">
      </div>
    </div>
    <div class='row'>
      <div class="col-12">
        <h1><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></h1>
      </div>
    </div>
    <div class='row'>
      <div class="col-12">
          <?php echo $text; ?>
      </div>
    </div>
  </div>
  <div class="offset-md-1 col-12 col-md-5">
    <div class="exhibit-items <?php echo $position; ?> <?php echo $size; ?> captions-<?php echo $captionPosition; ?>">
        <?php foreach ($attachments as $attachment):
            $item = $attachment->getItem();
            $file = $attachment->getFile();
            $fileOptions = array('imageSize' => $size);
            $linkProps = array(); $forceImage = false;

            $caption = $this->exhibitAttachmentCaption($attachment);

            if(!$caption):
              $caption = '<div class="exhibit-item-caption">'.metadata($item, array('Dublin Core', 'Title')).'</div>';
            endif;

            if ($file) {
                if (!isset($fileOptions['imgAttributes']['alt'])) {
                    $fileOptions['imgAttributes']['alt'] = metadata($item, array('Dublin Core', 'Title'), array('no_escape' => true));
                }

                if (!isset($fileOptions['linkAttributes']['href'])) {
                    $fileOptions['linkAttributes']['href'] = file_display_url($file);
                }
                $fileOptions['linkAttributes']['data-lightbox'] = file_display_url($file);
                $fileOptions['linkAttributes']['data-title'] = $caption;
                $html = file_markup($file, $fileOptions, null);

            } else if($item) {
                $html = exhibit_builder_link_to_exhibit_item(null, array('class'=>'test','data-lightbox'=>'test',' data-title'=>'test'), $item);
            }
            // Don't show a caption if we couldn't show the Item or File at all


            if (isset($html)) {
                $html .= $caption;
                echo $html;
            } else {
                echo $html = '';
            }

            //echo $this->exhibitAttachment($attachment, array('imageSize' => $size)); ?>
        <?php endforeach; ?>
    </div>
  </div>
</div>
