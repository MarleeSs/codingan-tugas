<?php

namespace Example;

use PHPUnit\Framework\TestCase;

class ContohRecursiTest extends TestCase
{
    public function testFactorial()
    {
        $fact = new ContohRecursi();
        $result = $fact->factorial(1);

        self::assertNotNull($result);
    }

    public function testCoba()
    {
        $contoh = new ContohRecursi();
        $result = $contoh->coba(1);



        self::assertEquals(1,$result);
    }
}
