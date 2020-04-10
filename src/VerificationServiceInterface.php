<?php

namespace PhoneVerificationBundle;

/**
 * Interface VerificationServiceInterface
 *
 * @package Umbrella\PhoneVerificationBundle
 */
interface VerificationServiceInterface
{

	/**
	 * @param string $phone
	 * @throws \PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function sendCode(string $phone) :void;

	/**
	 * @param string $phone
	 * @param string $code
	 * @return bool
	 * @throws \PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function verifyCode(string $phone, string $code) :bool;

	/**
	 * @param \PhoneVerificationBundle\UserPhoneInterface $User
	 * @param string                                          $phone
	 * @param string                                          $code
	 * @param string                                          $device
	 * @return bool
	 * @throws \PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function verifyUser(UserPhoneInterface $User, string $phone, string $code, string $device) :bool;
}