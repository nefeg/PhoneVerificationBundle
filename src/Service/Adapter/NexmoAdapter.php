<?php

namespace Aimchat\PhoneVerificationBundle\Service\Adapter;

use Aimchat\PhoneVerificationBundle\Service\AdapterInterface;
use Aimchat\PhoneVerificationBundle\Service\AdapterErrorInterface;
use GuzzleHttp\Client;
use Aimchat\PhoneVerificationBundle\Service\Adapter\Nexmo\NexmoResponseJSON;
use Predis\Pipeline\Pipeline;

/**
 * Class NexmoAdapter
 *
 * @error PhoneVerifyAdapterErrorNumber
 * @error PhoneVerifyAdapterErrorSending
 * @error PhoneVerifyAdapterErrorVerification
 * @error PhoneVerifyAdapterErrorUnknown
 *
 * @package Jelly\UserBundle\Utils\Adapter
 */
class NexmoAdapter implements AdapterInterface {

    const REDIS_REQUEST_ID_TEMPLATE     = 'nexmo:user:%s:request_id';
    const REDIS_PHONE_NUMBER_TEMPLATE   = 'nexmo:user:%s:phone';
    const REDIS_DEVICE_IDENTIFIER       = 'nexmo:user:%s:device_identifier';
    const VERIFICATION_CODE_TTL         = 11 * 60;

	/**
	 * @var \GuzzleHttp\Client
	 */
	private $http;
	/**
	 * @var string|null
	 */
    private $apiKey;
	/**
	 * @var string|null
	 */
    private $apiSecret;
	/**
	 * @var string|null
	 */
    private $brand;

	/**
	 * @var \Predis\Client
	 */
    private $Redis;

	/**
	 * @var \Aimchat\PhoneVerificationBundle\Service\AdapterErrorInterface|null
	 */
    private $LastError;

	/**
	 * NexmoAdapter constructor.
	 *
	 * @param array          $params
	 * @param \Predis\Client $Redis
	 * @throws \Exception
	 */
	public function __construct(array $params, \Predis\Client $Redis)
	{
		$this->http = new Client([
			'base_uri' => 'https://api.nexmo.com'
		]);

		$this->apiKey       = $params['api_key'] ?? null;
		$this->apiSecret    = $params['api_secret'] ?? null;
		$this->brand        = $params['brand'] ?? 'JellyChip';

		if(!($this->apiKey and $this->apiSecret))
			throw new \Exception('Nexmo Adapter: \'api_key\' and \'api_secret\' is required.');

		$this->Redis = $Redis;
	}

	/**
	 * @param string $phone
	 * @return string
	 */
	static private function _getPhoneKey(string $phone) {
        return sprintf(self::REDIS_PHONE_NUMBER_TEMPLATE, $phone);
    }

	/**
	 * @param string $requestId
	 * @return string
	 */
	static private function _getRequestKey(string $requestId) {
        return sprintf(self::REDIS_REQUEST_ID_TEMPLATE, $requestId);
    }

	/**
	 * @param string $requestId
	 * @param string $phone
	 */
	protected function setPhoneRequest(string $requestId, string $phone) :void{

		$this->Redis->pipeline(function ($pipe) use ($requestId, $phone) {

			/** @var Pipeline $pipe */
			$pipe->setex(self::_getPhoneKey($phone), self::VERIFICATION_CODE_TTL, $requestId);
			$pipe->setex(self::_getRequestKey($requestId), self::VERIFICATION_CODE_TTL, $phone);
		});
    }

	/**
	 * @param string $requestId
	 * @param string $phone
	 */
	protected function unsetPhoneRequest(string $requestId, string $phone) :void{

		$this->Redis->del([self::_getPhoneKey($phone), self::_getRequestKey($requestId)]);
	}

	/**
	 * @param string $requestId
	 * @return null|string
	 */
	protected function getPhoneByRequest(string $requestId): ?string {

		return $this->Redis->get(self::_getRequestKey($requestId));
	}

	/**
	 * @param string $phone
	 * @return null|string
	 */
	protected function getRequestByPhone(string $phone): ?string {

		return $this->Redis->get(self::_getPhoneKey($phone));
	}

	/**
	 * @param string $phone
	 * @return bool
	 */
	protected function isValidNumber(string $phone) :bool{

		return $phone && is_numeric($phone);
	}

	/**
	 * @param string $phone
	 * @param int    $codeLength
	 * @return mixed|string
	 */
    public function sendPIN(string $phone, int $codeLength = 4) :bool
    {
    	try{
		    // invalid number
		    if (!$this->isValidNumber($phone))
			    $this->setError(new AdapterErrorNumber());

		    // already sent (check from storage)
		    elseif ($this->getRequestByPhone($phone)){
			    $errorMessage = sprintf("Re-sending request is available in %s seconds", $this->Redis->ttl(self::_getPhoneKey($phone)));
			    $this->setError(new AdapterErrorSending($errorMessage));

		    }else{ // ok, try to send code

			    $httpResponse = (string) $this->http->request('GET', '/verify/json', [
				    'query' => [
					    'api_key'       => $this->apiKey,
					    'api_secret'    => $this->apiSecret,
					    'number'        => $phone,
					    'brand'         => $this->brand,
					    'pin_expiry'    => self::VERIFICATION_CODE_TTL,
					    'code_length'   => $codeLength
				    ]
			    ])->getBody();

			    $NexmoResponse = new NexmoResponseJSON($httpResponse);

			    if (!$NexmoResponse->getError()){
				    // save request-id into storage
				    $this->setPhoneRequest($NexmoResponse->getId(), $phone);
				    return true;
			    }

			    // nexmo error
			    $this->setError(new ProviderErrorSending($NexmoResponse->getError()));
	        }

	    }catch (\Throwable $Exception){

		    $this->setError(new AdapterErrorUnknown($Exception->getMessage()));
	    }

        return false;
    }

	/**
	 * @param string $phone
	 * @param string $code
	 * @param array  $params
	 * @return bool|mixed|\Psr\Http\Message\ResponseInterface
	 * @throws \Exception
	 */
    public function isValidPIN(string $phone, string $code, array $params = []) : bool
    {
    	try{
		    // invalid number
		    if (!$this->isValidNumber($phone))
			    $this->setError(new AdapterErrorNumber());

		    // get request-id by phone from storage and try to validate them via Nexmo
	        elseif($requestId = $this->getRequestByPhone($phone)){

		        $httpResponse = (string) $this->http->request('GET', '/verify/check/json', [
			        'query' => [
				        'api_key'       => $this->apiKey,
				        'api_secret'    => $this->apiSecret,
				        'request_id'    => $requestId,
				        'code'          => $code,
			        ]
		        ])->getBody();

		        $NexmoResponse = new NexmoResponseJSON($httpResponse);

		        // OK
		        if (!$NexmoResponse->getError()){
			        $this->unsetPhoneRequest($requestId, $phone);
					return true;
		        }

		        // nexmo verification error
		        $this->setError(new ProviderErrorVerification($NexmoResponse->getError()));

	        }else // request-id for given phone number is not found in storage
	            $this->setError(new AdapterErrorVerification('Verification code is not valid or expired.'));


        }catch (\Throwable $Exception){

		    $this->setError(new AdapterErrorUnknown($Exception->getMessage()));
	    }

        return false;
    }



	/**
	 * @param \Aimchat\PhoneVerificationBundle\Service\Adapter\AdapterError $Error
	 * @return \Aimchat\PhoneVerificationBundle\Service\Adapter\NexmoAdapter
	 */
	private function setError(AdapterError $Error) :NexmoAdapter{

		$this->LastError = $Error;

		return $this;
	}

	/**
	 * @return \Aimchat\PhoneVerificationBundle\Service\AdapterErrorInterface|null
	 */
	public function getLastError(): ?AdapterErrorInterface {
		return $this->LastError;
	}
}