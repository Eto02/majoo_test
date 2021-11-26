<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Id_ProdukKategori
 * @property int $Id_Produk
 * @property int $Id_Kategori
 * @property MstrProduk $mstrProduk
 * @property MstrKategori $mstrKategori
 */
class ProdukKategori extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'produk_kategori';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Id_ProdukKategori';

    /**
     * @var array
     */
    protected $fillable = ['Id_Produk', 'Id_Kategori'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mstrProduk()
    {
        return $this->belongsTo('App\MstrProduk', 'Id_Produk', 'Id_Produk');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mstrKategori()
    {
        return $this->belongsTo('App\MstrKategori', 'Id_Kategori', 'Id_Kategori');
    }
}
