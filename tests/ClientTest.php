<?php
declare(strict_types=1);

use Diagro\Zenfactuur;
use Diagro\Zenfactuur\Entity\Client;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{

    private $zenfactuur;


    public function setUp() : void
    {
        $this->zenfactuur = new Zenfactuur("69350545e7feafd8f45e5e2d9cc4ef2c");
    }


    public function tearDown(): void
    {
        unset($this->zenfactuur);
    }


    public function testGetClients(): void
    {
        $client = $this->zenfactuur->client();
        $clients = $client->getClients();
        $this->assertNotEmpty($clients);
    }


    public function testSearchClient() : void
    {
        $client = $this->zenfactuur->client();
        $results = $client->search('danapig');
        $this->assertCount(1, $results);
        $this->assertStringContainsStringIgnoringCase('danapig', $results[0]->name);
    }


    public function testDanapigClient() : void
    {
        $id = 75653;
        $client = $this->zenfactuur->client()->getClient($id);
        $this->assertStringContainsStringIgnoringCase('danapig', $client->name);
        $this->assertEquals($id, $client->id);
    }


    public function testUnexistedClient() :void
    {
        $this->expectException(Zenfactuur\Exception::class);
        $id = 111111111;
        $client = $this->zenfactuur->client()->getClient($id);
    }


    public function testInvalidVatNumberCreateClient() : void
    {
        $this->expectException(Zenfactuur\Exception::class);
        $client = new Client();
        $client->vat_number = "BE54785255441";
        $client->name = "not valid";

        $this->zenfactuur->client()->createClient($client);
    }


    public function testCreateClient() : Client
    {
        $client = new Client();
        $client->vat_number = "0670.448.261";
        $client->name = "phpunit";
        $this->zenfactuur->client()->createClient($client);

        $this->assertNotEmpty($client->id);
        $this->assertEquals('phpunit', $client->name);

        return $client;
    }


    /**
     * @depends testCreateClient
     * @param Client $client
     * @throws Zenfactuur\Exception
     */
    public function testUpdateClient(Client $client): void
    {
        $client->name .= ' 123';
        $this->zenfactuur->client()->editClient($client);

        $this->assertStringEndsWith('123', $client->name);
    }


    public function testInvalidVatNumber() : void
    {
        $this->assertFalse(
            $this->zenfactuur->client()->validVatNumber('45q45555')
        );
    }


    public function testValidVatNumber() : void
    {
        $this->assertTrue(
            $this->zenfactuur->client()->validVatNumber('0670.448.261')
        );
    }

}
