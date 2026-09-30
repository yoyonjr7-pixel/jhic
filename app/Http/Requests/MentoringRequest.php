<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class MentoringRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array { return [
        'nama_siswa'=>['required','string','max:150'],'no_telp'=>['nullable','digits_between:10,15'],'id_siswa'=>['nullable','integer','exists:siswa,id_siswa'],'id_jurusan'=>['nullable','integer','exists:jurusan,id_jurusan'],'kelas'=>['nullable','string','max:20'],'id_alumni'=>['nullable','integer','exists:alumni_track,id_alumni'],'nama_mentor'=>['nullable','string','max:150'],'topik_mentoring'=>['required','string','max:255'],'catatan'=>['nullable','string','max:5000'],'status'=>['required','in:pending,diproses,selesai'],'tanggal'=>['nullable','date'],
    ]; }
}