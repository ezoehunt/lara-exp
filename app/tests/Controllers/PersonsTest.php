<?php

use Mockery as m;
use Way\Tests\Factory;

class PersonsTest extends TestCase {

    public function __construct()
    {
        //$this->mock = m::mock('Eloquent', 'Member');
        $this->collection = m::mock('Illuminate\Database\Eloquent\Collection')->shouldDeferMissing();
    }

    public function setUp()
    {
        parent::setUp();

        // Moved from construct to setup so phpunit works
        $this->mock = m::mock('Eloquent', 'Person');

        $this->attributes = Factory::person(['id' => 1]);
        $this->app->instance('Person', $this->mock);
    }

    public function tearDown()
    {
        m::close();
    }

    public function testIndex()
    {   
        $this->mock
        // adjust to work with sortby
        //  ->shouldReceive('all')
            ->shouldReceive('get')
            ->once()
            ->andReturn($this->collection);

        $this->call('GET', 'persons');

        $this->assertViewHas('persons');
    }

    public function testShow()
    {
        $this->mock->shouldReceive('findOrFail')
                   ->with(1)
                   ->once()
                   ->andReturn($this->attributes);

        $this->call('GET', 'persons/1');

        $this->assertViewHas('persons');
    }
}
