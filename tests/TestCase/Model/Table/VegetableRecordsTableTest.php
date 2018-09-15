<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VegetableRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VegetableRecordsTable Test Case
 */
class VegetableRecordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VegetableRecordsTable
     */
    public $VegetableRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vegetable_records'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('VegetableRecords') ? [] : ['className' => VegetableRecordsTable::class];
        $this->VegetableRecords = TableRegistry::getTableLocator()->get('VegetableRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VegetableRecords);

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
