<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EmployeeMarksAccessesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EmployeeMarksAccessesTable Test Case
 */
class EmployeeMarksAccessesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EmployeeMarksAccessesTable
     */
    public $EmployeeMarksAccesses;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.employee_marks_accesses',
        'app.exams',
        'app.subjects',
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
        $config = TableRegistry::getTableLocator()->exists('EmployeeMarksAccesses') ? [] : ['className' => EmployeeMarksAccessesTable::class];
        $this->EmployeeMarksAccesses = TableRegistry::getTableLocator()->get('EmployeeMarksAccesses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EmployeeMarksAccesses);

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
