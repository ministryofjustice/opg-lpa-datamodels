<?php
namespace Opg\Lpa\DataModel\Lpa\Document;

use Opg\Lpa\DataModel\Lpa\AbstractData;

use Respect\Validation\Rules;
use Opg\Lpa\DataModel\Validator\Validator; // Extended instance of Respect\Validation\Validator

class Document extends AbstractData {

    const LPA_TYPE_PF = 'property-and-financial';
    const LPA_TYPE_HW = 'health-and-welfare';

    //---

    protected $type;

    protected $donor;

    protected $whoIsRegistering;

    protected $howAreDecisionsMade;

    protected $correspondent;

    protected $instruction;

    protected $preference;

    protected $attorneys;

    protected $certificateProviders;

    protected $peopleToNotify;

    public function __construct(){

        # TEMPORARY TEST DATA ------------

        $this->type = self::LPA_TYPE_HW;

        $this->donor = new Donor();

        //-----------------------------------------------------
        // Validators (wrapped in Closures for lazy loading)

        $this->validators['donor'] = function(){
            return (new Validator)->addRules([
                new Rules\Instance( 'Opg\Lpa\DataModel\Lpa\Document\Donor' ),
            ]);
        };


    } // function

} // class
