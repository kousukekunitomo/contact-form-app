<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'last_name'    => 'required|string|max:255',
            'first_name'   => 'required|string|max:255',
            'gender'       => 'required|in:1,2,3',
            'email'        => 'required|email',
            // 🚫 tel1〜3のルールは削除（共通エラーに集約）
            'address'      => 'required|string|max:255',
            'category_id'  => 'required|exists:categories,id',
            'detail'       => 'required|string|max:120',
        ];
    }

    public function messages()
    {
        return [
            'last_name.required'    => '姓を入力してください',
            'first_name.required'   => '名を入力してください',
            'gender.required'       => '性別を選択してください',
            'email.required'        => 'メールアドレスを入力してください',
            'email.email'           => 'メールアドレスはメール形式で入力してください',
            'address.required'      => '住所を入力してください',
            'category_id.required'  => 'お問い合わせの種類を選択してください',
            'detail.required'       => 'お問い合わせ内容を入力してください',
            'detail.max'            => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
        $tel1 = $this->input('tel1');
        $tel2 = $this->input('tel2');
        $tel3 = $this->input('tel3');

        $pattern = '/^[0-9]{1,5}$/';

        // どれか1つでも空欄ならメッセージ追加
        if (empty($tel1) || empty($tel2) || empty($tel3)) {
            $validator->errors()->add('tel_combined', '電話番号を入力してください');
        }

        // どれか1つでも形式不正（例：全角など）ならメッセージ追加
        if (
            (!empty($tel1) && !preg_match($pattern, $tel1)) ||
            (!empty($tel2) && !preg_match($pattern, $tel2)) ||
            (!empty($tel3) && !preg_match($pattern, $tel3))
        ) {
            $validator->errors()->add('tel_combined', '電話番号は5桁までの数字で入力してください');
        }
        });
    }
}
