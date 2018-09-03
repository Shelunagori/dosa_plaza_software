<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RawMaterialCategoriesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RawMaterialCategoriesTable Test Case
 */
class RawMaterialCategoriesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RawMaterialCategoriesTable
     */
    public $RawMaterialCategories;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.raw_material_categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RawMaterialCategories') ? [] : ['className' => RawMaterialCategoriesTable::class];
        $this->RawMaterialCategories = TableRegistry::getTableLocator()->get('RawMaterialCategories', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RawMaterialCategories);

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
