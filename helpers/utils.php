<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 11/13/2017
 * Time: 8:52 PM
 */

namespace Woroscope;

/**
 * Class Util
 *
 * Contains general functionality that may be used
 */
class Util
{
	private static $language = LANGUAGE_ENGLISH;

	/**
	 * Dummy constructor.
	 */
	private function __construct()
	{

	}

	/**
	 * Dummy clone.
	 */
	private function __clone()
	{

	}

	/**
	 * Method that returns the singleton instance
	 *
	 * @return Util
	 */
	public static function getInstance()
	{
		static $instance;
		if ($instance === null) {
			$instance = new Util();
		}
		return $instance;
	}

	public static function getLanguages()
	{
		$languages = array();
		$languages[LANGUAGE_ENGLISH] = 'English';
		$languages[LANGUAGE_ALBANIAN] = 'Albanian';
		$languages[LANGUAGE_ITALIAN] = 'Italian';
		$languages[LANGUAGE_SWEDISH] = 'Swedish';
        $languages[LANGUAGE_SPANISH] = 'Spanish';
		$languages[LANGUAGE_GERMAN] = 'German';

		return $languages;
	}

	public static function getLayouts()
	{
		$layouts = array();
		$layouts[SIMPLE_LAYOUT] = 'Simple Layout';
		$layouts[ICON_LAYOUT] = 'Icon Layout';

		return $layouts;
	}

	public static function getDateFormats()
	{
		$formats = array();
		$formats[] =  'd-m-Y';
		$formats[] =  'm-d-Y';
		$formats[] =  'd/m/Y';
		$formats[] =  'm/d/Y';
		$formats[] =  'd.m.Y';
		$formats[] =  'm.d.Y';

		return $formats;
	}

	public static function getHoroscopeSigns()
	{
		$signs                   = array();
		$signs[SIGN_ARIES]       = self::translate('Aries');
		$signs[SIGN_TAURUS]      = self::translate('Taurus');
		$signs[SIGN_GEMINI]      = self::translate('Gemini');
		$signs[SIGN_CANCER]      = self::translate('Cancer');
		$signs[SIGN_LEO]         = self::translate('Leo');
		$signs[SIGN_VIRGO]       = self::translate('Virgo');
		$signs[SIGN_LIBRA]       = self::translate('Libra');
		$signs[SIGN_SCORPIO]     = self::translate('Scorpio');
		$signs[SIGN_SAGITTARIUS] = self::translate('Sagittarius');
		$signs[SIGN_CAPRICORN]   = self::translate('Capricorn');
		$signs[SIGN_AQUARIUS]    = self::translate('Aquarius');
		$signs[SIGN_PISCES]      = self::translate('Pisces');

		return $signs;
	}

	public static function getHoroscopeObject($language)
	{
		$language = (int)$language;

		switch($language) {
			case LANGUAGE_ENGLISH:
				$object = new EnglishHoroscope();
				break;
			case LANGUAGE_ALBANIAN:
				$object = new AlbanianHoroscope();
				break;
			case LANGUAGE_ITALIAN:
				$object = new ItalianHoroscope();
				break;
			case LANGUAGE_SWEDISH:
				$object = new SwedishHoroscope();
				break;
            case LANGUAGE_SPANISH:
                $object = new SpanishHoroscope();
                break;
			case LANGUAGE_GERMAN:
				$object = new GermanHoroscope();
				break;
			default:
				$object = new EnglishHoroscope();
		}

		return $object;
	}

	public static function renderWidgetAdmin($data)
	{
		$languages = self::getLanguages();
		$layouts = self::getLayouts();
		$formats = self::getDateFormats();

		ob_start();
		include(SITE_ROOT.DS.'views'.DS.'admin.php');
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}

	public static function renderWidget($config)
	{
        $color   = $config['bg_color'];
		$layout   = $config['layout'];
		$language = $config['language'];
		$format   = self::getDateFormats()[$config["date_format"]];

		$layout = (int) $layout;
		if(empty($layout)) {
			$layout = SIMPLE_LAYOUT;
		}

		self::$language = (int)$language;
		$horoscopeObject = self::getHoroscopeObject($language);
		$signs  = self::getHoroscopeSigns();

		ob_start();
		include(SITE_ROOT.DS.'views'.DS.'layout'.$layout.'.php');
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}

	public static function translate($text, $language = null)
	{
		if (empty($language)) {
			$language = self::$language;
		}

		$translations = array();

		$albanian                        = array();
		$albanian['Aries']               = 'Dashi';
		$albanian['Taurus']              = 'Demi';
		$albanian['Gemini']              = 'Binjakët';
		$albanian['Cancer']              = 'Gaforrja';
		$albanian['Leo']                 = 'Luani';
		$albanian['Virgo']               = 'Virgjëresha';
		$albanian['Libra']               = 'Peshorja';
		$albanian['Scorpio']             = 'Akrepi';
		$albanian['Sagittarius']         = 'Shigjetari';
		$albanian['Capricorn']           = 'Bricjapi';
		$albanian['Aquarius']            = 'Ujori';
		$albanian['Pisces']              = 'Peshqit';
		$translations[LANGUAGE_ALBANIAN] = $albanian;

		$italian                         = array();
		$italian['Aries']                = 'Ariete';
		$italian['Taurus']               = 'Toro';
		$italian['Gemini']               = 'Gemelli';
		$italian['Cancer']               = 'Cancro';
		$italian['Leo']                  = 'Leone';
		$italian['Virgo']                = 'Vergine';
		$italian['Libra']                = 'Bilancia';
		$italian['Scorpio']              = 'Scorpione';
		$italian['Sagittarius']          = 'Sagittario';
		$italian['Capricorn']            = 'Capricorno';
		$italian['Aquarius']             = 'Acquario';
		$italian['Pisces']               = 'Pesci';
		$translations[LANGUAGE_ITALIAN]  = $italian;

		$swedish                        = array();
		$swedish['Aries']               = 'Vaduren';
		$swedish['Taurus']              = 'Oxen';
		$swedish['Gemini']              = 'Tvillingarna';
		$swedish['Cancer']              = 'Kraftan';
		$swedish['Leo']                 = 'Lejonet';
		$swedish['Virgo']               = 'Jungfrun';
		$swedish['Libra']               = 'Vagen';
		$swedish['Scorpio']             = 'Skorpionen';
		$swedish['Sagittarius']         = 'Skytten';
		$swedish['Capricorn']           = 'Stenbocken';
		$swedish['Aquarius']            = 'Vattumannen';
		$swedish['Pisces']              = 'Fiskarna';
		$translations[LANGUAGE_SWEDISH] = $swedish;

        $spanish                        = array();
        $spanish['Aries']               = 'Aries';
        $spanish['Taurus']              = 'Tauro';
        $spanish['Gemini']              = 'Geminis';
        $spanish['Cancer']              = 'Cáncer';
        $spanish['Leo']                 = 'León';
        $spanish['Virgo']               = 'Virgo';
        $spanish['Libra']               = 'Libra';
        $spanish['Scorpio']             = 'Escorpión';
        $spanish['Sagittarius']         = 'Sagitario';
        $spanish['Capricorn']           = 'Capricornio';
        $spanish['Aquarius']            = 'Acuario';
        $spanish['Pisces']              = 'Piscis';
        $translations[LANGUAGE_SPANISH] = $spanish;

		$german                        = array();
		$german['Aries']               = 'Widder';
		$german['Taurus']              = 'Stier';
		$german['Gemini']              = 'Zwillinge';
		$german['Cancer']              = 'Krebs';
		$german['Leo']                 = 'Löwe';
		$german['Virgo']               = 'Jungfrau';
		$german['Libra']               = 'Waage';
		$german['Scorpio']             = 'Skorpion';
		$german['Sagittarius']         = 'Schütze';
		$german['Capricorn']           = 'Steinbock';
		$german['Aquarius']            = 'Wassermann';
		$german['Pisces']              = 'Fische';
		$translations[LANGUAGE_GERMAN] = $german;

		if (isset($translations[$language][$text])){
			return $translations[$language][$text];
		}
		else{
			return $text;
		}
	}
}