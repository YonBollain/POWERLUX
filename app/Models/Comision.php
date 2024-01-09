<?php

namespace App\Models;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comision
 *
 * @property $id
 * @property $producto_id
 * @property $user_id
 * @property $comision
 * @property $created_at
 * @property $updated_at
 *
 * @property Producto $producto
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Comision extends Model
{
    protected $table = 'comisiones';

    static $rules = [
		'producto_id' => 'required',
		'user_id' => 'required',
		'comision' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['producto_id','user_id','comision'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'producto_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }


}
