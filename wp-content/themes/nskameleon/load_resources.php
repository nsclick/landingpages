<?php

/*
 * DON'T WRITE YOUR WIDGETS/SHORTCODES HERE,
 * YOU SHOULD CREATE a WIDGET/SHORTCODE FILE WITHIN WIDGETS/SHORTCODES DIRECTORY AND DISPĹAY ALL YOUR magic THERE ;) 
 * */


$dir = THEME_PATH . "/widgets"; 
bulkIncludeFiles($dir);

$dir = THEME_PATH . "/shortcodes"; 
bulkIncludeFiles($dir);

