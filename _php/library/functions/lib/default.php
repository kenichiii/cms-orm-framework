<?php

/*
function sanitize($string) {
    return htmlspecialchars(trim($string));
}
*/

function nbspTxt($string)
{
	$jp = preg_replace('/(?<=\b[a-z]) /i', '&nbsp;', $string);
	$jp = str_replace('. ', '.&nbsp;', $jp);
	return $jp;
}

function tinyMceStrip($string)
	{
	return strip_tags(nbspTxt($string), '<b><i><p><br><strong>');	
}

function date2db($datum)
	{
	if (preg_match('~^([0-9]+)\\.([0-9]+)\\.([0-9]+)$~', $datum, $match)) {
	    $datum_iso = sprintf("%d-%02d-%02d", $match[3], $match[2], $match[1]);
		return $datum_iso;
	}
	else
		{
		return false;
	}
}

function db2date($date)
	{
	if($date)
		return date('d.m.Y', strtotime($date));
}
