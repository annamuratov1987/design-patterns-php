<?php
interface ValidatorInterface
{
    public function setNextValidator(ValidatorInterface $validator): ValidatorInterface;
    public function validate(string $str): bool;
}

abstract class Validator implements ValidatorInterface
{
    private ?ValidatorInterface $nextValidator = null;

    public function setNextValidator(ValidatorInterface $validator): ValidatorInterface
    {
        $this->nextValidator = $validator;

        return $validator;
    }

    public function validate(string $str): bool
    {
        if (!is_null($this->nextValidator)){
            return $this->nextValidator->validate($str);
        }

        return true;
    }
}

class LengthValidator extends Validator
{
    public function validate(string $str): bool
    {
        if (strlen($str) < 8){
            return false;
        }

        return parent::validate($str);
    }
}

class UppercaseCharacterContainsValidator extends Validator
{
    public function validate(string $str): bool
    {
        if (preg_match("#[A-Z]#", $str) == 0){
            return false;
        }

        return parent::validate($str);
    }
}

class LovercaseCharacterContainsValidator extends Validator
{
    public function validate(string $str): bool
    {
        if (preg_match("#[a-z]#", $str) == 0){
            return false;
        }

        return parent::validate($str);
    }
}

class NumberCharacterContainsValidator extends Validator
{
    public function validate(string $str): bool
    {
        if (preg_match("#[0-9]#", $str) == 0){
            return false;
        }

        return parent::validate($str);
    }
}

class SpecialCharacterContainsValidator extends Validator
{
    public function validate(string $str): bool
    {
        if (preg_match("#[\#@\$&]#", $str) == 0){
            return false;
        }

        return parent::validate($str);
    }
}

function validatePassword(string $password): bool
{
    $validator = new LengthValidator();
    $lovercaseValidator = new LovercaseCharacterContainsValidator();
    $uppercaseValidator = new UppercaseCharacterContainsValidator();
    $numberValidator = new NumberCharacterContainsValidator();
    $specialValidator = new SpecialCharacterContainsValidator();

    $validator->setNextValidator($lovercaseValidator)
        ->setNextValidator($uppercaseValidator)
        ->setNextValidator($numberValidator)
        ->setNextValidator($specialValidator);

    return $validator->validate($password);
}

$password = "As54dFDSd5#";

if (validatePassword($password) === true){
    echo "Password verified successfully.\n";
}else{
    echo "The password must contain at least one uppercase and lowercase letter, a number, a special character, and must be at least 8 characters long.\n";
}