  <?php
  class Shell
  {
    public $hargaPerLiter;
    public $jumlahLiter;
    public $jenisBbm;
    public $ppn = 1.1;
    // 1.1 == 110% -_- !!

    public function __construct($hargaPerLiter, $jumlahLiter, $jenisBbm)
    {
      $this->hargaPerLiter = $hargaPerLiter;
      $this->jumlahLiter = $jumlahLiter;
      $this->jenisBbm = $jenisBbm;
    }

    public function hitungTotal()
    {
      $total = $this->hargaPerLiter * $this->jumlahLiter * $this->ppn;
      return $total;
    }
  }

  class Beli extends Shell
  {
    public function buktiTransaksi()
    {
      return number_format($this->hitungTotal());
    }
  }

  $hargaPerLiter = [
    "super" => 15420,
    "v-power" => 16130,
    "vpdiesel" => 18310,
    "ppnitro" => 16510
  ];

  $date = 'dd/mm/yy';
  $time = 'hh:mm:ss';
  $jenisBbm = '';
  $harga = 0;
  $jumlah = 0;
  $error_message = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['jumlah_liter']) || $_POST['jumlah_liter'] < 1) {
      $error_message = '<p class="mt-3 text-center text-maincolor">*Masukan Nilai Valid</p>';
    } else {
      $jumlah = $_POST['jumlah_liter'];
      $jenisBbm = $_POST['bahan_bakar'];
      $harga = $hargaPerLiter[$jenisBbm];
      date_default_timezone_set('Asia/Jakarta');
      $date = date('d/m/y');
      $time = date('H:i:s');
    }
  }

  $transaksi = new Beli($harga, $jumlah, $jenisBbm);
  ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OOP-BahanBakar</title>
    <link rel="stylesheet" href="public/css/output.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="icon" href="public/img/shellLogo.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
  </head>

  <body class="font-poppins bg-bg">
    <header class="text-white mb-10 text-2xl h-[55px] bg-maincolor px-10 w-full flex items-center">
      <i class="mr-2 bi bi-code-slash"></i>MipalSch
    </header>

    <main class="md:h-[73vh] z-10">
      <div class="flex flex-wrap items-center justify-center h-full md:flex-nowrap">
        <div class="md:bg-white px-5 py-7 sm:min-w-[420px] max-w-[360px] h-[480px] md:border-2 border-bordercolor relative">
          <img src="public/img/shellLogo.png" alt="" class="sm:w-[90px] w-[80px] mb-12 mx-auto">
          <form action="" method="post" class="flex flex-col">
            <input type="number" name="jumlah_liter" placeholder="Masukan Jumlah Liter" class="px-5 mb-5 border-2 border-bordercolor h-[50px] rounded-md">
            <select name="bahan_bakar" id="bahanBakar" class="border-2 border-bordercolor h-[50px] px-5 mb-5 rounded-md text-slate-400">
              <option value="super">Shell Super Rp15.420,00/L</option>
              <option value="v-power">Shell V-Power Rp16.130,00/L</option>
              <option value="vpdiesel">Shell VP Diesel Rp18.310,00/L</option>
              <option value="vpnitro">Shell VP Nitro Rp16.510,00/L</option>
            </select>
            <button type="submit" class="px-8 h-[50px] bg-maincolor text-white mb-7">Beli</button>
          </form>
          <p class="text-[13px] text-center text-slate-400 leading-2">Setiap pembelian akan dikenakan biaya tambahan
            berupa ppn sebesar 10%.</p>
          <?= $error_message ?>
        </div>

        <div class="md:bg-white px-7 py-4 sm:min-w-[420px] max-w-[360px] h-[480px] md:border-2 md:border-l-0 border-bordercolor uppercase text-slate-500 text-[13px] sm:text-base">
          <div class="flex items-center justify-center mb-6 text-2xl font-semibold sm:text-3xl text-slate-600">
            <img src="public/img/shellLogo.png" alt="" class="w-[35px] grayscale mr-3">Shell
          </div>
          <p class="mb-4 text-center sm:text-[18px] text-base">JL. Lembah Nendeut, Sukakarya<br>Megamendung, Kab. Bogor</p>
          <p>waktu : <?= $date ?> <span class="ml-7"> <?= $time ?> </span></p>

          <div class="py-4 my-4 border-dashed border-y-2 border-slate-500">
            <table class="w-full table-fixed">
              <tr>
                <td>nama produk</td>
                <td>Shell</td>
              </tr>
              <tr>
                <td>Grade</td>
                <td>Shell <?= $jenisBbm ?></td>
              </tr>
              <tr>
                <td>Harga/liter</td>
                <td>rp <?= number_format($harga) ?></td>
              </tr>
              <tr>
                <td>volume</td>
                <td>(l) <?= $jumlah ?></td>
              </tr>
              <tr>
                <td>ppn</td>
                <td>10%</td>
              </tr>
              <tr>
                <td>total harga</td>
                <td>rp <?= $transaksi->buktiTransaksi() ?></td>
              </tr>
              <tr>
                <td>operator</td>
                <td>Muhammad Patrick</td>
              </tr>
            </table>
          </div>
          Terimakasih Dan Selamat Jalan.
        </div>
      </div>

    </main>
    <footer class="bg-bg h-[55px] mt-10 px-10 border-t-2 w-full border-bordercolor flex items-center text-slate-500">
      <p class="text-[11px] md:text-base mx-auto md:mx-0 text-center w-full sm:text-left">
        Copyright©2024 All rights reserved | Made By <span class="text-maincolor">Muhammad Ipal</span>
      </p>
    </footer>
  </body>

  </html>