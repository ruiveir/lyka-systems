<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Agente;
use App\Cliente;
use App\Administrador;
use App\Conta;
use App\Universidade;
use App\User;

class UniqueController extends Controller
{
    public function agente(Agente $P_Agente, String $uniques){
        $agentes = Agente::withTrashed()->get();
        $users = User::withTrashed()->get();
        $result = explode("_", $uniques);

        $email = null;
        $num_doc = $result[0];
        $NIF = $result[1];
        if(count($result) == 3){
            $email = $result[2];
        }else{
            for($i = 2;$i < count($result); $i++){
                if($i != 2){
                    $email .= "_";
                    $email .= $result[$i];
                }else{
                    $email = $result[$i];
                }
            }
        }

        $verifyUser = false;

        foreach($users as $user){
            if($P_Agente->idAgente){
                if($user->idAgente != $P_Agente->idAgente){
                    if(strtolower($user->email) == strtolower($email)){
                        $verifyUser = true;
                    }
                }
            }else{
                if(strtolower($user->email) == strtolower($email)){
                    $verifyUser = true;
                }
            }
        }

        $existeEmail = false;
        $existeNif = false;
        $existeNumDoc = false;

        foreach($agentes as $agente){
            if($agente->idAgente != $P_Agente->idAgente){
                if(strtolower($agente->email) == strtolower($email) && $agente->email != null){
                    $existeEmail = true;
                }
                if(strtolower($agente->NIF) == strtolower($NIF) && $agente->NIF != null){
                    $existeNif = true;
                }
                if(strtolower($agente->num_doc) == strtolower($num_doc) && $agente->num_doc != null){
                    $existeNumDoc = true;
                }
            }
        }
        
        return ["email" => $existeEmail,"nif" => $existeNif,"numdoc" => $existeNumDoc,"user" => $verifyUser];
    }

    public function cliente(Cliente $P_Cliente, String $uniques){
        $clientes = Cliente::withTrashed()->get();
        $users = User::withTrashed()->get();
        $result = explode("_", $uniques);
        
        $email = null;
        $num_doc = $result[0];
        $NIF = $result[1];
        if(count($result) == 3){
            $email = $result[2];
        }else{
            for($i = 2;$i < count($result); $i++){
                if($i != 2){
                    $email .= "_";
                    $email .= $result[$i];
                }else{
                    $email = $result[$i];
                }
            }
        }

        $verifyUser = false;

        foreach($users as $user){
            if($P_Administrador->idCliente){
                if($user->idCliente != $P_Cliente->idCliente){
                    if(strtolower($user->email) == strtolower($email) && $user->email != null){
                        $verifyUser = true;
                    }
                }
            }else{
                if(strtolower($user->email) == strtolower($email)){
                    $verifyUser = true;
                }
            }
        }

        $existeEmail = false;
        $existeNif = false;
        $existeNumDoc = false;

        foreach($clientes as $cliente){
            if($cliente->idCliente != $P_Cliente->idCliente){
                if(strtolower($cliente->email) == strtolower($email) && $cliente->email != null){
                    $existeEmail = true;
                }
                if(strtolower($cliente->NIF) == strtolower($NIF) && $cliente->NIF != null){
                    $existeNif = true;
                }
                if(strtolower($cliente->num_docOficial) == strtolower($num_doc) && $cliente->num_docOficial != null){
                    $existeNumDoc = true;
                }
            }
        }
        
        return ["email" => $existeEmail,"nif" => $existeNif,"numdoc" => $existeNumDoc,"user" => $verifyUser];
    }
    public function administrador(Administrador $P_Administrador, String $email){
        $Admins = Administrador::withTrashed()->get();
        $users = User::withTrashed()->get();

        $verifyUser = false;

        foreach($users as $user){
            if($P_Administrador->idAdmin){
                if($user->idAdmin != $P_Administrador->idAdmin){
                    if(strtolower($user->email) == strtolower($email)){
                        $verifyUser = true;
                    }
                }
            }else{
                if(strtolower($user->email) == strtolower($email)){
                    $verifyUser = true;
                }
            }
        }
        

        $existeEmail = false;

        foreach($Admins as $Admin){
            if($Admin->idAdmin != $P_Administrador->idAdmin){
                if(strtolower($Admin->email) == strtolower($email) && $Admin->email != null){
                    $existeEmail = true;
                }
            }
        }

        
        return ["email" => $existeEmail,"user" => $verifyUser];
    }
    public function conta(Conta $P_Conta, String $uniques){
        $Contas = Conta::withTrashed()->get();
        $result = explode("_", $uniques);
        
        $numConta = $result[0];
        $IBAN = $result[0];
        $SWIFT = $result[0];
        
        $existeNumConta = false;
        $existeIban = false;
        $existeSwift = false;

        foreach($Contas as $Conta){
            if($Conta->idConta != $P_Conta->idConta){
                if(strtolower($Conta->numConta) == strtolower($numConta) && $Conta->numConta != null){
                    $existeNumConta = true;
                }
                if(strtolower($Conta->IBAN) == strtolower($IBAN) && $Conta->IBAN != null){
                    $existeIban = true;
                }
                if(strtolower($Conta->SWIFT) == strtolower($SWIFT) && $Conta->SWIFT != null){
                    $existeSwift = true;
                }
            }
        }
        return ["numconta" => $existeNumConta,"iban" => $existeIban,"swift" => $existeSwift];
    }
    public function universidade(Universidade $P_Universidade, String $NIF){
        $universidades = Universidade::withTrashed()->get();

        $existeNif = false;

        foreach($universidades as $universidade){
            if($universidade->idUniversidade != $P_Universidade->idUniversidade){
                if(strtolower($universidade->NIF) == strtolower($NIF) && $universidade->NIF != null){
                    $existeNif = true;
                }
            }
        }
        
        return ["nif" => $existeNif];
    }
}
