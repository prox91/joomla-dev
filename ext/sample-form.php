<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.mootools'); JHTML::_('behavior.modal');

?>
<style>
    .contact-default{
        color: #8E8E8E;
    }

    .contact-normal{
        color: #353535 !important
    }
</style>
<div class="contact" id="seeprofile">
	<div class="contact-form">
		<div class="header"><?php echo JText::_('PROFILE_TITLE'); ?></div>
		<form action="" name=""
		      method="post" id="contactFormId">
            <div class="row company">
                <input type="text" name="companyName" id="companyId" class="contact-default" value="<?php echo JText::_("PROFILE_CONTACT_FORM_BUSSINESS"); ?>"
                       onblur="onblurAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_BUSSINESS"); ?>');"
                       onfocus="onfocusAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_BUSSINESS"); ?>');"/>
            </div>
            <div class="row contact-address">
                <input type="text" name="companyAddress" id="companyAddressId" class="contact-default" value="<?php echo JText::_("PROFILE_CONTACT_FORM_ADDRESS"); ?>"
                       onblur="onblurAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_ADDRESS"); ?>');"
                       onfocus="onfocusAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_ADDRESS"); ?>');"/>
            </div>
            <div class="row phone">
                <input type="text" name="phoneNumber" id="phoneId" class="contact-default" value="<?php echo JText::_("PROFILE_CONTACT_FORM_TELEPHONE"); ?>"
                       onblur="onblurAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_TELEPHONE"); ?>');"
                       onfocus="onfocusAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_TELEPHONE"); ?>');"/>
            </div>
            <div class="row email">
                <input type="text" name="emailContact" id="emailContactId" class="contact-default" value="<?php echo JText::_("PROFILE_CONTACT_FORM_EMAIL"); ?>"
                       onblur="onblurAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_EMAIL"); ?>');"
                       onfocus="onfocusAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_EMAIL"); ?>');"/>
            </div>
            <div class="row contact-person">
                <input type="text" name="contactPerson" id="contactId" class="contact-default" value="<?php echo JText::_("PROFILE_CONTACT_FORM_CONTACT_PERSON"); ?>"
                       onblur="onblurAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_CONTACT_PERSON"); ?>');"
                       onfocus="onfocusAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_CONTACT_PERSON"); ?>');"/>
            </div>
			<div class="row message">
				<textarea rows="5" cols="30" name="message" id="messageId" class="contact-default"
                          onblur="onblurAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_MESSAGE"); ?>');"
                          onfocus="onfocusAction(this, '<?php echo JText::_("PROFILE_CONTACT_FORM_MESSAGE"); ?>');"><?php echo JText::_("PROFILE_CONTACT_FORM_MESSAGE"); ?></textarea>
			</div>

			<div class="row send-button">
				<input type="button" name="sendMail" value="<?php echo JText::_("PROFILE_CONTACT_FORM_SEND_BUTTON"); ?>" onclick="validateForm();"/>
			</div>

		</form>
        <script type="text/javascript">

            function onblurAction(obj, value)
            {
                var attr = obj.getAttribute("class");
                if(obj.value=='' && attr == "contact-normal")
                {
                    obj.value = value;
                    obj.setAttribute("class", "contact-default");
                }
            }

            function onfocusAction(obj, value)
            {
                var attr = obj.getAttribute("class");
                if(obj.value==value && attr == "contact-default")
                {
                    obj.value='';
                    obj.setAttribute("class", "contact-normal");
                }
            }

            function validateForm()
            {
                var form = document.getElementById("contactFormId");
                var company = document.getElementById("companyId").value;
                var attr = document.getElementById("companyId").getAttribute("class");
                if(!validateEmpty(company, attr))
                {
                    alert('<?php echo JText::_("PROFILE_CONTACT_FORM_ALERT_COMPANY_EMPTY"); ?>');
                    return false;
                }

                var address = document.getElementById("companyAddressId").value;
                attr = document.getElementById("companyAddressId").getAttribute("class");
                if(!validateEmpty(address, attr))
                {
                    alert('<?php echo JText::_("PROFILE_CONTACT_FORM_ALERT_ADDRESS_EMPTY"); ?>');
                    return false;
                }

                var phone = document.getElementById("phoneId").value;
                attr = document.getElementById("phoneId").getAttribute("class");
                if(!validateEmpty(phone, attr))
                {
                    alert('<?php echo JText::_("PROFILE_CONTACT_FORM_ALERT_PHONE_EMPTY"); ?>');
                    return false;
                }

                var email = document.getElementById("emailContactId").value;
                attr = document.getElementById("emailContactId").getAttribute("class");
                if(!validateEmpty(email, attr))
                {
                    alert('<?php echo JText::_("PROFILE_CONTACT_FORM_ALERT_EMAIL_EMPTY"); ?>');
                    return false;
                }
                if(!validateEmail(email))
                {
                    alert('<?php echo JText::_("PROFILE_CONTACT_FORM_ALERT_EMAIL_ERROR_FORMAT"); ?>');
                    return false;
                }

                var contactPerson = document.getElementById("contactId").value;
                attr = document.getElementById("contactId").getAttribute("class");
                if(!validateEmpty(contactPerson, attr))
                {
                    alert('<?php echo JText::_("PROFILE_CONTACT_FORM_ALERT_CONTACT_PERSON_EMPTY"); ?>');
                    return false;
                }

                var message = document.getElementById("messageId").value;
                attr = document.getElementById("messageId").getAttribute("class");
                if(!validateEmpty(message, attr))
                {
                    alert('<?php echo JText::_("PROFILE_CONTACT_FORM_ALERT_MESSAGE_EMPTY"); ?>');
                    return false;
                }

                form.submit();
            }

            function validateEmpty(value, attr)
            {
                if(value == "" || attr == 'contact-default')
                {
                    return false;
                }
                return true;
            }

            function validateEmail(email)
            {
                var re = /\S+@\S+\.\S+/;
                return re.test(email);
            }
        </script>
	</div>
</div>
