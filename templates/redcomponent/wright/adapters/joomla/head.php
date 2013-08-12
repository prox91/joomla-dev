<?php

class WrightAdapterJoomlaHead
{
	public function render($args)
	{
		$head = '';
		$dochtml = JFactory::getDocument();
		if ($dochtml->params->get('responsive',1)) {
		    // add viewport meta for tablets
		    $head = '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
		}
		$head .= '<jdoc:include type="head" />';
	    $head .= "\n";

	    $wr = Wright::getInstance();
	    $head .= $wr->generateCSS();

		return $head;
	}
}
