<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\AdminUser;

class ExampleTest extends TestCase
{
    /**
     * @coversNothing
     *
     * @return void
     */
    public function testBasicTest()
    {
        $adminUser = new AdminUser(); 
        $this->assertTrue(true);
    }
}
