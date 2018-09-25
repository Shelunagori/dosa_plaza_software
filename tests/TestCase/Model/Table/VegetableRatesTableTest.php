<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VegetableRatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VegetableRatesTable Test Case
 */
class VegetableRatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VegetableRatesTable
     */
    public $VegetableRates;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vegetable_rates',
        'app.vegetables'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('VegetableRates') ? [] : ['className' => VegetableRatesTable::class];
        $this->VegetableRates = TableRegistry::getTableLocator()->get('VegetableRates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VegetableRates);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
