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
        font-family: 'Open Sans', sans-serif;
      }

      html, body {
        margin: 0; padding: 0; background: #F5F5F5;
      }

      p, h1, h2, h3 {
        margin: 0; padding: 0;
      }

      .align-center {
        text-align: center;
      }

      p { font-size: 1.0em; }
      p.caption { font-size: 0.9em; color: #686868; }
      h3 { font-size: 1.2em; font-weight: normal; }
      a { text-decoration: none; }

      header {
        display: flex; background: #009688; height: 80px; align-items: center;
        padding: 0 32px; box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.4);
      }

      header .title {
        color: #fff; font-size: 1.4em; font-weight: normal;
      }

      article {
        display: block; margin: 0; padding: 32px; overflow: hidden;
      }

      .item-grid {
        display: flex; flex-direction: row; flex-wrap: wrap; justify-content: center;
        margin: -2.5% -2.5% 0 0;
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
        padding: 16px; border-top: 1px solid #ddd;
      }

      .card .button {
        display: block; padding: 12px 16px; background: #009688; color: #fff;
        text-align: center;
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
      <div class="item-grid">
        <?php foreach ($provinsi_rows as $row) { ?>
          <div class="item">
            <!-- Provinsi item -->
            <div class="card">
              <img class="photo" src="<?php echo $row['photo']; ?>" />
              <div class="detail">
                <h3 class="align-center">
                  <?php echo $row['nama']; ?>
                </h3>
                <p class="align-center caption" style="margin-top: 4px;">
                  <?php echo strftime('%e - %B %Y', strtotime($row['diresmikan'])); ?>
                </p>
              </div>
              <a href="?p=view_provinsi&id=<?php echo $row['id']; ?>" class="button">Detail</a>
            </div>
          </div>
        <?php } ?>
      </div>
      <!-- End of Home -->
      <?php } ?>

      <?php if ($page == 'view_provinsi') { ?>
      <!-- View Provinsi -->
      <?php echo $provinsi ? $provinsi['nama'] : '404'; ?>
      <!-- End of View Provinsi -->
      <?php } ?>
    </article>
  </body>
</html>
<?php
$db->close();
?>
