<?php

namespace OpgTest\Lpa\DataModel\Lpa\Document;

use Opg\Lpa\DataModel\Lpa\Document\CertificateProvider;
use OpgTest\Lpa\DataModel\FixturesData;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class CertificateProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadValidatorMetadata()
    {
        $metadata = new ClassMetadata(CertificateProvider::class);

        CertificateProvider::loadValidatorMetadata($metadata);

        $this->assertEquals(2, count($metadata->properties));
        $this->assertNotNull($metadata->properties['name']);
        $this->assertNotNull($metadata->properties['address']);
    }

    public function testMap()
    {
        $certificateProvider = FixturesData::getCertificateProvider();

        $this->assertEquals('Mr', $certificateProvider->get('name')->title);
        $this->assertEquals('Certy', $certificateProvider->get('name')->first);
        $this->assertEquals('Edwards', $certificateProvider->get('name')->last);

        $this->assertEquals('Sixthaven', $certificateProvider->get('address')->address1);
        $this->assertEquals('Little Gorway', $certificateProvider->get('address')->address2);
        $this->assertEquals('Walsall', $certificateProvider->get('address')->address3);
        $this->assertEquals('WS1 3BQ', $certificateProvider->get('address')->postcode);

        $testable = new TestableCertificateProvider();
        $this->assertEquals('testValue', $testable->testMap('testProperty', 'testValue'));
    }

    public function testValidation()
    {
        $certificateProvider = FixturesData::getCertificateProvider();

        $this->assertFalse($certificateProvider->validate()->hasErrors());
    }

    public function testValidationFailed()
    {
        $certificateProvider = new CertificateProvider();

        $validatorResponse = $certificateProvider->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(2, count($errors));
    }
}

class TestableCertificateProvider extends CertificateProvider
{
    public function testMap($property, $v)
    {
        return parent::map($property, $v);
    }
}