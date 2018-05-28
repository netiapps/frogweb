<?php	
	date_default_timezone_set('Europe/Rome');
	error_reporting(E_ALL);
	
	/* Configuration */
	
	$config = new stdClass();
	$config->project = 'Sisal Games Mobile';
		
	/********************************************************************************************
	
	You do not need to change anything below this line
	
	********************************************************************************************/
	
	$config->path = new stdClass();
	$config->path->base = dirname(__FILE__);
	$config->path->smarty = $config->path->base . '/_smarty/Smarty.class.php';
	$config->path->functions = $config->path->base . '/_includes/functions.php';
	$config->path->custom_functions = $config->path->base . '/_includes/_custom_functions.php';
	$config->path->custom_variables = $config->path->base . '/_includes/_custom_variables.php';
	$config->path->templates = new stdClass();
	$config->path->templates->sources = $config->path->base . '/_templates';
	$config->path->templates->cache = $config->path->base . '/_templates/cache';
	$config->path->output = $config->path->base . '/_output';
	
	/* Init vars */
	$error = new stdClass();
	$error->output = false;
	$error->message = null;
	$page = '_index.html';
	$exported = false;
	$zipped = false;
	$custom = new stdClass();
		
	/* Check if custom functions and custom variables exist */
	if (file_exists($config->path->custom_functions)) {
		require_once($config->path->custom_functions);
	}
	if (file_exists($config->path->custom_variables)) {
		require_once($config->path->custom_variables);
	}
	
	/* Check required files and folders */
	if (!file_exists($config->path->functions)) {
		$error->output = true;
		$error->message .= "Functions file not found.\n";
	} else {
		require_once($config->path->functions);
	}	
	if (!file_exists($config->path->smarty)) {
		$error->output = true;
		$error->message .= "Smarty class not found.\n";
	} else {
		require_once($config->path->smarty);
	}
	if (!file_exists($config->path->templates->sources)) {
		if (!mkdir($config->path->templates->sources, 0777)) {
			$error->output = true;
			$error->message .= "Unable to create templates folder.\n";
		}
	}
	if (!file_exists($config->path->templates->cache)) {
		if (!mkdir($config->path->templates->cache, 0777)) {
			$error->output = true;
			$error->message .= "Unable to create templates cache folder.\n";
		}
	}
	if (!file_exists($config->path->output)) {
		if (!mkdir($config->path->output, 0777)) {
			$error->output = true;
			$error->message .= "Unable to create output folder.\n";
		}
	}
	if (file_exists($config->path->output . '/index.html')) {
		$exported = true;
	}
	if (file_exists($config->path->output . '/templates.zip')) {
		$zipped = true;
	}
	
	
	/* Stop execution, configuration errors */
	if ($error->output) {
		echo nl2br($error->message);
		die();
	}
	
	/* Check inputs */
	$page = (isset($_GET['page'])) ? $_GET['page'] : '_index.html';
	$cli = php_sapi_name() == 'cli';
	if ($cli) {
		$command = (isset($argv[1])) ? $argv[1] : null;	
	} else {
		$command = (isset($_GET['command'])) ? $_GET['command'] : null;
	}
	$pages = array();
	
	if ($handle = opendir($config->path->templates->sources)) {
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != ".." && (strstr($entry, '.html') !== false) && (strpos($entry, '_', 0) !== 0)) {
				array_push($pages, $entry);
			}
		}
	}
	
	$lipsum = new stdClass();
	$lipsum->html = new stdClass();
	$lipsum->html->complete = getLipsum('html',0);
	$lipsum->html->par1 = getLipsum('html',1);
	$lipsum->html->par2 = getLipsum('html',2);
	$lipsum->html->par3 = getLipsum('html',3);
	$lipsum->html->par4 = getLipsum('html',4);
	$lipsum->html->par5 = getLipsum('html',5);
	
	$lipsum->plain = new stdClass();
	$lipsum->plain->complete = getLipsum('plain',0);
	$lipsum->plain->par1 = getLipsum('plain',1);
	$lipsum->plain->par2 = getLipsum('plain',2);
	$lipsum->plain->par3 = getLipsum('plain',3);
	$lipsum->plain->par4 = getLipsum('plain',4);
	$lipsum->plain->par5 = getLipsum('plain',5);
	
	$smarty = new Smarty();
	$smarty->template_dir = $config->path->templates->sources;
	$smarty->compile_dir = $config->path->templates->cache;
	$smarty->debugging = false;
	$smarty->compile_check = true;
	
	$smarty->assign('config',$config);
	$smarty->assign('command',$command);
	$smarty->assign('pages',$pages);
	$smarty->assign('exported',$exported);
	$smarty->assign('zipped',$zipped);
	$smarty->assign('lipsum', $lipsum);
	$smarty->assign('custom', $custom);
	
	switch ($command) {
		case 'output':
			saveHTML();
			if ($error->output) {
				echo nl2br($error->message);
				die();
			} else {
				header("Location:" . $_SERVER['PHP_SELF'] . "\n\n");
				die();
			}
			break;
		case 'delete':
			deleteHTML();
			if ($error->output) {
				echo nl2br($error->message);
				die();
			} else {
				header("Location:" . $_SERVER['PHP_SELF'] . "\n\n");
				die();
			}
			break;
		default:
			try {
				$smarty->assign('page',$page);
				$smarty->display($page);
				unset($smarty);
			} catch (Exception $e) {
				echo $e->getMessage();
				die(0);
			}
	}
?>