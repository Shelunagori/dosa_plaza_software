<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StockLedgersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StockLedgersTable Test Case
 */
class StockLedgersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StockLedgersTable
     */
    public $StockLedgers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stock_ledgers',
        'app.raw_materials'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StockLedgers') ? [] : ['className' => StockLedgersTable::class];
        $this->StockLedgers = TableRegistry::getTableLocator()->get('StockLedgers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StockLedgers);

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
