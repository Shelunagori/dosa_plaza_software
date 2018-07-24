<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RawMaterialsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RawMaterialsTable Test Case
 */
class RawMaterialsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RawMaterialsTable
     */
    public $RawMaterials;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::getTableLocator()->exists('RawMaterials') ? [] : ['className' => RawMaterialsTable::class];
        $this->RawMaterials = TableRegistry::getTableLocator()->get('RawMaterials', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RawMaterials);

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
