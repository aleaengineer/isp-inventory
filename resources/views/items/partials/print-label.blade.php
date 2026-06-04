<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Label - {{ $item->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print { body { -webkit-print-color-adjust: exact; print-color-adjust: exact; } }
    </style>
</head>
<body class="bg-white">
    <div class="w-[300px] p-4 border-2 border-black rounded-lg text-center">
        <div class="text-lg font-bold tracking-wider">{{ $item->name }}</div>
        <div class="text-xs text-gray-600 mt-1">{{ $item->category->name ?? '' }}</div>
        <div class="mt-3 border-t border-gray-300 pt-2 text-left text-xs space-y-1">
            <p><strong>SN:</strong> {{ $item->serial_number }}</p>
            <p><strong>MAC:</strong> {{ $item->mac_address ?? '—' }}</p>
            <p><strong>Stock:</strong> {{ $item->stock_quantity }} {{ $item->unit }}</p>
        </div>
        <div class="mt-3 text-[10px] text-gray-500">ISP Inventory - {{ now()->format('Y-m-d') }}</div>
    </div>
    <div class="text-center mt-4">
        <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Print</button>
    </div>
</body>
</html>
