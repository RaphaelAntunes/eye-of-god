<?php

namespace App\Http\Controllers;
use App\Models\ApiModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function Consulta($data)
    {
        $evento = ApiModel::where('placa', $data)
        ->get();
        if (!$evento) {
            return response()->json(['message' => 'Placa não encontrada'], 404);
        }


        return response()->json(['message' => 'Placa Encontrada', 'Data' => $evento], 200);
    }

}
