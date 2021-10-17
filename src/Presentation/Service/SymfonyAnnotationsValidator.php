<?php

declare(strict_types=1);

namespace App\Presentation\Service;

use App\Presentation\Exception\InvalidDto;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SymfonyAnnotationsValidator implements ValidatesApiDto
{
    public function __construct(
        private ?ValidatorInterface $validator
    ) {
    }

    public function validate(object $dto): void
    {
        $violations = $this->validator()->validate($dto);

        if (!count($violations)) {
            return;
        }

        $errorMsg = 'Encountered errors processing input: ';

        /** @var ConstraintViolation $violation */
        foreach ($violations as $violation) {
            $errorMsg .= sprintf('%s: %s. ', $violation->getPropertyPath(), $violation->getMessage());
        }

        throw new InvalidDto($errorMsg);
    }

    private function validator(): ValidatorInterface
    {
        return $this->validator
            ?: $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    }
}
