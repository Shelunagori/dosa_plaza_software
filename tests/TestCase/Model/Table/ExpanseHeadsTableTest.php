<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExpanseHeadsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExpanseHeadsTable Test Case
 */
class ExpanseHeadsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExpanseHeadsTable
     */
    public $ExpanseHeads;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.expanse_heads',
        'app.expanse_voucher_rows'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ExpanseHeads') ? [] : ['className' => ExpanseHeadsTable::class];
        $this->ExpanseHeads = TableRegistry::getTableLocator()->get('ExpanseHeads', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ExpanseHeads);

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
