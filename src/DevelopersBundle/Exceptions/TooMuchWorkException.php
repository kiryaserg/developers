<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07.11.17
 * Time: 17:38
 */

namespace DevelopersBundle\Exceptions;

class TooMuchWorkException extends DeveloperException
{
    protected $message = 'Слишком много работы!';
}