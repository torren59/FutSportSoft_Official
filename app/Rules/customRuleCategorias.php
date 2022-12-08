<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use App\Models\Programacion\Categoria;


class customRuleCategorias implements InvokableRule, DataAwareRule
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
        $id = $data['CategoriaId'];

        switch($attribute){
            case 'NombreCategoria':
                $outRegisterItem = Categoria::where('NombreCategoria', '=', $value)
                ->where('CategoriaId', '!=', $id)->count();

                if ($outRegisterItem > 0) {
                    $fail('Nombre ya está registrado para otra categoría');
                }
            break;
        }
    }
}
