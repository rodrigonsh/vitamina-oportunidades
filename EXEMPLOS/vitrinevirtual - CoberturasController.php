<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Cobertura;

class CoberturasController extends Controller
{
    public function adminFotos($source, $id)
    {
        $user = Auth::user();
        if ( $user->fotografo == 0 && $user->root == 0)
        {
            die("LIGMA");
        }

        $cobertura = Cobertura::find($id);

        $fotos = $cobertura->listPhotos();

        //dd("fotos/$id/*");
        //dd($fotos);

        return view('admin.fotos', ['fotos'=>$fotos, 'id'=>$id]);

    }

    public function adminUpload(Request $request)
    {
        $user = Auth::user();
        if ( $user->fotografo == 0 && $user->root == 0)
        {
            die("LIGMA");
        }

        // validate
        $originalName = $request->file('foto')->getClientOriginalName();

        //dd($request->file('foto'));

        $id = $request->id;
        $cobertura = Cobertura::find($id);

        if ( $cobertura->diretorio == "" )
        {
            $dir = $cobertura->id;
        } else {
            $dir = $cobertura->diretorio;
        }

        
        $partes = explode('.', $originalName);
        
        $ext = array_pop($partes);
        $ext = strtolower($ext);
        
        if ($ext != "jpg" && $ext != "jpeg")
        {
            return "DAFUQISDIS";
        }

        $newName = implode(".", $partes).".jpg";
        
        $cache_filename = "fotos/$dir/$newName";
        //dd($cache_filename);

        if ( !is_dir("fotos/$dir") )
        {
            mkdir("fotos/$dir");
        }


        

        $pic = imagecreatefromjpeg($request->file('foto')->getRealPath());
        
        if ( ! $pic )
        {
            dd("generic image");
        }
        
        $wAtual = imagesx($pic); // Largura da imagem
        $hAtual = imagesy($pic); // Altura da imagem
        
        //print "<p>Atual: $wAtual w x $hAtual h	</p>";
        
        // Proporcial em relacao à altura
        $hFinal = 915;
        $wFinal = $hFinal * $wAtual / $hAtual;
        
        $thumb = @imagecreatetruecolor ($wFinal, $hFinal) or die ("Can't create Image!");
        imagecopyresampled($thumb, $pic, 0, 0, 0, 0, $wFinal, $hFinal, $wAtual, $hAtual);

        if ( $cobertura->carimbar == 1 )
        {

            if ( is_file("carimbos/{$user->id}.png") )
            {
                // TODO: dar uma forma de não carregar se for antigo
                $marca = imagecreatefrompng("carimbos/{$user->id}.png");
                $tam_marca = getimagesize("carimbos/{$user->id}.png");
            }
            else
            {
                $marca = imagecreatefrompng("marca.png");
                $tam_marca = getimagesize('marca.png');
            }
            
            
            $marca_width = $tam_marca[0];
            $marca_height = $tam_marca[1];
            $padding = 20;
    
            $dst_x = ($wFinal / 2) - ($marca_width / 2);
            $dst_y = $hFinal - $padding - $marca_height;
            
            imagecopy ( $thumb , $marca , $dst_x , $dst_y , 0 , 0 , $marca_width , $marca_height );
        }
        
        
        imageinterlace($thumb,1);
       
        ImageJPEG($thumb, $cache_filename, 80);
        
        return "OK";
        
    }

    public function adminApagaFoto(Request $request)
    {
        $user = Auth::user();
        if ( $user->fotografo == 0 && $user->root == 0)
        {
            die("LIGMA");
        }

        $id = $request->id;
        $fname = $request->fname;

        if ( substr_count($fname, "../") > 0 )
        {
            die("LIGMA");
        }

        $teste = "/fotos/$id/";

        //dd($teste, $fname,  strpos($fname, $teste));

        if ( strpos($fname, $teste) === 0)
        {   
            unlink(substr($fname, 1));
            return "OK";
        }
        
        die("LIGMA");

    }


    public function thumb($dir, $file)
    {

        // TODO: autoclean cache

        $cache_filename = "cache/$dir-$file";
        if ( is_file($cache_filename) )
        {
            $contents = file_get_contents($cache_filename);
            return response($contents)
                ->header('Content-Type', 'application/octet-stream');
        }  

        $pic = imagecreatefromjpeg("fotos/$dir/$file");
        
        if ( ! $pic )
        {
            return "generic image";
        }

        $wAtual = imagesx($pic); // Largura da imagem
        $hAtual = imagesy($pic); // Altura da imagem

        //print "<p>Atual: $wAtual w x $hAtual h	</p>";

        // Proporcial em relacao à altura
        $hFinal = 220;
        $wFinal = $hFinal * $wAtual / $hAtual;

        $thumb = @imagecreatetruecolor ($wFinal, $hFinal) or die ("Can't create Image!");
        imagecopyresampled($thumb, $pic, 0, 0, 0, 0, $wFinal, $hFinal, $wAtual, $hAtual);

        imageinterlace($thumb,1);

        ImageJPEG($thumb, $cache_filename, 80);

        $contents = file_get_contents($cache_filename);
        return response($contents)
            ->header('Content-Type', 'application/octet-stream');



    }

    public function enviarCarimbo(Request $req)
    {
        
        $user = Auth::user();
        
        if ( $user->fotografo == 0 && $user->root == 0)
        {
            die("LIGMA");
        }

        $novoNome = $user->id.".".$req->carimbo->extension();
        
        $req->carimbo->storeAs("", $novoNome, 'carimbos');

    }


    public function excluirCarimbo()
    {
        
        $user = Auth::user();
        if ( $user->fotografo == 0 && $user->root == 0)
        {
            die("LIGMA");
        }
        
        if( is_file("carimbos/{$user->id}.png") )
        {
            unlink("carimbos/{$user->id}.png");
        }

        return "OK";

    }

    public function migrar()
    {
        
        die("migration disabled");

        require "festas.php";
        require "Encoding.php";

        //dd($festas[1000]);

        $inicio = new Carbon('first day of January 2018', 'America/Vancouver');

        
        $vai = 0;
        $naovai = 0;

        $fotografos = 
        [
	
            "Anderson Gallo" => 3,
            "andersongallo19" => 3,
            "Johonie Midon" => 6 , 
            "johoniemidon" => 6 ,
            "Pedro Cleve" => 4,
            "pedrocleve" => 4,
            "Juan Galeano" => 5, 
            "juangaleano_" => 5
            
        ];
        
        
        foreach($festas as $f)
        {
            $d = new Carbon($f['data']);

            if ( ! $d->greaterThan($inicio) )
            {
                continue;
            }

            if ( $f['diretorio'] == "" )
            {
                continue;
            }

            $data = new Carbon($f['data']);

            $cobertura = new Cobertura();
            $cobertura->nome = \ForceUTF8\Encoding::fixUTF8($f['nome']);
            $cobertura->diretorio = \ForceUTF8\Encoding::fixUTF8($f['diretorio']);
            $cobertura->tag = $f['tag'];
            $cobertura->data = $f['data'];
            $cobertura->hora = $data->toTimeString();
            $cobertura->password = $f['password'];

            if ( $f['area'] == '5003207' )
            {
                // corumba
                $cobertura->local_id = 2;
            }
            else
            {
                // ladario
                $cobertura->local_id = 3;
            }


            if ( strpos($f['fotografo'], "/") )
            {
                $partes = explode("/", $f['fotografo']);
            }
            else
            {
                $partes = explode("-", $f['fotografo']);
            }

            $kensku = trim($partes[0]);
            if ( isset($fotografos[$kensku]) )
            {
                $cobertura->user_id = $fotografos[$kensku];
            }
            else
            {
                $cobertura->user_id = 1;
            }

            

            $cobertura->save();

        }

        dd( "VAI $vai, NAO VAI $naovai" );
    }

}
