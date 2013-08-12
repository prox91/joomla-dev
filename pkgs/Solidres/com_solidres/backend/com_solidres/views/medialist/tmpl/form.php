<?php 
/*------------------------------------------------------------------------
  Solidres - Hotel booking extension for Joomla
  ------------------------------------------------------------------------
  @Author    Solidres Team
  @Website   http://www.solidres.com
  @Copyright Copyright (C) 2013 Solidres. All Rights Reserved.
  @License   GNU General Public License version 3, or later
------------------------------------------------------------------------*/
	
defined('_JEXEC') or die;

SRHtml::_('jquery.upload');

$comMediaUploadMaxFileSize = $this->comMediaParams->get('upload_maxsize', 10);

?>

<div id="uploader">You browser doesn't have Flash installed.</div>

<script type="text/javascript">
	Solidres.jQuery(function($) {
		$("#uploader").pluploadQueue({
			runtimes : 'html5,flash',
			url : '<?php echo JURI::root() ?>administrator/index.php?option=com_solidres&task=media.upload&format=json',
			max_file_size : '<?php echo $comMediaUploadMaxFileSize ?>mb',
			unique_names : false,
			filters : [
				{title : "Image files", extensions : "<?php echo $this->comMediaParams->get('upload_extensions', 'jpg,png,gif')?>"}
			],
			flash_swf_url : '<?php echo SRURI_MEDIA ?>/assets/js/plupload/plupload.flash.swf',
			multipart_params : {
				"<?php echo JSession::getFormToken();?>" : "1"
			},
			init: SolidresMediaUploaderCallBacks
		});

		function SolidresMediaUploaderCallBacks( uploader )
		{
			uploader.bind( 'Error', function( up, args ) {
			} );

			uploader.bind( 'FileUploaded', function( up, file, response ) {
				var res = response.response;
				if ( res ) {
					var objResponse = jQuery.parseJSON( res );
					if ( typeof objResponse.error != 'undefined')
					{
						up.trigger( 'Error', {
							code:    -300,
							message: 'Upload Failed',
							details: file.name + ' failed',
							file:    file
						} );
						return false;
					}
					else
					{
						// Do stuff on success
					}
				}
			} );
		}
	});
</script>
