<?php

namespace Tests\Helpers;

use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

final class ViolationBuilderMock implements ConstraintViolationBuilderInterface
{
    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function atPath($path): static
    {
        return $this;
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function setParameter($key, $value): static
    {
        return $this;
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function setParameters(array $parameters): static
    {
        return $this;
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function setTranslationDomain($translationDomain): static
    {
        return $this;
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function setInvalidValue($invalidValue): static
    {
        return $this;
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function setPlural($number): static
    {
        return $this;
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function setCode($code): static
    {
        return $this;
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function setCause($cause): static
    {
        return $this;
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function addViolation()
    {
        // TODO: Implement addViolation() method.
    }
}
