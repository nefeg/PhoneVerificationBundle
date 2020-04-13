<?php

namespace Aimchat\PhoneVerificationBundle\Service\Adapter\Nexmo;


/**
 * Class NexmoResponse
 *
 * @package Jelly\UserBundle\Utils\Adapter\Nexmo
 */
abstract class NexmoResponse
{
	const STATUS_CODE_OK                        = 0; // The message was successfully accepted for delivery by Nexmo.
	const STATUS_CODE_THROTTLED                 = 1; // You are trying to send more than the maximum of 30 requests-per-second.
	const STATUS_CODE_PARAMS_MISS               = 2; // Your request is incomplete and missing some mandatory parameters.
	const STATUS_CODE_PARAMS_INVALID            = 3; // Invalid value for parameter. If you see Facility not allowed in the error text, check that you are using the correct Base URL in your request.
	const STATUS_CODE_INVALID_CREDENTIALS       = 4; // The api_key or api_secret you supplied in the request is either invalid or disabled.
	const STATUS_CODE_INTERNAL_ERROR            = 5; // An error occurred processing this request in the Cloud Communications Platform.
	const STATUS_CODE_NO_ROUTE                  = 6; // The Nexmo platform was unable to process this message for the following reason: $reason
	const STATUS_CODE_NUMBER_BANNED             = 7; // The number you are trying to verify is blacklisted for verification
	const STATUS_CODE_API_KEY_BARRED            = 8; // The api_key you supplied is for an account that has been barred from submitting messages.
	const STATUS_CODE_PARTNER_QUOTA             = 9; // Your account does not have sufficient credit to process this request.
	const STATUS_CODE_CONCURRENT_VERIFICATION   = 10;// Concurrent verifications to the same number are not allowed
	const STATUS_CODE_NETWORK_NOT_SUPPORT       = 15;// The destination number is not in a supported network
	const STATUS_CODE_INVALID_CODE              = 16;// The code inserted does not match the expected value
	const STATUS_CODE_INVALID_CODE_LIMIT        = 17;// You can run Verify Check on a Verify request_id up to three times unless a new PIN code is generated. If you check a request more than 3 times, it is set to FAILED and you cannot check it again.
	const STATUS_CODE_REQUEST_LIMIT             = 18;// You added more than the maximum of 10 request_ids to your request.
	const STATUS_CODE_NO_EXECUTE                = 19;// No more events are left to execute for the request
	const STATUS_CODE_NO_RESPONSE               = 101;// There are no matching Verify request.

	/**
	 * @return null|string
	 */
	abstract public function getId() :?string;

	/**
	 * @return int
	 */
	abstract public function getStatusCode() :int;

	/**
	 * @return \Aimchat\PhoneVerificationBundle\Service\Adapter\Nexmo\NexmoError|null
	 */
	abstract public function getError() :?NexmoError;
}