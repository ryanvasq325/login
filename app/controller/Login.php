<?php

namespace app\controller;

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
    public function precadastro($request,$response){
        try{
            #Captura os dados do form
            $form = $request->getParsedBody();
            var_dump($form);
            die;
        } catch (\Exception $e) {  
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
