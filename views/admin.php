<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 11/13/2017
 * Time: 9:03 PM
 */
?>

<p>
	<label for="<?php echo $data['title']->id ?>">Title:</label>
	<input type="text" id="<?php echo $data['title']->id ?>" class="widefat" name="<?php echo $data['title']->name ?>" value="<?php echo esc_attr( $data['title']->val ); ?>" />
</p>

<p>
    <label for="<?php echo $data['date_format']->id ?>">Date format:</label>
    <select id="<?php echo $data['date_format']->id ?>" name="<?php echo $data['date_format']->name ?>" class="widefat">
		<?php foreach($formats as $key=>$format) { ?>
            <option value="<?php echo $key ?>" <?php echo $key == $data['date_format']->val?'selected':'' ?> ><?php echo $format ?></option>
		<?php } ?>
    </select>
</p>

<p>
	<label for="<?php echo $data['language']->id ?>">Language:</label>
	<select id="<?php echo $data['language']->id ?>" name="<?php echo $data['language']->name ?>" class="widefat">
		<?php foreach($languages as $key=>$language) { ?>
			<option value="<?php echo $key ?>" <?php echo $key == $data['language']->val?'selected':'' ?> ><?php echo $language ?></option>
		<?php } ?>
	</select>
</p>

<p>
	<label for="<?php echo $data['layout']->id ?>">Layout:</label>
	<select id="<?php echo $data['layout']->id ?>" name="<?php echo $data['layout']->name ?>" class="widefat">
		<?php foreach($layouts as $key=>$layout) { ?>
			<option value="<?php echo $key ?>" <?php echo $key == $data['layout']->val?'selected':'' ?> ><?php echo $layout ?></option>
		<?php } ?>
	</select>
</p>

<p>
    <label for="<?php echo $data['bg_color']->id ?>">Background Color:</label>
    <input type="color" name="<?php echo $data['bg_color']->name ?>" id="<?php echo $data['bg_color']->id ?>"
           value="<?php echo $data['bg_color']->val ?>">
</p>

<p>
    <label for="<?php echo $data['color']->id ?>">Text Color:</label>
    <input type="color" name="<?php echo $data['color']->name ?>" id="<?php echo $data['color']->id ?>"
           value="<?php echo $data['color']->val ?>">
</p>