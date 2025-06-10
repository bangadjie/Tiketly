<!DOCTYPE html>
<html>
<head>
    <title>Tiket Detail</title>
    <style>
        body { font-family: sans-serif; }
    </style>
</head>
<body id="print-area">
    <h1>Detail Tiket</h1>
    <p><strong>NIK:</strong> {{ $detail->NIK }}</p>
    <p><strong>ID Pembelian:</strong> {{ $detail->id_pembelian_tiket }}</p>
    <p><strong>ID Gerbong:</strong> {{ $detail->id_gerbong }}</p>
    <p><strong>ID Kursi:</strong> {{ $detail->id_kursi }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ $detail->metode_pembayaran }}</p>
</body>
</html>
