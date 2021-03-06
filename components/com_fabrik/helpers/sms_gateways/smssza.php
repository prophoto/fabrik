<?php
/**
 * Send an SMS via the SMSS (ZA) gateway
 *
 * @package     Joomla.Plugin
 * @subpackage  Fabrik.form.sms
 * @copyright   Copyright (C) 2005-2015 fabrikar.com - All rights reserved.
 * @license     GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * SMSS (ZA) SMS gateway class
 *
 * @package     Joomla.Plugin
 * @subpackage  Fabrik.form.sms
 * @since       3.0
 */

class Kapow extends JObject
{
	/**
	 * URL To Post SMS to
	 *
	 * @var string
	 */
	protected $url = 'http://148.251.196.36/app/smsapi/index.php?key=%s&type=text&contacts=%s&senderid=%s&msg=%s&time=';

	/**
	 * Send SMS
	 *
	 * @param   string  $message  sms message
	 * @param   array   $opts     Options
	 *
	 * @return  void
	 */

	public function process($message, $opts)
	{
		$username = FArrayHelper::getValue($opts, 'sms-username');
		$password = FArrayHelper::getValue($opts, 'sms-password');
		$smsfrom = FArrayHelper::getValue($opts, 'sms-from');
		$smsto = FArrayHelper::getValue($opts, 'sms-to');
		$smstos = explode(',', $smsto);

		foreach ($smstos as $smsto)
		{
			$url = sprintf($this->url, $username, $smsto, $smsfrom, $message);
			FabrikSMS::doRequest('GET', $url, '');
		}
	}
}
