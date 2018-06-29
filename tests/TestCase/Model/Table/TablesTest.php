<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Tables;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Tables Test Case
 */
class TablesTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\Tables
     */
    public $Tables;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('s') ? [] : ['className' => Tables::class];
        $this->Tables = TableRegistry::getTableLocator()->get('s', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tables);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
