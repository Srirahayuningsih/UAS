<?php 

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //Cara MENULISKAN fORM Validasi Form Request
            //Cara Membuat Form Validation (2)
            'nama' => 'required',
            'username' => 'required|unique:user,username',

            //ATAU
             //'username' => 'required|unique:\App\Models\User|gte:10',
            
            'email' => 'required|email:rfc,dns',
            'password' =>'required',
            'no_handphone' =>'required',

        ];
    }

    function messages(){
        return [
            'nama.required' => 'Field Nama Wajib Diisi',
            'username.required' => 'Field Username Wajib Diisi',
            'username.unique' => 'Username Tersebut Sudah Terdaftar',
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi',
            'no_handphone.required' => 'Nomor Hp Wajib Diisi',



        ];
    }
}