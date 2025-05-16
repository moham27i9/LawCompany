<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIssueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'total_cost' => 'sometimes|decimal:2',
            'number_of_payments' => 'sometimes|integer',
            'title' => 'sometimes|string|max:255',
            'issue_number' => 'sometimes|string',
            'category' => 'sometimes|string',
           'amount_paid' => 'sometimes|numeric',
            'court_name' => 'sometimes|string',
            'opponent_name' => 'sometimes|string',
            'status' => 'sometimes|in:open,in_progress,closed,archived',
            'priority' => 'sometimes|in:normal,medium,high,critical',
            'end_date' => 'sometimes|date',
            'description' => 'sometimes|string',
   
        ];
        
    }

    public function messages(): array
    {
        return [
            'total_cost.decimal' => 'يجب أن تكون التكلفة الكلية رقمًا عشريًا يحتوي على خانتين بعد الفاصلة.',
            'number_of_payments.integer' => 'عدد الدفعات يجب أن يكون عددًا صحيحًا.',
            'title.string' => 'العنوان يجب أن يكون نصًا.',
            'title.max' => 'العنوان لا يجب أن يتجاوز 255 حرفًا.',
            'issue_number.string' => 'رقم القضية يجب أن يكون نصًا.',
            'category.string' => 'التصنيف يجب أن يكون نصًا.',
            'amount_paid.numeric' => 'المبلغ المدفوع يجب أن يكون رقمًا.',
            'court_name.string' => 'اسم المحكمة يجب أن يكون نصًا.',
            'opponent_name.string' => 'اسم الخصم يجب أن يكون نصًا.',
            'status.in' => 'open, in_progress, closed, archived :الحالة يجب أن تكون واحدة من.',
            'priority.in' => 'normal, medium, high, critical:الأولوية يجب أن تكون واحدة من ',
            'end_date.date' => 'تاريخ الانتهاء يجب أن يكون تاريخًا صحيحًا.',
            'description.string' => 'الوصف يجب أن يكون نصًا.',
        ];
    }

}
