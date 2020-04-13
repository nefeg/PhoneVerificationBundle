<?php

namespace Aimchat\PhoneVerificationBundle\Service\Adapter;


/**
 * Class PhoneVerifyAdapterErrorSending
 *
 * @package Aimchat\PhoneVerificationBundle\Service\Adapter
 */
class AdapterErrorSending extends AdapterError
{
	private const CODE      = 'ADAPTER_SENDING_ERROR';
	private const MESSAGE   = 'Code sending error.';

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