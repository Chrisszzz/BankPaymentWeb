<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomponenPembayaran extends Model
{
    protected $table="komponen_pembayaran";
	protected $primaryKey="id_komponen_pembayaran";

	public static function getKomponenPembayaran($request)
	{
		$data = KomponenPembayaran::all();
		return $data;
	}
	public static function getEditKomponenPembayaran($id_komponen_pembayaran)
	{
		$data = KomponenPembayaran::where('id_komponen_pembayaran',$id_komponen_pembayaran)
		->get();
		return $data;
	}
}
