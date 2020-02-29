<?php
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID', 'IND.UTF8', 'IND', 'Indonesian', 'id', 'ID');

$config = [
  'host' => 'localhost',
  'user' => 'root',
  'pass' => '',
  'db' => 'dw_test'
];

// Database connection
$db = new mysqli($config['host'], $config['user'], $config['pass'], $config['db']);
if ($db->connect_error) die('Connection failed.');

// Paging
$page = !empty($_GET['p']) ? trim($_GET['p']) : '';

if ($page == '') {
  // Fetch list provinsi
  $query = $db->query("SELECT * FROM provinsi_tb");
  $provinsi_rows = $query->fetch_all(MYSQLI_ASSOC);
}

if ($page == 'view_provinsi') {
  // Params
  $prov_id = !empty($_GET['id']) ? $db->escape_string($_GET['id']) : 0;

  // Fetch provinsi data
  $query = $db->query("SELECT * FROM provinsi_tb WHERE id='$prov_id' LIMIT 1");
  $provinsi = $query->num_rows ? $query->fetch_assoc() : false;
  
  if ($provinsi) {
    $query = $db->query("SELECT * FROM kabupaten_tb WHERE provinsi_id='$prov_id' ORDER BY nama ASC");
    $kabupaten = $query->fetch_all(MYSQLI_ASSOC);
  }
}

if ($page == 'view_kabupaten') {
  // Params
  $kab_id = !empty($_GET['id']) ? $db->escape_string($_GET['id']) : 0;

  // Fetch provinsi data
  $query = $db->query("SELECT kab.*, prov.nama AS provinsi FROM kabupaten_tb AS kab
    INNER JOIN provinsi_tb AS prov ON kab.provinsi_id=prov.id
    WHERE kab.id='$kab_id' LIMIT 1");
  $kabupaten = $query->num_rows ? $query->fetch_assoc() : false;
}

if ($page == 'add_provinsi' && isset($_POST['submit'])) {
  // Params
  $nama = !empty($_POST['nama']) ? $db->escape_string(trim($_POST['nama'])) : null;
  $diresmikan = !empty($_POST['diresmikan']) ? trim($_POST['diresmikan']) : null;
  $diresmikan = strftime('%Y-%m-%d', strtotime($diresmikan));
  $photo = !empty($_POST['photo']) ? $db->escape_string(trim($_POST['photo'])) : null;
  $pulau = !empty($_POST['pulau']) ? $db->escape_string(trim($_POST['pulau'])) : null;

  if (!$nama) {
    $error = 'Nama kosong!';
  } else {
    $query = $db->query("INSERT INTO provinsi_tb (`nama`, `diresmikan`, `photo`, `pulau`)
      VALUES ('$nama', '$diresmikan', '$photo', '$pulau')");
    if ($query) {
      header('Location: 4.php?p=view_provinsi&id=' . $db->insert_id);
    } else {
      $error = 'Gagal menyimpan data!';
    }
  }
}

if ($page == 'edit_provinsi') {
  // Params
  $prov_id = !empty($_GET['id']) ? $db->escape_string($_GET['id']) : 0;

  // Submit for edit
  if (isset($_POST['submit'])) {
    // Params
    $nama = !empty($_POST['nama']) ? $db->escape_string(trim($_POST['nama'])) : null;
    $diresmikan = !empty($_POST['diresmikan']) ? trim($_POST['diresmikan']) : null;
    $diresmikan = strftime('%Y-%m-%d', strtotime($diresmikan));
    $photo = !empty($_POST['photo']) ? $db->escape_string(trim($_POST['photo'])) : null;
    $pulau = !empty($_POST['pulau']) ? $db->escape_string(trim($_POST['pulau'])) : null;

    if (!$nama) {
      $error = 'Nama kosong!';
    } else {
      $query = $db->query("UPDATE provinsi_tb SET nama='$nama', diresmikan='$diresmikan',
        photo='$photo', pulau='$pulau' WHERE id='$prov_id'");
      if ($query) {
        header("Location: 4.php?p=view_provinsi&id=$prov_id");
      } else {
        $error = 'Gagal menyimpan data!';
      }
    }
  }

  // Fetch provinsi data
  $query = $db->query("SELECT * FROM provinsi_tb WHERE id='$prov_id' LIMIT 1");
  $provinsi = $query->num_rows ? $query->fetch_assoc() : false;

  if ($provinsi) {
    $provinsi['diresmikan'] = strftime('%d-%m-%Y', strtotime($provinsi['diresmikan']));
  }
}

if ($page == 'del_provinsi') {
  // Params
  $prov_id = !empty($_GET['id']) ? $db->escape_string($_GET['id']) : 0;

  // Hapus provinsi
  $query = $db->query("DELETE FROM provinsi_tb WHERE id='$prov_id' LIMIT 1");
  header("Location: 4.php");
}

if ($page == 'add_kabupaten') {
  // Params
  $prov_id = !empty($_GET['id']) ? $db->escape_string($_GET['id']) : 0;

  // Fetch provinsi data
  $query = $db->query("SELECT nama FROM provinsi_tb WHERE id='$prov_id' LIMIT 1");
  $provinsi = $query->num_rows ? $query->fetch_assoc() : false;

  if (isset($_POST['submit'])) {
    // Params
    $nama = !empty($_POST['nama']) ? $db->escape_string(trim($_POST['nama'])) : null;
    $diresmikan = !empty($_POST['diresmikan']) ? trim($_POST['diresmikan']) : null;
    $diresmikan = strftime('%Y-%m-%d', strtotime($diresmikan));
    $photo = !empty($_POST['photo']) ? $db->escape_string(trim($_POST['photo'])) : null;

    if (!$nama) {
      $error = 'Nama kosong!';
    } else {
      $query = $db->query("INSERT INTO kabupaten_tb (`nama`, `provinsi_id`, `diresmikan`, `photo`)
        VALUES ('$nama', '$prov_id', '$diresmikan', '$photo')");
      if ($query) {
        header("Location: 4.php?p=view_provinsi&id=$prov_id");
      } else {
        $error = 'Gagal menyimpan data!';
      }
    }
  }
}

if ($page == 'edit_kabupaten') {
  // Params
  $kab_id = !empty($_GET['id']) ? $db->escape_string($_GET['id']) : 0;

  // Submit for edit
  if (isset($_POST['submit'])) {
    // Params
    $nama = !empty($_POST['nama']) ? $db->escape_string(trim($_POST['nama'])) : null;
    $diresmikan = !empty($_POST['diresmikan']) ? trim($_POST['diresmikan']) : null;
    $diresmikan = strftime('%Y-%m-%d', strtotime($diresmikan));
    $photo = !empty($_POST['photo']) ? $db->escape_string(trim($_POST['photo'])) : null;
    $pulau = !empty($_POST['pulau']) ? $db->escape_string(trim($_POST['pulau'])) : null;

    if (!$nama) {
      $error = 'Nama kosong!';
    } else {
      $query = $db->query("UPDATE kabupaten_tb SET nama='$nama', diresmikan='$diresmikan',
        photo='$photo' WHERE id='$kab_id'");
      if ($query) {
        header("Location: 4.php?p=view_kabupaten&id=$kab_id");
      } else {
        $error = 'Gagal menyimpan data!';
      }
    }
  }

  // Fetch data kabupaten
  $query = $db->query("SELECT kab.*, prov.nama AS provinsi
    FROM kabupaten_tb AS kab
    INNER JOIN provinsi_tb AS prov ON kab.provinsi_id=prov.id
    WHERE kab.id='$kab_id' LIMIT 1");
  $kabupaten = $query->num_rows ? $query->fetch_assoc() : false;

  if ($kabupaten) {
    $kabupaten['diresmikan'] = strftime('%d-%m-%Y', strtotime($kabupaten['diresmikan']));
  }
}

if ($page == 'del_kabupaten') {
  // Params
  $kab_id = !empty($_GET['id']) ? $db->escape_string($_GET['id']) : 0;

  // Fetch data kabupaten
  $query = $db->query("SELECT provinsi_id FROM kabupaten_tb WHERE id='$kab_id' LIMIT 1");
  $prov_id = $query->num_rows ? $query->fetch_assoc()['provinsi_id'] : false;

  // Hapus provinsi
  $query = $db->query("DELETE FROM kabupaten_tb WHERE id='$kab_id' LIMIT 1");
  header("Location: 4.php" . ($prov_id ? "?p=view_provinsi&id=$prov_id" : ''));
}
?>
<!doctype html>
<html>
  <head>
    <!-- meta tags -->
    <meta charset="UTF-8">
    <meta name="author" content="Khairul Hidayat">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- site title -->
    <title>Provinsi dan Kabupaten</title>

    <!-- styles -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
    <style type="text/css">
      * {
        font-family: 'Open Sans', sans-serif; color: #333;
      }

      html, body {
        margin: 0; padding: 0; background: #F5F5F5;
      }

      p, h1, h2, h3 {
        margin: 0 0 8px 0; padding: 0;
      }

      .align-center {
        text-align: center;
      }

      p { font-size: 1.1em; }
      p.caption { font-size: 0.9em; color: #686868; }
      h2 { font-size: 1.5em; border-bottom: 1px solid #ddd; padding-bottom: 16px; }
      h3 { font-size: 1.2em; }
      a { text-decoration: none; color: #43A047; }

      header {
        display: flex; background: #009688; height: 80px; align-items: center;
        padding: 0 32px; box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.4);
      }

      header .title {
        color: #fff; font-size: 1.4em; font-weight: normal; margin: 0;
      }

      article {
        display: block; margin: 0; padding: 32px; overflow: hidden;
      }

      .item-grid {
        display: flex; flex-direction: row; flex-wrap: wrap;
        margin: -2.5% -2.5% 0 0;
      }

      .item-grid.centered {
        justify-content: center;
      }

      .item-grid .item {
        width: 22.5%; margin: 2.5% 2.5% 0 0;
      }

      .card {
        background: #fff; box-shadow: 0 2px 4px 1px rgba(0, 0, 0, 0.4);
        display: flex; flex-direction: column;
      }

      .card .photo {
        align-self: center; height: 150px; margin: 32px 0;
      }

      .card .detail {
        padding: 0 16px; border-top: 1px solid #ddd;
        height: 80px; display: flex; flex-direction: column; justify-content: center;
      }

      .message {
        background: #FFF8E1; color: #333; font-size: 1.1em; padding: 16px;
        border: 1px solid #FFECB3; margin-bottom: 16px;
      }

      .button, input[type='submit'] {
        display: block; padding: 12px 16px; background: #009688; color: #fff;
        text-align: center; border: none; font-size: 1.0em;
      }

      .button.contained, input[type='submit'] {
        border-radius: 3px; box-shadow: 0 1px 4px 1px rgba(0, 0, 0, 0.2);
      }

      .button.alt {
        background: #EEEEEE; color: #333;
      }

      input[type='text'] {
        border: none; border-bottom: 1px solid #ddd; font-size: 1.0em;
        padding-bottom: 4px;
      }

      input[type='text']:focus {
        outline: none;
      }
    </style>
  </head>

  <body>
    <header>
      <a href="4.php">
        <h1 class="title">Provinsi dan Kabupaten</h1>
      </a>
    </header>

    <article>
      <?php if ($page == '') { ?>
      <!-- Home -->
      <div class="item-grid centered">
        <!-- Tambah provinsi button -->
        <div class="item">
          <a href="?p=add_provinsi">
          <div class="card">
            <div style="margin-top: 40px;"></div>
            <img class="photo" src="https://img.icons8.com/cotton/2x/plus.png" />
            <div style="margin-top: 40px;"></div>
            <div class="button">Tambah</div>
          </div>
          </a>
        </div>
        <!-- End of tambah provinsi button -->

        <?php foreach ($provinsi_rows as $row) { ?>
          <div class="item">
            <!-- Provinsi item -->
            <div class="card">
              <img class="photo" src="<?php echo $row['photo']; ?>" />
              <div class="detail">
                <p class="align-center">
                  <?php echo $row['nama']; ?>
                </p>
                <p class="align-center caption">
                  <?php echo strftime('%e %B %Y', strtotime($row['diresmikan'])); ?>
                </p>
              </div>
              <a href="?p=view_provinsi&id=<?php echo $row['id']; ?>" class="button">Detail</a>
            </div>
          </div>
        <?php } ?>
      </div>
      <!-- End of Home -->
      <?php } ?>

      <?php if ($page == 'view_provinsi' && $provinsi) { ?>
      <!-- View Provinsi -->
      <div style="display: flex; align-items: flex-start;">
        <div style="width: 20%; margin-right: 5%; display: flex; flex-direction: column;">
          <img src="<?php echo $provinsi['photo']; ?>" style="width: 80%; align-self: center;" />
          <a href="?p=edit_provinsi&id=<?php echo $provinsi['id']; ?>" class="button contained" style="margin-top: 32px;">
            Ubah
          </a>
        </div>
        <div style="flex: 1;">
          <h2>
            <?php echo $provinsi['nama']; ?>
          </h2>
          <div style="display: flex; border-bottom: 1px solid #ddd;">
            <p style="flex: 3;">Tanggal diresmikan</p>
            <p style="flex: 9;">
              <?php echo strftime('%e %B %Y', strtotime($provinsi['diresmikan'])); ?>
            </p>
          </div>
          <div style="display: flex; border-bottom: 1px solid #ddd; margin-top: 6px;">
            <p style="flex: 3;">Pulau</p>
            <p style="flex: 9;"><?php echo $provinsi['pulau']; ?></p>
          </div>

          <h3 style="margin-top: 32px; margin-bottom: 16px;">Kabupaten:</h3>
          <div class="item-grid">
            <!-- Tambah kabupaten button -->
            <div class="item">
              <a href="?p=add_kabupaten&id=<?php echo $provinsi['id']; ?>">
              <div class="card">
                <div style="margin-top: 40px;"></div>
                <img class="photo" src="https://img.icons8.com/cotton/2x/plus.png" />
                <div style="margin-top: 40px;"></div>
                <div class="button">Tambah</div>
              </div>
              </a>
            </div>
            <!-- End of tambah kabupaten button -->
            
            <?php foreach ($kabupaten as $row) { ?>
              <!-- Kabupaten item -->
              <div class="item">
                <div class="card">
                  <img class="photo" src="<?php echo $row['photo']; ?>" />
                  <div class="detail">
                    <p class="align-center">
                      <?php echo $row['nama']; ?>
                    </p>
                    <p class="align-center caption">
                      <?php echo strftime('%e %B %Y', strtotime($row['diresmikan'])); ?>
                    </p>
                  </div>
                  <a href="?p=view_kabupaten&id=<?php echo $row['id']; ?>" class="button">Detail</a>
                </div>
              </div>
              <!-- End of kabupaten item -->
            <?php } ?>
          </div>
          
        </div>
      </div>
      <!-- End of View Provinsi -->
      <?php } ?>

      <?php if ($page == 'view_kabupaten' && $kabupaten) { ?>
      <!-- View Kabupaten -->
      <div style="display: flex; align-items: flex-start;">
        <div style="width: 20%; margin-right: 5%; display: flex; flex-direction: column;">
          <img src="<?php echo $kabupaten['photo']; ?>" style="width: 80%; align-self: center;" />
          <a href="?p=edit_kabupaten&id=<?php echo $kabupaten['id']; ?>" class="button contained" style="margin-top: 32px;">
            Ubah
          </a>
        </div>
        <div style="flex: 1;">
          <h2>
            <?php echo $kabupaten['nama']; ?>
          </h2>
          <div style="display: flex; border-bottom: 1px solid #ddd;">
            <p style="flex: 3;">Tanggal diresmikan</p>
            <p style="flex: 9;">
              <?php echo strftime('%e %B %Y', strtotime($kabupaten['diresmikan'])); ?>
            </p>
          </div>
          <div style="display: flex; border-bottom: 1px solid #ddd; margin-top: 6px;">
            <p style="flex: 3;">Provinsi</p>
            <p style="flex: 9;">
              <a href="?p=view_provinsi&id=<?php echo $kabupaten['provinsi_id']; ?>">
                <?php echo $kabupaten['provinsi']; ?>
              </a>
            </p>
          </div>
        </div>
      </div>
      <!-- End of View Kabupaten -->
      <?php } ?>

      <?php if ($page == 'add_provinsi') { ?>
      <!-- Add Provinsi -->
      <form method="POST">
        <?php if (isset($error)) echo "<div class=\"message\">$error</div>\n"; ?>
        <div class="card" style="padding: 32px;">
          <p class="caption">Nama Provinsi</p>
          <input type="text" name="nama" />
          <br />
          <p class="caption">Tanggal Diresmikan</p>
          <input type="text" name="diresmikan" placeholder="DD-MM-YYYY" />
          <br />
          <p class="caption">Foto</p>
          <input type="text" name="photo" />
          <br />
          <p class="caption">Pulau</p>
          <input type="text" name="pulau" />
          <br />
          <input type="submit" value="Simpan" name="submit" />
        </div>
      </form>
      <!-- End of Add Provinsi -->
      <?php } ?>

      <?php if ($page == 'edit_provinsi' && $provinsi) { ?>
      <!-- Edit Provinsi -->
      <form method="POST">
        <?php if (isset($error)) echo "<div class=\"message\">$error</div>\n"; ?>
        <div class="card" style="padding: 32px;">
          <p class="caption">Nama Provinsi</p>
          <input type="text" name="nama" value="<?php echo $provinsi['nama']; ?>" />
          <br />
          <p class="caption">Tanggal Diresmikan</p>
          <input type="text" name="diresmikan" value="<?php echo $provinsi['diresmikan']; ?>" placeholder="DD-MM-YYYY" />
          <br />
          <p class="caption">Foto</p>
          <input type="text" name="photo" value="<?php echo $provinsi['photo']; ?>" />
          <br />
          <p class="caption">Pulau</p>
          <input type="text" name="pulau" value="<?php echo $provinsi['pulau']; ?>" />
          <br />
          <input type="submit" value="Simpan" name="submit" />
          <a href="?p=del_provinsi&id=<?php echo $provinsi['id']; ?>" class="button contained alt" style="margin-top: 16px;">
            Hapus
          </a>
        </div>
      </form>
      <!-- End of Edit Provinsi -->
      <?php } ?>

      <?php if ($page == 'add_kabupaten') { ?>
      <!-- Add Kabupaten -->
      <form method="POST">
        <?php if (isset($error)) echo "<div class=\"message\">$error</div>\n"; ?>
        <div class="card" style="padding: 32px;">
          <p class="caption">Nama Provinsi</p>
          <input type="text" readonly value="<?php echo $provinsi ? $provinsi['nama'] : ''; ?>" />
          <br />
          <p class="caption">Nama Kabupaten</p>
          <input type="text" name="nama" />
          <br />
          <p class="caption">Tanggal Diresmikan</p>
          <input type="text" name="diresmikan" placeholder="DD-MM-YYYY" />
          <br />
          <p class="caption">Foto</p>
          <input type="text" name="photo" />
          <br />
          <input type="submit" value="Simpan" name="submit" />
        </div>
      </form>
      <!-- End of Add Kabupaten -->
      <?php } ?>

      <?php if ($page == 'edit_kabupaten' && $kabupaten) { ?>
      <!-- Edit Kabupaten -->
      <form method="POST">
        <?php if (isset($error)) echo "<div class=\"message\">$error</div>\n"; ?>
        <div class="card" style="padding: 32px;">
          <p class="caption">Nama Provinsi</p>
          <input type="text" readonly value="<?php echo $kabupaten['provinsi']; ?>" />
          <br />
          <p class="caption">Nama Kabupaten</p>
          <input type="text" name="nama" value="<?php echo $kabupaten['nama']; ?>" />
          <br />
          <p class="caption">Tanggal Diresmikan</p>
          <input type="text" name="diresmikan" value="<?php echo $kabupaten['diresmikan']; ?>" placeholder="DD-MM-YYYY" />
          <br />
          <p class="caption">Foto</p>
          <input type="text" name="photo" value="<?php echo $kabupaten['photo']; ?>" />
          <br />
          <input type="submit" value="Simpan" name="submit" />
          <a href="?p=del_kabupaten&id=<?php echo $kabupaten['id']; ?>" class="button contained alt" style="margin-top: 16px;">
            Hapus
          </a>
        </div>
      </form>
      <!-- End of Edit Kabupaten -->
      <?php } ?>
    </article>
  </body>
</html>
<?php
$db->close();
?>
