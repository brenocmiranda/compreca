<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Plataforma;
use App\Models\Imagens;

class PlataformaCtrl extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    // Plataforma
    public function Geral(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_plataforma == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_plataforma == 1){
        	$geral = Plataforma::first();
    	   return view('admin.plataforma.geral')->with('geral', $geral);
        }else{
            return redirect(route('permission'));
        }
    }

    // Configurações
    public function SalvarGeral(Request $request){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_plataforma == 1){
		    // Atualizando registro
        	$geral = Plataforma::find(1)->update([
        		'nome' => $request->nome,
        		'razao_social' => $request->razao_social,
        		'cnpj' => $request->cnpj,
        		'frase_descricao' => $request->frase_descricao,
        		'descricao' => $request->descricao,
        		'cep' => $request->cep, 
	            'endereco' => $request->endereco,
	            'numero' => $request->numero,
	            'complemento' => (isset($request->complemento) ? $request->complemento : null), 
	            'bairro' => (isset($request->bairro) ? $request->bairro : $request->bairro1),
	            'cidade' => (isset($request->cidade) ? $request->cidade : $request->cidade1),
	            'estado' => (isset($request->estado) ? $request->estado : $request->estado1),
        		'telefone' => $request->telefone,
        		'whatsapp' => $request->whatsapp,
        		'email_contato' => $request->email_contato,
        		'email_suporte' => $request->email_suporte,
        		'url_instagram' => $request->url_instagram,
        		'url_facebook' => $request->url_facebook,
        		'url_youtube' => $request->url_youtube,
        	]);
            // Upload Logomarca
            $imagens = (isset($request->logomarca) ? $request->logomarca : null);
            if(!empty($imagens)){
                $nameFile = null;
                if ($request->hasFile('logomarca') && $request->file('logomarca')->isValid()) {
                    $name = uniqid(date('HisYmd'));
                    $extension = $request->logomarca->extension();
                    $nameFile = "{$name}.{$extension}";
                    $upload = $request->logomarca->storeAs('plataforma', $nameFile);
                }                       
                $logomarca = Imagens::create(['caminho' => $upload, 'tipo' => 'logomarca']);   
                $geral = Plataforma::find(1)->update(['logomarca' => $logomarca->id]); 
            }
            // Upload Icone
            $imagens1 = (isset($request->icone) ? $request->icone : null);
            if(!empty($imagens1)){
                $nameFile = null;
                if ($request->hasFile('icone') && $request->file('icone')->isValid()) {
                    $name = uniqid(date('HisYmd'));
                    $extension = $request->icone->extension();
                    $nameFile = "{$name}.{$extension}";
                    $upload = $request->icone->storeAs('plataforma', $nameFile);
                }
                        
                $icone = Imagens::create(['caminho' => $upload, 'tipo' => 'icone']);  
                $geral = Plataforma::find(1)->update(['icone' => $icone->id]);     
            }
    	   return redirect(route('plataforma.geral'));
        }else{
            return redirect(route('permission'));
        }
    }
}
