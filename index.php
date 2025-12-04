<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

function e($s){ return htmlspecialchars($s, ENT_QUOTES); }
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>CRUD - Produk</title>
  <style>
    body{font-family: Arial; max-width:900px;margin:20px auto;}
    table{width:100%;border-collapse:collapse}
    th,td{padding:8px;border:1px solid #ddd;text-align:left}
    img.thumb{height:60px}
    .actions a{margin-right:8px}
  </style>
</head>
<body>
  <h1>Daftar Produk</h1>
  <p><a href="create.php">+ Tambah Produk</a></p>

  <table>
    <thead> 
      <tr><th>ID</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Gambar</th><th>Status</th><th>Aksi</th></tr>
    </thead>
    <tbody>
      <?php if(!$products): ?>
        <tr><td colspan="8">Belum ada data.</td></tr>
      <?php else: foreach($products as $p): ?>
        <tr>
          <td><?=e($p['id'])?></td>
          <td><?=e($p['name'])?></td>
          <td><?=e($p['category'])?></td>
          <td><?=number_format($p['price'],2)?></td>
          <td><?=e($p['stock'])?></td>
          <td>
            <?php if($p['image_path'] && file_exists($p['image_path'])): ?>
              <img src="<?=e($p['image_path'])?>" class="thumb" alt="">
            <?php else: echo '-'; endif; ?>
          </td>
          <td><?=e($p['status'])?></td>
          <td class="actions">
            <a href="edit.php?id=<?=e($p['id'])?>">Edit</a>
            <a href="delete.php?id=<?=e($p['id'])?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
          </td>
        </tr>
      <?php endforeach; endif; ?>
    </tbody>
  </table>
</body>
</html>