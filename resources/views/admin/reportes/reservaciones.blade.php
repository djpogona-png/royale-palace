<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #111;
        }

        .header {
            background: #111;
            padding: 20px 30px;
            margin-bottom: 20px;
        }

        .header-title {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .header-title span {
            color: #C8A24D;
        }

        .header-sub {
            font-size: 9px;
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .report-meta {
            padding: 12px 30px;
            background: #F8F8F8;
            border-bottom: 2px solid #C8A24D;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }

        .meta-item {
            display: inline-block;
            margin-right: 30px;
        }

        .meta-label {
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #888;
        }

        .meta-value {
            font-size: 11px;
            font-weight: bold;
            color: #111;
            margin-top: 2px;
        }

        .section-title {
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #C8A24D;
            padding: 0 30px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        thead th {
            background: #111;
            color: #fff;
            padding: 8px 10px;
            text-align: left;
            font-size: 8px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        tbody td {
            padding: 8px 10px;
            border-bottom: 1px solid #E5E5E5;
        }

        tbody tr:nth-child(even) td {
            background: #F8F8F8;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-green {
            background: #E8F5E9;
            color: #2E7D32;
        }

        .badge-gold {
            background: #FFF8E1;
            color: #A8862C;
        }

        .badge-red {
            background: #FDECEA;
            color: #C62828;
        }

        .badge-gray {
            background: #F5F5F5;
            color: #666;
        }

        .summary {
            margin: 20px 30px 0;
            display: flex;
            gap: 16px;
        }

        .summary-box {
            flex: 1;
            background: #F8F8F8;
            border: 1px solid #E5E5E5;
            border-top: 3px solid #C8A24D;
            padding: 12px;
            text-align: center;
            border-radius: 4px;
        }

        .summary-num {
            font-size: 20px;
            font-weight: bold;
            color: #C8A24D;
        }

        .summary-lbl {
            font-size: 8px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #888;
            margin-top: 3px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8px;
            color: #999;
            padding: 10px;
            border-top: 1px solid #E5E5E5;
            background: #fff;
        }

        .px-30 {
            padding: 0 30px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-title">The <span>Royale</span> Palace</div>
        <div class="header-sub">
            Reporte de Reservaciones —
            {{ \Carbon\Carbon::create()->month($mes)->locale('es')->monthName }} {{ $anio }}
            @if($sede) · Sede {{ $sede->nombre }} @else · Todas las Sedes @endif
        </div>
    </div>

    <div class="report-meta">
        <div>
            <div class="meta-item">
                <div class="meta-label">Período</div>
                <div class="meta-value">{{ \Carbon\Carbon::create()->month($mes)->locale('es')->monthName }} {{ $anio }}
                </div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Sede</div>
                <div class="meta-value">{{ $sede ? $sede->nombre : 'Todas' }}</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Total</div>
                <div class="meta-value">{{ $reservaciones->count() }} reservaciones</div>
            </div>
        </div>
        <div>
            <div class="meta-label">Generado</div>
            <div class="meta-value">{{ now()->format('d/m/Y H:i') }}</div>
        </div>
    </div>

    {{-- Resumen --}}
    <div class="summary">
        @php
            $confirmadas = $reservaciones->where('estado', 'confirmada')->count();
            $completadas = $reservaciones->where('estado', 'completada')->count();
            $canceladas = $reservaciones->where('estado', 'cancelada')->count();
            $pendientes = $reservaciones->where('estado', 'pendiente')->count();
        @endphp
        <div class="summary-box">
            <div class="summary-num">{{ $confirmadas }}</div>
            <div class="summary-lbl">Confirmadas</div>
        </div>
        <div class="summary-box">
            <div class="summary-num">{{ $completadas }}</div>
            <div class="summary-lbl">Completadas</div>
        </div>
        <div class="summary-box">
            <div class="summary-num">{{ $canceladas }}</div>
            <div class="summary-lbl">Canceladas</div>
        </div>
        <div class="summary-box">
            <div class="summary-num">{{ $pendientes }}</div>
            <div class="summary-lbl">Pendientes</div>
        </div>
        <div class="summary-box" style="border-top-color:#305D42;">
            <div class="summary-num" style="color:#305D42;">{{ $reservaciones->count() }}</div>
            <div class="summary-lbl">Total</div>
        </div>
    </div>

    <br>
    <div class="section-title">Detalle de Reservaciones</div>

    <div class="px-30">
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cliente</th>
                    <th>Sede</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Mesa</th>
                    <th>Personas</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservaciones as $res)
                                <tr>
                                    <td style="font-family:monospace;font-weight:bold;color:#C8A24D;">{{ $res->codigo }}</td>
                                    <td>
                                        <div style="font-weight:bold;">{{ $res->user->name }}</div>
                                        <div style="color:#888;font-size:8px;">{{ $res->user->email }}</div>
                                    </td>
                                    <td>{{ $res->sede->nombre }}</td>
                                    <td>{{ $res->fecha->format('d/m/Y') }}</td>
                                    <td>{{ $res->hora }}</td>
                                    <td>{{ $res->mesa->numero }}</td>
                                    <td style="text-align:center;">{{ $res->num_personas }}</td>
                                    <td>
                                        <span class="badge {{ match ($res->estado) {
                        'confirmada' => 'badge-green',
                        'pendiente' => 'badge-gold',
                        'cancelada' => 'badge-red',
                        default => 'badge-gray'
                    } }}">{{ ucfirst($res->estado) }}</span>
                                    </td>
                                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        The Royale Palace — Reporte generado automáticamente el {{ now()->format('d/m/Y H:i') }} · Confidencial
    </div>

</body>

</html>