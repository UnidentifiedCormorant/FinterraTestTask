<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckPlannedTransfers implements Rule
{
    protected $money;
    protected $plannedAmount;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($money)
    {
        $this->money = $money;
        $this->plannedAmount = auth()->user()->transfers()->where('status', 0)->sum('transferredMoney');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->plannedAmount + $this->money <= auth()->user()->money;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Невозможно выполнить перевод; сумма запланированных переводов ('.$this->plannedAmount.') с учётом введённой суммы('.$this->money.') превышает имеющиеся у вас средства';
    }
}
