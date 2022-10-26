<?php
namespace App\Filters\V1;
use  App\Filters\ApiFilters\V1\ApiFilter;


class CustomerFilter extends ApiFilter{

    protected $safeParams =  [
        'name'=>['eq'],
        'type'=>['eq'],
        'email'=>['eq'],
        'address'=>['eq'],
        'city'=>['eq'],
        'state'=>['eq'],
        'postal_code'=>['eq','gt','lt'], //eq = equal, gt = greater, lt = less then
    ];
    // transform the json postalCode format to the database column value 
    protected $columnMap = [
        'postalCode'=>'postal_code',
    ];

    protected $operatorMap = [
        'eq'=>'=',
        'lt'=>'<',
        'gt'=>'>',
        'lte'=> '<=',
        'gte'=>'>=',
        'sme'=>'like',
    ];     
}
