<?php
namespace Diagro\Zenfactuur\Api;

use Diagro\Zenfactuur\Entity\Invoice as InvoiceEntity;
use Diagro\Zenfactuur\Entity\InvoiceLine;
use Diagro\Zenfactuur\Exception;


class Invoice extends BaseZenfactuur
{


    /**
     * Vraag alle facturen op.
     *
     * @param int $per_page
     * @param int $page
     * @return InvoiceEntity[]
     * @throws Exception
     */
    public function getInvoices(int $per_page = 100, int $page = 1)
    {
        return array_map(function($invoice) {
                return new InvoiceEntity($invoice);
            },
            $this->get('invoices.json', ['per_age' => $per_page, 'page' => $page])
        );
    }


    /**
     * Vraag alle onbetaalde facturen op.
     * 100 facturen per pagina.
     *
     * @param int $page
     * @return array
     * @throws Exception
     */
    public function getUnpaidInvoices(int $page = 1)
    {
        return array_map(function($invoice) {
            return new InvoiceEntity($invoice);
        },
            $this->get('invoices/unpaid.json', ['page' => $page])
        );
    }


    /**
     * Vraag een specifieke factuur op.
     *
     * @param int $id
     * @return InvoiceEntity
     * @throws Exception
     */
    public function getInvoice(int $id)
    {
        return new InvoiceEntity(
            $this->get('invoices/' . $id . '.json')
        );
    }


    /**
     * Vraag het volgende factuurnummer op.
     *
     * @return string
     * @throws Exception
     */
    public function getNextInvoiceNumber()
    {
        return (string)$this->get('next_invoice_serial_number.json');
    }


}