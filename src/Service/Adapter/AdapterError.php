<?php

namespace PhoneVerificationBundle\Service\Adapter;

use PhoneVerificationBundle\Service\AdapterErrorInterface;
use Throwable;

/**
 * Class PhoneVerifyAdapterError
 *
 * @package Umbrella\PhoneVerificationBundle\Service\Adapter
 */
abstract class AdapterError extends \Exception implements AdapterErrorInterface
{
	/**
	 * @return string
	 */
	abstract protected function getSelfMessage() :string;

	/**
	 * Construct the exception. Note: The message is NOT binary safe.
	 *
	 * @link  http://php.net/manual/en/exception.construct.php
	 * @param string    $message  [optional] The Exception message to throw.
	 * @param int       $code     [optional] The Exception code.
	 * @param Throwable $previous [optional] The previous throwable used for the exception chaining.
	 * @since 5.1.0
	 */
	public function __construct(string $message = '', int $code = 0, \Throwable $previous = NULL) {

		parent::__construct($this->getSelfMessage(). " ". $message, $code, $previous);
	}
}