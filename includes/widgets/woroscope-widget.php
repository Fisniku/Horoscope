<?php

use  Woroscope\Util;

/**
 * Woroscope widget class
 */
class Woroscope_Widget extends WP_Widget
{

	/**
	 * Register widget with WordPress.
	 */
	public function __construct()
	{
		$widgetOptions = array(
			'classname'   => 'Woroscope_Widget',
			'description' => 'A simple horoscope widget'
		);

		parent::__construct
		(
			'woroscope_widget', // Base ID
			'Woroscope', // Name
			$widgetOptions
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance)
	{
		$title    = apply_filters('widget_title', $instance['title']);

		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
		Util::renderWidget($instance);
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance)
	{
		$data = array();

		$title         = new stdClass();
		$title->val    = !empty($instance['title']) ? $instance['title'] : '';
		$title->id     = $this->get_field_id('title');
		$title->name   = $this->get_field_name('title');
		$data['title'] = $title;

		$format              = new stdClass();
		$format->val         = !empty($instance['date_format']) ? $instance['date_format'] : '';
		$format->id          = $this->get_field_id('date_format');
		$format->name        = $this->get_field_name('date_format');
		$data['date_format'] = $format;

		$language         = new stdClass();
		$language->val    = !empty($instance['language']) ? $instance['language'] : '';
		$language->id     = $this->get_field_id('language');
		$language->name   = $this->get_field_name('language');
		$data['language'] = $language;

		$layout         = new stdClass();
		$layout->val    = !empty($instance['layout']) ? $instance['layout'] : '';
		$layout->id     = $this->get_field_id('layout');
		$layout->name   = $this->get_field_name('layout');
		$data['layout'] = $layout;

        $color         = new stdClass();
        $color->val    = !empty($instance['bg_color']) ? $instance['bg_color'] : '';
        $color->id     = $this->get_field_id('bg_color');
        $color->name   = $this->get_field_name('bg_color');
        $data['bg_color'] = $color;

        Util::renderWidgetAdmin($data);
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance)
	{
		$instance                = $old_instance;
		$instance['title']       = strip_tags($new_instance['title']);
		$instance['date_format'] = strip_tags($new_instance['date_format']);
		$instance['language']    = strip_tags($new_instance['language']);
		$instance['layout']      = strip_tags($new_instance['layout']);
        $instance['bg_color']    = strip_tags($new_instance['bg_color']);

        return $instance;
	}

}

function registerWoroscope()
{
	register_widget('Woroscope_Widget');
}

add_action('widgets_init', 'registerWoroscope');