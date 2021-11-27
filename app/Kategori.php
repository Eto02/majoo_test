<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $Id_Kategori
 * @property string $Nama_Kategori
 * @property string $Kode_Kategori
 * @property string $Created_By
 * @property string $Created_Date
 * @property string $Modified_By
 * @property string $Modified_Date
 * @property string $updated_at
 * @property ProdukKategori[] $produkKategoris
 */
class Kategori extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'mstr_kategori';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'Id_Kategori';

    /**
     * @var array
     */
    protected $fillable = ['Nama_Kategori', 'Kode_Kategori', 'Created_By', 'Created_Date', 'Modified_By', 'Modified_Date', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produkKategoris()
    {
        return $this->hasMany('App\ProdukKategori', 'Id_Kategori', 'Id_Kategori');
    }
}
