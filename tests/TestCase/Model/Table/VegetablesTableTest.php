<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VegetablesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VegetablesTable Test Case
 */
class VegetablesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VegetablesTable
     */
    public $Vegetables;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('Vegetables') ? [] : ['className' => VegetablesTable::class];
        $this->Vegetables = TableRegistry::getTableLocator()->get('Vegetables', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Vegetables);

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
}
