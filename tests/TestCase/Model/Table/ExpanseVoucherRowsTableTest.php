<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpanseVoucherRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpanseVoucherRowsTable Test Case
 */
class ExpanseVoucherRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpanseVoucherRowsTable
     */
    public $ExpanseVoucherRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.expanse_voucher_rows',
        'app.expanse_vouchers',
        'app.expanse_heads'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ExpanseVoucherRows') ? [] : ['className' => ExpanseVoucherRowsTable::class];
        $this->ExpanseVoucherRows = TableRegistry::getTableLocator()->get('ExpanseVoucherRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExpanseVoucherRows);

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
