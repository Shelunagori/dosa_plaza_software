<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StudentElectiveSubjectsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StudentElectiveSubjectsTable Test Case
 */
class StudentElectiveSubjectsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StudentElectiveSubjectsTable
     */
    public $StudentElectiveSubjects;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.student_elective_subjects',
        'app.students',
        'app.subjects'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('StudentElectiveSubjects') ? [] : ['className' => StudentElectiveSubjectsTable::class];
        $this->StudentElectiveSubjects = TableRegistry::getTableLocator()->get('StudentElectiveSubjects', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StudentElectiveSubjects);

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
