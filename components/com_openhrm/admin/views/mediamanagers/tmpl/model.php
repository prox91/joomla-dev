<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ngoc Nha
 * Date: 4/6/13
 * Time: 11:20 AM
 * To change this template use File | Settings | File Templates.
 */
// No direct access to this file
defined('_JEXEC') or die;
JHtml::_('dropdown.init');
JHtml::_('bootstrap.tooltip');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.multiselect');

$app		= JFactory::getApplication();
$user		= JFactory::getUser();
$userId		= $user->get('id');
$link = JRoute::_('index.php?option=com_openhrm&task=mediamanager.apply&view=mediamanager&tmpl=component&layout=modal');

JHtml::_('stylesheet', 'openhrm/assets/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css');
JHtml::_('script', 'openhrm/assets/jquery/ui/jquery-ui-1.8.16.custom.min.js', false, true, false, false);
JHtml::_('script', 'openhrm/assets/jquery/ui/external/jquery.bgiframe-2.1.2.js', false, true, false, false);
JHtml::_('script', 'openhrm/assets/jquery/jstree/jquery.tree.min.js', false, true, false, false);
JHtml::_('script', 'openhrm/assets/jquery/ajaxupload.js', false, true, false, false);

$button_folder = JText::_('Thư mục mới');
$button_delete = JText::_('Xóa');
$button_move = JText::_('Chuyển');
$button_copy = JText::_('Sao');
$button_rename = JText::_('Sửa tên');
$button_upload = JText::_('Tải lên');
$button_refresh = JText::_('Làm tươi');

$entry_folder = JText::_('entry_folder');
$entry_move = JText::_('entry_move');
$entry_copy = JText::_('entry_copy');
$entry_rename = JText::_('entry_rename');

$button_submit = JText::_('button_submit');

$error_directory = JText::_('error_directory');
$error_select = JText::_('error_select');

$no_image = OpenHrmHelpersOpenhrm::resize(JPATH_ROOT  . '/media/openhrm/images/default-photo.png', 100, 100);
?>

<style type="text/css">
	body {
		padding: 0;
		margin: 0;
		background: #F7F7F7;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 11px;
	}
	img {
		border: 0;
	}
	#container {
		padding: 0px 10px 7px 10px;
		height: 340px;
	}
	#menu {
		clear: both;
		height: 29px;
		margin-bottom: 3px;
	}
	#column-left {
		background: #FFF;
		border: 1px solid #CCC;
		float: left;
		width: 20%;
		height: 320px;
		overflow: auto;
	}
	#column-right {
		background: #FFF;
		border: 1px solid #CCC;
		float: right;
		width: 78%;
		height: 320px;
		overflow: auto;
		text-align: center;
	}
	#column-right div {
		text-align: left;
		padding: 5px;
	}
	#column-right a {
		display: inline-block;
		text-align: center;
		border: 1px solid #EEEEEE;
		cursor: pointer;
		margin: 5px;
		padding: 5px;
	}
	#column-right a.selected {
		border: 1px solid #7DA2CE;
		background: #EBF4FD;
	}
	#column-right input {
		display: none;
	}
	#dialog {
		display: none;
	}
	.button {
		display: block;
		float: left;
		padding: 8px 5px 8px 25px;
		margin-right: 5px;
		background-position: 5px 6px;
		background-repeat: no-repeat;
		cursor: pointer;
	}
	.button:hover {
		background-color: #EEEEEE;
	}
	.thumb {
		padding: 5px;
		width: 105px;
		height: 105px;
		background: #F7F7F7;
		border: 1px solid #CCCCCC;
		cursor: pointer;
		cursor: move;
		position: relative;
	}
</style>
<div id="container">
    <div id="menu">
	    <a id="create" class="button" style="background-image: url(<?php echo JUri::root() . 'media/openhrm/assets/images/folder.png'; ?>);"><?php echo $button_folder; ?></a>
	    <a id="delete" class="button" style="background-image: url(<?php echo JUri::root() . 'media/openhrm/assets/images/edit-delete.png'; ?>);"><?php echo $button_delete; ?></a>
	    <a id="move" class="button" style="background-image: url(<?php echo JUri::root() . 'media/openhrm/assets/images/edit-cut.png'; ?>);"><?php echo $button_move; ?></a>
	    <a id="copy" class="button" style="background-image: url(<?php echo JUri::root() . 'media/openhrm/assets/images/edit-copy.png'; ?>);"><?php echo $button_copy; ?></a>
	    <a id="rename" class="button" style="background-image: url(<?php echo JUri::root() . 'media/openhrm/assets/images/edit-rename.png'; ?>);"><?php echo $button_rename; ?></a>
	    <a id="upload" class="button" style="background-image: url(<?php echo JUri::root() . 'media/openhrm/assets/images/upload.png'; ?>);"><?php echo $button_upload; ?></a>
	    <a id="refresh" class="button" style="background-image: url(<?php echo JUri::root() . 'media/openhrm/assets/images/refresh.png'; ?>);"><?php echo $button_refresh; ?></a>
    </div>
    <div id="column-left"></div>
    <div id="column-right"></div>
</div>
<script type="text/javascript">
<!--
jQuery(document).ready(function() {
    (function(){
        var special = jQuery.event.special,
            uid1 = 'D' + (+new Date()),
            uid2 = 'D' + (+new Date() + 1);

        special.scrollstart = {
            setup: function() {
                var timer,
                    handler =  function(evt) {
                        var _self = this,
                            _args = arguments;

                        if (timer) {
                            clearTimeout(timer);
                        } else {
                            evt.type = 'scrollstart';
                            jQuery.event.handle.apply(_self, _args);
                        }

                        timer = setTimeout( function(){
                            timer = null;
                        }, special.scrollstop.latency);

                    };

                jQuery(this).bind('scroll', handler).data(uid1, handler);
            },
            teardown: function(){
                jQuery(this).unbind( 'scroll', jQuery(this).data(uid1) );
            }
        };

        special.scrollstop = {
            latency: 300,
            setup: function() {

                var timer,
                    handler = function(evt) {

                        var _self = this,
                            _args = arguments;

                        if (timer) {
                            clearTimeout(timer);
                        }

                        timer = setTimeout( function(){

                            timer = null;
                            evt.type = 'scrollstop';
                            jQuery.event.handle.apply(_self, _args);

                        }, special.scrollstop.latency);

                    };

                jQuery(this).bind('scroll', handler).data(uid2, handler);

            },
            teardown: function() {
                jQuery(this).unbind('scroll', jQuery(this).data(uid2));
            }
        };
    })();

	/*
    jQuery('#column-right').bind('scrollstop', function() {
        jQuery('#column-right a').each(function(index, element) {
            var height = jQuery('#column-right').height();
            var offset = jQuery(element).offset();

            if ((offset.top > 0) && (offset.top < height) && jQuery(element).find('img').attr('src') == '<?php //echo $no_image; ?>') {
                jQuery.ajax({
	                url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.image&format=json', false); ?>&image=' + encodeURIComponent('data/' + jQuery(element).find('input[name=\'image\']').attr('value')),
                    dataType: 'html',
                    success: function(html) {
                        jQuery(element).find('img').replaceWith('<img src="' + html + '" alt="" title="" />');
                    }
                });
            }
        });
    });
    */

    jQuery('#column-left').tree({
        data: {
            type: 'json',
            async: true,
            opts: {
                method: 'post',
	            url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.directory&format=json', false); ?>'
            }
        },
        selected: 'top',
        ui: {
            theme_name: 'classic',
            animation: 700
        },
        types: {
            'default': {
                clickable: true,
                creatable: false,
                renameable: false,
                deletable: false,
                draggable: false,
                max_children: -1,
                max_depth: -1,
                valid_children: 'all'
            }
        },
        callback: {
            beforedata: function(NODE, TREE_OBJ) {
                if (NODE == false) {
                    TREE_OBJ.settings.data.opts.static = [
                        {
                            data: 'image',
                            attributes: {
                                'id': 'top',
                                'directory': ''
                            },
                            state: 'closed'
                        }
                    ];

                    return { 'directory': '' }
                } else {
                    TREE_OBJ.settings.data.opts.static = false;

                    return { 'directory': jQuery(NODE).attr('directory') }
                }
            },
            onselect: function (NODE, TREE_OBJ) {
                jQuery.ajax({
	                url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.files&format=json', false); ?>',
                    type: 'post',
                    data: 'directory=' + encodeURIComponent(jQuery(NODE).attr('directory')),
                    dataType: 'json',
                    success: function(json) {
                        html = '<div>';

                        if (json) {
                            for (i = 0; i < json.length; i++) {
                                html += '<a><img src="<?php echo $no_image; ?>" alt="" title="" /><br />' + ((json[i]['filename'].length > 15) ? (json[i]['filename'].substr(0, 15) + '..') : json[i]['filename']) + '<br />' + json[i]['size'] + '<input type="hidden" name="image" value="' + json[i]['file'] + '" /></a>';
                            }
                        }

                        html += '</div>';

                        jQuery('#column-right').html(html);

                        jQuery('#column-right').trigger('scrollstop');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }
    });

    jQuery('#column-right a').live('click', function() {
        if (jQuery(this).attr('class') == 'selected') {
            jQuery(this).removeAttr('class');
        } else {
            jQuery('#column-right a').removeAttr('class');

            jQuery(this).attr('class', 'selected');
        }
    });

/*
    jQuery('#column-right a').live('dblclick', function() {
        <?php //if ($fckeditor) { ?>
        window.opener.CKEDITOR.tools.callFunction(<?php //echo $fckeditor; ?>, '<?php //echo $directory; ?>' + jQuery(this).find('input[name=\'image\']').attr('value'));

        self.close();
        <?php //} else { ?>
        parent.jQuery('#<?php //echo $field; ?>').attr('value', 'data/' + jQuery(this).find('input[name=\'image\']').attr('value'));
        parent.jQuery('#dialog').dialog('close');

        parent.jQuery('#dialog').remove();
        <?php //} ?>
    });
*/

    jQuery('#create').bind('click', function() {
        var tree = jQuery.tree.focused();

        if (tree.selected) {
            jQuery('#dialog').remove();

            html  = '<div id="dialog">';
            html += '<?php echo $entry_folder; ?> <input type="text" name="name" value="" /> <input type="button" value="<?php echo $button_submit; ?>" />';
            html += '</div>';

            jQuery('#column-right').prepend(html);

            jQuery('#dialog').dialog({
                title: '<?php echo $button_folder; ?>',
                resizable: false
            });

            jQuery('#dialog input[type=\'button\']').bind('click', function() {
                jQuery.ajax({
	                url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.create&format=json', false); ?>',
                    type: 'post',
                    data: 'directory=' + encodeURIComponent(jQuery(tree.selected).attr('directory')) + '&name=' + encodeURIComponent(jQuery('#dialog input[name=\'name\']').val()),
                    dataType: 'json',
                    success: function(json) {
                        if (json.success) {
                            jQuery('#dialog').remove();

                            tree.refresh(tree.selected);

                            alert(json.success);
                        } else {
                            alert(json.error);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            });
        } else {
            alert('<?php echo $error_directory; ?>');
        }
    });

    jQuery('#delete').bind('click', function() {
        path = jQuery('#column-right a.selected').find('input[name=\'image\']').attr('value');

        if (path) {
            jQuery.ajax({
	            url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.delete&format=json', false); ?>',
                type: 'post',
                data: 'path=' + encodeURIComponent(path),
                dataType: 'json',
                success: function(json) {
                    if (json.success) {
                        var tree = jQuery.tree.focused();

                        tree.select_branch(tree.selected);

                        alert(json.success);
                    }

                    if (json.error) {
                        alert(json.error);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        } else {
            var tree = jQuery.tree.focused();

            if (tree.selected) {
                jQuery.ajax({
	                url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.delete&format=json', false); ?>',
                    type: 'post',
                    data: 'path=' + encodeURIComponent(jQuery(tree.selected).attr('directory')),
                    dataType: 'json',
                    success: function(json) {
                        if (json.success) {
                            tree.select_branch(tree.parent(tree.selected));

                            tree.refresh(tree.selected);

                            alert(json.success);
                        }

                        if (json.error) {
                            alert(json.error);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            } else {
                alert('<?php echo $error_select; ?>');
            }
        }
    });

    jQuery('#move').bind('click', function() {
        jQuery('#dialog').remove();

        html  = '<div id="dialog">';
        html += '<?php echo $entry_move; ?> <select name="to"></select> <input type="button" value="<?php echo $button_submit; ?>" />';
        html += '</div>';

        jQuery('#column-right').prepend(html);

        jQuery('#dialog').dialog({
            title: '<?php echo $button_move; ?>',
            resizable: false
        });

        jQuery('#dialog select[name=\'to\']').load('<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.folders&format=json', false); ?>');

        jQuery('#dialog input[type=\'button\']').bind('click', function() {
            path = jQuery('#column-right a.selected').find('input[name=\'image\']').attr('value');

            if (path) {
                jQuery.ajax({
	                url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.move&format=json', false); ?>',
	                type: 'post',
                    data: 'from=' + encodeURIComponent(path) + '&to=' + encodeURIComponent(jQuery('#dialog select[name=\'to\']').val()),
                    dataType: 'json',
                    success: function(json) {
                        if (json.success) {
                            jQuery('#dialog').remove();

                            var tree = jQuery.tree.focused();

                            tree.select_branch(tree.selected);

                            alert(json.success);
                        }

                        if (json.error) {
                            alert(json.error);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            } else {
                var tree = jQuery.tree.focused();

                jQuery.ajax({
	                url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.move&format=json', false); ?>',
                    type: 'post',
                    data: 'from=' + encodeURIComponent(jQuery(tree.selected).attr('directory')) + '&to=' + encodeURIComponent(jQuery('#dialog select[name=\'to\']').val()),
                    dataType: 'json',
                    success: function(json) {
                        if (json.success) {
                            jQuery('#dialog').remove();

                            tree.select_branch('#top');

                            tree.refresh(tree.selected);

                            alert(json.success);
                        }

                        if (json.error) {
                            alert(json.error);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        });
    });

    jQuery('#copy').bind('click', function() {
        jQuery('#dialog').remove();

        html  = '<div id="dialog">';
        html += '<?php echo $entry_copy; ?> <input type="text" name="name" value="" /> <input type="button" value="<?php echo $button_submit; ?>" />';
        html += '</div>';

        jQuery('#column-right').prepend(html);

        jQuery('#dialog').dialog({
            title: '<?php echo $button_copy; ?>',
            resizable: false
        });
        jQuery('#dialog select[name=\'to\']').load('<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.folders&format=json', false); ?>');

        jQuery('#dialog input[type=\'button\']').bind('click', function() {
            path = jQuery('#column-right a.selected').find('input[name=\'image\']').attr('value');

            if (path) {
                jQuery.ajax({
	                url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.copy&format=json', false); ?>',
                    type: 'post',
                    data: 'path=' + encodeURIComponent(path) + '&name=' + encodeURIComponent(jQuery('#dialog input[name=\'name\']').val()),
                    dataType: 'json',
                    success: function(json) {
                        if (json.success) {
                            jQuery('#dialog').remove();

                            var tree = jQuery.tree.focused();

                            tree.select_branch(tree.selected);

                            alert(json.success);
                        }

                        if (json.error) {
                            alert(json.error);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            } else {
                var tree = jQuery.tree.focused();

                jQuery.ajax({
	                url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.copy&format=json', false); ?>',
                    type: 'post',
                    data: 'path=' + encodeURIComponent(jQuery(tree.selected).attr('directory')) + '&name=' + encodeURIComponent(jQuery('#dialog input[name=\'name\']').val()),
                    dataType: 'json',
                    success: function(json) {
                        if (json.success) {
                            jQuery('#dialog').remove();

                            tree.select_branch(tree.parent(tree.selected));

                            tree.refresh(tree.selected);

                            alert(json.success);
                        }

                        if (json.error) {
                            alert(json.error);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        });
    });

    jQuery('#rename').bind('click', function() {
        jQuery('#dialog').remove();

        html  = '<div id="dialog">';
        html += '<?php echo $entry_rename; ?> <input type="text" name="name" value="" /> <input type="button" value="<?php echo $button_submit; ?>" />';
        html += '</div>';

        jQuery('#column-right').prepend(html);

        jQuery('#dialog').dialog({
            title: '<?php echo $button_rename; ?>',
            resizable: false
        });

        jQuery('#dialog input[type=\'button\']').bind('click', function() {
            path = jQuery('#column-right a.selected').find('input[name=\'image\']').attr('value');

            if (path) {
                jQuery.ajax({
	                url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.rename&format=json', false); ?>',
                    type: 'post',
                    data: 'path=' + encodeURIComponent(path) + '&name=' + encodeURIComponent(jQuery('#dialog input[name=\'name\']').val()),
                    dataType: 'json',
                    success: function(json) {
                        if (json.success) {
                            jQuery('#dialog').remove();

                            var tree = jQuery.tree.focused();

                            tree.select_branch(tree.selected);

                            alert(json.success);
                        }

                        if (json.error) {
                            alert(json.error);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            } else {
                var tree = jQuery.tree.focused();

                jQuery.ajax({
	                url: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.rename&format=json', false); ?>',
                    type: 'post',
                    data: 'path=' + encodeURIComponent(jQuery(tree.selected).attr('directory')) + '&name=' + encodeURIComponent(jQuery('#dialog input[name=\'name\']').val()),
                    dataType: 'json',
                    success: function(json) {
                        if (json.success) {
                            jQuery('#dialog').remove();

                            tree.select_branch(tree.parent(tree.selected));

                            tree.refresh(tree.selected);

                            alert(json.success);
                        }

                        if (json.error) {
                            alert(json.error);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        });
    });

    new AjaxUpload('#upload', {
	    action: '<?php echo JRoute::_('index.php?option=com_openhrm&task=mediamanagers.upload&format=json', false); ?>',
        name: 'image',
        autoSubmit: false,
        responseType: 'json',
        onChange: function(file, extension) {
            var tree = jQuery.tree.focused();

            if (tree.selected) {
                this.setData({'directory': jQuery(tree.selected).attr('directory')});
            } else {
                this.setData({'directory': ''});
            }

            this.submit();
        },
        onSubmit: function(file, extension) {
            jQuery('#upload').append('<img src="view/image/loading.gif" class="loading" style="padding-left: 5px;" />');
        },
        onComplete: function(file, json) {
            if (json.success) {
                var tree = jQuery.tree.focused();

                tree.select_branch(tree.selected);

                alert(json.success);
            }

            if (json.error) {
                alert(json.error);
            }

            jQuery('.loading').remove();
        }
    });

    jQuery('#refresh').bind('click', function() {
        var tree = jQuery.tree.focused();

        tree.refresh(tree.selected);
    });
});
//--></script>
