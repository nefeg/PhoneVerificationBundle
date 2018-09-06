<?php
/**
 * Created by PhpStorm.
 * User: omni
 * Date: 03.07.2018
 * Time: 1:31
 */

namespace Umbrella\PhoneVerificationBundle\Service;

use Umbrella\PhoneVerificationBundle\VerificationErrorInterface;

class VerificationError extends \Exception implements VerificationErrorInterface
{

}