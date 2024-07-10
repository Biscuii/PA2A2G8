<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [

        'bien_immobilier_id', 'voyageur_id','date_debut', 'date_fin' // on voit pr ajouter +
    ];
    public function bienImmobilier()
    {
        return $this->belongsTo(BienImmobilier::class, 'bien_immobilier_id');
    }

    public function voyageur()
    {
        return $this->belongsTo(Voyageur::class, 'voyageur_id');
    }

}
