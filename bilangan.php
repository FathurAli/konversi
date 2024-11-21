<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konversi IDR ke Mata Uang Lain</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 8px;
            border: none;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            font-size: 1rem;
        }

        #terbilangOutput {
            font-size: 0.9rem;
            color: #495057;
            font-style: italic;
        }
    </style>

    <script>
        function formatAngka(input) {
            let value = input.value.replace(/\./g, ''); // Remove dots for formatting
            if (/^\d+(\,\d{0,2})?$/.test(value)) { // Allow up to two decimal places
                input.value = new Intl.NumberFormat('id-ID').format(value.replace(',', '.'));
            } else {
                input.value = input.value.substring(0, input.value.length - 1);
            }
        }

        // Helper function to parse input and remove non-numeric characters
        function parseNumber(value) {
            return parseFloat(value.replace(/\./g, '').replace(',', '.'));
        }

        function updateNilaiTukar() {
            let nilaiTukarInput = document.getElementById('exchangeRatesInput').value;
            let jumlahMataUang = document.getElementById('mataUangAsing').value;
            let nilaiTukar = document.getElementById('nilaiTukar');

            let nilaiTukarValue = parseNumber(nilaiTukarInput);
            let jumlahMataUangValue = parseNumber(jumlahMataUang);

            if (!isNaN(nilaiTukarValue) && !isNaN(jumlahMataUangValue)) {
                let rupiah = jumlahMataUangValue * nilaiTukarValue;
                nilaiTukar.value = new Intl.NumberFormat('id-ID').format(rupiah);
            } else {
                nilaiTukar.value = '';
            }
        }

        function generateTotal() {
            let hargaBarang = document.getElementById('hargaBarang').value;
            let nilaiTukarInput = document.getElementById('exchangeRatesInput').value;
            let total = document.getElementById('total');
            let terbilangOutput = document.getElementById('terbilangOutput');

            let hargaBarangValue = parseNumber(hargaBarang);
            let nilaiTukarValue = parseNumber(nilaiTukarInput);

            if (!isNaN(hargaBarangValue) && !isNaN(nilaiTukarValue)) {
                let totalHarga = hargaBarangValue * nilaiTukarValue;
                total.value = new Intl.NumberFormat('id-ID').format(totalHarga);
                
                terbilangOutput.textContent = "Terbilang: " + angkaTerbilang(totalHarga) + " rupiah";
            } else {
                total.value = '';
                terbilangOutput.textContent = '';
            }
        }

        function angkaTerbilang(angka) {
            let bilangan = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
            angka = parseInt(angka);

            if (angka < 12) return bilangan[angka];
            if (angka < 20) return bilangan[angka - 10] + " belas";
            if (angka < 100) return bilangan[Math.floor(angka / 10)] + " puluh " + bilangan[angka % 10];
            if (angka < 200) return "seratus " + angkaTerbilang(angka - 100);
            if (angka < 1000) return bilangan[Math.floor(angka / 100)] + " ratus " + angkaTerbilang(angka % 100);
            if (angka < 2000) return "seribu " + angkaTerbilang(angka - 1000);
            if (angka < 1000000) return angkaTerbilang(Math.floor(angka / 1000)) + " ribu " + angkaTerbilang(angka % 1000);
            if (angka < 1000000000) return angkaTerbilang(Math.floor(angka / 1000000)) + " juta " + angkaTerbilang(angka % 1000000);
            if (angka < 1000000000000) return angkaTerbilang(Math.floor(angka / 1000000000)) + " miliar " + angkaTerbilang(angka % 1000000000);
            if (angka < 10000000000000) return angkaTerbilang(Math.floor(angka / 1000000000000)) + " triliun " + angkaTerbilang(angka % 1000000000000);
            return "Angka terlalu besar!";
        }
    </script>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white border-bottom-0">
                <h4 class="text-center text-secondary">Konversi IDR ke Mata Uang Lain</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="hargaBarang" class="form-label">Harga Barang (IDR):</label>
                            <input type="text" id="hargaBarang" class="form-control" placeholder="Masukkan harga barang" required oninput="formatAngka(this);">
                        </div>
                        <div class="col-md-3">
                            <label for="exchangeRatesInput" class="form-label">Nilai Kurs:</label>
                            <input type="text" id="exchangeRatesInput" class="form-control" placeholder="Masukkan nilai kurs" required oninput="formatAngka(this); updateNilaiTukar();">
                            <a href="https://www.bi.go.id/id/statistik/informasi-kurs/transaksi-bi/default.aspx" target="_blank"> Cek Nilai Biaya Kurs</a> 
                        </div>
                        <div class="col-md-3">
                            <label for="pilihMataUang" class="form-label">Pilih Mata Uang:</label>
                            <select id="pilihMataUang" class="form-select">
                                <option value="" selected>Pilih Mata Uang</option>
                                <option value="usd">USD - Dollar</option>
                                <option value="eur">EUR - Euro</option>
                                <option value="jpy">JPY - Yen Jepang</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="mataUangAsing" class="form-label">Jumlah Mata Uang Asing:</label>
                            <input type="text" id="mataUangAsing" class="form-control" placeholder="Masukkan jumlah mata uang" required oninput="formatAngka(this); updateNilaiTukar();">
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-3">
                            <label for="nilaiTukar" class="form-label">Nilai Tukar (IDR):</label>
                            <input type="text" id="nilaiTukar" class="form-control" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="total" class="form-label">Total Harga (IDR):</label>
                            <input type="text" id="total" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <div id="terbilangOutput" class="alert alert-success mt-3">Terbilang:</div>
                        </div>

                        <button type="button" class="btn btn-primary w-100 mt-4" onclick="generateTotal()">Generate Total</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-header bg-white border-bottom-0">
                <h5 class="text-secondary">Konversi Angka ke Terbilang</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="angka" class="form-label">Masukkan Angka:</label>
                        <input type="text" id="angka" name="angka" class="form-control" placeholder="Masukkan angka" required oninput="formatAngka(this)">
                    </div>
                    <button type="submit" name="convertTerbilang" class="btn btn-primary w-100">Konversi Terbilang</button>
                </form>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['convertTerbilang'])) {
                        function terbilang($angka)
                        {
                            $angka = (float)str_replace('.', '', $angka);
                            $satuan = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

                            if ($angka < 12) return $satuan[$angka];
                            elseif ($angka < 20) return $satuan[$angka - 10] . " belas";
                            elseif ($angka < 100) return $satuan[intval($angka / 10)] . " puluh " . $satuan[$angka % 10];
                            elseif ($angka < 200) return "seratus " . terbilang($angka - 100);
                            elseif ($angka < 1000) return $satuan[intval($angka / 100)] . " ratus " . terbilang($angka % 100);
                            elseif ($angka < 2000) return "seribu " . terbilang($angka - 1000);
                            elseif ($angka < 1000000) return terbilang(intval($angka / 1000)) . " ribu " . terbilang($angka % 1000);
                            elseif ($angka < 1000000000) return terbilang(intval($angka / 1000000)) . " juta " . terbilang($angka % 1000000);
                            else return "Angka terlalu besar!";
                        }

                        $angka = str_replace('.', '', $_POST['angka']);
                        $terbilang = terbilang($angka);
                        echo "<div class='alert alert-success mt-3'>Terbilang: <strong>$terbilang rupiah</strong></div>";
                    }
                }
                ?>
            </div>
    </body>
</html>
