<?php

namespace App\Rules;

use App\Models\Programacion\Sede;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;


class customRuleSedes implements InvokableRule, DataAwareRule
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
        $id = $data['SedeId'];

        switch($attribute){
            case 'NombreSede':
                $outRegisterItem = Sede::where('NombreSede', '=', $value)
                ->where('SedeId', '!=', $id)->count();

                if ($outRegisterItem > 0) {
                    $fail('Nombre ya está registrado para otra sede');
                }
            break;

            case 'Direccion':
                $outRegisterItem = Sede::where('Direccion', '=', $value)
                ->where('SedeId', '!=', $id)->count();

                if ($outRegisterItem > 0) {
                    $fail('Dirección ya está registrado para otra sede');
                }
            break;
        }
    }
}