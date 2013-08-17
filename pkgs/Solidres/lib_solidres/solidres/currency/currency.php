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

/**
 * Currency handler class
 *
 * @since 0.3.0
 */
class SRCurrency
{
	protected $id = 0;

	protected $activeId;

	protected $code;

	protected $sign;

	protected $name;

	protected $rate;

	protected $value = 0;

	protected $formatOptions = array();

	/**
	 * Currency Constructor
	 *
	 * @param $value
	 * @param $id
	 * @param int $scopeId 0 is Global
	 */
	public function __construct($value = 0, $id = 0, $scopeId = 0)
	{
		if ($value > 0)
		{
			$this->value = $value;
		}

		if ($id > 0)
		{
			$this->id = $id;
		}

		// Query for global currency display format
		if ($scopeId == 0)
		{
			$params = JComponentHelper::getParams('com_solidres');
			$this->formatOptions['currency_format_pattern'] = $params->get('currency_format_pattern', 1);
			$this->formatOptions['number_decimal_points'] = $params->get('number_decimal_points', 2);
		}
		else // Query for reservation asset currency display format
		{

		}

		$this->activeId = JFactory::getApplication()->getUserState('current_currency_id', 0);

		$this->getCurrencyDetails();

		// Exchange the value
		if ($this->activeId > 0 && $this->activeId != $this->id)
		{
			$fromExchangeRate = $this->rate;
			$this->id = $this->activeId;
			$this->getCurrencyDetails();
			$toExchangeRate = $this->rate;
			$this->value *= $fromExchangeRate / $toExchangeRate;
			$this->value = round($this->value, $this->formatOptions['number_decimal_points']);
		}
	}

	/**
	 * Format the given number
	 *
	 * @return string
	 */
	public function format()
	{
		switch ($this->formatOptions['currency_format_pattern'])
		{
			case 1:  // X0,000.00
			default:
				$formatted = $this->code . number_format($this->value, $this->formatOptions['number_decimal_points'] );
				break;
			case 2: // 0 000,00X
				$formatted = number_format($this->value, $this->formatOptions['number_decimal_points'], ',', ' ' ) . $this->code;
				break;
			case 3: // X0.000,00
				$formatted = $this->code . number_format($this->value, $this->formatOptions['number_decimal_points'], ',', '.' );
				break;
			case 4: // 0,000.00X
				$formatted = number_format($this->value, $this->formatOptions['number_decimal_points'], '.', ',' ) . $this->code;
				break;
			case 5: // 0 000.00X
				$formatted = number_format($this->value, $this->formatOptions['number_decimal_points'], '.', ' ' ) . $this->code;
				break;
		}

		return $formatted;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setCode($code)
	{
		$this->code = $code;
	}

	public function getCode()
	{
		return $this->code;
	}

	public function setActiveId($activeId)
	{
		$this->activeId = $activeId;
	}

	public function getActiveId()
	{
		return $this->activeId;
	}

	public function setRate($rate)
	{
		$this->rate = $rate;
	}

	public function getRate()
	{
		return $this->rate;
	}

	public function setSign($sign)
	{
		$this->sign = $sign;
	}

	public function getSign()
	{
		return $this->sign;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setFormatOptions($formatOptions)
	{
		$this->formatOptions = $formatOptions;
	}

	public function getFormatOptions()
	{
		return $this->formatOptions;
	}

	/**
	 * Query for currency details
	 *
	 * @return Object
	 */
	public function getCurrencyDetails()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query->select('*')
			->from($db->quoteName('#__sr_currencies'))
			->where($db->quoteName('id') . ' = ' . $this->id);

		$details = $db->setQuery($query)->loadObject();

		$this->id = $details->id;
		$this->code = $details->currency_code;
		$this->sign = $details->sign;
		$this->name = $details->currency_name;
		$this->rate = $details->exchange_rate;
	}
}