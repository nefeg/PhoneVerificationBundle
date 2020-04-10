<?php

namespace PhoneVerificationBundle\Service\Adapter;


/**
 * Class PhoneVerifyAdapterErrorNumber
 *
 * @package Umbrella\PhoneVerificationBundle\Service\Adapter
 */
class AdapterErrorNumber extends AdapterError
{
	private const CODE      = 'ADAPTER_INVALID_NUMBER';
	private const MESSAGE   = 'Invalid phone number.';

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