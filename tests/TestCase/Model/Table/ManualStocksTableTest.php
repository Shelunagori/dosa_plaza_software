<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ManualStocksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ManualStocksTable Test Case
 */
class ManualStocksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ManualStocksTable
     */
    public $ManualStocks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.manual_stocks',
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
        $config = TableRegistry::getTableLocator()->exists('ManualStocks') ? [] : ['className' => ManualStocksTable::class];
        $this->ManualStocks = TableRegistry::getTableLocator()->get('ManualStocks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ManualStocks);

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
