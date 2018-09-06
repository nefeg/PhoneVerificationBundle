<?php
/**
 * Created by PhpStorm.
 * User: omni
 * Date: 20.06.17
 * Time: 15:09
 */

namespace Umbrella\PhoneVerificationBundle\Service\Adapter\Nexmo;


/**
 * Class NexmoResponseJSON
 *
 * @package Jelly\UserBundle\Utils\Adapter\Nexmo
 */
class NexmoResponseJSON extends NexmoResponse
{
	/**
	 * The unique ID of the Verify request you sent.
	 * The value of request_id is up to 32 characters long.
	 * You use this request_id for the Verify Check.
	 *
	 * @var string
	 */
	private $request_id;

	/**
	 * @see https://docs.nexmo.com/verify/api-reference/api-reference#rresponse
	 * @var int
	 */
	private $status;

	/**
	 * @var string|null
	 */
	private $error_text;

	/**
	 * @var \Umbrella\PhoneVerificationBundle\Service\Adapter\Nexmo\NexmoError
	 */
	private $Error;

	/**
	 * NexmoResponseJSON constructor.
	 *
	 * @param string $response
	 */
	public function __construct(string $response){

		$response = json_decode($response, true);

		$this->request_id       = isset($response['request_id']) ? $response['request_id'] : null;
		$this->status           = (int) $response['status'];

		if ($this->getStatusCode() != NexmoResponse::STATUS_CODE_OK){
			$this->error_text   = $response['error_text'];
			$this->Error        = new NexmoError($this->getStatusCode(), $this->error_text);
		}
	}

	/**
	 * @return null|string
	 */
	public function getId() :?string{

		return $this->request_id;
	}

	/**
	 * @return int
	 */
	public function getStatusCode() :int{

		return $this->status;
	}

	/**
	 * @return \Umbrella\PhoneVerificationBundle\Service\Adapter\Nexmo\NexmoError|null
	 */
	public function getError() :?NexmoError{

		return $this->Error;
	}
}