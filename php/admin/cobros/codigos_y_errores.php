<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CODIGOS</title>
    <style>
        .contenedor {
            display: flex;
        }

        .columna {
            flex: 1;
            /* cada columna ocupa la mitad del contenedor */
            padding: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>


<body>
    <ul>
        <div class="contenedor">
            <div class="columna">
                <li>Sin Voucher</li>
                <li><b>(err 1) semanas = 0</b></li>
                <li><b>OK OK (err 2) Error deuda anterior menor a cero</b></li>
                <li><b>OK OK (err 3) Error saldo a favor menor que cero</b></li>
                <li><b>OK OK (err 4) Error efectivo menor que cero</b></li>
                <li><b>OK OK (err 5) Error Saldo a favor - deuda anterior mayores a 0</b></li>
                <li><b>OK OK (cod 6) Solo ventas</b></li>
                <li><b>OK OK (cod 7) Solo saldo a favor</b></li>
                <li><b>(cod 8) Saldo a favor - Ventas - terminar de revisar si no le alcanza la plata</b></li>
                <li><b>OK OK (cod 9) Solo deuda anterior</b></li>
                <li><b>OK OK (cod 10) Deuda anterior - ventas</b></li>
                <li><b>OK OK (cod 11) Solo semanas</b></li>
                <li><b>OK OK (cod 12) Ventas - Semanas</b></li>
                <li><b>OK OK (cod 13) Semanas - Saldo a favor</b></li>
                <li><b>OK OK (cod 14) Semanas - Saldo a favor - Ventas</b></li>
                <li><b>OK OK (cod 15) Semanas - Deuda anterior</b></li>
                <li><b>OK OK (cod 16) Semanas - deuda anterior - ventas</b></li>
                <li><b>OK OK (cod 17) Deposito Solo</b></li>
                <li><b>OK OK (cod 18) Deposito - Ventas</b></li>
                <li><b>OK OK (cod 19) Deposito - saldo a favor</b></li>
                <li><b>(cod 20) Deposito - saldo a favor - Ventas</b></li>
                <li><b>OK OK (cod 21) Deposito - Deuda anterior</b></li>
                <li><b>OK OK (cod 22) Deposito - Deuda anterior - Ventas</b></li>
                <li><b>OK OK (cod 23) Deposito - semanas</b></li>
                <li><b>OK OK (cod 24) Deposito - Semanas - Ventas</b></li>
                <li><b>OK OK (cod 25) Deposito - Semanas - Saldo a favor</b></li>
                <li><b>OK OK (cod 26) Deposito - semanas - saldo a favor - ventas</b></li>
                <li><b>OK OK (cod 27) Deposito - Semanas - Deuda anterior</b></li>
                <li><b>OK OK (cod 28) Deposito - Semanas - Deuda anterior - Ventas</b></li>
            </div>
            <div class="columna">
                <li>Con Voucher</li>
                <li><b>OK OK (cod 29) Voucher </b></li>
                <li><b>OK OK (cod 30) Voucher - Ventas</b></li>
                <li><b>OK OK (cod 31) Voucher - saldo a favor</b></li>
                <li><b>OK OK (cod 32) Voucher - Saldo a favor - Ventas</b></li>
                <li><b>OK OK (cod 33) voucher - Deuda anterior</b></li>
                <li><b>OK OK (cod 34) voucher - Deuda anterior - ventas</b></li>
                <li><b>OK OK (err 35) voucher - Deuda anterior - saldo a favor</b></li>
                <li><b>OK OK (err 36) voucher - Deuda anterior - saldo a favor - ventas</b></li>
                <li><b>OK OK (cod 37) voucher semanas</b></li>
                <li><b>OK OK (cod 38) voucher semanas - postergar pago</b></li>
                <li><b>OK OK (cod 39) voucher - semanas - ventas</b></li>
                <li><b>OK OK (cod 40) voucher - semanas - ventas - postergar pago</b></li>
                <li><b>OK OK (cod 41) voucher - semanas - saldo_a_favor</b></li>
                <li><b>OK OK (cod 42) voucher - semanas - saldo a favor - ventas</b></li>
                <li><b>OK OK (cod 43) voucher - semanas - Deuda anterior</b></li>
                <li><b>OK OK (cod 44) voucher - semanas - Deuda anterior - postergar pago</b></li>
                <li><b>OK OK (cod 45) voucher - Semanas - deuda anterior - ventas</b></li>
                <li><b>OK OK (cod 46) voucher - Semanas - deuda anterior - ventas - postergar pago</b></li>
                <li><b>OK OK (err 47) voucher - Semanas - deuda anterior - Saldo a favor</b></li>
                <li><b>OK OK (err 48) voucher - semanas - deuda anterior - Saldo a favor - ventas</b></li>
                <li><b>OK OK (cod 49) voucher - Deposito</b></li>
                <li><b>OK OK (cod 50) voucher - Deposito - Ventas</b></li>
                <li><b>OK OK (cod 51) voucher - deposito - saldo a favor</b></li>
                <li><b>OK OK (cod 52) voucher - deposito - saldo a favor - ventas</b></li>
                <li><b>OK OK (cod 53) voucher - deposito - deuda anterior</b></li>
                <li><b>OK OK (cod 54) voucher - deposito - deuda anterior - ventas</b></li>
                <li><b>OK OK (err 55) voucher - deposito - deuda anterior - saldo a favor</b></li>
                <li><b>OK OK (err 56) voucher - deposito - deuda anterior - saldo a favor - ventas</b></li>
                <li><b>OK OK (cod 57) voucher - deposito - semanas</b></li>
                <li><b>OK OK (cod 58) voucher - deposito - semanas - ventas</b></li>
                <li><b>OK OK (cod 59) voucher - deposito - semanas - saldo a favor - ventas</b></li>
                <li><b>OK OK (cod 60) voucher - deposito - semanas - deuda anterior</b></li>
                <li><b>OK OK (cod 61) voucher - deposito - semanas - deuda anterior - ventas</b></li>
                <li><b>OK OK (err 62) voucher - deposito - semanas - deuda anterior - saldo a favor</b></li>
                <li><b>OK OK (err 63) voucher - deposito - semanas- deuda anterior - saldo a favor - ventas</b></li>
                <li><b>OK OK (cod 64) no voucher - no semanas - no deuda anterior - no Saldo a favor - no ventas - no deposito</b></li>
            </div>
        </div>
        <br>
    </ul>


</body>

</html>