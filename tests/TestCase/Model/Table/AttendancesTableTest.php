<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AttendancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AttendancesTable Test Case
 */
class AttendancesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AttendancesTable
     */
    public $Attendances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.attendances',
        'app.employees'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Attendances') ? [] : ['className' => AttendancesTable::class];
        $this->Attendances = TableRegistry::getTableLocator()->get('Attendances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Attendances);

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
