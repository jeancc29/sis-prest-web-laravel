<?php

namespace App\Models;

use App\Traits\BelongsToCaja;
use App\Traits\BelongsToCompania;
use App\Traits\BelongsToTipo;
use App\Traits\BelongsToUser;
use App\Traits\SetearUserYCompaniaIdYFiltrarPorCompania;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaccion extends Model
{
    use HasFactory, SetearUserYCompaniaIdYFiltrarPorCompania, BelongsToCompania, BelongsToUser, BelongsToCaja, BelongsToTipo;

    protected $fillable = [
        'id',
        'compania_id',
        'user_id',
        'caja_id',
        'monto',
        'comentario',
        'estado',
        'tipo_id',
        'tipo_id_pago',
        'transaccionable_id',
        'transaccionable_type',
        'tipo_id_ingreso_egreso'
    ];

    public static function make(User $usuario, ?Caja $caja, $monto, $tipo, string $transaccionableType, $transaccionableId, string $comentario, $tipoIdPago = null, $caja2 = null){
        if($caja == null)
            return;

        if(!isset($caja))
            return;

//        $monto = (Transaction::isSum($tipo, $monto)) ? abs($monto) : \App\Classes\Helper::toNegative($monto);
        $tipoIngresoEgreso = Transaction::getTipoIngresoEgreso($tipo, $monto);


        $arrayOfData = [
            "compania_id" => $usuario->compania_id,
            "user_id" => $usuario->id,
            "caja_id" => $caja->id,
            "monto" => $monto,
            "tipo_id" => $tipo["id"],
            "transaccionable_type" => $transaccionableType,
            "transaccionable_id" => $transaccionableId,
            "comentario" => $comentario,
            "tipo_id_ingreso_egreso" => $tipoIngresoEgreso->id
        ];

        if($tipoIdPago != null)
            $arrayOfData["tipo_id_pago"] = $tipoIdPago;

        if($tipo["descripcion"] == "Balance inicial" || $tipo["descripcion"] == "Ajuste caja" || $tipo["descripcion"] == "Transferencia entre cajas"){
            $t = Transaction::create($arrayOfData);
            \App\Box::updateBalance($t->caja_id);
            return;
        }

        /// Si la transaccion existe pues validamos de que esta no este cerrada para poderla editar, de lo contrario pues no se
        /// podrá editar la transacccion
        if($tipo["descripcion"] != "Balance inicial" && $tipo["descripcion"] != "Ajuste caja"){
            $t = Transaction::where(["transaccionable_type" => $transaccionableType, "transaccionable_id" => $transaccionableId, "tipo_id" => $tipo["id"]])->first();
            if($t != null){
                if($t->estado == 2){
                    abort(402, __("errores.cajaEstaCerrada"));
                    return;
                }
            }
        }

        // $t = Transaction::create($arrayOfData);
        if($monto < 0 && $caja->balance < abs($monto)){
//            abort(402, "La caja no tiene monto suficiente monto: $monto balance: " . $caja["balance"]);
            abort(402, __("errores.cajaNoTieneMontoSuficiente"));
            return;
        }


        $t = Transaction::updateOrCreate(
            ["transaccionable_type" => $transaccionableType, "transaccionable_id" => $transaccionableId, "tipo_id" => $tipo["id"]],
            $arrayOfData
        );
        // $caja = \App\Box::whereId($caja["id"])->first();
        // $caja->balance += $monto;
        // $caja->save();
        \App\Box::updateBalance($t->caja_id);
    }

    static function getTipoIngresoEgreso($tipo, $monto = null){
        $isIngreso = false;
        switch ($tipo["descripcion"]) {
            case 'Balance inicial':
                $isIngreso = true;
                break;
            case 'Pago':
                $isIngreso = true;
                break;
            case 'Préstamo':
                $isIngreso = false;
                break;
            case 'Cancelación préstamo':
                $isIngreso = true;
                break;
            case 'Ajuste capital':
                $isIngreso = ($monto > 0 ) ? false : true;
                break;
            case 'Gasto':
                $isIngreso = false;
                break;

            default:
                # code...
                $isIngreso = ($monto > 0) ? true : false;
                break;
        }
        return $isIngreso ? Type::query()->whereDescripcion("Ingresos")->first() : Type::query()->whereDescripcion("Egresos")->first();
    }

    public static function cancel($tipo, $transaccionableType, $transaccionableId, $comentario = null){
        $t = Transaction::where(["tipo_id" => $tipo->id, "transaccionable_type", "transaccionable_id" => $transaccionableId])->first();
        if($t == null)
            return;

        if($t->estado == 2){
            abort(402, "La caja ya ha sido cerrada, asi que no se puede cancelar la transacción.");
            return;
        }

        $t->estado = 0;
        if($comentario != null)
            $t->comentario = $comentario;
        $t->save();

        // $caja = \App\Box::whereId($t->caja_id)->first();
        // $monto = ($t->monto < 0) ? abs($t->monto) : \App\Classes\Helper::toNegative($t->monto);
        // $caja->balance += $monto;

        \App\Box::updateBalance($t->caja_id);
    }

    public function user() : BelongsTo
    {
        //Modelo, foreign key, local key
        return $this->belongsTo(User::class);
    }

    public function tipoPago() : BelongsTo
    {
        //Modelo, foreign key, local key
        return $this->belongsTo(Tipo::class, 'tipo_id_pago');
    }

    public function tipoIngresoEgreso() : BelongsTo
    {
        //Modelo, foreign key, local key
        return $this->belongsTo(Tipo::class, 'tipo_id_ingreso_egreso');
    }

}
