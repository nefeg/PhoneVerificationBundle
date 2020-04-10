<?php

namespace PhoneVerificationBundle;


/**
 * Interface UserPhoneInterface
 *
 * @package Umbrella\PhoneVerificationBundle
 */
interface UserPhoneInterface
{
	/**
	 * @return null|string
	 */
	public function getDevice(): ?string;

	/**
	 * @param string $device
	 * @return \PhoneVerificationBundle\UserPhoneInterface
	 */
	public function setDevice(string $device) :UserPhoneInterface;

	/**
	 * @return null|string
	 */
	public function getPhone(): ?string;

	/**
	 * @param string $phone
	 * @return \PhoneVerificationBundle\UserPhoneInterface
	 */
	public function setPhone(string $phone) :UserPhoneInterface;
}