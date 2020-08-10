<?php

namespace App\Http\Resources;
use App\Http\Resources\WarisResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BerkasResource extends JsonResource
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
            'kd_berkas' => $this->kd_berkas,
            'petugas'=>  $this->petugas ? ['username'=> $this->petugas->username,'nama'=> $this->petugas->nama] : (object)[],
            'dinkes'=> $this->dinkes ? ['username'=>$this->dinkes->username,'nama'=> $this->dinkes->nama] : (object) [],
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
            'ktp_meninggal' => $this->ktp_meninggal,
            'kk_meninggal' => $this->kk_meninggal,
            'jamkesmas' => $this->jamkesmas,
            'ktp_waris' => $this->ktp_waris,
            'kk_waris' => $this->kk_waris,
            'akta_kematian' => $this->akta_kematian,
            'pakta_waris' => $this->pakta_waris,
            'pernyataan_waris'=>$this->pernyataan_ahli_waris,
            'buku_tabungan'=>$this->buku_tabungan,
            'keterangan' => $this->keterangan,
            'keterangan_II' => $this->keterangan_II,
            'date_transfer'=>$this->date_transfer,
            'date_konfirmasi'=>$this->date_konfirmasi,
            'ket_ktp_meninggal' => $this->ket_ktp_meninggal,
            'ket_kk_meninggal' => $this->ket_kk_meninggal,
            'ket_jamkesmas' => $this->ket_jamkesmas,
            'ket_ktp_waris' => $this->ket_ktp_waris,
            'ket_kk_waris' => $this->ket_kk_waris,
            'ket_akta_kematian' => $this->ket_akta_kematian,
            'ket_pakta_waris' => $this->ket_pakta_waris,
            'ket_pernyataan_waris'=>$this->ket_pernyataan_ahli_waris,
            'ket_buku_tabungan'=>$this->ket_buku_tabungan,
            'confirmed_I'=> $this->confirmed_I,
            'confirmed_II'=> $this->confirmed_II,
            
        ];
        //'confirmed_III'=>($this->confirmed_III == 1) ? true : false
    }
}
