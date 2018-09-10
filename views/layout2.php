<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 12/10/2017
 * Time: 8:01 PM
 */
?>

<div class="woroscope-wrapper-2">
	<div class="woroscope-header">
		<p><?php echo date($format); ?></p>
	</div>
    <div>
        <select id="horoscope_sign" onchange="updateSign()">
            <?php foreach($signs as $key=>$sign) { ?>
                <option value="<?php echo $key ?>"><?php echo $sign ?></option>
            <?php } ?>
        </select>
    </div>
    <br/>

    <div style="background-color: <?php echo $color?>">
        <?php foreach ($signs as $key=>$sign) { ?>
            <?php $display = $key==SIGN_ARIES?'':'style="display:none;"'; ?>
            <div class="horoscope-content-flat" id="horoscope-<?php echo $key ?>" <?php echo $display ?>>
                <img id="horoscope-icon" class="horoscope-icon" style="" src="<?php echo plugins_url() ?>/horoscope/assets/images/flat/<?php echo $key ?>.png" width="80" />
                <p><?php echo $horoscopeObject->getDailyHoroscope($key); ?></p>
            </div>
        <?php } ?>

    </div>
</div>

<script>
    function updateSign()
    {
        var sign = jQuery('#horoscope_sign option:selected').val();

        jQuery('.horoscope-content-flat').hide(500);
        jQuery('#horoscope-'+sign).show(500);
    }
</script>


