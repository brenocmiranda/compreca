<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Atividades;
use App\Models\PagNavbar;
use App\Models\PagMenu;
use App\Models\PagSlider;
use App\Models\PagSections;
use App\Models\PagSectionsCard;
use App\Models\PagFooter;
use App\Models\Categorias;
use App\Models\Produtos;
use App\Models\Marcas;
use App\Models\Lojas;
use App\Models\Instituicoes;
use App\Models\Imagens;

class MarketplaceCtrl extends Controller
{	
	public function __construct(){
        $this->middleware('admin');
    }

    // Listando navbar
    public function ExibirNavbar(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_pagina == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_pagina == 1){
            $navbar = PagNavbar::find(1);
            return view('admin.marketplace.navbar')->with('navbar', $navbar);
        }else{
            return redirect(route('permission'));
        } 
    }
    // Salvando navbar
    public function SalvarNavbar(Request $request){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_pagina == 1){
            $navbar = PagNavbar::first();
            if(!isset($navbar)){
                PagNavbar::create([
                    'mensagem' => (isset($request->mensagem) ? $request->mensagem : null),
                    'facebook' => (isset($request->facebook) ? $request->facebook : null), 
                    'instagram' => (isset($request->instagram) ? $request->instagram : null), 
                    'youtube' => (isset($request->youtube) ? $request->youtube : null), 
                    'search' => (isset($request->search) ? $request->search : null), 
                    'status' => (isset($request->status) ? 1 : 0), 
                ]);
            }else{
                PagNavbar::find(1)->update([
                    'mensagem' => (isset($request->mensagem) ? $request->mensagem : null),
                    'facebook' => (isset($request->facebook) ? $request->facebook : null), 
                    'instagram' => (isset($request->instagram) ? $request->instagram : null), 
                    'youtube' => (isset($request->youtube) ? $request->youtube : null), 
                    'search' => (isset($request->search) ? $request->search : null), 
                    'status' => (isset($request->status) ? 1 : 0), 
                ]);
            }
            
            \Session::flash('confirm', array(
                'class' => 'success',
                'mensagem' => 'Informações alteradas com sucesso.'
            ));

            Atividades::create([
                'nome' => 'Atualização do marketplace',
                'descricao' => 'Você atualizou a navbar do marketplace',
                'icone' => 'mdi-sync',
                'url' => route('exibir.navbar.marketplace'),
                'id_usuario' => Auth::guard('admin')->id()
            ]);
            return redirect(route('exibir.navbar.marketplace'));
        }else{
            return redirect(route('permission'));
        }     
    }


    // Listando menu
    public function ExibirMenu(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_pagina == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_pagina == 1){
            $menu = PagMenu::where('status', 1)->get();
            return view('admin.marketplace.menu')->with('menu', $menu);
        }else{
            return redirect(route('permission'));
        } 
    }
    // Adicionando menu
    public function AdicionarMenu(Request $request){
        PagMenu::create([
            'nome' => $request->nome,
            'tagName' => $request->tagName
        ]);
        return response()->json(['sucess' => true]);
    }
    // Editando menu
    public function EditarMenu(Request $request, $id){
        PagMenu::find($id)->update([
            'nome' => $request->nome,
            'tagName' => $request->tagName
        ]);
        return response()->json(['sucess' => true]);
    }
    // Deletando menu
    public function RemoverMenu($id){
        PagMenu::find($id)->update(['status' => 0]);
        return response()->json(['sucess' => true]);
    }
    // Detalhes do menu
    public function DetalhesMenu($id){
        $menu = PagMenu::find($id);
        return $menu;
    }


    // Listando sliders
    public function ExibirSlider(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_pagina == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_pagina == 1){
            $slider = PagSlider::where('status', 1)->get();
            return view('admin.marketplace.slider')->with('slider', $slider);
        }else{
            return redirect(route('permission'));
        } 
    }
    //  Salvando sliders
    public function SalvarSlider(Request $request){
        foreach($request->tagName as $key => $slider) {
           if(isset($request->id[$key])){
                PagSlider::find($request->id[$key])->update([
                    'title' => (isset($request->title[$key]) ? $request->title[$key] : null),
                    'text' => (isset($request->text[$key]) ? $request->text[$key] : null),
                    'text_button' => (isset($request->text_button[$key]) ? $request->text_button[$key] : null),
                    'tagName' => (isset($request->tagName[$key]) ? $request->tagName[$key] : null),
                    'escurecer' => (isset($request->escurecer[$key]) ? $request->escurecer[$key] : null),
                ]);

                $imagens = (isset($request->id_imagem[$key]) ? $request->id_imagem[$key] : null);
                if(!empty($imagens)){
                    $nameFile = null;
                    if ($request->hasFile('id_imagem.'.$key) && $request->file('id_imagem.'.$key)->isValid()) {
                        $name = uniqid(date('HisYmd'));
                        $extension = $request->id_imagem[$key]->extension();
                        $nameFile = "{$name}.{$extension}";
                        $upload = $request->id_imagem[$key]->storeAs('sliders', $nameFile);
                        $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'sliders']);
                        PagSlider::find($request->id[$key])->update(['id_imagem' => $imagem->id]);
                    }
                }
           }else{
                $new = PagSlider::create([
                    'title' => (isset($request->title[$key]) ? $request->title[$key] : null),
                    'text' => (isset($request->text[$key]) ? $request->text[$key] : null),
                    'text_button' => (isset($request->text_button[$key]) ? $request->text_button[$key] : null),
                    'tagName' => (isset($request->tagName[$key]) ? $request->tagName[$key] : null),
                    'escurecer' => (isset($request->escurecer[$key]) ? $request->escurecer[$key] : null),
                ]);

                $imagens = (isset($request->id_imagem[$key]) ? $request->id_imagem[$key] : null);
                if(!empty($imagens)){
                    $nameFile = null;
                    if ($request->hasFile('id_imagem.'.$key) && $request->file('id_imagem.'.$key)->isValid()) {
                        $name = uniqid(date('HisYmd'));
                        $extension = $request->id_imagem[$key]->extension();
                        $nameFile = "{$name}.{$extension}";
                        $upload = $request->id_imagem[$key]->storeAs('sliders', $nameFile);
                        $imagem = Imagens::create(['caminho' => $upload, 'tipo' => 'sliders']);
                        PagSlider::find($new->id)->update(['id_imagem' => $imagem->id]);
                    }
                }
           }
        }
        return redirect(route('exibir.slider.marketplace'));
    }  
    //  Desativando os sliders
    public function RemoverSlider($id){
        PagSlider::find($id)->update(['status' => 0]);
        return response()->json(['success' => true]);
    }


    // Listando sections
    public function ExibirSections(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_pagina == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_pagina == 1){
	         $sections = PagSections::where('status', 1)->get();
             $cards = PagSectionsCard::where('status', 1)->get();
            return view('admin.marketplace.sections')->with('sections', $sections)->with('cards', $cards);
        }else{
            return redirect(route('permission'));
        } 
    }
    // Salvando sections
    public function SalvarSections(Request $request){ 
        $categorias = $request->id_categoria;
        $produtos = $request->id_produto;
        $marcas = $request->id_marca;
        $instituicoes = $request->id_instituicoes;
        $lojas = $request->id_loja;
    
        foreach ($request->section as $key => $value) {
            if(isset($request->title[$key])){
                // Inserindo ou alterando as sections
                if(isset($request->id[$key])){
                    $update = PagSections::find($request->id[$key])->update([
                        'section' => $request->section[$key],
                        'background' => $request->background[$key],
                        'title' => $request->title[$key],
                        'carousel' => ($request->carousel[$key] == 'on' ? 1 : 0),
                        'qtdCarousel' => (isset($request->qtdCarousel[$key]) ? $request->qtdCarousel[$key] : null),
                        'container' => ($request->container[$key] == 'on' ? 1 : 0),
                        'style' => $request->style[$key],
                        'width_card' => $request->width_card[$key],
                        'height_card' => $request->height_card[$key],
                        'style_card' => (isset($request->style_card[$key]) ? $request->style_card[$key] : null),
                        'type' => $request->type[$key],
                    ]);
                }else{
                    $create = PagSections::create([
                        'section' => $request->section[$key],
                        'background' => $request->background[$key],
                        'title' => $request->title[$key],
                        'carousel' => ($request->carousel[$key] == 'on' ? 1 : 0),
                        'qtdCarousel' => (isset($request->qtdCarousel[$key]) ? $request->qtdCarousel[$key] : null),
                        'container' => ($request->container[$key] == 'on' ? 1 : 0),
                        'style' => $request->style[$key],
                        'width_card' => $request->width_card[$key],
                        'height_card' => $request->height_card[$key],
                        'style_card' => (isset($request->style_card[$key]) ? $request->style_card[$key] : null),
                        'type' => $request->type[$key],
                    ]);
                }          

                // Inserindo novos cards
                if($request->type[$key] == 'categorias' && isset($categorias)){
                    if(isset($request->id[$key])){
                        PagSectionsCard::where('section', $request->id[$key])->delete();  
                    }
                    for ($i = 0; $i < $request->qtd_card[$key]; $i++) {

                        $dados = PagSectionsCard::create([
                            'section' => (isset($request->id[$key]) ? $request->id[$key] : $create->id),
                            'tagName' => (isset($request->tagName[$i]) ? $request->tagName : null),
                            'title_card' => (isset($request->title_card[$i]) ? $request->title_card[$i] : null),
                            'text_card' => (isset($request->text_card[$i]) ? $request->text_card[$i] : null),
                            'button_card' => (isset($request->button_card[$i]) ? $request->button_card[$i] : null),
                            'width_card' => $request->width_cardC[$i],
                            'height_card' => $request->height_cardC[$i],
                            'style_card' => (isset($request->style_card[$i]) ? $request->style_card[$i] : null),
                            'id_categoria' => $categorias[$i],
                        ]);
                    }
                    array_splice($categorias, 1, $i);
                }elseif($request->type[$key] == 'produtos' && isset($produtos)){
                    if(isset($request->id[$key])){
                        PagSectionsCard::where('section', $request->id[$key])->delete();  
                    }
                    for ($i = 0; $i < $request->qtd_card[$key]; $i++) {
                        $dados = PagSectionsCard::create([
                            'section' => (isset($request->id[$key]) ? $request->id[$key] : $create->id),
                            'tagName' => (isset($request->tagName[$i]) ? $request->tagName : null),
                            'title_card' => (isset($request->title_card[$i]) ? $request->title_card[$i] : null),
                            'text_card' => (isset($request->text_card[$i]) ? $request->text_card[$i] : null),
                            'button_card' => (isset($request->button_card[$i]) ? $request->button_card[$i] : null),
                            'width_card' => $request->width_cardP[$i],
                            'height_card' => $request->height_cardP[$i],
                            'style_card' => (isset($request->style_card[$i]) ? $request->style_card[$i] : null),
                            'id_produto' => $produtos[$i],
                        ]);
                    }
                    array_splice($produtos, 1, $i);
                }elseif($request->type[$key] == 'marcas' && isset($marcas)){
                    if(isset($request->id[$key])){
                        PagSectionsCard::where('section', $request->id[$key])->delete();  
                    }
                    for ($i = 0; $i < $request->qtd_card[$key]; $i++) {
                        $dados = PagSectionsCard::create([
                            'section' => (isset($request->id[$key]) ? $request->id[$key] : $create->id),
                            'tagName' => (isset($request->tagName[$i]) ? $request->tagName : null),
                            'title_card' => (isset($request->title_card[$i]) ? $request->title_card[$i] : null),
                            'text_card' => (isset($request->text_card[$i]) ? $request->text_card[$i] : null),
                            'button_card' => (isset($request->button_card[$i]) ? $request->button_card[$i] : null),
                            'width_card' => $request->width_cardM[$i],
                            'height_card' => $request->height_cardM[$i],
                            'style_card' => (isset($request->style_card[$i]) ? $request->style_card[$i] : null),
                            'id_marca' => $marcas[$i],
                        ]);
                    }
                    array_splice($marcas, 1, $i);
                }elseif($request->type[$key] == 'instituicoes' && isset($instituicoes)){
                    if(isset($request->id[$key])){
                        PagSectionsCard::where('section', $request->id[$key])->delete();  
                    }
                    for ($i = 0; $i < $request->qtd_card[$key]; $i++) {
                        $dados = PagSectionsCard::create([
                            'section' => (isset($request->id[$key]) ? $request->id[$key] : $create->id),
                            'tagName' => (isset($request->tagName[$i]) ? $request->tagName : null),
                            'title_card' => (isset($request->title_card[$i]) ? $request->title_card[$i] : null),
                            'text_card' => (isset($request->text_card[$i]) ? $request->text_card[$i] : null),
                            'button_card' => (isset($request->button_card[$i]) ? $request->button_card[$i] : null),
                            'width_card' => $request->width_cardI[$i],
                            'height_card' => $request->height_cardI[$i],
                            'style_card' => (isset($request->style_card[$i]) ? $request->style_card[$i] : null),
                            'id_instituicoes' => $instituicoes[$i],
                        ]);
                    }
                    array_splice($instituicoes, 1, $i);
                }elseif($request->type[$key] == 'lojas' && isset($lojas)){
                    if(isset($request->id[$key])){
                        PagSectionsCard::where('section', $request->id[$key])->delete();  
                    }
                    for ($i = 0; $i < $request->qtd_card[$key]; $i++) {
                        $dados = PagSectionsCard::create([
                            'section' => (isset($request->id[$key]) ? $request->id[$key] : $create->id),
                            'tagName' => (isset($request->tagName[$i]) ? $request->tagName : null),
                            'title_card' => (isset($request->title_card[$i]) ? $request->title_card[$i] : null),
                            'text_card' => (isset($request->text_card[$i]) ? $request->text_card[$i] : null),
                            'button_card' => (isset($request->button_card[$i]) ? $request->button_card[$i] : null),
                            'width_card' => $request->width_cardL[$i],
                            'height_card' => $request->height_cardL[$i],
                            'style_card' => (isset($request->style_card[$i]) ? $request->style_card[$i] : null),
                            'id_loja' => $lojas[$id],
                        ]);
                    }
                    array_splice($lojas, 1, $i);
                }elseif($request->type[$key] == 'outros'){
                }
            }
        }
        return redirect(route('exibir.sections.marketplace'));
    }
    // Listando os cards
    public function ListarOpcoes($tipo, $id_section){ 
        if($tipo == 'categorias'){
            $categorias = Categorias::where('status', 1)->whereNull('id_loja')->get();
            foreach ($categorias as $key => $categoria) {
                $checkbox = rand();
                $card[] = '<div class="card border"> <div class="card-header p-0" style="height: 197px;background-size:100% 100%;background-image:url('.asset('storage/app').'/'.$categoria->RelationImagens->caminho.')"> </div> <div class="card-body text-center"> <h6>'.$categoria->nome.'</h6> <hr> <div class="custom-control custom-checkbox mx-auto"> <input type="checkbox" id="customCheckC'.$checkbox.'" name="id_categoria[]" class="custom-control-input" value="'.$categoria->id.'" '.(isset($categoria->RelationSectionsCard) && 
                    $categoria->RelationSectionsCard->section == $id_section ? 'checked' : '').' onChange="change(this)"> <label class="custom-control-label" for="customCheckC'.$checkbox.'">Mostrar na home</label> </div> </div> </div>'; }
            return response()->json(['card' => $card]);
        }elseif($tipo == 'produtos'){
            $produtos = Produtos::where('status', 1)->get();
            foreach ($produtos as $key => $produto) {
                $checkbox = rand();
                $card[] = '<div class="card border"> <div class="card-header p-0" style="height: 197px;background-size:100% 100%;background-image:url('.asset('storage/app').'/'.$produto->RelationImagensPrincipal->first()->caminho.'"> </div> <div class="card-body text-center"> <h6 class="mb-0">'.substr($produto->nome, 0, 40).'</h6> '.($produto->preco_promocional ? '<label class="mb-0"><small class="text-danger" style="text-decoration: line-through">R$ '.number_format($produto->preco_venda,2,",",".").'</small></label> <b>R$ '.number_format($produto->preco_promocional,2,",",".").'</b>' : 'R$ '.number_format($produto->preco_venda,2,",",".")).'<hr> <div class="custom-control custom-checkbox mx-auto"> <input type="checkbox" id="customCheckP'.$checkbox.'" name="id_produto[]" class="custom-control-input" value="'.$produto->id.'" '.(isset($produto->RelationSectionsCard) && $produto->RelationSectionsCard->section == $id_section ? 'checked' : '').' onChange="change(this)"> <label class="custom-control-label" for="customCheckP'.$checkbox.'" >Mostrar na home</label> </div> </div> </div> '; 
            }
            return response()->json(['card' => $card]);
        }elseif($tipo == 'marcas'){
            $marcas = Marcas::where('status', 1)->get();
            foreach ($marcas as $key => $marca) {
                $checkbox = rand();
                $card[] = '<div class="card border"> <div class="card-header p-0" style="height: 197px;background-size:100% 100%;background-image:url('.asset('storage/app').'/'.$marca->RelationImagens->caminho.')"> </div> <div class="card-body text-center"> <h6>'.$marca->nome.'</h6> <hr> <div class="custom-control custom-checkbox mx-auto"> <input type="checkbox" id="customCheckM'.$checkbox.'" name="id_marca[]" class="custom-control-input" value="'.$marca->id.'" '.(isset($marca->RelationSectionsCard) && $marca->RelationSectionsCard->section == $id_section ? 'checked' : '').' onChange="change(this)"> <label class="custom-control-label" for="customCheckM'.$checkbox.'">Mostrar na home</label> </div> </div> </div>';
            }
            return response()->json(['card' => $card]);
        }elseif($tipo == 'instituicoes'){
            $checkbox = rand();
            $instituicoes = Instituicoes::where('status', 1)->get();
            foreach ($instituicoes as $key => $instituicao) {
                $card[] = '<div class="card border"> <div class="card-header p-0 m-auto" style="height: 197px;background-size:75% 50%;background-image:url('.asset('storage/app').'/'.$instituicao->RelationLogomarca->caminho.');    background-position: center; background-repeat: no-repeat;"> </div> <div class="card-body text-center"> <h6 class="mb-0">'.$instituicao->nome.'</h6> <label class="mb-0">'.$instituicao->razao_social.'</label> <hr><div class="custom-control custom-checkbox mx-auto"> <input type="checkbox" id="customCheckI'.$checkbox.'" name="id_instituicoes[]" class="custom-control-input" value="'.$instituicao->id.'" '.(isset($instituicao->RelationSectionsCard) && $instituicao->RelationSectionsCard->section == $id_section ? 'checked' : '').' onChange="change(this)"> <label class="custom-control-label" for="customCheckI'. $checkbox.'">Mostrar na home</label> </div> </div> </div>'; 
            }
            return response()->json(['card' => $card]);
        }elseif($tipo == 'lojas'){
            $lojas = Lojas::where('status', 1)->get();
            foreach ($lojas as $key => $loja) {
                $checkbox = rand();
                $card[] = '<div class="card border"> <div class="card-header p-0" style="height: 197px;"> <div class="w-100 position-absolute" style="background-image: url('.asset('storage/app').'/'.$loja->RelationImagens->caminho.');  background-size: cover; background-position: center; height: 197px"></div> <img src="'.asset('storage/app').'/'.$loja->RelationLogomarca->caminho.'" class="position-relative m-auto w-75 h-75"> </div> <div class="card-body text-center"> <h6 class="mb-0">'.$loja->nome.'</h6> <label class="mb-0">'.$loja->razao_social.'</label> <hr> <div class="custom-control custom-checkbox mx-auto"> <input type="checkbox" id="customCheckL'. $checkbox.'" name="id_loja[]" class="custom-control-input" value="'.$loja->id.'" '.(isset($loja->RelationSectionsCard) && $loja->RelationSectionsCard->section == $id_section ? 'checked' : '').' onChange="change(this)"> <label class="custom-control-label" for="customCheckL'.$checkbox.'">Mostrar na home</label> </div> </div> </div>'; 
            }
            return response()->json(['card' => $card]);
        }elseif($tipo == 'outros'){
            return response()->json(['card' => '']);
        } 
    }
    // Removendo alguma da seções
    public function RemoverSections($id){
        PagSectionsCard::where('section', $id)->delete();
        PagSections::find($id)->delete();
        return response()->json(['success' => true]);
    }


    // Listando footer
    public function ExibirFooter(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_pagina == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_pagina == 1){
            $footer = PagFooter::where('status', 1)->get();
            return view('admin.marketplace.footer')->with('footer', $footer);
        }else{
            return redirect(route('permission'));
        } 
    }
    // Salvando footer
    public function SalvarFooter(){

    }

}
