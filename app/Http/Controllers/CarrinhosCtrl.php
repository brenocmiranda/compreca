<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Pedidos;
use App\Models\Status;
use App\Models\PedidosStatus;
use App\Models\PedidosProdutos;

class CarrinhosCtrl extends Controller
{   
    public function __construct(){
        $this->middleware('admin');
    }
    
    // Lista categoria
    public function Exibir(){
        if(Auth::guard('admin')->user()->RelationGrupo->ver_carrinhos == 1 || Auth::guard('admin')->user()->RelationGrupo->edit_carrinhos == 1){
            $carrinhos = Pedidos::whereNotIn('id', PedidosStatus::select('id_pedido')->get())->count();
            return view('admin.carrinhos.lista')->with('carrinhos', $carrinhos);
        }else{
            return redirect(route('permission'));
        }  
    }
    public function Lista(){
        if(Auth::guard('admin')->user()->id_grupo == 1){
           return datatables()->of(PedidosProdutos::join('pedidos', 'pedidos.id', 'id_pedido')->join('produtos', 'produtos.id', 'id_produto')->join('lojas', 'lojas.id', 'produtos.id_loja')->select('pedidos.*')->get())
                    ->editColumn('cliente', function(Pedidos $dados){ 
                        return '<a href="'.route('detalhes.carrinhos', $dados->id).'" id="detalhes"><p class="nome_pedido mb-0 text-capitalize">'.strtolower($dados->RelationClientes->nome).'</p></a></div></a>';
                    })
                    ->editColumn('data', function(Pedidos $dados){
                        return '<div>'.date_format($dados->created_at, "d/m/Y H:i:s").'</div><div class="font-weight-bold">'.$dados->created_at->subMinutes(2)->diffForHumans().'</div>';
                    })
                    ->editColumn('valor', function(Pedidos $dados){
                        return 'R$ '.number_format($dados->valor_total, 2, ',', '.');
                    })
                    ->editColumn('acoes', function(Pedidos $dados){ 
                       return '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('detalhes.carrinhos', $dados->id).'">
                                    <i class="mdi mdi-clipboard-text-outline"></i> Mais detalhes
                                </a> 
                                <a class="dropdown-item has-icon" href="'.route('editar.leads', $dados->id).'">
                                    <i class="mdi mdi-cart-outline"></i> Retornar ao carrinho
                                </a> 
                                <a class="dropdown-item has-icon" href="'.route('editar.leads', $dados->id).'">
                                    <i class="mdi mdi-email"></i> Disparar e-mail
                                </a> 
                            </div>';
                    })->rawColumns(['cliente', 'data', 'valor', 'acoes'])->make(true); 
        }else{
            return datatables()->of(Pedidos::whereNotIn('id', PedidosStatus::select('id_pedido')->get())->get())
                    ->editColumn('cliente', function(Pedidos $dados){ 
                        return '<a href="'.route('detalhes.carrinhos', $dados->id).'" id="detalhes"><p class="nome_pedido mb-0 text-capitalize">'.strtolower($dados->RelationClientes->nome).'</p></a></div></a>';
                    })
                    ->editColumn('data', function(Pedidos $dados){
                        return '<div>'.date_format($dados->created_at, "d/m/Y H:i:s").'</div><div class="font-weight-bold">'.$dados->created_at->subMinutes(2)->diffForHumans().'</div>';
                    })
                    ->editColumn('valor', function(Pedidos $dados){
                        return 'R$ '.number_format($dados->valor_total, 2, ',', '.');
                    })
                    ->editColumn('acoes', function(Pedidos $dados){ 
                       return '<button class="btn btn-outline-secondary shadow-none dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-cog"></i></button>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;"> 
                                <a class="dropdown-item has-icon" href="'.route('detalhes.carrinhos', $dados->id).'">
                                    <i class="mdi mdi-clipboard-text-outline"></i> Mais detalhes
                                </a> 
                                <a class="dropdown-item has-icon" href="'.route('editar.leads', $dados->id).'">
                                    <i class="mdi mdi-cart-outline"></i> Retornar ao carrinho
                                </a> 
                                <a class="dropdown-item has-icon" href="'.route('editar.leads', $dados->id).'">
                                    <i class="mdi mdi-email"></i> Disparar e-mail
                                </a> 
                            </div>';
                    })->rawColumns(['cliente', 'data', 'valor', 'acoes'])->make(true); 

        }
    }

    // Detalhes do pedido
    public function Detalhes($id){
        if(Auth::guard('admin')->user()->RelationGrupo->edit_carrinhos == 1){
            $pedido = Pedidos::find($id);
            $status = Status::all();
            return view('admin.carrinhos.detalhes')->with('pedido', $pedido)->with('status', $status);
        }else{
            return redirect(route('permission'));
        }
        
    }
}
