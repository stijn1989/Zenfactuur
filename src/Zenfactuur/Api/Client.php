<?php
namespace Diagro\Zenfactuur\Api;

use Diagro\Zenfactuur\Entity\Client as ClientEntity;
use Diagro\Zenfactuur\Exception;
use Diagro\Zenfactuur\Entity\ClientLanguage;
use Diagro\Zenfactuur\Entity\ClientType;


class Client extends BaseZenfactuur
{


    /**
     * Vraag alle klanten op.
     *
     * @return ClientEntity[]
     * @throws Exception
     */
    public function getClients()
    {
        return array_map(function($client) {
                return new ClientEntity($client);
            },
            $this->get('clients.json')
        );
    }


    /**
     * Zoeken naar een klant op basis van de naam of deel.
     * Maximum 100 results per pagina.
     *
     * @param $query Naam of deel van de klant.
     * @param null $page Pagina nummer
     * @return ClientEntity[]
     * @throws Exception
     */
    public function search($query, $page = null)
    {
        $parameters = ['q' => $query];
        if($page > 0) $parameters['page'] = $page;

        return array_map(function($client) {
            return new ClientEntity($client);
            },
            $this->get('clients/search.json', $parameters)
        );
    }


    /**
     * Vraag een klant op aan de hand van zijn ID.
     *
     * @param $id
     * @return ClientEntity
     * @throws Exception
     */
    public function getClient($id) : ClientEntity
    {
        return new ClientEntity(
            $this->get('/clients/' . $id . '.json')
        );
    }


    /**
     * Maak een nieuwe klant aan. Na succesvol aanmaken van de klant, bevat $client parameter een id.
     *
     * @param ClientEntity $client
     * @return bool
     * @throws Exception
     */
    public function createClient(ClientEntity &$client) : bool
    {
        $client = new ClientEntity(
            $this->post('clients.json', [
                'type_id' => $client->type_id,
                'name' => $client->name,
                'vat_number' => $client->vat_number,
                'street' => $client->street,
                'postcode' => $client->postcode,
                'city' => $client->city,
                'email' => $client->email,
                'country' => $client->country,
                'contact' => $client->contact,
                'tel' => $client->tel,
                'reference' => $client->reference,
                'website' => $client->website,
                'language' => $client->language
            ])
        );

        return (! empty($client->id));
    }

    /**
     * Wijzig de gegevens van een bestaande klant.
     *
     * @param ClientEntity $client
     * @return bool
     * @throws Exception
     */
    public function editClient(ClientEntity &$client) : bool
    {
        if(empty($client->id)) {
            throw new Exception('Je kan enkel bestaande klanten wijzigen!');
        }

        $client = new ClientEntity(
            $this->put('clients/' . $client->id . '.json', [
                'type_id' => $client->type_id,
                'name' => $client->name,
                'vat_number' => $client->vat_number,
                'street' => $client->street,
                'postcode' => $client->postcode,
                'city' => $client->city,
                'email' => $client->email,
                'country' => $client->country,
                'contact' => $client->contact,
                'tel' => $client->tel,
                'reference' => $client->reference,
                'website' => $client->website,
                'language' => $client->language
            ])
        );

        return true;
    }


    /**
     * Checks the validation of the VAT number.
     *
     * @param string $vat_number
     * @return bool
     * @throws Exception
     */
    public function validVatNumber(string $vat_number) : bool
    {
        $json = $this->get('clients/valid_be_vat_number.json', ['vat_number' => $vat_number]);
        return $json['valid'];
    }


}