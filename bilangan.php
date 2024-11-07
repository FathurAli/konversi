<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi Angka ke Terbilang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function formatAngka(input) {
            let value = input.value.replace(/\./g, ''); // Hapus semua titik
            if (!isAngka(value)) {
                input.value = new Intl.NumberFormat('id-ID').format(value); // Tambahkan format dengan titik
            } else {
                input.value = input.value.substring(0, input.value.length - 1); // Hapus karakter terakhir jika bukan angka
            }
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Konversi Angka ke Terbilang</h2>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="angka" class="form-label">Masukkan Angka :</label>
                <input type="text" id="angka" name="angka" class="form-control" placeholder="Masukkan angka" required oninput="formatAngka(this)">
            </div>
            <button type="submit" class="btn btn-primary">Konversi</button>
        </form>

        <?php
        function terbilang($angka) {
            $angka = str_replace('.', '', $angka); // Hilangkan tanda titik
            $angka = (float)$angka;

            $satuan = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
            
            if ($angka < 12) {
                return $satuan[$angka];
            } elseif ($angka < 20) {
                return $satuan[$angka - 10] . " belas";
            } elseif ($angka < 100) {
                return $satuan[intval($angka / 10)] . " puluh " . $satuan[$angka % 10];
            } elseif ($angka < 200) {
                return "seratus " . terbilang($angka - 100);
            } elseif ($angka < 1000) {
                return $satuan[intval($angka / 100)] . " ratus " . terbilang($angka % 100);
            } elseif ($angka < 2000) {
                return "seribu " . terbilang($angka - 1000);
            } elseif ($angka < 1000000) {
                return terbilang(intval($angka / 1000)) . " ribu " . terbilang($angka % 1000);
            } elseif ($angka < 1000000000) {
                return terbilang(intval($angka / 1000000)) . " juta " . terbilang($angka % 1000000);
            } else {
                return "Angka terlalu besar!";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $angka = $_POST['angka'];
            echo "<div class='alert alert-success mt-3'>Terbilang: <strong>" . terbilang($angka) . " rupiah</strong></div>";
        }
        ?>
    </div>
</body>
</html>
