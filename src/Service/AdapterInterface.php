<?php

namespace PhoneVerificationBundle\Service;

interface AdapterInterface
{
	/**
	 * @param string $phoneNumber
	 * @return bool
	 */
	public function sendPIN(string $phoneNumber) :bool;

	/**
	 * @param string $phone
	 * @param string $code
	 * @param array  $parameters
	 * @return bool
	 */
    public function isValidPIN(string $phone, string $code, array $parameters = []) : bool;

	/**
	 * @return \PhoneVerificationBundle\Service\AdapterErrorInterface|null
	 */
	public function getLastError() :?AdapterErrorInterface;
}