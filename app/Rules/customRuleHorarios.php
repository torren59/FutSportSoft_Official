<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class customRuleHorarios implements InvokableRule, DataAwareRule
{

        /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];


        /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
 
        return $this;
    }


    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $data = $this->data;

        switch($attribute){
            case 'HoraFinalizacion':
                $inicio = $data['HoraInicio'];
                $finalizacion = $data['HoraFinalizacion'];
                $initialVal = '';
                $finalVal = '';
                for($i = 1; $i <= 5; $i++){
                    if($i % 3 != 0){
                        $initialVal = $initialVal.strval(substr($inicio,($i-1),1));
                    }
                }

                for($i = 1; $i <= 5; $i++){
                    if($i % 3 != 0){
                        $finalVal = $finalVal.strval(substr($finalizacion,($i-1),1));
                    }
                }

                if (intval($initialVal)   >= intval($finalVal)) {
                    $fail('Hora de finalización debe ser mayor que la hora de inicio');
                }
            break;
        }
    }
}