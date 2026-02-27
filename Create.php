<?php
require 'Koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $harga = (int)$_POST['harga']; // Explicit cast to int
    $stok = (int)$_POST['stok'];   // Explicit cast to int
    $kategori = $_POST['kategori'];

    $sql = "INSERT INTO barang (nama_produk, harga, stok, kategori) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([$nama_produk, $harga, $stok, $kategori])) {
        header("Location: Read.php?status=success_add");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk | Dark Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f172a; }
    </style>
</head>
<body class="text-gray-200 min-h-screen font-sans flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-slate-800 border border-slate-700 rounded-3xl shadow-2xl p-8">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-500/10 text-blue-400 rounded-2xl mb-4 border border-blue-500/20 shadow-inner">
                <i class="fas fa-box-open text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-white">Tambah Produk</h2>
            <p class="text-gray-400 text-sm mt-2 tracking-wide">Input data barang ke sistem inventaris.</p>
        </div>

        <form method="POST" action="" class="space-y-6">
            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase text-gray-500 tracking-widest ml-1">Nama Produk</label>
                <input type="text" name="nama_produk" required maxlength="20" placeholder="Contoh: Laptop Gaming"
                    class="w-full bg-slate-900/50 border border-slate-700 text-white px-5 py-3 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition duration-300 outline-none">
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase text-gray-500 tracking-widest ml-1">Harga (Rp)</label>
                    <input type="number" name="harga" required placeholder="0"
                        class="w-full bg-slate-900/50 border border-slate-700 text-white px-5 py-3 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition duration-300 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase text-gray-500 tracking-widest ml-1">Stok</label>
                    <input type="number" name="stok" required placeholder="0"
                        class="w-full bg-slate-900/50 border border-slate-700 text-white px-5 py-3 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition duration-300 outline-none">
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase text-gray-500 tracking-widest ml-1">Kategori</label>
                <input type="text" name="kategori" required maxlength="10" placeholder="Elektronik"
                    class="w-full bg-slate-900/50 border border-slate-700 text-white px-5 py-3 rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition duration-300 outline-none">
            </div>
            
            <div class="flex flex-col space-y-4 pt-6">
                <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-900/40 transition duration-300 transform active:scale-95">
                    <i class="fas fa-save mr-2"></i> Simpan ke Database
                </button>
                <a href="Read.php" 
                    class="w-full text-center py-2 text-gray-400 font-medium hover:text-white transition duration-300 underline-offset-4 hover:underline">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>
</body>
</html>
