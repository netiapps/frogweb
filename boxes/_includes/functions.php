<?php
	/* Functions */
	
	function saveHTML() {
		global $config, $smarty, $error, $page, $pages, $command;
		
		$error->output = false;
		$error->output = null;
		
		$smarty->assign('exporting',true);
		
		$output = exec('rm -R ' . $config->path->output . '/*');
		if ($output != '') {
			$error->output = true;
			$error->message .= "Unable to remove temapltes and assets from output directory.\n" . "Directory: " . $config->path->output . "\n";
		}
		foreach ($pages as $p) {
			$smarty->assign('page',$p);
			$output = $smarty->fetch($p);
			if (!$f = fopen( $config->path->output . '/' . $p, 'w' )) {
				$error->output = true;
				$error->message .= "Unable to open output file for writing.\n" . "File: " . $config->path->output . "/" . $p . "\n";
			}
			if (!fwrite($f, $output)) {
				$error->output = true;
				$error->message .= "Unable to write to output file.\n" . "File: " . $config->path->output . "/" . $p . "\n";
			}
		}
		/* Copy assets to the output directory */
		if ($handle = opendir($config->path->base)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != ".." && (strpos($entry, '_', 0) !== 0) && (strpos($entry, '.', 0) !== 0)  && (!strpos($entry, '.php', 0))) {
					$output = exec('cp -R ' . $config->path->base . '/' . $entry . ' ' . $config->path->output . '/' . $entry);
					if ($output != '') {
						$error->output = true;
						$error->message .= "Unable to copy assets to output directory.\n" . "File: " . $config->path->output . "/" . $entry . "\n";
					}
					exec('rm -R ' . $config->path->output . '/' . $entry . '/.svn'); 
				}
			}
		}
		/* Output index template */
		$output = $smarty->fetch('_index.html');
		if (!$f = fopen( $config->path->output . '/index.html', 'w' )) {
			$error->output = true;
			$error->message .= "Unable to open output file for writing.\n" . "File: " . $config->path->output . "/index.html\n";
		}
		if (!fwrite($f, $output)) {
			$error->output = true;
			$error->message .= "Unable to write to output file.\n" . "File: " . $config->path->output . "/index.html\n";
		}
		/* Create zip file */
		try {
			exec('zip -r ' . $config->path->output . '/templates.zip ' . './' . str_replace($config->path->base,'',$config->path->output) );
		} catch(Exception $e) {
			$error->output = true;
			$error->message .= "Unable to create zip archive.\n" . "File: " . $config->path->output . "/templates.zip\n" . "Exception: " . $e . "\n";
		}
	}
	
	function deleteHTML() {
		global $config, $error;
		$output = exec('rm -R ' . $config->path->output . '/*');
		if ($output != '') {
			$error->output = true;
			$error->message .= "Unable to remove temapltes and assets from output directory.\n" . "Directory: " . $config->path->output . "\n";
		}
	}
	
	function getLipsum( $mode = 'html', $par = 0 ) {
		$output = null;
		$lipsum = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vel scelerisque nibh. Aliquam volutpat porta felis faucibus tempus. Aliquam semper lectus vitae odio varius feugiat. Vestibulum lacus tortor, fermentum id consequat eu, tincidunt eget leo. Proin sodales purus et lorem commodo eu aliquet metus euismod. Nulla euismod aliquam condimentum. Integer nec posuere nisl. Sed faucibus nunc velit. Sed felis diam, imperdiet vel accumsan ut, aliquam in turpis. Suspendisse potenti. Etiam id orci velit, eu commodo nisl. Curabitur iaculis, arcu vitae bibendum lobortis, turpis elit tincidunt est, sed faucibus mi nisl eu justo. Quisque ac orci eros, quis rutrum sem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed porttitor rutrum molestie.</p>
<p>Sed aliquam adipiscing nisl quis hendrerit. Pellentesque porta massa at libero aliquam eu ullamcorper sapien ornare. Suspendisse nec magna non ligula volutpat egestas eu in ante. Pellentesque nulla erat, pulvinar ac faucibus eget, lacinia ut arcu. Donec velit nulla, congue ac posuere et, egestas vitae sapien. Nullam dictum, dui eu congue luctus, mi tortor lacinia nisl, vitae tempor sapien nisl vitae neque. Sed nec urna lectus, non gravida enim. Nunc gravida arcu quis tellus rhoncus sit amet semper est sollicitudin. Curabitur ligula lacus, luctus sit amet condimentum ac, mollis nec leo. Suspendisse vehicula dapibus quam tristique eleifend. Vestibulum nec tortor nisl, id rutrum odio. Ut nec massa ligula, vitae interdum lorem. Suspendisse gravida, erat eu consequat mattis, ipsum orci tincidunt mauris, interdum rhoncus massa massa vel lectus. Sed dignissim hendrerit enim id euismod. Etiam nisl orci, iaculis sed consectetur sed, elementum eget metus. Donec congue odio vel massa tristique vitae consequat metus pellentesque.</p>
<p>Vivamus lectus ipsum, ullamcorper at luctus ac, tincidunt sit amet eros. Nam venenatis, turpis eu bibendum posuere, velit augue elementum arcu, at rhoncus purus lectus a urna. Nullam rutrum, tortor eget mollis mollis, augue arcu eleifend turpis, ut tincidunt leo risus euismod libero. Etiam vitae augue tempus mi ultricies laoreet. Morbi rutrum gravida tincidunt. Maecenas nisi quam, mattis vel dapibus sagittis, laoreet eget neque. Curabitur tincidunt, ante pretium adipiscing convallis, massa dolor aliquam nisi, in ullamcorper nisi mi molestie velit. Morbi placerat leo eu mi pulvinar non interdum metus consequat. Fusce sed justo nisl, at iaculis lectus. Vivamus eu magna est, ac tristique mi. Sed accumsan, lectus non molestie posuere, quam turpis eleifend justo, eu interdum turpis tortor quis quam. Morbi neque odio, faucibus a fringilla ac, laoreet ut mauris.</p>
<p>Etiam tortor nisl, placerat ac bibendum at, malesuada et lorem. Sed adipiscing felis vel velit commodo mattis. Fusce enim elit, cursus nec ultricies at, ornare ut enim. Ut ut nisi sit amet velit vulputate euismod id ut orci. Aliquam massa velit, gravida ac tristique ac, condimentum et nisl. Pellentesque gravida viverra pulvinar. Curabitur mattis, justo quis sollicitudin adipiscing, ipsum tortor fringilla felis, in interdum risus libero ut velit. In placerat dapibus gravida. Mauris et urna quis quam pretium malesuada. Suspendisse bibendum laoreet elit quis rutrum.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in hendrerit urna. Fusce enim leo, scelerisque non vehicula non, dapibus at eros. Ut vulputate laoreet nibh id ultricies. Quisque quis varius diam. Sed sagittis tempus arcu eget vestibulum. Nullam at sem magna, at sollicitudin ligula.</p>';
		$paragraphs = explode("\n",$lipsum);
		switch ($par) {
			case 0:
				$output = $lipsum;
				break;
			case 1:
				$output = $paragraphs[0];
				break;
			case 2:
				$output = $paragraphs[1];
				break;
			case 3:
				$output = $paragraphs[2];
				break;
			case 4:
				$output = $paragraphs[3];
				break;
			case 5:
				$output = $paragraphs[4];
				break;
		}
		if ($mode != 'html') {
			$output = strip_tags($output); 
		}
		return $output;
	}
	
	/* End functions */
?>