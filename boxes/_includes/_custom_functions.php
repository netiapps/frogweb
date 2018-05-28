<?php
	/* Add you custom functions here */
	/* Useles example function */
	
	function dayPart() {
		$h = (int)date('H');
		if ($h < 5 && $h > 21) return 'night';
			else return 'day';
	}
?>