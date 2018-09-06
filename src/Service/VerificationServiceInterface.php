<?php
/**
 * Created by PhpStorm.
 * User: omni
 * Date: 02.07.2018
 * Time: 19:22
 */

namespace Umbrella\PhoneVerificationBundle;

/**
 * Interface VerificationServiceInterface
 *
 * @package Umbrella\PhoneVerificationBundle
 */
interface VerificationServiceInterface
{

	/**
	 * @param string $phone
	 * @throws \Umbrella\PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \Umbrella\PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function sendCode(string $phone) :void;

	/**
	 * @param string $phone
	 * @param string $code
	 * @return bool
	 * @throws \Umbrella\PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \Umbrella\PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function verifyCode(string $phone, string $code) :bool;

	/**
	 * @param \Umbrella\PhoneVerificationBundle\UserPhoneInterface $User
	 * @param string                                          $phone
	 * @param string                                          $code
	 * @param string                                          $device
	 * @return bool
	 * @throws \Umbrella\PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \Umbrella\PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function verifyUser(UserPhoneInterface $User, string $phone, string $code, string $device) :bool;
}