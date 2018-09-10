<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 1/8/2018
 * Time: 11:05 PM
 */

namespace Woroscope;

class ItalianHoroscope extends HoroscopeFeeder
{
	private $source = "http://www.tgcom24.mediaset.it/oroscopo/";
	protected $enableCache = true;
	protected $language = LANGUAGE_ITALIAN;

	protected function getDailyContent($sign)
	{
		$signs    = Util::getHoroscopeSigns();
		$signName = $signs[$sign];
		$html     = new \simple_html_dom();
		$dailyUrl = $this->source . strtolower($signName) . '-oggi.shtml';
		$html->load_file($dailyUrl);

		$result = '';
		if (!empty($html)) {
			$container  = $html->find('div.p__media__h');
			$paragraphs = $container[0]->find('p');
			$result     = $paragraphs[0]->innertext;
		}

		return $result;
	}
}