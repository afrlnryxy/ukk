<?php
    error_reporting(0);
    include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);
	
	$produk = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the form is submitted
        if (isset($_POST['like'])) {
            // Handle like button click
            $imageId = $_GET['id'];
            $adminId = 2; // Assuming admin_id is hard-coded for this example
            $tanggalLike = date("Y-m-d H:i:s"); // Assuming you want to store the exact timestamp
            mysqli_query($conn, "INSERT INTO likefoto (image_id, admin_id, tanggallike) VALUES ('$imageId', '$adminId', '$tanggalLike')");
        } elseif (isset($_POST['comment'])) {
            // Handle comment submission
            $imageId = $_GET['id'];
            $adminId = 2; // Assuming admin_id is hard-coded for this example
            $isiKomentar = mysqli_real_escape_string($conn, $_POST['comment']); // Sanitize input
            $tanggalKomentar = date("Y-m-d H:i:s"); // Assuming you want to store the exact timestamp
            mysqli_query($conn, "INSERT INTO komentarfoto (image_id, admin_id, isikomentar, tanggalkomentar) VALUES ('$imageId', '$adminId', '$isiKomentar', '$tanggalKomentar')");
        }
    }
    error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri Foto</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="index.php">WEB GALERI FOTO</a></h1>
        <ul>
            <li><a href="galeri.php">Galeri</a></li>
           <li><a href="registrasi.php">Registrasi</a></li>
           <li><a href="login.php">Login</a></li>
        </ul>
        </div>
    </header>
    
    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto" value="<?php echo $_GET['search'] ?>" />
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>
    
    <!-- product detail -->
    <div class="section">
        <div class="container">
             <h3>Detail Foto</h3>
            <div class="box">
                <div class="col-2">
                   <img src="foto/<?php echo $p->image ?>" width="100%" /> 
                </div>
                <div class="col-2">
                   <h3><?php echo $p->image_name ?><br />Kategori : <?php echo $p->category_name  ?></h3>
                   <h4>Nama User : <?php echo $p->admin_name ?><br />
                   Upload Pada Tanggal : <?php echo $p->date_created  ?></h4>
                   <p>Deskripsi :<br />
                        <?php echo $p->image_description ?>
                   </p>
                   
                </div>
                <div class="col-2">
                <!-- Like button form -->
                <form method="post">
                    <input type="hidden" name="like" value="1">
                    <button type="submit">Like</button>
                </form>

                <!-- Comment form -->
                <form method="post">
                    <textarea name="comment" placeholder="Add a comment"></textarea>
                    <button type="submit">Post Comment</button>
                </form>
            </div>
            </div>
        </div>
    </div>
    
    

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri Foto.</small>
        </div>
    </footer>
</body>
</html>