<?php

namespace Aimchat\PhoneVerificationBundle\Service;

use Aimchat\PhoneVerificationBundle\VerificationErrorInterface;

class UnexpectedError extends \Exception implements VerificationErrorInterface
{

}