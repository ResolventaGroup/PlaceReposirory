<?php

namespace App\Module\PlaceRepository\Validator;

use App\Module\PlaceRepository\PlaceRepositoryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class PlaceIsExistsValidator extends ConstraintValidator
{
    private PlaceRepositoryInterface $placeRepository;

    public function __construct(PlaceRepositoryInterface $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    /**
     * @inheritdoc
     */
    public function validate($placeLocation, Constraint $constraint): void
    {
        self::assertConstraintInstanceOf($constraint, PlaceIsExists::class);

        if (!$placeLocation) {
            return;
        }

        if ($this->placeRepository->findByAddress($placeLocation)) {
            return;
        }

        $this->context->addViolation($constraint->message, ['{name}' => $placeLocation]);
    }

    private static function assertConstraintInstanceOf(Constraint $constraint, string $constraintType): void
    {
        if (!$constraint instanceof $constraintType) {
            throw new \InvalidArgumentException(sprintf('Constraint must be instance of %s', $constraintType));
        }
    }
}
