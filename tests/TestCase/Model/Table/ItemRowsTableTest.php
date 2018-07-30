<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemRowsTable Test Case
 */
class ItemRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemRowsTable
     */
    public $ItemRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.item_rows',
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
        $config = TableRegistry::getTableLocator()->exists('ItemRows') ? [] : ['className' => ItemRowsTable::class];
        $this->ItemRows = TableRegistry::getTableLocator()->get('ItemRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemRows);

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
