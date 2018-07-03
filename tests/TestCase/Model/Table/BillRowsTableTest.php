<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BillRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BillRowsTable Test Case
 */
class BillRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BillRowsTable
     */
    public $BillRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bill_rows',
        'app.bills',
        'app.items'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('BillRows') ? [] : ['className' => BillRowsTable::class];
        $this->BillRows = TableRegistry::getTableLocator()->get('BillRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BillRows);

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
