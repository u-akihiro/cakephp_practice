<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    public $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = TableRegistry::getTableLocator()->get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Users);

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
        $invalidEntities = $this->Users->newEntities([
            [
                'name' => '',
                'email' => '',
                'password' => '',
            ],
            [
                'name' => 'ab',
                'email' => 'invalidemail',
                'password' => 'abcdefg',
            ],
        ]);
        foreach ( $invalidEntities as $entity ) {
            $errors = $entity->getErrors();
            $this->assertArrayHasKey('name', $errors);
            $this->assertArrayHasKey('email', $errors);
            $this->assertArrayHasKey('password', $errors);
        }

        $validEntities = $this->Users->newEntities([
            [
                'name' => 'abc',
                'email' => 'validemail@example.com',
                'password' => 'abcdefgh',
            ]
        ]);
        foreach ($validEntities as $entity) {
            $errors = $entity->getErrors();
            $this->assertEmpty($errors);
        }
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $notUniqueEntity = $this->Users->newEntity([
            'name' => 'alreadyused',
            'email' => 'already.exists@example.com',
            'password' => 'password'
        ]);
        $this->assertFalse($this->Users->save($notUniqueEntity));
        $errors = $notUniqueEntity->getErrors();
        $this->assertArrayHasKey('name', $errors);
        $this->assertArrayHasKey('email', $errors);

        $uniqueEntity = $this->Users->newEntity([
            'name' => 'uniquename',
            'email' => 'unique@example.com',
            'password' => 'password'
        ]);
        $this->assertInstanceOf('Cake\Datasource\EntityInterface', $this->Users->save($uniqueEntity));
        $errors = $uniqueEntity->getErrors();
        $this->assertEmpty($errors);
    }
}
