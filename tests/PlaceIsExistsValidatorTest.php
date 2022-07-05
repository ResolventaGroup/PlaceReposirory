<?php

namespace Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Helpers\ExecutionContextMock;
use Resolventa\PlaceRepository\PlaceRepositoryInterface;
use Resolventa\PlaceRepository\PlaceRepositoryMock;
use Resolventa\PlaceRepository\Validator\PlaceIsExists;
use Resolventa\PlaceRepository\Validator\PlaceIsExistsValidator;
use Symfony\Component\Validator\Constraint;

final class PlaceIsExistsValidatorTest extends TestCase
{
    private ExecutionContextMock $executionContext;
    private PlaceIsExistsValidator $validator;
    private PlaceIsExists $constraint;

    protected function setUp(): void
    {
        parent::setUp();
        $this->executionContext = new ExecutionContextMock();
        $this->validator = new PlaceIsExistsValidator(new PlaceRepositoryMock());
        $this->validator->initialize($this->executionContext);

        $this->constraint = new PlaceIsExists();
    }

    public function testNonGeocodedStringMustCauseErrors(): void
    {
        $validator = new PlaceIsExistsValidator($this->createGeocodeServiceWithPlaceResultForSearch());
        $validator->initialize($this->executionContext);
        $validator->validate('some place', $this->constraint);

        $this->assertTrue($this->executionContext->hasError());
    }

    public function testEmptyStringMustNotCauseErrors(): void
    {
        $this->validator->validate('', $this->constraint);

        $this->assertFalse($this->executionContext->hasError());
    }

    public function testGeocodedStringMustNotCauseErrors(): void
    {
        $this->validator->validate('some place', $this->constraint);

        $this->assertFalse($this->executionContext->hasError());
    }

    public function testUnsupportedConstraint(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Constraint must be instance of');

        $validator = new PlaceIsExistsValidator($this->createMock(PlaceRepositoryInterface::class));
        $validator->validate('placeLocation', $this->createMock(Constraint::class));
    }

    private function createGeocodeServiceWithPlaceResultForSearch(): PlaceRepositoryInterface
    {
        $geocodeService = $this->createMock(PlaceRepositoryInterface::class);
        $geocodeService->method('findByAddress')
            ->willReturn(null);

        return $geocodeService;
    }
}
