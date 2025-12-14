<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $order->invoice }}</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* === TAMPILAN LAYAR === */
        body {
            background: #f8f9fa;
            font-family: 'Courier New', monospace;
            padding: 20px;
        }
        .receipt {
            max-width: 380px;
            margin: 0 auto;
            background: white;
            padding: 15px;
            border: 1px dashed #ccc;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            font-size: 14px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .fw-bold { font-weight: bold; }
        .small { font-size: 12px; }
        .border-bottom { border-bottom: 1px dashed #aaa; padding-bottom: 8px; margin-bottom: 8px; }
        .mt-2 { margin-top: 8px; }
        .mb-2 { margin-bottom: 8px; }

        /* === SAAT PRINT === */
        @media print {
            body, html {
                margin: 0 !important;
                padding: 5mm !important;
                background: white !important;
            }
            .receipt {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                max-width: 100% !important;
                font-size: 10pt;
            }
            .no-print { display: none !important; }
            @page { margin: 0; }
        }

        /* Thermal 80mm */
        @media print and (max-width: 85mm) {
            body { padding: 2mm; font-size: 9pt; }
            .receipt { padding: 0; }
        }
    </style>
</head>
<body>

    <!-- STRUK -->
    <div class="receipt">
        <div class="text-center border-bottom">
            <h5 class="fw-bold mb-1">{{ config('app.name', 'TOKO KITA') }}</h5>
            <div class="small text-muted">
                {{-- Jl. Contoh No. 123<br>
                Telp: 0812-3456-7890 --}}
            </div>
        </div>

        <table class="w-100 small mt-2">
            <tr>
                <td>Invoice</td>
                <td class="text-right">: {{ $order->invoice }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td class="text-right">: {{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td class="text-right">: {{ auth()->user()->name ?? 'Admin' }}</td>
            </tr>
            <tr>
                <td>Pelanggan</td>
                <td class="text-right">: {{ optional($order->customer)->name ?? 'Umum' }}</td>
            </tr>
        </table>

        <div class="border-bottom mt-2"></div>

        <table class="w-100 small">
            @foreach($order->details as $d)
            <tr>
                <td colspan="2" class="fw-bold">{{ $d->product->name }}</td>
            </tr>
            <tr>
                <td class="ps-3 small text-muted">
                    {{ $d->quantity }} × Rp {{ number_format($d->price / $d->quantity, 0, ',', '.') }}
                </td>
                <td class="text-right fw-bold">Rp {{ number_format($d->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <div class="border-bottom mt-2"></div>

        <table class="w-100 fw-bold mt-2">
            <tr>
                <td>TOTAL</td>
                <td class="text-right text-success" style="font-size: 16px;">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        <div class="text-center small text-muted mt-3">
            <p class="mb-1">Terima kasih!</p>
            <p class="mb-0">Barang tidak dapat ditukar.</p>
        </div>
    </div>
    <!-- AKHIR STRUK -->

    <!-- Tombol hanya di layar -->
    <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn btn-success btn-sm">Cetak Struk</button>
        <a href="{{ route('order.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    <script>
        window.onload = function () {
            // Auto buka print dialog setelah 500ms
            setTimeout(() => {
                window.print();
            }, 500);
        };

        // Setelah print dialog ditutup (baik dicetak atau dibatalkan)
        // window.onafterprint = function () {
        //     // Tunggu 5–10 detik sebelum redirect
        //     setTimeout(() => {
        //         window.location.href = '{{ route('order.index') }}';
        //     }, 5000); // Ganti ke 10000 untuk 10 detik
        // };

    </script>
</body>
</html>