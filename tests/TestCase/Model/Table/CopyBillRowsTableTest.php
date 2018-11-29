<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CopyBillRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CopyBillRowsTable Test Case
 */
class CopyBillRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CopyBillRowsTable
     */
    public $CopyBillRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.copy_bill_rows',
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
        $config = TableRegistry::getTableLocator()->exists('CopyBillRows') ? [] : ['className' => CopyBillRowsTable::class];
        $this->CopyBillRows = TableRegistry::getTableLocator()->get('CopyBillRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CopyBillRows);

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
