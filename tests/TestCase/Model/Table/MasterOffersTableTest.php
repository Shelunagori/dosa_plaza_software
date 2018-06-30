<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MasterOffersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MasterOffersTable Test Case
 */
class MasterOffersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MasterOffersTable
     */
    public $MasterOffers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.master_offers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('MasterOffers') ? [] : ['className' => MasterOffersTable::class];
        $this->MasterOffers = TableRegistry::getTableLocator()->get('MasterOffers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MasterOffers);

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
