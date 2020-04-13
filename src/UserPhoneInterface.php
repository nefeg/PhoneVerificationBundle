<?php

namespace Aimchat\PhoneVerificationBundle;


/**
 * Interface UserPhoneInterface
 *
 * @package Aimchat\PhoneVerificationBundle
 */
interface UserPhoneInterface
{
	/**
	 * @return null|string
	 */
	public function getDevice(): ?string;

	/**
	 * @param string $device
	 * @return \Aimchat\PhoneVerificationBundle\UserPhoneInterface
	 */
	public function setDevice(string $device) :UserPhoneInterface;

	/**
	 * @return null|string
	 */
	public function getPhone(): ?string;

	/**
	 * @param string $phone
	 * @return \Aimchat\PhoneVerificationBundle\UserPhoneInterface
	 */
	public function setPhone(string $phone) :UserPhoneInterface;
}