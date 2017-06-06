<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Banners;
use guialocaliza\Categorias;
use guialocaliza\Cidades;
use guialocaliza\Empresas;
use guialocaliza\Estados;
use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;
use Illuminate\Database\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class SiteController extends Controller
{
    public $busca = "";
    private $empresa;
    private $request;
    private $cidadeBase;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $cidBase  = $this->cidadeBase = Cidades::where('active', 1)->get();
        $empresas = Empresas::orderBy('click','desc')->where('logo', '<>', "")->take(10)->get();
        if(isset($_COOKIE['cid_id'])){
            $cidade = Cidades::findOrFail($_COOKIE['cid_id']);
            $empresas = Empresas::orderBy('click','desc')->where('cidade_id', $cidade->id)->where('logo', '<>', "")->take(10)->get();
            return view('site.index', compact('empresas','ufs','cidBase','cidade'));
        }
		return view('site.index', compact('empresas', 'cidBase'));
	}


    public function addEmpresa()
    {
        $cidBase = $this->cidadeBase = Cidades::where('active', 1)->get();
        return view('site.novaempresa',compact('cidbase'));
    }

	public function search(Request $request){
        $cidBase = $this->cidadeBase = Cidades::where('active', 1)->get();
        if($request->busca) {
            $this->busca = trim($request->busca);

            $banners    = Banners::join('empresas','empresas.id','=','banners.empresa_id')
                                    ->where('empresas.cidade_id',$request->cidade)
                                    ->where('plano_id',6)
                                    ->where('active',1)
                                    ->where(function($query){
                                        return $query->where('empresas.tags', 'like', "%" . $this->busca . "%")->orWhere('empresas.name', 'like', "%" . $this->busca . "%");
                                    })
                                    ->limit(5)
                                    ->get();


            $destaques  = Empresas::select('empresas.*')->where('empresas.cidade_id',$request->cidade)
                ->where('empresas.plano_id',6)->where('empresas.active',1)
                ->where(function($query){
                return $query->where('empresas.tags', 'like', "%" . $this->busca . "%")
                ->orWhere('empresas.name', 'like', "%" . $this->busca . "%")
                ->orWhere('categorias.name', 'like', "%" . $this->busca . "%")
                ->orWhere('subcategorias.nome', 'like', "%" . $this->busca . "%");
            })
            ->join('categorias', 'categorias.id', '=', 'empresas.categoria_id')
            ->join('subcategorias', 'subcategorias.id', '=', 'empresas.subcategoria_id')
            ->orderBy('name')
            ->get();

            $todas = Empresas::select('empresas.*')->where('empresas.cidade_id',$request->cidade)
                ->where('empresas.plano_id',4)->where('empresas.active',1)->where(function($query){
                return $query->where('empresas.tags', 'like', "%" . $this->busca . "%")
                    ->orWhere('empresas.name', 'like', "%" . $this->busca . "%")
                    ->orWhere('categorias.name', 'like', "%" . $this->busca . "%")
                    ->orWhere('subcategorias.nome', 'like', "%" . $this->busca . "%");
            })
            ->leftjoin('categorias', 'categorias.id', '=', 'empresas.categoria_id')
            ->leftjoin('subcategorias', 'subcategorias.id', '=', 'empresas.subcategoria_id')
            ->orderBy('name')
            ->paginate(20);

            if(isset($_COOKIE['cid_id'])){
                $cidade = Cidades::findOrFail($_COOKIE['cid_id']);
                return view('site.search', compact('banners', 'destaques', 'todas', 'cidBase','cidade'));
            }

            return view('site.search', compact('banners', 'destaques', 'todas','cidBase'));
        }else{
            return redirect("/");
        }
    }


    public function increment($id){
        Empresas::findOrFail($id)->increment('click');
    }

    public function sendMail(Request $request){

        $this->empresa = Empresas::findOrFail($request->to_empresa);
        $this->request = $request;

        $data = [
          'nome' => $this->request->from_name,
          'email' => $this->request->from_email,
          'phone' => $this->request->from_phone,
          'text' => $this->request->from_Text,
        ];

        return json_encode(Mail::send('site.email', $data, function($message)
        {
            $message->to($this->empresa->email, 'John Smith');
            $message->from($this->request->from_email, $this->request->from_name);
            $message->replyTo($this->request->from_email, $this->request->from_name);
            $message->subject("Guia Localiza");
            $message->getSwiftMessage();
        }));

    }

    public function sugerir(){
        $ufs      = Estados::where('active',1)->get();
        return view('contato.sugerir', compact('ufs'));
    }

    public function sendSugerir(Request $request){
       // $this->empresa = Empresas::findOrFail($request->to_empresa);
        $this->request = $request;

        $data = [
            'nome' => $this->request->nome,
            'email' => $this->request->email,
            'phone' => $this->request->telefone,
            'text' => $this->request->mensagem,
        ];

        if(json_encode(Mail::send('site.email', $data, function($message)
        {
            $message->to('noreply@guialocaliza.com.br', 'John Smith');
            $message->from($this->request->email, $this->request->nome);
            $message->replyTo($this->request->email, $this->request->nome);
            $message->subject("Sugerir Telefone");
            $message->getSwiftMessage();
        }))){
            echo "<script language=\"javascript\">
                    window.alert('Enviado com sucesso, aguarde nosso retorno.')
                    window.location.href='http://guialocaliza.com.br';
                 </script>";
        }

    }

    public function atualizar(){
        $ufs      = Estados::where('active',1)->get();
        return view('contato.atualizar', compact('ufs'));
    }

    public function sendAtualizar(Request $request){
        // $this->empresa = Empresas::findOrFail($request->to_empresa);
        $this->request = $request;

        $data = [
            'nome' => $this->request->nome,
            'email' => $this->request->email,
            'phone' => $this->request->telefone,
            'text' => $this->request->mensagem,
        ];

        if(json_encode(Mail::send('site.email', $data, function($message)
        {
            $message->to('noreply@guialocaliza.com.br', 'John Smith');
            $message->from($this->request->email, $this->request->nome);
            $message->replyTo($this->request->email, $this->request->nome);
            $message->subject("Atualizar Telefone");
            $message->getSwiftMessage();
        }))){
            echo "<script language=\"javascript\">
                    window.alert('Enviado com sucesso, aguarde nosso retorno.')
                    window.location.href='http://guialocaliza.com.br';
                 </script>";
        }

    }

}
