<?php
declare(strict_types=1);

use Diagro\Zenfactuur;
use PHPUnit\Framework\TestCase;

final class InvoiceTest extends TestCase
{

    /**
     * @var Zenfactuur
     */
    private $zenfactuur;


    public function setUp() : void
    {
        $this->zenfactuur = new Zenfactuur("69350545e7feafd8f45e5e2d9cc4ef2c");
    }


    public function tearDown(): void
    {
        unset($this->zenfactuur);
    }


    public function testGetInvoices() : void
    {
        $invoices = $this->zenfactuur->invoice()->getInvoices();
        $this->assertNotEmpty($invoices);
    }

}
