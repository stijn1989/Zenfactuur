<?php
namespace Diagro\Zenfactuur\Entity;


class Client extends BaseEntity
{


    public $id;

    public $name;

    public $vat_number;

    public $street;

    public $postcode;

    public $city;

    public $type_id = ClientType::BELGISCH_BEDRIJF;

    public $created_at;

    public $updated_at;

    public $company_id;

    public $email;

    public $country;

    public $contact;

    public $tel;

    public $reference;

    public $website;

    public $language = ClientLanguage::NL;

    public $active;

    public $remarks;

    public $business_relation_since;

    public $client_tag_list = [];

    public $btw_number;

    public $all_client_tags_list = [];


    public function getType()
    {
        switch($this->type_id)
        {
            case 0:
                return 'Particulier uit EU (of instelling zonder BTW nummer)';
                break;
            case 1:
                return 'Belgisch bedrijf';
                break;
            case 2:
                return 'Bedrijf uit EU';
                break;
            case 3:
                return 'Klant buiten EU';
                break;
            default:
                return '';
                break;
        }
    }


}