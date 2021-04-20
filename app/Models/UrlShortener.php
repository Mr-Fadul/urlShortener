<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShortener extends Model
{
    protected $table = "url_shorteners";

    protected $fillable = ['url', 'shortUrl'];

    public $timestamps = true;

    public function encurtarUrl()
    {
        $shortUrl = substr(str_shuffle('123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5);
        $existe = $this->where(['shortUrl' => $shortUrl])->first();
        if ($existe) {
            return $this->encurtarUrl();
        }
        return $shortUrl;
    }
}
