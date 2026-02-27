<?php
require 'Koneksi.php';

$id = $_GET['id'] ?? $_POST['id'] ?? null;

if (!$id) {
    header("Location: Read.php");
    exit;
}

// Fetch current data
$stmt = $pdo->prepare("SELECT * FROM barang WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    header("Location: Read.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $harga = (int)$_POST['harga'];
    $stok = (int)$_POST['stok'];
    $kategori = $_POST['kategori'];

    try {
        $sql = "UPDATE barang SET nama_produk = ?, harga = ?, stok = ?, kategori = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nama_produk, $harga, $stok, $kategori, $id])) {
            header("Location: Read.php?status=success_update");
            exit;
        }
    } catch (PDOException $e) {
        $error = "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | Dark Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f172a; }
    </style>
</head>
<body class="text-gray-200 min-h-screen font-sans flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-slate-800 border border-slate-700 rounded-3xl shadow-2xl p-8">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-amber-500/10 text-amber-400 rounded-2xl mb-4 border border-amber-500/20">
                <i class="fas fa-edit text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-white">Edit Produk</h2>
            <p class="text-gray-400 text-sm mt-2">Perbarui detail produk ID: #<?= htmlspecialchars($id); ?></p>
        </div>

        <?php if (isset($error)): ?>
            <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/30 text-rose-400 text-sm">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="Update.php" class="space-y-6">
            <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">

            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase text-gray-500 tracking-widest ml-1">Nama Produk</label>
                <input type="text" name="nama_produk" value="<?= htmlspecialchars($data['nama_produk']); ?>" required maxlength="20"
                    class="w-full bg-slate-900/50 border border-slate-700 text-white px-5 py-3 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition duration-300 outline-none">
            </div>
            
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase text-gray-500 tracking-widest ml-1">Harga (Rp)</label>
                    <input type="number" name="harga" value="<?= htmlspecialchars((int)$data['harga']); ?>" required
                        class="w-full bg-slate-900/50 border border-slate-700 text-white px-5 py-3 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition duration-300 outline-none">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase text-gray-500 tracking-widest ml-1">Stok</label>
                    <input type="number" name="stok" value="<?= htmlspecialchars($data['stok']); ?>" required
                        class="w-full bg-slate-900/50 border border-slate-700 text-white px-5 py-3 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition duration-300 outline-none">
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase text-gray-500 tracking-widest ml-1">Kategori</label>
                <input type="text" name="kategori" value="<?= htmlspecialchars($data['kategori']); ?>" required maxlength="10"
                    class="w-full bg-slate-900/50 border border-slate-700 text-white px-5 py-3 rounded-xl focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition duration-300 outline-none">
            </div>
            
            <div class="flex flex-col space-y-4 pt-6">
                <button type="submit" 
                    class="w-full bg-amber-600 hover:bg-amber-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-amber-900/40 transition duration-300 transform active:scale-95">
                    <i class="fas fa-sync-alt mr-2"></i> Perbarui Produk
                </button>
                <a href="Read.php" 
                    class="w-full text-center py-2 text-gray-400 font-medium hover:text-white transition duration-300">
                    <i class="fas fa-arrow-left mr-2"></i> Batal & Kembali
                </a>
            </div>
        </form>
    </div>
</body>
</html>
