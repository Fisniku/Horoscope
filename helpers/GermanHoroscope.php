<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 11/19/2017
 * Time: 2:55 PM
 */

namespace Woroscope;

class GermanHoroscope extends HoroscopeFeeder
{
	private $source = "http://www.stardm.com/";
	protected $enableCache = true;
	protected $language = LANGUAGE_GERMAN;
	protected $buffer;

	protected function getDailyContent($sign)
	{
		$dailyUrl = $this->source."daily-horoscopes/N-german-daily-horoscopes.asp";

		if (empty($this->buffer)) {
			$html = new \simple_html_dom();
			$html->load_file($dailyUrl);
			$this->buffer = $html;
		}

		$result = '';
		if (!empty($this->buffer)) {
			$container = $this->buffer->find('div.entry');
			$paragraphs = $container[0]->find('p');
			$result = $paragraphs[$sign]->innertext;
		}

		return $result;
	}
}