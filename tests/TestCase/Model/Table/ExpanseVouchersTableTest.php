<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpanseVouchersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpanseVouchersTable Test Case
 */
class ExpanseVouchersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpanseVouchersTable
     */
    public $ExpanseVouchers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.expanse_vouchers',
        'app.expanse_voucher_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ExpanseVouchers') ? [] : ['className' => ExpanseVouchersTable::class];
        $this->ExpanseVouchers = TableRegistry::getTableLocator()->get('ExpanseVouchers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExpanseVouchers);

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
