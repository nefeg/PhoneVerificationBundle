<?php

namespace Umbrella\PhoneVerificationBundle\Service;

use Umbrella\PhoneVerificationBundle\UserPhoneInterface;
use Umbrella\PhoneVerificationBundle\VerificationServiceInterface;


/**
 * Class PhoneVerifyService
 *
 * @package Umbrella\PhoneVerificationBundle\Service
 */
class VerificationService implements VerificationServiceInterface
{
	/**
	 * @var \Umbrella\PhoneVerificationBundle\Service\AdapterInterface
	 */
	private $Adapter;

	/**
	 * @return \Umbrella\PhoneVerificationBundle\Service\AdapterInterface
	 */
	protected function getAdapter() :AdapterInterface{

		return $this->Adapter;
    }

	/**
	 * VerificationService constructor.
	 *
	 * @param \Umbrella\PhoneVerificationBundle\Service\AdapterInterface $Adapter
	 */
	public function __construct(AdapterInterface $Adapter)
	{
		$this->Adapter = $Adapter;
	}

	/**
	 * Send verification code to given phone.
	 * Return true if success and throw exception on fail.
	 *
	 * ## Parameters: ##
	 * `phone` - `string`, phone number
	 *
	 * ## Response: ##
	 * `true` - no errors<br>
	 * `throws Exception` -  on error
	 *
	 * ## Errors: ##
	 * Can contain errors<br>
	 * `ADAPTER_INVALID_NUMBER`     - Invalid phone number.<br>
	 * `ADAPTER_SENDING_ERROR`      - Code sending error.<br>
	 * `PROVIDER_SENDING_ERROR`     - Code sending error.<br>
	 * `ADAPTER_UNKNOWN_ERROR`      - Unknown error: %<br>
	 *
	 * `UnexpectedError` - if code was not be sent, but no errors returned
	 *
	 * @param string $phone
	 * @throws \Umbrella\PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \Umbrella\PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function sendCode(string $phone) :void
	{

		if(!$this->getAdapter()->sendPIN($phone)) {

			if ($Error = $this->Adapter->getLastError())
				throw $Error;

			else
				throw new UnexpectedError("Unexpected error");
		}
	}

	/**
	 *
	 * Verify given code.
	 *
	 * <br>**Device identifiers**<br>
	 *      `ios` : <a target="_blank" href="https://developer.apple.com/reference/uikit/uidevice/1620059-identifierforvendor">identifierForVendor</a>
	 *      `android` : imei?
	 *
	 * ## Parameters: ##
	 * `phone` - `string`, phone number<br>
	 * `code` - `string`, verification code<br>
	 *
	 * ## Response: ##
	 * `true` - no errors<br>
	 * `throws Exception` -  on error
	 *
	 * ## Errors: ##
	 * Can contain errors<br>
	 * `Device ID is required.` - no provided device id<br>
	 * `Verification code is required.` -  no provided Verification code<br>
	 * `ADAPTER_INVALID_NUMBER`     - Invalid phone number.<br>
	 * `ADAPTER_UNKNOWN_ERROR`      - Unknown error: %<br>
	 * `ADAPTER_VERIFICATION_ERROR` - Verification Error.<br>
	 * `PROVIDER_VERIFICATION_ERROR`- Verification Error.<br>
	 *
	 * @param string $phone
	 * @param string $code
	 * @return bool
	 * @throws \Umbrella\PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \Umbrella\PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function verifyCode(string $phone, string $code) :bool
	{

		if(!$this->getAdapter()->isValidPIN($phone, $code)) {

			if ($Error = $this->getAdapter()->getLastError())
				throw $Error;

			else
				throw new UnexpectedError("Unexpected error");
		}

		return true;
	}

	/**
	 *
	 * Verify given code and connect phone to given user.
	 *
	 * <br>**Device identifiers**<br>
	 *      `ios` : <a target="_blank" href="https://developer.apple.com/reference/uikit/uidevice/1620059-identifierforvendor">identifierForVendor</a>
	 *      `android` : imei?
	 *
	 * ## Parameters: ##
	 * `phone` - `string`, phone number<br>
	 * `device_id` - `string`, device identifier<br>
	 * `code` - `string`, verification code<br>
	 * `User` - `UserPhoneInterface`<br>
	 *
	 * ## Response: ##
	 * `true` - no errors<br>
	 * `throws Exception` -  on error
	 *
	 * ## Errors: ##
	 * Can contain errors<br>
	 * `Device ID is required.` - no provided device id<br>
	 * `Verification code is required.` -  no provided Verification code<br>
	 * `ADAPTER_INVALID_NUMBER`     - Invalid phone number.<br>
	 * `ADAPTER_UNKNOWN_ERROR`      - Unknown error: %<br>
	 * `ADAPTER_VERIFICATION_ERROR` - Verification Error.<br>
	 * `PROVIDER_VERIFICATION_ERROR`- Verification Error.<br>
	 *
	 * @param \Umbrella\PhoneVerificationBundle\UserPhoneInterface $User
	 * @param string                                          $phone
	 * @param string                                          $code
	 * @param string                                          $device
	 * @return bool
	 * @throws \Umbrella\PhoneVerificationBundle\Service\UnexpectedError
	 * @throws \Umbrella\PhoneVerificationBundle\VerificationErrorInterface
	 */
	public function verifyUser(UserPhoneInterface $User, string $phone, string $code, string $device) :bool
	{
		$this->verifyCode($phone, $code);

		$User->setPhone($phone)->setDevice($device);

		return true;
	}
}