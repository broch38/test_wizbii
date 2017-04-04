<?php
namespace Wizbii\ApiBundle\Validator;

use Symfony\Component\Validator\Context\ExecutionContextInterface;


class Validator
{
    public static function validateEc($object,ExecutionContextInterface $context, $payload){
        if($object->getT() == "event"){
            if(empty($object->getEc())){
                $context->buildViolation('the value must not be empty')
                    ->atPath('ec')
                    ->addViolation();
            }
        }
    }

    public static function validateEa($object,ExecutionContextInterface $context, $payload){
        if($object->getT() == "event"){
            if(empty($object->getEa())){
                $context->buildViolation('the value must not be empty')
                    ->atPath('ea')
                    ->addViolation();
            }
        }
    }

    public static function validateSn($object,ExecutionContextInterface $context, $payload){
        if($object->getT() == "screenview" && $object->getDs() == "apps"){
            if(empty($object->getSn())){
                $context->buildViolation('the value must not be empty')
                    ->atPath('sn')
                    ->addViolation();
            }
        }
    }

    public static function validateAn($object,ExecutionContextInterface $context, $payload){
        if($object->getDs() == "apps"){
            if(empty($object->getAn())){
                $context->buildViolation('the value must not be empty')
                    ->atPath('an')
                    ->addViolation();
            }
        }
    }

    public static function validateWui($object,ExecutionContextInterface $context, $payload){
        $users = array("emeric-wasson","philippe-brochier");
        if(!in_array($object->getWui(), $users)){
            $context->buildViolation("user {{ value }} does not exist")
                ->atPath('wui')
                ->setParameter('{{ value }}', $object->getWui())
                ->addViolation();
        }
    }
}