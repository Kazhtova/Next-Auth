<?php

include_once 'config/database.php';
include_once 'app/models/CatatanModel.php';
include_once 'app/models/KategoriModel.php';

class CatatanController {
    private $db;
    private $CatatanModel;
    private $KategoriModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->CatatanModel = new CatatanModel($this->db);
        $this->KategoriModel = new KategoriModel($this->db);
    }

    public function index(){
        if(!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
        }
        
        if(isset($_GET['search'])) {
            $keyword = $_GET['search'];
            
            $data_catatan = $this->CatatanModel->searchcatatan($keyword);
        }else{
            $data_catatan = $this->CatatanModel->getAll();
        }
        include 'app/views/catatan/index.php';
    }

    public function tambah() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
        }
        $data_kategori = $this->KategoriModel->getAll();
        include 'app/views/catatan/tambah.php';
    }

    public function tambahproses() {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }
            
            if($_POST){
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $id_kategori = $_POST['id_kategori'];
            $id_admin = $_SESSION['admin_id'];
            

            if(!empty($judul)) {
                $this->CatatanModel->create($judul, $isi, $id_kategori, $id_admin);
                $_SESSION['success_msg'] = "Berhasil Menambahkan Catatan";
            }
            header("Location: index.php?act=catatan");
            exit;
            
        }
    }

    public function edit(){
        if(!isset($_SESSION['admin_id'])){
            header("Location: index.php");exit;
        }
        $id_catatan = isset($_GET['id_catatan']) ? $_GET['id_catatan'] : die("Error: ID Kosong");
        $catatan = $this->CatatanModel->getById($id_catatan);
        $data_kategori = $this->KategoriModel->getAll();
        include 'app/views/catatan/edit.php';
    }

    public function editproses() {
        if(!isset($_SESSION['admin_id'])) {
            header("Location: index.php");
            exit;
        }
        if($_POST) {
            $id = $_POST['id_catatan'];
            $judul = $_POST['judul'];
            $isi = $_POST['isi'];
            $id_kategori = $_POST['id_kategori'];

            if(!empty($judul) && !empty($id)) {
                $this->CatatanModel->update($id, $judul, $isi, $id_kategori);
                $_SESSION['success_msg'] = "Berhasil Edit Catatan";
            }
        }
        header("Location: index.php?act=catatan");
        exit;
    }

    public function hapus(){
        if(!isset($_SESSION['admin_id'])){
            header("Location: index.php");
            exit;
        }
        if(isset($_GET['id_catatan'])) {
            $this->CatatanModel->delete($_GET['id_catatan']);
            $_SESSION['success_msg'] = "Berhasil Dihapus";
        }
        header('Location: index.php?act=catatan');
        exit;
    }
    

}