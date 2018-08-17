<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OfferCodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OfferCodesTable Test Case
 */
class OfferCodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OfferCodesTable
     */
    public $OfferCodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.offer_codes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('OfferCodes') ? [] : ['className' => OfferCodesTable::class];
        $this->OfferCodes = TableRegistry::getTableLocator()->get('OfferCodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OfferCodes);

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
