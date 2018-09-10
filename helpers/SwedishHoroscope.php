<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 4/7/2018
 * Time: 7:29 PM
 */

namespace Woroscope;


class SwedishHoroscope extends HoroscopeFeeder
{
	private $source = "http://www.spray.se/horoskop/";
	protected $enableCache = true;
	protected $language = LANGUAGE_SWEDISH;

	protected function getDailyContent($sign)
	{
		$signs    = Util::getHoroscopeSigns();
		$signName = $signs[$sign];
		$html     = new \simple_html_dom();
		$dailyUrl = $this->source . strtolower($signName);
		$html->load_file($dailyUrl);

		$result = '';
		if (!empty($html))
		{
			$container  = $html->find('.horoscope-starsign-daily');
			$paragraphs = $container[0]->find('p');
			$result     = $paragraphs[0]->innertext;

			if (isset($paragraphs[1])) {
				if (!empty($paragraphs[1]->innertext)) {
					$result     .= $paragraphs[1]->innertext;
				}
			}
		}

		return $result;
	}
}