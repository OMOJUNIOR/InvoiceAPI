<?php
namespace App\Filters\ApiFilters\V1;
use Illuminate\Http\Request;


class ApiFilter {

    protected $safeParams =  [];
    // transform the json postalCode format to the database column value 
    protected $columnMap = [];

    protected $operatorMap = [];

    public function transform(Request $request){
        $eloQuery = [];

        foreach($this->safeParams as $param => $operators){
            $query = $request->query($param);
            if(!isset($query)){
                continue;
            }
            $column = $this->columnMap[$param] ?? $param;
            foreach($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[] = [$column,$this->operatorMap[$operator],$query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}
