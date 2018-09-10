<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 6/26/2018
 * Time: 4:52 AM
 */


namespace Woroscope;

class SpanishHoroscope extends HoroscopeFeeder
{
    private $source = "http://www.stardm.com/daily-horoscopes/";
    protected $enableCache = true;
    protected $language = LANGUAGE_SPANISH;
    protected $buffer;

    protected function getDailyContent($sign)
    {
        $dailyUrl = $this->source."O-spanish-daily-horoscopes.asp";

        if (empty($this->buffer)) {
            $html = new \simple_html_dom();
            $html->load_file($dailyUrl);
            $this->buffer = $html;
        }

        $result = '';
        if (!empty($this->buffer)) {
            $container = $this->buffer->find('div.post');
            $paragraphs = $container[0]->find('p');
            $result = $paragraphs[$sign]->innertext;
        }

        return $result;
    }
}