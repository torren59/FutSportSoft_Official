<?php

namespace App\Rules;

use App\Models\Programacion\Deportista;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;


class customRuleDeportistas implements InvokableRule, DataAwareRule
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
        switch($attribute){
            case 'Documento':
                $outRegisterItem = Deportista::where('Documento', '=', $value)
                ->count();

                if ($outRegisterItem > 0) {
                    $fail('Documento ya se encuentra registrado');
                }
            break;
        }
    }
}
