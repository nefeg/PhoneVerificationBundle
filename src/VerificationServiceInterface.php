<?php

namespace Aimchat\PhoneVerificationBundle;

/**
 * Interface VerificationServiceInterface
 *
 * @package Aimchat\PhoneVerificationBundle
 */
interface VerificationServiceInterface
{

	/**
	 * @param string $phone
	 * @throws \Aimchat\PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \Aimchat\PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function sendCode(string $phone) :void;

	/**
	 * @param string $phone
	 * @param string $code
	 * @return bool
	 * @throws \Aimchat\PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \Aimchat\PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function verifyCode(string $phone, string $code) :bool;

	/**
	 * @param \Aimchat\PhoneVerificationBundle\UserPhoneInterface $User
	 * @param string                                          $phone
	 * @param string                                          $code
	 * @param string                                          $device
	 * @return bool
	 * @throws \Aimchat\PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \Aimchat\PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function verifyUser(UserPhoneInterface $User, string $phone, string $code, string $device) :bool;
}