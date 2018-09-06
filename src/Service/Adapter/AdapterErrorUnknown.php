<?php
/**
 * Created by PhpStorm.
 * User: omni
 * Date: 20.06.17
 * Time: 21:23
 */

namespace Umbrella\PhoneVerificationBundle\Service\Adapter;


/**
 * Class PhoneVerifyAdapterErrorUnknown
 *
 * @package Umbrella\PhoneVerificationBundle\Service\Adapter
 */
class AdapterErrorUnknown extends AdapterError
{
	private const CODE      = 'ADAPTER_UNKNOWN_ERROR';
	private const MESSAGE   = 'Unknown error: %';

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