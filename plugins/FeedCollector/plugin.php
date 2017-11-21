<?php
/* OMEKA PLUGIN ADDTHIS:
 * This plug-in will add the Feed Collector to Omeka,
 * You are able to add a feed in the configuration menu *
 */

// add plugin hooks (configuration)
add_plugin_hook('config_form', 'feedCollector_config_form');
add_plugin_hook('config', 'feedCollector_config');

//install and uninstall
add_plugin_hook('install', 'feedCollector_install');
add_plugin_hook('uninstall', 'feedCollector_uninstall');

//set the location
//add_plugin_hook(get_option('addThis_hook'),'feedCollector_add');

//link to config_form.php
function feedCollector_config_form() {
	include('config_form.php');
}

//process the config_form
function feedCollector_config() {
	//get the POST variables from config_form and set them in the DB
	if($_POST["rss"])
		set_option('feedCollector_rss',$_POST['rss']);
        if($_POST["rss2"])
		set_option('feedCollector_rss2',$_POST['rss2']);

	if($_POST["proxy"]):
		set_option('feedCollector_proxy',$_POST['proxy']);
	else:
		set_option('feedCollector_proxy','');
	endif;

	if($_POST["limit"])
		set_option('feedCollector_limit',$_POST['limit']);
}

//handle the installation
function feedCollector_install() {
	set_option('feedCollector_rss','');
        set_option('feedCollector_rss2','');
   	set_option('feedCollector_proxy','');
   	set_option('feedCollector_limit','2');
}

//handle the uninstallation
function feedCollector_uninstall() {
    // Delete the plugin options
    delete_option('feedCollector_rss');
    delete_option('feedCollector_rss2');
    delete_option('feedCollector_proxy');
    delete_option('feedCollector_limit');
}

//converts the rss feed into html and returns it
function feedCollector_show($feed=1) {

	$html="";

        if($feed==1){
            $rss = get_option('feedCollector_rss');
        }else {
            $rss = get_option('feedCollector_rss2');
        }

	$proxy = get_option('feedCollector_proxy');
	$limit = get_option('feedCollector_limit');



	if(!empty($rss))
		$html = feedCollector_convertToHtml($rss,$proxy,$limit);
	if($html=="")
		return false;
	else
		return $html;

}

function feedCollector_convertToHtml($feed,$proxy,$limit) {

	$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml,application/atom+xml';
	$headers[] = 'Connection: Keep-Alive';
	$headers[] = 'Content-type: application/atom+xml;charset=UTF-8';
	$user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:10.0) Gecko/20100101 Firefox/10.0';

	// initialiseer html om geen execptions te krijgen
	$html = "";

	$ch = curl_init($feed);

	//set options
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

	curl_setopt($ch, CURLOPT_HEADER, 0);

	if(!empty($proxy))
		curl_setopt($ch, CURLOPT_PROXY,$proxy);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

	//get data and close connection
	$data = curl_exec($ch);

	//die(curl_error($ch));

	curl_close($ch);

	try {
	  $doc = simplexml_load_string($data);

	}catch (Exception $e) {
	  echo "Geen berichten gevonden";
	}


	if(isset($doc->guid))
	{
		$html = parseRSS($doc,$limit);
	}
	if(isset($doc->id))
	{
                $doc->registerXpathNamespace('a', 'http://www.w3.org/2005/Atom');
                $list = $doc->xpath("//a:link[@rel='alternate']");
		$html = parseAtom($doc,$limit,$list);
	}

	return $html;
}

function parseRSS($xml,$cnt)
{
	$html= "";

	//$cnt = count($xml->channel->item);
	for($i=0; $i<$cnt; $i++)
	{
		$html .= "<div class='blok border-bottom'>";
		$url 	= $xml->channel->item[$i]->link;
		$title 	= $xml->channel->item[$i]->title;
		$desc = $xml->channel->item[$i]->description;


		$html.= '<h2><a href="'.$url.'">'.$title.'</a></h2>';
		$html.= '<div class="content"><p>'.$desc.'</p><h3><a class="more" href="'.$url.'">lees meer</a></h3></div>';
		$html.='</div>';
	}
	$html .= '<div class="blok meer"><p><a class="more" href="'.$xml->channel->link.'"><strong>meer nieuws</strong></a></p></div>';
	return $html;
}

function parseAtom($xml,$cnt,$list)
{
    $html="";
    //$cnt = count($xml->entry);
    $i=1;

    foreach($xml->entry as $entry)
    {
            $html .= "<li>";

            $url	= $list[$i]['href'];

            $title 	= $entry->title;
            //$image = $entry->image;
            $desc	= truncateHtml($entry->summary);
            foreach($entry->link as $link){
                    if($link['type'] == 'image/jpeg')
                            $image = "<img width=70 class='inline' src=".$link['href'].">";
            }

						$date = strtotime($entry->published);
						$date = date('d-m-Y',$date);

            $html.= '<h3><a href="'.$url.'">'.$title.'</a></h3>
                <div class="date">'.$date.'</div>';
            $html .= "</li>";

            $i++;
            if($i>$cnt){break;}
    }

    return $html;
}

/**
 * truncateHtml can truncate a string up to a number of characters while preserving whole words and HTML tags
 *
 * @param string $text String to truncate.
 * @param integer $length Length of returned string, including ellipsis.
 * @param string $ending Ending to be appended to the trimmed string.
 * @param boolean $exact If false, $text will not be cut mid-word
 * @param boolean $considerHtml If true, HTML tags would be handled correctly
 *
 * @return string Trimmed string.
 */
function truncateHtml($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true) {
	if ($considerHtml) {
		// if the plain text is shorter than the maximum length, return the whole text
		if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
			return $text;
		}
		// splits all html-tags to scanable lines
		preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
		$total_length = strlen($ending);
		$open_tags = array();
		$truncate = '';
		foreach ($lines as $line_matchings) {
			// if there is any html-tag in this line, handle it and add it (uncounted) to the output
			if (!empty($line_matchings[1])) {
				// if it's an "empty element" with or without xhtml-conform closing slash
				if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
					// do nothing
				// if tag is a closing tag
				} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
					// delete tag from $open_tags list
					$pos = array_search($tag_matchings[1], $open_tags);
					if ($pos !== false) {
					unset($open_tags[$pos]);
					}
				// if tag is an opening tag
				} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
					// add tag to the beginning of $open_tags list
					array_unshift($open_tags, strtolower($tag_matchings[1]));
				}
				// add html-tag to $truncate'd text
				$truncate .= $line_matchings[1];
			}
			// calculate the length of the plain text part of the line; handle entities as one character
			$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
			if ($total_length+$content_length> $length) {
				// the number of characters which are left
				$left = $length - $total_length;
				$entities_length = 0;
				// search for html entities
				if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
					// calculate the real length of all entities in the legal range
					foreach ($entities[0] as $entity) {
						if ($entity[1]+1-$entities_length <= $left) {
							$left--;
							$entities_length += strlen($entity[0]);
						} else {
							// no more characters left
							break;
						}
					}
				}
				$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
				// maximum lenght is reached, so get off the loop
				break;
			} else {
				$truncate .= $line_matchings[2];
				$total_length += $content_length;
			}
			// if the maximum length is reached, get off the loop
			if($total_length>= $length) {
				break;
			}
		}
	} else {
		if (strlen($text) <= $length) {
			return $text;
		} else {
			$truncate = substr($text, 0, $length - strlen($ending));
		}
	}
	// if the words shouldn't be cut in the middle...
	if (!$exact) {
		// ...search the last occurance of a space...
		$spacepos = strrpos($truncate, ' ');
		if (isset($spacepos)) {
			// ...and cut the text in this position
			$truncate = substr($truncate, 0, $spacepos);
		}
	}
	// add the defined ending to the text
	$truncate .= $ending;
	if($considerHtml) {
		// close all unclosed html-tags
		foreach ($open_tags as $tag) {
			$truncate .= '</' . $tag . '>';
		}
	}
	return $truncate;
}
