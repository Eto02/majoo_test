<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Id_Produk
 * @property int $Id_Kategori
 * @property string $Nama_Produk
 * @property int $Harga_Produk
 * @property string $Deskripsi_Produk
 * @property string $Foto_Produk
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property string $updated_at
 * @property MstrKategori $mstrKategori
 */
class Produk extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'mstr_produk';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Id_Produk';

    /**
     * @var array
     */
    protected $fillable = ['Id_Kategori', 'Nama_Produk', 'Harga_Produk', 'Deskripsi_Produk', 'Foto_Produk', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mstrKategori()
    {
        return $this->belongsTo('App\MstrKategori', 'Id_Kategori', 'Id_Kategori');
    }
}
