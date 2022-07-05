<?php

namespace Resolventa\PlaceRepository\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
final class PlaceIsExists extends Constraint
{
    public string $message = 'The place with name "{name}" can\'t be found.';
}
