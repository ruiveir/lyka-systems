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
            if($user->idAgente != $P_Agente->idAgente){
                if($user->email == $email){
                    $verifyUser = true;
                }
            }
        }

        $existeEmail = false;
        $existeNif = false;
        $existeNumDoc = false;

        foreach($agentes as $agente){
            if($agente->idAgente != $P_Agente->idAgente){
                if($agente->email == $email && $agente->email != null){
                    $existeEmail = true;
                }
                if($agente->NIF == $NIF && $agente->NIF != null){
                    $existeNif = true;
                }
                if($agente->num_doc == $num_doc && $agente->num_doc != null){
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
            if($user->idCliente != $P_Cliente->idCliente){
                if($user->email == $email && $user->email != null){
                    $verifyUser = true;
                }
            }
        }

        $existeEmail = false;
        $existeNif = false;
        $existeNumDoc = false;

        foreach($clientes as $cliente){
            if($cliente->idCliente != $P_Cliente->idCliente){
                if($cliente->email == $email && $cliente->email != null){
                    $existeEmail = true;
                }
                if($cliente->NIF == $NIF && $cliente->NIF != null){
                    $existeNif = true;
                }
                if($cliente->num_docOficial == $num_doc && $cliente->num_docOficial != null){
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
            if($user->idAdmin != $P_Administrador->idAdmin){
                if($user->email == $email){
                    $verifyUser = true;
                }
            }
        }

        $existeEmail = false;

        foreach($Admins as $Admin){
            if($Admin->idAdmin != $P_Administrador->idAdmin){
                if($Admin->email == $email && $Admin->email != null){
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
                if($Conta->numConta == $numConta && $Conta->numConta != null){
                    $existeNumConta = true;
                }
                if($Conta->IBAN == $IBAN && $Conta->IBAN != null){
                    $existeIban = true;
                }
                if($Conta->SWIFT == $SWIFT && $Conta->SWIFT != null){
                    $existeSwift = true;
                }
            }
        }

        $resultado[] = $existeNumConta;
        $resultado[] = $existeIban;
        $resultado[] = $existeSwift;
        
        return ["numconta" => $existeNumConta,"iban" => $existeIban,"swift" => $existeSwift];
    }
    public function universidade(Universidade $P_Universidade, String $NIF){
        $universidades = Universidade::withTrashed()->get();

        $existeNif = false;

        foreach($universidades as $universidade){
            if($universidade->idUniversidade != $P_Universidade->idUniversidade){
                if($universidade->NIF == $NIF && $universidade->NIF != null){
                    $existeNif = true;
                }
            }
        }
        
        return ["nif" => $existeNif];
    }
}
