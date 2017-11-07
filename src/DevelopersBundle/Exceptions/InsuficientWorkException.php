<?php
/**
 * Created by PhpStorm.
 * User: administrator
 * Date: 07.11.17
 * Time: 17:01
 */
namespace DevelopersBundle\Exceptions;

class InsuficientWorkException extends DeveloperException
{
    protected $message = 'Нечего делать!';
}