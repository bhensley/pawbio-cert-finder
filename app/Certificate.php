<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'certificates';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['po', 'part', 'certificate_file', 'lot', 'uploaded_by'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
