<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 11/14/2017
 * Time: 6:33 PM
 */

namespace Woroscope;

abstract class HoroscopeFeeder
{
	protected $language;
	protected $enableCache = true;

	public function getDailyHoroscope($sign)
	{
		if (!$this->validateSign($sign)) {
			return false;
		}

		if($this->enableCache){
			Cache::getInstance()->initialize();
			if (Cache::search($sign, $this->language)){
				$horoscope = Cache::getResult($sign, $this->language);
			}
			else {
				$horoscope = $this->getDailyContent($sign);
				Cache::update($sign, $horoscope, $this->language);
				Cache::commit();
			}
		}
		else {
			$horoscope = $this->getDailyContent($sign);
		}

		return $horoscope;
	}

	protected function validateSign($sign)
	{
		$signs = Util::getHoroscopeSigns();

		return isset($signs[$sign]);
	}

	/**
	 * @return bool
	 */
	public function isEnableCache()
	{
		return $this->enableCache;
	}

	/**
	 * @param bool $enableCache
	 */
	public function setEnableCache($enableCache)
	{
		$this->enableCache = $enableCache;
	}

	abstract protected function getDailyContent($sign);
}