<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExamSubjectDetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExamSubjectDetailsTable Test Case
 */
class ExamSubjectDetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExamSubjectDetailsTable
     */
    public $ExamSubjectDetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.exam_subject_details',
        'app.exams',
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
        $config = TableRegistry::getTableLocator()->exists('ExamSubjectDetails') ? [] : ['className' => ExamSubjectDetailsTable::class];
        $this->ExamSubjectDetails = TableRegistry::getTableLocator()->get('ExamSubjectDetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExamSubjectDetails);

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
