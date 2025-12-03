<?php

namespace app\controller;

use app\database\builder\InsertQuery;
use app\database\builder\SelectQuery;

class Login extends Base
{
    public function login($request, $response)
    {
        try {
            $dadosTemplate = [
                'titulo' => 'Autenticação'
            ];
            return $this->getTwig()
                ->render($response, $this->setView('login'), $dadosTemplate)
                ->withHeader('Content-Type', 'text/html')
                ->withStatus(200);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die;
        }
    }
    public function precadastro($request, $response)
    {
        try {
            #Captura os dados do form
            $form = $request->getParsedBody();
            $dadosUsuario = [
                'nome' => $form['nome'],
                'sobrenome' => $form['sobrenome'],
                'cpf' => $form['cpf'],
                'rg' => $form['rg'],
                'senha' => password_hash($form['senha'], PASSWORD_DEFAULT)
            ];
            $IsInseted = InsertQuery::table('usuario')->save($dadosUsuario);
            if (!$IsInseted) {
                return $this->SendJson($response,['status' => false, 'msg' => 'Restrição', $IsInseted, 'id' => 0],403);
            }
            $id = SelectQuery::select('id')->from('usuario')->order('id', 'desc')->fetch();
            $id_usuario = $id['id'];
            #Finalizar Cadastro
            #Inserimos o email
            $dadosContato = [
                'id_usuario' => $id_usuario,
                'tipo' => 'email',
                'contato' => $form['email'],
            ];
            InsertQuery::table('contato')->save($dadosContato);
            #Inserimos o celular
            $dadosContato = [
                'id_usuario' => $id_usuario,
                'tipo' => 'celular',
                'contato' => $form['celular']
            ];
            InsertQuery::table('contato')->save($dadosContato);
            #Inserimos o Whatsapp
            $dadosContato = [
                'id_usuario' => $id_usuario,
                'tipo' => 'whatsapp',
                'contato' => $form['whatsapp']
            ];
            InsertQuery::table('contato')->save($dadosContato);
            return $this->SendJson($response,['status' => true, 'msg' => 'Cadastrado realizado com sucesso!', 'id' => $id_usuario],201);
        } catch (\Exception $e) {
            return $this->SendJson($response,['status' => true, 'msg' => 'Restrição:' .  $e->getMessage(), 'id' => 0],500);
        }
    }
    public function autenticar($request, $response)
    {
        try {
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            die;
        }
    }
}
