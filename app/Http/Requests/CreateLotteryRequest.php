<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLotteryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lottery_master_id' => 'required|exists:lottery_master,id',
            'expires_on' => 'required|date_format:d-m-Y H:i',
            'start_number' => 'required|integer',
            'end_number' => 'required|integer|gte:start_number',
        ];
    }
}
