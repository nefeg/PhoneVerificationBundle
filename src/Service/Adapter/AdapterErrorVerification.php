<?php

namespace Aimchat\PhoneVerificationBundle\Service\Adapter;


/**
 * Class PhoneVerifyAdapterErrorVerification
 *
 * @package Aimchat\PhoneVerificationBundle\Service\Adapter
 */
class AdapterErrorVerification extends AdapterError
{
	private const CODE      = 'ADAPTER_VERIFICATION_ERROR';
	private const MESSAGE   = 'Verification Error.';

	/**
	 * @return string
	 */
	protected function getSelfMessage(): string {
		return self::MESSAGE;
	}

	/**
	 * @return string
	 */
	public function getCodeString() :string {
		return self::CODE;
	}
}