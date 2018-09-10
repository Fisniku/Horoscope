<?php
/*
Plugin Name: Woroscope
Plugin URI: http://www.wpexplorer.com/
Description: A simple wordpress horoscope plugin which will support different languages.
Version: 1.0
Author: Fisniku
Author URI: 
License: GPL2
*/

define('SITE_ROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);
?>


<?php wp_enqueue_style( 'slider', plugins_url() . '/horoscope/assets/css/woroscope.css'); ?>

<?php require_once('vendor'.DS.'simple_html_dom.php'); ?>
<?php require_once('helpers'.DS.'defines.php'); ?>
<?php require_once('helpers'.DS.'utils.php'); ?>
<?php require_once('helpers'.DS.'Cache.php'); ?>
<?php require_once('helpers'.DS.'HoroscopeFeeder.php'); ?>
<?php require_once('helpers'.DS.'EnglishHoroscope.php'); ?>
<?php require_once('helpers'.DS.'AlbanianHoroscope.php'); ?>
<?php require_once('helpers'.DS.'ItalianHoroscope.php'); ?>
<?php require_once('helpers'.DS.'SwedishHoroscope.php'); ?>
<?php require_once('helpers'.DS.'SpanishHoroscope.php'); ?>
<?php require_once('helpers'.DS.'GermanHoroscope.php'); ?>
<?php require_once('includes'.DS.'widgets'.DS.'woroscope-widget.php'); ?>

