<?php

function autosuggest_excerpt( $text ) { // Fakes an excerpt if needed
	$text = strip_tags( $text );
	$blah = explode(' ', $text);
	$excerpt_length = 10;
	if (count($blah) > $excerpt_length) {
		$k = $excerpt_length;
		$use_dotdotdot = 1;
	} else {
		$k = count($blah);
		$use_dotdotdot = 0;
	}
	$excerpt = '';
	for ($i=0; $i<$k; $i++) {
		$excerpt .= trim(ent2ncr($blah[$i])).' ';
	}
	$excerpt .= '[...]';
	$text = $excerpt;
	return $text;
}

function get_wpas_option($key, $default) {
	$value = stripslashes(get_option($key));
	if ($value == '') {
		$value = $default;
	}
	
	return $value;
}

?>
