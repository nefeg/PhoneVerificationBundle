<?php

namespace Aimchat\PhoneVerificationBundle\Service\Adapter;


/**
 * Class ProviderErrorVerification
 *
 * @package Aimchat\PhoneVerificationBundle\Service\Adapter
 */
class ProviderErrorVerification extends AdapterErrorVerification
{
	private const CODE      = 'PROVIDER_VERIFICATION_ERROR';

	/**
	 * @return string
	 */
	public function getCodeString() :string {
		return self::CODE;
	}
}