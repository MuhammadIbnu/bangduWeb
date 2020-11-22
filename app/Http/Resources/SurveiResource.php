<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class SurveiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'waris' => [
                'nik' => $this->waris->nik,
                'kk' => $this->waris->kk,
                'nama' => $this->waris->nama,
                'jenis_kelamin' => $this->waris->jk,
                'alamat' => $this->waris->alamat,
                'rt' => $this->waris->rt,
                'rw' => $this->waris->rw,
                'kelurahan' => $this->waris->kel,
                'kecamatan' => $this->waris->kec,
                'kota' => $this->waris->kota
        ],
            'nilai'=>$this->nilai,
            'komentar'=> $this->komentar,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
    ];
    }
}
