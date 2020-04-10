<?php

namespace PhoneVerificationBundle\Service\Adapter\Nexmo;


/**
 * Class NexmoError
 *
 * @package Jelly\UserBundle\Utils\Adapter\Nexmo
 */
class NexmoError
{
	/**
	 * @var int
	 */
	private $code;
	/**
	 * @var string
	 */
	private $message;

	/**
	 * NexmoError constructor.
	 *
	 * @param int    $code
	 * @param string $message
	 */
	public function __construct(int $code, string $message){

		$this->code     = $code;
		$this->message  = $message;
	}


	/**
	 * @return string
	 */
	public function __toString() :string{

		return $this->getCode() .':'.$this->getMessage();
	}

	/**
	 * @return int
	 */
	public function getCode() :int{

		return $this->code;
	}

	/**
	 * @return string
	 */
	public function getMessage() :string{

		return $this->message;
	}
}