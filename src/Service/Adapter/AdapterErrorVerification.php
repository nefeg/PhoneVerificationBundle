<?php
/**
 * Created by PhpStorm.
 * User: omni
 * Date: 20.06.17
 * Time: 18:39
 */

namespace Umbrella\PhoneVerificationBundle\Service\Adapter;


/**
 * Class PhoneVerifyAdapterErrorVerification
 *
 * @package Umbrella\PhoneVerificationBundle\Service\Adapter
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