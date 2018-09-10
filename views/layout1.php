<?php
/**
 * Created by PhpStorm.
 * User: Fisniku
 * Date: 11/14/2017
 * Time: 7:57 PM
 */

?>

<div class="woroscope-wrapper-1">
    <span><?php echo date($format); ?></span>
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
            <div  class="horoscope-content" id="horoscope-<?php echo $key ?>" <?php echo $display ?>>
                <span><?php echo $horoscopeObject->getDailyHoroscope($key); ?></span>
            </div>
        <?php } ?>

    </div>
</div>

<script>
    function updateSign()
    {
        var sign = jQuery('#horoscope_sign option:selected').val();

        jQuery('.horoscope-content').hide();
        jQuery('#horoscope-'+sign).show();
    }
</script>


