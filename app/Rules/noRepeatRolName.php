<?php

namespace App\Rules;

use App\Models\Configuracion\Roles;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class noRepeatRolName implements InvokableRule , DataAwareRule
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
        $outRegisterItem = Roles::where('name', '=', $value)
        ->where('id', '!=', $data['IdRol'])->count();
    if ($outRegisterItem > 0) {
        $fail('Este nombre ya corresponde a otro rol');
    }


    }
}


