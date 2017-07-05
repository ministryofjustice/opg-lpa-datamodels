<?php

namespace OpgTest\Lpa\DataModel\Lpa\Elements;

use Opg\Lpa\DataModel\Lpa\Elements\Address;
use OpgTest\Lpa\DataModel\FixturesData;

class AddressTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $donor = FixturesData::getDonor();
        $address = $donor->get('address');

        $this->assertEquals('562 Queen Street, Charlestown, Cornwall, England, EH9K 8UC', '' . $address);
    }

    public function testValidation()
    {
        $donor = FixturesData::getDonor();
        $address = $donor->get('address');

        $validatorResponse = $address->validate();
        $this->assertFalse($validatorResponse->hasErrors());
    }

    public function testValidationFailed()
    {
        $address = new Address();

        $validatorResponse = $address->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(2, count($errors));
        $this->assertNotNull($errors['address1']);
        $this->assertNotNull($errors['address2/postcode']);
    }

    public function testValidationFailedLength()
    {
        $address = new Address();
        $address->set('address1', FixturesData::generateRandomString(51));
        $address->set('address2', FixturesData::generateRandomString(51));
        $address->set('address3', FixturesData::generateRandomString(51));
        $address->set('postcode', FixturesData::generateRandomString(9));

        $validatorResponse = $address->validate();
        $this->assertTrue($validatorResponse->hasErrors());
        $errors = $validatorResponse->getArrayCopy();
        $this->assertEquals(4, count($errors));
        $this->assertNotNull($errors['address1']);
        $this->assertNotNull($errors['address2']);
        $this->assertNotNull($errors['address3']);
        $this->assertNotNull($errors['postcode']);
    }
}