<!DOCTYPE html>
<html lang="en">
<head>
    <title>PrismaNews</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>



</head>
<body>
<nav>
        <div class="wrapper">
            <div class="logo"><a href=''>CSSA U-Prisma</a></div>
            
            <div class="menu">
                <ul>
                    <li><a href="index.html#home">Home</a></li>
                    <li><a href="index.html#aboutus">About Us</a></li>
                    <li><a href="index.html#officers">Officers</a></li>
                    <li><a href="index.html#gallery">Gallery</a></li>
                    <li><a href="index.html#partners">Partners</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="index.php">News</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <?php
        include 'config/database.php';
        $ambil_kategori = mysqli_query ($kon,"select * from profil limit 1");
        $row = mysqli_fetch_assoc($ambil_kategori); 
        $nama_website = $row['nama_website'];
        $copy_right = $row['nama_website'];
    ?>
    <a class="navbar-brand" href="index.php?halaman=home"><?php echo $nama_website;?></a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
        <?php
         
            include 'config/database.php';
            $sql="select * from kategori";
            $hasil=mysqli_query($kon,$sql);
            while ($data = mysqli_fetch_array($hasil)):
        ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori'];?></a>
            </li>
            <?php endwhile; ?>
        </ul>
        <ul class="navbar-nav  ml-auto">
            <?php 
                session_start();
                if (isset($_SESSION["id_pengguna"])) {
                        echo " <li><a class='nav-link' href='admin/index.php?halaman=kategori'>Halaman Admin</a></li>";
                }else {
                    echo " <li><a class='nav-link' href='index.php?halaman=login'><span class='fas fa-log-in'></span> Login</a></li>";
                }
            ?>
        </ul>
    </div>
   
</nav>
<div class="jumbotron text-center">

<?php
    $judul="PrismaNews";   
    include 'config/database.php';
    if (isset($_GET['id'])) {
        $sql="select * from artikel where status=1 and id_artikel=".$_GET['id']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['judul_artikel'];  
    }else if (isset($_GET['kategori'])){
        $sql="select * from kategori where id_kategori=".$_GET['kategori']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['nama_kategori'];  
    }

    

?>
    <h1><?php echo $judul;?></h1>

</div>

<div class="container">
<?php 
    if(isset($_GET['halaman'])){
        $halaman = $_GET['halaman'];
        switch ($halaman) {
            case 'home':
                include "home.php";
                break;
            case 'artikel':
                include "artikel.php";
                break;
            case 'login':
                include "login.php";
                break;
            default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
    }else {
        include "home.php";
    }
?>
</div>

<div id="contact">
        <div class="wrapper">
            <div class="footer">
                <div class="footer-section">
                    <h3>Universitas Prisma</h3>
                    <p>Prisma Campus Manado - Jl. Pomorouw No. 113, Kel. Tikala Baru Link.3, Kec. Tikala, Kota Manado, Prov. Sulawesi Utara</p>
                </div>
                <div class="footer-section">
                    <h3>CSSA Prisma</h3>
                    <p><b>Office: </b><a href="https://goo.gl/maps/cWgeZ4YGerkFJRz38?coh=178571&entry=tt">Prisma Campus Manado - 2nd Floor Room 206</a> </p>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p>cssa@prisma.ac.id</p>
                </div>
                <div class="footer-section">
                    <h3>Social Media</h3>
                    <p><b>Instagram: </b> <a href="https://www.instagram.com/cssaprisma/">cssaprisma</a> </p>
                    <p><b>Campus Web: </b> <a href="https://www.prisma.ac.id/teknik-informatika">prisma.ac.id/teknik-informatika</a> </p>
                </div>
            </div>
        </div>
    </div>

    <div id="copyright">
        <div class="wrapper">
            &copy; 2023 <b>Samuel Towoliu </b> CSSA U-Prisma
        </div>
    </div>
    
</body>

<style type="text/css">
  body {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px;
  }
 
  #scroll-btn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: red;
    color: white;
    cursor: pointer;
    padding: 15px 19px;
    border-radius: 100px;
  }
 
  #scroll-btn:hover {
    background-color: #555;
  }
 
  .sampel {
    min-height: 2000px;
  }
</style>
</head>

<body>
 
<button onclick="topFunction()" id="scroll-btn" title="Top">&uarr;</button>
 
<script>
window.onscroll = function() {scrollFunction()};
 
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("scroll-btn").style.display = "block";
  } else {
    document.getElementById("scroll-btn").style.display = "none";
  }
}
 
// ketika tombol tersebut di klik, maka lakukan scroll keatas laman
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>
 
</body>

</html>