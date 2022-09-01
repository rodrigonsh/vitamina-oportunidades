<?php

namespace App\Models;

use App\Models\Local;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CoberturaModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 
        'local_id', 
        'tag', 
        'data',
        'hora',
        'password',
        'carimbar'
    ];

    protected $hidden = 
    [
        'password',
        'local_id',
        'user_id',
        'created_at',
        'updated_at',
        'diretorio',
        'hora'
    ];

    public function getFotosAttribute()
    {

        $glob = $this->listPhotos();

        return count($glob)." fotos";
    }

    public function getFotoAttribute()
    {
        $glob = $this->listPhotos();
        if ( count($glob) > 0 )
        {
            return "/thumbs".substr($glob[0], 5 );
        }
    }

    public function getIsParticularAttribute()
    {
        return ( $this->password != "" ) ? true : false;
    }

    public function listPhotos()
    {
        if ( $this->diretorio == "" )
        {
            $glob = glob("fotos/".$this->id."/*.jpg");
        } else {
            $glob = glob("fotos/".$this->diretorio."/*.jpg");
        }
        return $glob;
    }

    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    static function items()
    {
        $user = Auth::user();
        if ( $user->root ) return self::orderByDesc("id")->get();
        else return self::where('user_id', $user->id)->orderByDesc("id")->get();
    }


    public function gimme($key)
    {
        return $this->$key;
    }

    static function crud()
    {

        return [
            "source" => "coberturas",
            "nome" => "Coberturas",
            "icon" => "📸",
            "cols" =>
            [
                "nome", 
                "data", 
                "local", 
                "fotos" =>
                [
                    "link" => "/admin/cobertura/:id/fotos"
                ]
            ],
            "model" =>
            [
                "nome" => [ "label"=>"Nome", "class"=>"long", "required" => true ],
                "local_id" => [ "type" => "foreign" , "source" => "locais", "label" => "Local" ],
                "data" => [ "type" => "date" ],
                "hora" => [ "type" => "time" ],
                "tag" => 
                [
                    "type"=>"select" , 
                    "options" => self::categorias()
                ],
                "password" => [ "label" => "Senha" ] ,
                "instagram" => [ "label" => "Instagram" ],
                "carimbar" => [
                    "type" => "checkbox",
                    "label" => "Carimbar automaticamente"
                ]
            ]
        ];
    }

    static function categorias()
    {
        return [
            'aniversarios' => "Aniversários",
            'casamentos' => "Casamentos", 
            'batizados' => "Batizados",
            'baladas' => "Baladas",
            'ensaios' => "Ensaios",
            'geral' => "Outros",
            'carnaval' => "Carnaval"
        ];
    }

    public function crudSetUser()
    {
        $user = Auth::user();
        $this->user_id = $user->id;
    }

    public function crudBeforeFill()
    {
        $this->carimbar = 0;
    }

}
