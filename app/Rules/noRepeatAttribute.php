<?php

namespace App\Rules;

use App\Models\Compras\Proveedor;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class noRepeatAttribute implements InvokableRule , DataAwareRule
{

    protected $data =[];
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
        $data=$this->data;


    switch($attribute){
        case "NombreEmpresa":
            $outRegisterItem = Proveedor::where('NombreEmpresa', '=', $value)
            ->where('Nit', '!=', $data['Nit'])->count();
        if ($outRegisterItem > 0) {
            $fail('Este nombre ya corresponde a otro proveedor');
        }
            break;

            case "Correo":
                $outRegisterItem = Proveedor::where('Correo', '=', $value)
                ->where('Nit', '!=', $data['Nit'])->count();
            if ($outRegisterItem > 0) {
                $fail('Este correo ya corresponde a otro proveedor');
            }
                break;

                case "Direccion":
                    $outRegisterItem = Proveedor::where('Direccion', '=', $value)
                    ->where('Nit', '!=', $data['Nit'])->count();
                if ($outRegisterItem > 0) {
                    $fail('Esta dirección ya corresponde a otro proveedor');
                }
                    break;
    }

    }
}
