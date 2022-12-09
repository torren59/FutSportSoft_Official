<?php

namespace App\Rules;

use App\Models\Programacion\Deporte;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class noRepeatDeportes implements InvokableRule , DataAwareRule
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
        $outRegisterItem = Deporte::where('NombreDeporte', '=', $value)
        ->where('DeporteId', '!=', $data['DeporteId'])->count();
    if ($outRegisterItem > 0) {
        $fail('Este nombre ya corresponde a otro Usuario');
    }
    }
}
