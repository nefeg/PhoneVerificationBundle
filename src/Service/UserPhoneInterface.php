<?php
/**
 * Created by PhpStorm.
 * User: omni
 * Date: 12.07.2018
 * Time: 21:52
 */

namespace Umbrella\PhoneVerificationBundle;


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
	 * @return \Umbrella\PhoneVerificationBundle\UserPhoneInterface
	 */
	public function setDevice(string $device) :UserPhoneInterface;

	/**
	 * @return null|string
	 */
	public function getPhone(): ?string;

	/**
	 * @param string $phone
	 * @return \Umbrella\PhoneVerificationBundle\UserPhoneInterface
	 */
	public function setPhone(string $phone) :UserPhoneInterface;
}