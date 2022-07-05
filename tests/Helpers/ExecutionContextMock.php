<?php

namespace Tests\Helpers;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\MetadataInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

final class ExecutionContextMock implements ExecutionContextInterface
{
    /** @var string[] */
    private array $violationMessages = [];
    private bool $isError = false;
    private ViolationBuilderMock $violationBuilder;
    private object $objectContext;

    public function __construct()
    {
        $this->violationBuilder = new ViolationBuilderMock();
    }

    public function hasError(): bool
    {
        return $this->isError;
    }

    /**
     * @return string[]
     */
    public function getViolationMessages(): array
    {
        return $this->violationMessages;
    }

    /**
     * @inheritDoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function addViolation($message, array $params = array())
    {
        $this->isError = true;
        $this->violationMessages[] = $message;
    }

    /**
     * @inheritDoc
     */
    public function getGroup(): ?string
    {
        // TODO: Implement getGroup() method.
    }

    /**
     * @inheritDoc
     */
    public function buildViolation($message, array $parameters = array()): ConstraintViolationBuilderInterface
    {
        $this->addViolation($message, $parameters);

        return $this->violationBuilder;
    }

    /**
     * @inheritDoc
     */
    public function getClassName(): ?string
    {
        // TODO: Implement getClassName() method.
    }

    /**
     * @inheritDoc
     */
    public function getMetadata(): ?MetadataInterface
    {
        // TODO: Implement getMetadata() method.
    }

    public function setObject(object $object): void
    {
        $this->objectContext = $object;
    }

    /**
     * @inheritdoc
     */
    public function getObject(): ?object
    {
        return $this->objectContext;
    }

    /**
     * @inheritdoc
     */
    public function getPropertyName(): ?string
    {
        // TODO: Implement getPropertyName() method.
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function getPropertyPath($subPath = ''): string
    {
        // TODO: Implement getPropertyPath() method.
    }

    /**
     * @inheritdoc
     */
    public function getRoot(): mixed
    {
        // TODO: Implement getRoot() method.
    }

    /**
     * @inheritdoc
     */
    public function getValidator(): ValidatorInterface
    {
        // TODO: Implement getValidator() method.
    }

    /**
     * @inheritdoc
     */
    public function getValue(): mixed
    {
        // TODO: Implement getValue() method.
    }

    /**
     * @inheritdoc
     */
    public function getViolations(): ConstraintViolationListInterface
    {
        // TODO: Implement getViolations() method.
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function isConstraintValidated($cacheKey, $constraintHash): bool
    {
        // TODO: Implement isConstraintValidated() method.
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function isGroupValidated($cacheKey, $groupHash): bool
    {
        // TODO: Implement isGroupValidated() method.
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function isObjectInitialized($cacheKey): bool
    {
        // TODO: Implement isObjectInitialized() method.
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function markConstraintAsValidated($cacheKey, $constraintHash): void
    {
        // TODO: Implement markConstraintAsValidated() method.
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function markGroupAsValidated($cacheKey, $groupHash): void
    {
        // TODO: Implement markGroupAsValidated() method.
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function markObjectAsInitialized($cacheKey): void
    {
        // TODO: Implement markObjectAsInitialized() method.
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function setConstraint(Constraint $constraint): void
    {
        // TODO: Implement setConstraint() method.
    }

    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function setGroup($group): void
    {
        // TODO: Implement setGroup() method.
    }

    /**
     * phpcs:disable
     */
    public function setNode($value, $object, ?MetadataInterface $metadata = null, $propertyPath): void
    {
        // TODO: Implement setNode() method.
    }
}
