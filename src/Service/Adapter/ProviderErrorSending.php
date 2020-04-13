<?php

namespace Aimchat\PhoneVerificationBundle\Service\Adapter;


/**
 * Class PhoneVerifyProviderErrorSending
 *
 * @package Aimchat\PhoneVerificationBundle\Service\Adapter
 */
class ProviderErrorSending extends AdapterErrorSending
{
	private const CODE      = 'PROVIDER_SENDING_ERROR';

	/**
	 * @return string
	 */
	public function getCodeString() :string {
		return self::CODE;
	}
}