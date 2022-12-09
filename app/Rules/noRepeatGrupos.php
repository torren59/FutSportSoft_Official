<?php

namespace App\Rules;

use App\Models\Programacion\Grupo;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class noRepeatGrupos implements InvokableRule , DataAwareRule
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
        $outRegisterItem = Grupo::where('NombreGrupo', '=', $value)
        ->where('GrupoId', '!=', $data['IdGrupo'])->count();
    if ($outRegisterItem > 0) {
        $fail('Este nombre ya corresponde a otro grupo');
    }
    }
}
