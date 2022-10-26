<?php
namespace App\Filters\V1;
use  App\Filters\ApiFilters\V1\ApiFilter;


class InvoiceFilter extends ApiFilter{

    protected $safeParams =  [
        'id'=>['eq'],
        'customer_id'=>['eq'],
        'amount'=>['eq','lt','gt','lte','gte'],
        'status'=>['eq'],
        'billed_date'=>['eq'],
        'paid_date'=>['eq'],
    ];
    // transform the json postalCode format to the database column value 
    protected $columnMap = [
        'customerId'=>'customer_id',
        'billedDate'=>'billed_date',
        'paidDate'=>'paid_date',
    ];

    protected $operatorMap = [
        'eq'=>'=',
        'lt'=>'<',
        'lte'=> '<=',
        'gt'=>'>',
        'gte'=>'>=',
    ];     
}
