<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 11/19/2017
 * Time: 2:55 PM
 */

namespace Woroscope;

class AlbanianHoroscope extends HoroscopeFeeder
{
	private $source = "http://horoskopishqip.net/";
	protected $enableCache = true;
	protected $language = LANGUAGE_ALBANIAN;
	protected $buffer;

	protected function getDailyContent($sign)
	{
		$dailyUrl = $this->source."horoskopi-ditor/";

		if (empty($this->buffer)) {
			$html = new \simple_html_dom();
			$html->load_file($dailyUrl);
			$this->buffer = $html;
		}

		$result = '';
		if (!empty($this->buffer)) {
			$container = $this->buffer->find('div.col-sm-8');
			$paragraphs = $container[0]->find('p');
			$result = $paragraphs[$sign]->innertext;
		}

		return $result;
	}
}