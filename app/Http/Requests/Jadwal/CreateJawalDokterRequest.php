<?php

namespace App\Http\Requests\Jadwal;

use Illuminate\Foundation\Http\FormRequest;

class CreateJawalDokterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'dokter' => 'required',
            'poliklinik' => 'required|numeric',
            'jadwal_buka' => 'required',
            'jadwal_tutup' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'dokter.required' => 'Nama Dokter tidak boleh kosong',
            'poliklinik.required' => 'Poliklinik tidak boleh kosong',
            'poliklinik.numeric' => 'Poliklinik tidak boleh kosong',
            'jadwal_buka.required' => 'Jadwal tidak boleh kosong',
            'jadwal_tutup.required' => 'Jadwal tidak boleh kosong',
        ];
    }
}
