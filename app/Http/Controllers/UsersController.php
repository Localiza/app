<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\User;
use Validator;
use Session;
use Illuminate\Http\Request;

use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Carrega os registro e renderiza a view passando os mesmos.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $usuarios = User::all();
        $titulo = "Usuários";
        return view('users.list', compact('usuarios', 'titulo'));
    }

    /**
     * Renderiza a view
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $titulo = "Novo Usuário";
        return view('users.form', compact('titulo'));
    }


    /**
     * Valida dados do formulário e insere registro no banco.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $user = $request->all();
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $active = (isset($user['active']) ? 1 : 0);
        User::create([
            'name' 		  => $user['name'],
            'email' 	  => $user['email'],
            'password' 	=> bcrypt($user['password']),
            'active'   	=> $active,
        ]);
        Session::flash('type', 'success');
        Session::flash('message', 'Usuário cadastrado com sucesso!');
        return redirect('usuarios');

    }

    /**
     * Carrega registro e renderiza view passando o mesmo.
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $titulo = "Editar Usuário";
        return view('users.form', compact('titulo'))->with('usuario', $usuario);
    }


    /**.
     * Valida dados do formulário e atualiza registro.
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $user = $request->all();
        $validator = $this->validator_edit($request->all(), $id);
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $active = (isset($user['active']) ? 1 : 0);
        $update = [
            'name' 		  => $user['name'],
            'email' 	  => $user['email'],
            'active'   	=> $active
        ];
        if($user['password'] != ""){
            $update['password'] = bcrypt($user['password']);
        }
        User::where('id', $id)->update($update);
        Session::flash('type', 'success');
        Session::flash('message', 'Usuário editado com sucesso!');
        return redirect('usuarios');

    }

    /**
     * Realiza a atualização de ativo do registro.
     * @param $id
     * @param $active
     */
    public function active($id, $active){
        if(User::where('id', $id)->update([
            'active'   	  => $active,
        ])):
            return'Atualizado.';
        endif;
    }

    /**
     * Realiza a deleção do registro.
     * @param $id
     */
    public function destroy($id){
        if(User::where('id', $id)->delete()):
            return'Deletado.';
        endif;
    }

    /**
     * Validação de dados para registro.
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        $messages = [
            'name.required' => 'Por favor infrome seu nome completo.',
            'email.required' => 'Por favor infrome seu e-mail.',
            'email.unique' => 'Já existe um usuário cadastrado com esse e-mail.',
            'password.required' => 'Por favor infrome uma senha.',
            'password.confirmed' => 'As senhas não confere, tente novamente.',
            'password.min' => 'Sua senha deve conter pelo 6 caracteres.',
        ];
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ], $messages);
    }

    /**
     * Validação de dados para edição.
     * @param array $data
     * @param $email_current
     * @return mixed
     */
    protected function validator_edit(array $data, $id)
    {

        $messages = [
            'name.required' => 'Por favor infrome seu nome completo.',
            'email.required' => 'Por favor infrome seu e-mail.',
            'email.unique' => 'Já existe um usuário cadastrado com esse e-mail.',
            'password.confirmed' => 'As senhas não confere, tente novamente.',
            'password.min' => 'Sua senha deve conter pelo 6 caracteres.',
        ];

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$id.',id',
            'password' => 'confirmed|min:6',
        ], $messages);

    }
}
