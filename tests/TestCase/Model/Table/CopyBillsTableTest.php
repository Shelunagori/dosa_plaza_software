<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CopyBillsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CopyBillsTable Test Case
 */
class CopyBillsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CopyBillsTable
     */
    public $CopyBills;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.copy_bills',
        'app.tables',
        'app.taxes',
        'app.customers',
        'app.employees',
        'app.offers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('CopyBills') ? [] : ['className' => CopyBillsTable::class];
        $this->CopyBills = TableRegistry::getTableLocator()->get('CopyBills', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CopyBills);

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
