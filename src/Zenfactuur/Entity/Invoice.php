<?php
namespace Diagro\Zenfactuur\Entity;


class Invoice extends BaseEntity
{


    public $id;

    public $serial_number;

    public $date;

    public $client_id;

    public $created_at;

    public $updated_at;

    public $company_id;

    public $vat_percentage;

    public $client_name;

    public $client_name2;

    public $client_address1;

    public $client_address2;

    public $client_address3;

    public $client_vat_number;

    public $sender_name;

    public $sender_address1;

    public $sender_address2;

    public $sender_address3;

    public $sender_bank_account;

    public $sender_vat_number;

    public $vat_exempted;

    public $sale_id;

    public $payment_term;

    public $last_send;

    public $last_seen;

    public $pay_message;

    public $custom_text_top;

    public $custom_text_bottom;

    public $internal_description;

    public $reference;

    public $caption;

    public $email_error;

    public $discount_amount;

    public $discount_percentage;

    public $valid_till;

    public $saved_check_value;

    public $client_reference;

    public $clioent_language;

    public $delivery_date;

    public $has_signature_field;

    public $sales_category_id;

    public $status_id;

    public $send_reminder = false;

    public $show_mollie_payment_button = false;

    public $from_quotation_id;

    public $sender_rpr;

    public $sender_iban;

    public $sender_bic;

    public $show_units = false;

    public $client_postcode;

    public $client_city;

    public $client_country;

    public $sender_postcode;

    public $sender_city;

    public $sender_country;

    public $sender_contact;

    public $project_id;

    public $financial_discount_days;

    public $payment_term_style_id = 1;

    public $due_date;

    public $ogm;

    public $send_to_coda_accountant = false;

    public $send_via_email_ubl_integration = false;

    public $po_number;

    public $numeric_serial_number_version;

    public $no_vat_reason;

    public $amount;

    public $vat_amount;

    public $html_url_for_client;

    public $pdf_url_for_client;

    public $xml_url_for_client;

    public $invoice_lines = [];


    protected function build(array $data)
    {
        parent::build($data);

        if(array_key_exists("commercial_document_lines", $data) && is_array($data['commercial_document_lines'])) {
            foreach($data['commercial_document_lines'] as $cdl) {
                $line = new InvoiceLine();
                foreach($cdl as $k => $v) {
                    $line->$k = $v;
                }
                $this->invoice_lines[$line->row_order] = $line;
            }
        }
    }


}