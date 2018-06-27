<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\YearsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\YearsTable Test Case
 */
class YearsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\YearsTable
     */
    public $Years;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.years'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Years') ? [] : ['className' => YearsTable::class];
        $this->Years = TableRegistry::getTableLocator()->get('Years', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Years);

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
