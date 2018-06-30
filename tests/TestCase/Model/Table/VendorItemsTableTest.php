<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VendorItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VendorItemsTable Test Case
 */
class VendorItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VendorItemsTable
     */
    public $VendorItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vendor_items',
        'app.vendors',
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
        $config = TableRegistry::getTableLocator()->exists('VendorItems') ? [] : ['className' => VendorItemsTable::class];
        $this->VendorItems = TableRegistry::getTableLocator()->get('VendorItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VendorItems);

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
