<?php
//No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$getVars = JRequest::get('get');
$postVars = JRequest::get('post');
$searchParams = array_merge($getVars, $postVars);

$searchParams['option'] = 'com_search';
$searchParams['task'] = 'search';
$searchParams['view'] = 'search';

$searchAction = http_build_query($searchParams);

$session = JFactory::getSession();
$searchWord = $session->get('searchword', '', 'redcontent_search');
$session->clear('searchword', 'redcontent_search');
// ------------------------------------------------
?>
<style>
.contact-default{
    color: #8E8E8E;
}

.contact-normal{
    color: #353535 !important
}
</style>
<div class="redcontent-search<?php echo $moduleclass_sfx; ?>" id="redcontent-search">
    <h3><?php echo JText::_("MOD_REDCONTENT_SEARCH_BYWEEK_TITLE") ?></h3>
    <div class="redcontent-search" style="border-top: 1px dotted #D1D1D1; margin-left: 10px;">
        <form action="<?php echo JRoute::_('index.php?' . $searchAction); ?>" method="post" enctype="multipart/form-data" id="tagsForm" style="margin-bottom: 0px;">
            <span><?php echo JText::_("MOD_REDCONTENT_SEARCH_BYWEEK_GUIDE") ?></span>
            <div style="padding-top: 5px;">
                <input type="text" value="<?php if(!empty($searchWord)) { echo $searchWord; } else { echo JText::_("MOD_REDCONTENT_SEARCH_BYWEEK_INPUT_DEFAULT"); } ?>"
                       id="searchwordModuleId"
                       name="searchword"
                       class="<?php if(!empty($searchWord)) { echo 'contact-normal'; } else { echo 'contact-default'; } ?>"
                       style="width: 77%;"
                       onblur="onblurAction(this, '<?php echo JText::_("MOD_REDCONTENT_SEARCH_BYWEEK_INPUT_DEFAULT"); ?>');"
                       onfocus="onfocusAction(this, '<?php echo JText::_("MOD_REDCONTENT_SEARCH_BYWEEK_INPUT_DEFAULT"); ?>');"
                />
                <input type="button" value="<?php echo JText::_("MOD_REDCONTENT_SEARCH_BYWEEK_BUTTON") ?>" class="button" style="padding-bottom: 3px;" onclick="submitButton(this);"/>
            </div>
        </form>
    </div>
    <div style="clear:both"></div>
    <div class="redcontent-search-advance" style="border-top: 1px dotted #D1D1D1; margin-left: 10px;">
        <form action="<?php echo JRoute::_('index.php?' . $searchAction); ?>" method="post" enctype="multipart/form-data" id="tagsForm">
            <span><?php echo JText::_("MOD_REDCONTENT_SEARCH_BYWEEK_OPTION"); ?></span>
            <div style="padding-top: 5px;">
                <input type="submit" value="<?php echo JText::_("MOD_REDCONTENT_SEARCH_BYWEEK_OPTION_BUTTON") ?>"/>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function onblurAction(obj, value) {
        var attr = obj.getAttribute("class");
        if(obj.value=='' && attr == "contact-normal") {
            obj.value = value;
            obj.setAttribute("class", "contact-default");
        }
    }

    function onfocusAction(obj, value) {
        var attr = obj.getAttribute("class");
        if(obj.value==value && attr == "contact-default") {
            obj.value='';
            obj.setAttribute("class", "contact-normal");
        }
    }

    function submitButton(obj) {
        var searchWord = document.getElementById("searchwordModuleId").value;
        if(!isNaN(searchWord))
        {
            // Check it because the min of search string is at least 3 character
            if(searchWord.length < 3) {
                var prefix = "0";
                if(searchWord.length == 1)
                {
                    prefix = "00";
                }
                var newSearchWord = prefix + searchWord;
                document.getElementById("searchwordModuleId").value = newSearchWord;
            }
            setCookie('searchByWeek', 1, 10)
            obj.parentNode.parentNode.submit();
        }
        else
        {
            alert('<?php echo JText::_("MOD_REDCONTENT_SEARCH_BYWEEK_OPTION_MSG_NUM"); ?>');
        }
    }

    function setCookie(name, value, exdays) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
        document.cookie = name + "=" + value;
    }
</script>