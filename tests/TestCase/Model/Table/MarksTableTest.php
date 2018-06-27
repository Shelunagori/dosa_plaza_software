<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MarksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MarksTable Test Case
 */
class MarksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MarksTable
     */
    public $Marks;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.marks',
        'app.subjects',
        'app.exams',
        'app.students'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Marks') ? [] : ['className' => MarksTable::class];
        $this->Marks = TableRegistry::getTableLocator()->get('Marks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Marks);

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
