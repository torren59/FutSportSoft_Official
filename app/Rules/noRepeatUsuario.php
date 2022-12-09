<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Contracts\Validation\DataAwareRule;

class noRepeatUsuario implements InvokableRule , DataAwareRule
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
        $outRegisterItem = User::where('email', '=', $value)
        ->where('id', '!=', $data['id'])->count();
    if ($outRegisterItem > 0) {
        $fail('Este nombre ya corresponde a otro Usuario');
    }
    }
}
