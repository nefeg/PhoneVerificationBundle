<?php

namespace PhoneVerificationBundle\Service;

use PhoneVerificationBundle\VerificationErrorInterface;

class UnexpectedError extends \Exception implements VerificationErrorInterface
{

}