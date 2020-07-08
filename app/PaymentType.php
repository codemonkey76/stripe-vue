<?php


namespace App;


class PaymentType
{
    public $id;
    public $label;

    public function __construct($id, $label)
    {
        $this->id = $id;
        $this->label = $label;
    }
}
