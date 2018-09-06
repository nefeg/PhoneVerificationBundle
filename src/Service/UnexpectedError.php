<?php
/**
 * Created by PhpStorm.
 * User: omni
 * Date: 12.07.2018
 * Time: 22:20
 */

namespace Umbrella\PhoneVerificationBundle\Service;

use Umbrella\PhoneVerificationBundle\VerificationErrorInterface;

class UnexpectedError extends \Exception implements VerificationErrorInterface
{

}