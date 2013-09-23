<?php
// no direct access
defined('_JEXEC') or die;
?>
<div class="search-wrapper">
    <form action="<?php echo JRoute::_('index.php');?>" method="post" class="form-search">
        <div class="search-module">
            <?php
            $output = '<input name="searchword" id="mod-search-searchword" maxlength="'.$maxlength.'"  class="inputbox'.$moduleclass_sfx.'" type="text" size="'.$width.'" value="'.$text.'"  onblur="if (this.value==\'\') { this.value=\''.$text.'\'; }" onfocus="if (this.value==\''.$text.'\'){ this.value=\'\'; }" onkeypress="submitFormSearch(this, event);"/>';

            if ($button) :
                if ($imagebutton) :
                    $button = ' <input type="image" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" src="'.$img.'" onclick="submitButtonSearch(this);"/>';
                else :
                    $button = ' <input type="button" value="'.$button_text.'" class="button'.$moduleclass_sfx.'" onclick="submitButtonSearch(this);"/>';
                endif;
            endif;

            switch ($button_pos) :
                case 'top' :
                    $button = $button.'<br />';
                    $output = $button.$output;
                    break;

                case 'bottom' :
                    $button = '<br />'.$button;
                    $output = $output.$button;
                    break;

                case 'right' :
                    $output = $output.$button;
                    break;

                case 'left' :
                default :
                    $output = $button.$output;
                    break;
            endswitch;

            echo $output;
            ?>
            <input type="hidden" name="task" value="search" />
            <input type="hidden" name="option" value="com_search" />
            <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
        </div>
    </form>
</div>
<script type="text/javascript">

    function submitFormSearch(obj, e) {
        if (e.keyCode == 13) {
            submitButtonSearch(obj);
        }
    }

    function submitButtonSearch(obj) {
        setCookieSearch('isInfoSys', <?php echo $isInfosys; ?>, 10)
        obj.parentNode.parentNode.submit();
    }

    function setCookieSearch(name, value, exdays) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
        document.cookie = name + "=" + value;
    }
</script>
