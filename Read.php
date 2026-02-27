<?php
require 'Koneksi.php';
$stmt = $pdo->query("SELECT * FROM barang ORDER BY id DESC");
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Barang | Dark Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #0f172a; }
    </style>
</head>
<body class="text-gray-200 min-h-screen font-sans">
    <div class="max-w-6xl mx-auto px-4 py-10">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
            <div>
                <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-emerald-400">
                    Dashboard Inventaris
                </h1>
                <p class="text-gray-400 mt-2 text-lg">Kelola stok barang dengan antarmuka modern & elegan.</p>
            </div>
            <a href="Create.php" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-semibold rounded-xl transition duration-300 shadow-lg shadow-blue-900/20 transform hover:-translate-y-1">
                <i class="fas fa-plus-circle mr-2"></i> Tambah Produk
            </a>
        </div>

        <!-- Success Messages -->
        <?php if (isset($_GET['status'])): ?>
            <div class="mb-6 p-4 rounded-xl border border-emerald-500/30 bg-emerald-500/10 text-emerald-400 flex items-center animate-pulse">
                <i class="fas fa-check-circle mr-3"></i>
                <span>Operasi berhasil diselesaikan.</span>
            </div>
        <?php endif; ?>

        <!-- Table Container -->
        <div class="bg-slate-800/50 backdrop-blur-md rounded-2xl border border-slate-700 shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-700/50 border-b border-slate-600">
                            <th class="px-6 py-5 font-bold uppercase text-xs text-gray-400 tracking-wider text-center">No</th>
                            <th class="px-6 py-5 font-bold uppercase text-xs text-gray-400 tracking-wider">Nama Produk</th>
                            <th class="px-6 py-5 font-bold uppercase text-xs text-gray-400 tracking-wider">Kategori</th>
                            <th class="px-6 py-5 font-bold uppercase text-xs text-gray-400 tracking-wider">Harga</th>
                            <th class="px-6 py-5 font-bold uppercase text-xs text-gray-400 tracking-wider">Stok</th>
                            <th class="px-6 py-5 font-bold uppercase text-xs text-gray-400 tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        <?php if (empty($barang)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center opacity-40">
                                        <i class="fas fa-box-open text-6xl mb-4"></i>
                                        <p class="text-xl">Belum ada data inventaris.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($barang as $row): ?>
                                <tr class="hover:bg-slate-700/30 transition duration-200 group">
                                    <td class="px-6 py-4 text-center font-mono text-gray-500"><?= $no++; ?></td>
                                    <td class="px-6 py-4 font-semibold text-white"><?= htmlspecialchars($row['nama_produk']); ?></td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-900 border border-slate-600 text-blue-400">
                                            <?= htmlspecialchars($row['kategori']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-emerald-400 font-mono">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                    <td class="px-6 py-4">
                                        <?php if ($row['stok'] <= 5): ?>
                                            <span class="flex items-center text-rose-400 font-bold">
                                                <span class="w-2 h-2 rounded-full bg-rose-500 mr-2 animate-ping"></span>
                                                <?= htmlspecialchars($row['stok']); ?> (Kritis)
                                            </span>
                                        <?php else: ?>
                                            <span class="text-gray-300"><?= htmlspecialchars($row['stok']); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center items-center space-x-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="Update.php?id=<?= $row['id']; ?>" class="p-2 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded-lg transition" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="Delete.php?id=<?= $row['id']; ?>" 
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                               class="p-2 bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white rounded-lg transition" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
