<?php

	/*------------------------------------------------------------------------
	# aixeenaseoimages.php - Aixeena SEO Images (plugin)
	# ------------------------------------------------------------------------
	# version		1.0.0
	# author    	Ciro Artigot for Aixeena.org
	# copyright 	Copyright (c) 2018 CiroArtigot. All rights reserved.
	# @license 		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
	# Websites 		http://aixeena.org/
	-------------------------------------------------------------------------
	*/
	
	// no direct access
	defined('_JEXEC') or die('Restricted access');

	jimport('joomla.plugin.plugin');

	class plgSystemAixeenaSeoImages extends JPlugin {

	function onAfterRender(){
			
		$app	= JFactory::getApplication();
		$document = JFactory::getDocument();
		if ($app->isAdmin()) return;
		if ($document->getType() != 'html') return;
		$headerstuff = $document->getHeadData(); 
		$buffer = JResponse::getBody(); // take the buffer
		$menu = $app->getMenu();
		$menuactive = $menu->getActive(); // active menu
		$dir = $this->params->get('dir','images/thumbs/'); // directory to create the thumbs
		$quality = $this->params->get('quality',60);
		$qualitypng = $this->params->get('qualitypng',8);
		$path = JPATH_ROOT.'/'.$dir;
		$needClass = $this->params->get('needclass',1); // is mandatory a class
		$maxwidth = $this->params->get('maxwidth',''); // default max width
		$theip = $_SERVER['REMOTE_ADDR'];
		$debug = $this->params->get('debug',0); // default max width
		$p_debug = 0;
		
		$myip = 'xxx.xx.xx.xx';
		$debug = 1;
		
		if($theip == $myip && $debug) $p_debug = 1;
		
		// URL ALIAS
		$alias = JFilterOutput::stringURLSafe(str_replace(JURI::base(),'', JURI::current()));
		if($alias == '') $alias = 'home';
		
		$search = array( // This tags are not in domDcoument
		"<header", "</header>", "<nav", "</nav>", "<section", "</section>","<article", "</article>","<footer", "</footer>","<aside", "</aside>");
		
		$replace = array("<div", "</div>","<div", "</div>", "<div", "</div>","<div", "</div>","<div", "</div>","<div", "</div>");
		
		$buffer = str_replace($search, $replace, $buffer); // replace non existing tags with divs
		
		if (!file_exists($path)) mkdir($path, 0755, true);
		
		$dom = new domDocument;
		libxml_use_internal_errors(true);
    	$dom->loadHTML($buffer);
		libxml_clear_errors();
    	$dom->preserveWhiteSpace = false;
		$imgs  = $dom->getElementsByTagName("img"); 
		$pattern = '/background-image:\s*url\(\s*([\'"]*)(?P<file>[^\1]+)\1\s*\)/i';
		
		$finder = new DomXPath($dom);
		$classname = "aixeena-background";
		$backgrounds = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
		
		$links = array();
		
		// set all "img" into an array with "src" and "class" attributes
		for($i = 0; $i < $imgs->length; $i++) { 
		   $links[] = array($imgs->item($i)->getAttribute("src"), $imgs->item($i)->getAttribute("class"));
		}
		
		// set all "img" into an array with "src" and "class" attributes
		for($i = 0; $i < $backgrounds->length; $i++) { 
		
			$styles = $backgrounds->item($i)->getAttribute("style");
			$matches = array();
			if (preg_match($pattern, $styles, $matches)) {
				$links[] =  array(trim($matches['file']), $backgrounds->item($i)->getAttribute("class"));		
			}	
		}

		// foeach $link object		
		foreach($links as $link) {
		
			if($p_debug) echo $link[0].'<hr/>';
	
			$isClass = 0;
			$cadena = '';

			if(strpos($link[0],'://') === false) { //this plugin is only for local images		
				
				if($link[1]) { // there must be the class
					
					$classes = explode(' ',trim($link[1])); // Put all the classes into an array					
					
					foreach($classes as $k=>$v)  {
					
						if(trim($v) == 'aixeena-images') $isClass = 1;  // there must be the class called "aixeena-images"
					
						if(substr(trim($v),0,5)=="size-") { //  the class size-image
							$cadena =  (int) str_replace(substr(trim($v),0,5),'',$v);
							if($cadena) $maxwidth = $cadena;
						}
						if(substr(trim($v),0,8)=="quality-") { //  the class quality-image
							$cadena =  (int) str_replace(substr(trim($v),0,8),'',$v);
							if($cadena) $quality = $qualitypng = $qualitygif = $cadena;
						}
					}
				}
				
				if($isClass || !$needClass) {
				
					$source = str_replace('//','/',JPATH_ROOT.'/'.$link[0]);
					
					if($p_debug) echo 'source:'.$source.'<hr/>';
					
					if(!$maxwidth) list($maxwidth, $alto) = getimagesize($source);
					$sufixwidth = '';
					if($maxwidth) $sufixwidth = '-'.$maxwidth;
					$extension = strtolower(substr(strrchr($link[0], '.'), 1));
					
					// The thumbnail filename
					$filename = $alias.'-'.JFilterOutput::stringURLSafe(basename(str_replace('.'.$extension,'',strtolower($link[0])))).$sufixwidth;
					
					if($p_debug) echo '$filename:'.$filename.'<hr/>';
					
					// The complete thumbnail path
					$file = $path.$filename.'.'.$extension;
					
					if($p_debug) echo '$file:'.$file.'<hr/>';
					
					// The image URI
					$filesrc = JUri::base().$dir.$filename.'.'.$extension;
					
					if($p_debug) echo '$filesrc:'.$filesrc.'<hr/>';
					
					$copia = 0;
		
					if (file_exists($file)) { // exist
						
					} else { // if not exist the thumbnail we create it

						switch($extension){
							case 'png':
								$image = imagecreatefrompng($source);break;
							case 'jpeg': case 'jpg':
								$image = imagecreatefromjpeg($source);break;
						}
						
						// The image sizes
						$source_imagex = imagesx($image);
						$source_imagey = imagesy($image);
						
						if($maxwidth && ($source_imagex > $maxwidth)) { // If the image is bigger than the thumb
							$dest_imagex = $maxwidth;					
							$dest_imagey = (($source_imagey * $dest_imagex) / $source_imagex);
							$dest_image = imagecreatetruecolor($dest_imagex, $dest_imagey);
							imagecopyresampled($dest_image, $image, 0, 0, 0, 0, $dest_imagex, $dest_imagey, $source_imagex, $source_imagey); 
							$copia = 1;
						}
		
						// Create the thumb
						switch($extension){
							case 'png':
								if($copia) imagepng($dest_image, $file, $qualitypng); 
								else imagepng($image, $file, $qualitypng); 
								break;
							case 'jpeg': case 'jpg':
								if($copia) imagejpeg($dest_image, $file, $quality); 
								else imagejpeg($image, $file, $quality); 
								break; 
						}
						
						imagedestroy($image);
						if($copia) imagedestroy($dest_image);
					}
					
					$buffer = str_replace($link[0], $filesrc, $buffer);				
					
				}
			}
		}

		JResponse::setBody($buffer);

	}	
}
?>