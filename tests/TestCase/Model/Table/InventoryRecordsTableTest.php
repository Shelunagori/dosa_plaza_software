<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InventoryRecordsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InventoryRecordsTable Test Case
 */
class InventoryRecordsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InventoryRecordsTable
     */
    public $InventoryRecords;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.inventory_records',
        'app.item_lists'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('InventoryRecords') ? [] : ['className' => InventoryRecordsTable::class];
        $this->InventoryRecords = TableRegistry::getTableLocator()->get('InventoryRecords', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InventoryRecords);

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
