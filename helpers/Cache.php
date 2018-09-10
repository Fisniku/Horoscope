<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 11/18/2017
 * Time: 3:40 PM
 */

namespace Woroscope;

define('CACHE_LOCATION', SITE_ROOT . '/cache.json');

class Cache
{
	private static $content;

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
	 * @return Cache
	 */
	public static function getInstance()
	{
		static $instance;
		if ($instance === null) {
			$instance = new Cache();
		}
		return $instance;
	}

	/**
	 * Initializes the cache object by loading the cache content and adding it to the instance.
	 */
	public function initialize()
	{
		self::checkCacheFile();
		self::load();
	}

	/**
	 * Searches if the cache contains the requested data.
	 *
	 * @param int    $sign
	 * @param int    $language
	 * @param string $date
	 *
	 * @return bool True if request found, false if not present in cache
	 */
	public static function search($sign, $language = LANGUAGE_ENGLISH, $date = null)
	{
		if (empty($date)){
			$date = date('Y-m-d');
		}

		if (empty(self::$content)){
			return false;
		}
		else if (!isset(self::$content[$language])){
			return false;
		}
		else if (!isset(self::$content[$language][$sign])){
			return false;
		}
		else if (!isset(self::$content[$language][$sign]['date'])){
			return false;
		}

		$requiredContent = self::$content[$language];
		if (strtotime($requiredContent[$sign]['date']) == strtotime($date)){
			return true;
		}

		return false;
	}

	/**
	 * Returns the requested result.
	 *
	 * @param int $sign
	 * @param int $language
	 *
	 * @return mixed
	 */
	public static function getResult($sign, $language = LANGUAGE_ENGLISH)
	{
		//TODO check if data is present, or change logic
		return self::$content[$language][$sign]['horoscope'];
	}

	/**
	 * Updates the cache object with the provided horoscope for the specified
	 * sign and language.
	 *
	 * @param int    $sign
	 * @param string $horoscope
	 * @param int    $language
	 */
	public static function update($sign, $horoscope, $language = LANGUAGE_ENGLISH)
	{
		if (!isset(self::$content[$language])){
			self::$content[$language] = array();
		}

		$tmp                             = new \stdClass();
		$tmp->date                       = date('Y-m-d');
		$tmp->horoscope                  = $horoscope;
		self::$content[$language][$sign] = $tmp;
	}

	/**
	 * Saves the state of the cache object into the file.
	 */
	public static function commit()
	{
		$jsonCache = json_encode(self::$content);
		$fp = fopen(CACHE_LOCATION, 'w');
		fwrite($fp, $jsonCache);
		fclose($fp);
	}


	/**
	 * Checks if the file exists, otherwise it creates it.
	 *
	 * @return bool true on success, false otherwise
	 */
	private static function checkCacheFile()
	{
		$filename = CACHE_LOCATION;
		if (file_exists($filename)){
			return true;
		}
		else{
			$file = fopen($filename, 'w');

			//TODO handle the case when the file cannot be created due to permissions
			if (!$file){
				return false;
			}
		}

		return true;
	}

	/**
	 * Loads the content of the cache file
	 */
	private static function load()
	{
		$data = file_get_contents(CACHE_LOCATION);
		$data = json_decode($data, true);

		self::setContent($data);
	}

	/**
	 * @return mixed
	 */
	public static function getContent()
	{
		return self::$content;
	}

	/**
	 * @param mixed $content
	 */
	public static function setContent($content)
	{
		self::$content = $content;
	}
}