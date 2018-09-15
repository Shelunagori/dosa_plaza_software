<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ItemListsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ItemListsTable Test Case
 */
class ItemListsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ItemListsTable
     */
    public $ItemLists;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('ItemLists') ? [] : ['className' => ItemListsTable::class];
        $this->ItemLists = TableRegistry::getTableLocator()->get('ItemLists', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ItemLists);

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
