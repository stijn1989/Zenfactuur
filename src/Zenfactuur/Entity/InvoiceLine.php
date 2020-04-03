<?php
namespace Diagro\Zenfactuur\Entity;


class InvoiceLine
{


    public $id;

    public $number_skus;

    /**
     * Is de Invoice ID
     * @var int
     */
    public $commercial_document_id;

    public $created_at;

    public $updated_at;

    public $description;

    public $unit_price;

    public $vat_percentage;

    public $p_and_l_line = true;

    public $row_order;

    public $unit_id;

    public $image_url;


}