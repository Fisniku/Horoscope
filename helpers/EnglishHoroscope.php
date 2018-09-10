<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 11/14/2017
 * Time: 6:40 PM
 */

namespace Woroscope;

class EnglishHoroscope extends HoroscopeFeeder
{
	private $source = "https://www.astrology.com/";
	protected $enableCache = true;
	protected $language = LANGUAGE_ENGLISH;

	public function getDailyContent($sign)
	{
		$daily    = $this->source."/horoscope/daily/";
		$signs    = Util::getHoroscopeSigns();
		$signName = $signs[$sign];
		$dailyUrl = $daily . strtolower($signName) . '.html';

		$html = new \simple_html_dom();
		$html->load_file($dailyUrl);

		$result = '';
		if (!empty($html))
		{
			$element = $html->find("p");
			$result  = $element[0]->innertext;
		}

		return $result;
	}
}