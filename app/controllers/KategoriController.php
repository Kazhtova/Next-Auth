<?php
include_once 'config/database.php';
include_once 'app/models/KategoriModel.php';

class KategoriController {
  private $db;
  private $KategoriModel;

  public function __construct() {
    $database = new Database();
    $this->db = $database->getConnection();
    $this->KategoriModel = new KategoriModel($this->db);

  }

  public function index() {
    if(!isset($_SESSION['admin_id'])) {
      header("Location: index.php");
      exit;
    }

    if(isset($_GET['search'])) {
      $keyword = $_GET['search'];

      $data_kategori = $this->KategoriModel->searchkategori($keyword);
    }else{
      $data_kategori = $this->KategoriModel->getAll();
    }


    include 'app/views/kategori/index.php';
  }

  public function tambah() {
    if(!isset($_SESSION['admin_id'])) {
      header("Location: index.php");
      exit;
    }
    include 'app/views/kategori/tambah.php';
    }

  public function tambahproses(){
    if(!isset($_SESSION['admin_id'])){
      header("Location: index.php");
      exit;
    }

    if($_POST) {
      $nama = $_POST['nama_kategori'];
      $admin_id = $_SESSION['admin_id'];
        if(!empty($nama)) {
        if ($this->KategoriModel->cekKategoriAda($nama)) {
          $_SESSION['error_msg'] = "Gagal: Kategori '<b>$nama</b>' sudah ada!";
          header("Location: index.php?act=kategori-tambah");
          exit;
        } else {
          $this->KategoriModel->create($nama, $admin_id);
          $_SESSION['success_msg'] = "Berhasil Tambah Kategori";
          header("Location: index.php?act=kategori");
          exit;
        }
      }
    }
  }

  public function edit(){
    if(!isset($_GET['id_kategori']) && $_SESSION['admin_id']) {
      header("Location: index.php?act=edit-kategori");
      exit;
    }
    $id_kategori = isset($_GET['id_kategori']) ? $_GET['id_kategori'] : die("Error: ID Kosong");
    $kategori = $this->KategoriModel->getById($id_kategori);
    $data_kategori = $this->KategoriModel->edit($id_kategori);

    include 'app/views/kategori/edit.php';
  }

  public function editproses() {
    if(!isset($_POST['id_kategori']) && !isset($_SESSION['admin_id'])) {
      $_SESSION['error_msg'] = "error";
      header("Location: index.php?act=kategori");
      exit;
    }
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];
    $data_kategori = $this->KategoriModel->editkategori($nama_kategori, $id_kategori);
    $_SESSION['success_msg'] = "Berhasil Update";
    header("Location: index.php?act=kategori");
    exit;
  }

  public function hapus(){
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
      $id_kategori = $_GET['id_kategori'];
      if($this->KategoriModel->hapus($id_kategori)) {
          $_SESSION['success_msg'] = "Berhasil Hapus Kategori";
          header("Location: index.php?act=kategori");
          exit; 
      }
    }
  }

}