<?php

namespace App\Http\Requests;

use App\Rules\CheckPlannedTransfers;
use Illuminate\Foundation\Http\FormRequest;

class DonateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'transferredMoney' => [
                'required',
                'gt:0',
                'lte:'.auth()->user()->money,
                new CheckPlannedTransfers($this->request->get('transferredMoney'))
            ],
            'date' => 'required|date|after:yesterday',
            'time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'transferredMoney.required' => 'Введите сумму, которую собираетесь перевести',
            'transferredMoney.gt' => 'Донат в 0 или даже меньше 0? Похоже на плохую шутку',
            'transferredMoney.lte' => 'Недостаточно средств для проведения опреации',

            'date.required' => 'Введите дату поступления платежа',
            'date.after' => 'Мы не умеем делать донат в прошлое, если умеете или можете научить - напишите нам',

            'time.required' => 'Вы как умудрились стереть время, которое там задано по умолчанию?',
        ];
    }
}
