<?php
/**
 * Created by PhpStorm.
 * User: omni
 * Date: 21.06.17
 * Time: 18:47
 */

namespace Umbrella\PhoneVerificationBundle\Service\Adapter;


/**
 * Class PhoneVerifyProviderErrorSending
 *
 * @package Umbrella\PhoneVerificationBundle\Service\Adapter
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