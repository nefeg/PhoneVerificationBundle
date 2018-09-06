<?php
/**
 * Created by PhpStorm.
 * User: omni
 * Date: 21.06.17
 * Time: 18:51
 */

namespace Umbrella\PhoneVerificationBundle\Service\Adapter;


/**
 * Class ProviderErrorVerification
 *
 * @package Umbrella\PhoneVerificationBundle\Service\Adapter
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