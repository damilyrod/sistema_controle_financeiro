<?php

// futuramente essa Classe vai gerar a sessão de usuário, permitindo o acesso na aplicação.
// De início, vamos apenas simular um acesso de um suposto usuário logado na aplicação.
  // O retorno esta simulado o acesso do suposto usuário de ID 1, na aplicação!

class UtilDAO
{

    private static function IniciarSessao()
    {
        if (!isset($_SESSION))
            session_start();
    }

    public  static function ValidarEmail($email)
    {

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }


    public static function CriarSessao($cod, $nome)
    {
        self::IniciarSessao();

        $_SESSION['cod'] = $cod;
        $_SESSION['nome'] = $nome;
    }
    public static function NomeLogado()
    {
        self::IniciarSessao();
        return $_SESSION['nome'];
    }

    public static function UsuarioLogado()
    {
        self::IniciarSessao();
        return $_SESSION['cod'];
    }

    public static function Deslogar()
    {
        self::IniciarSessao();
        unset($_SESSION['cod']);
        unset($_SESSION['nome']);

        header('location: index.php');
        exit;
    }

    public static function VerificarLogado()
    {
        self::IniciarSessao();
        if (!isset($_SESSION['cod']) || $_SESSION['cod'] == '') {
            header('location: index.php');
            exit;
        }
    }
}
