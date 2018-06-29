<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\KotRowsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\KotRowsTable Test Case
 */
class KotRowsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\KotRowsTable
     */
    public $KotRows;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.kot_rows',
        'app.kots',
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
        $config = TableRegistry::getTableLocator()->exists('KotRows') ? [] : ['className' => KotRowsTable::class];
        $this->KotRows = TableRegistry::getTableLocator()->get('KotRows', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->KotRows);

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
