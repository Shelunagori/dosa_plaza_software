<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\KotsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\KotsTable Test Case
 */
class KotsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\KotsTable
     */
    public $Kots;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.kots',
        'app.tables',
        'app.kot_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Kots') ? [] : ['className' => KotsTable::class];
        $this->Kots = TableRegistry::getTableLocator()->get('Kots', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Kots);

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
