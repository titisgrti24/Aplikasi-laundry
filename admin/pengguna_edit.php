<?php
$title = 'pengguna';
require'functions.php';

$role = ['admin','owner','kasir'];

$id_user = $_GET['id'];
$queryedit = "SELECT * FROM user WHERE id_user = '$id_user'";
$edit = ambilsatubaris($conn,$queryedit);

if(isset($_POST['btn-simpan'])){
    $nama     = $_POST['nama_user'];
    $username = $_POST['username'];
    $pass     = $_POST['password'];
    $pass2    = $_POST['password2'];
    $role     = $_POST['role'];
    
    if($pass == $pass2){
        $pass = md5($_POST['password']);
        if($_POST['password'] != null || $_POST['password'] == ''){
            $query = "UPDATE user SET nama_user = '$nama' , username = '$username' , role = '$role' , password ='$pass' WHERE id_user = '$id_user'";    
        }else{
            $query = "UPDATE user SET nama_user = '$nama' , username = '$username' , role = '$role' WHERE id_user = '$id_user'";
        }

        $execute = bisa($conn,$query);
        if($execute == 1){
            $success = 'true';
            $title = 'Berhasil';
            $message = 'Berhasil mengubah ' .$role;
            $type = 'success';
            header('location: pengguna.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
        }else{
            echo "Gagal Tambah Data";
            echo "<script type='text/javascript'>alert('Error. Gagal Tambah Data!');</script>";
            // header('location: pengguna_edit.php?id='.$id_user);
        }
    }
    else{
        echo "Gagal Tambah Data";
        echo "<script type='text/javascript'>
                alert('password tidak sama!');
            </script>";
        // header('location: pengguna_edit.php?id='.$id_user);
    }
}


require'layout_header.php';
?> 
<div class="container-fluid">
    
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="">
                <div class="form-group">
                    <label>Nama Pengguna</label>
                    <input autocomplete="off" type="text" name="nama_user" class="form-control" value="<?= $edit['nama_user'] ?>">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input autocomplete="off" type="text" name="username" class="form-control" value="<?= $edit['username'] ?>">
                <div class="form-group">
                    <label>Password</label>
                    <input autocomplete="off" type="text" name="password" class="form-control">
                    <small class="text-danger">Kosongkan saja jika tidak akan mengubah password</small>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input autocomplete="off" type="text" name="password2" class="form-control">
                    <small class="text-danger">Kosongkan saja jika tidak akan mengubah password</small>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <?php foreach ($role as $key): ?>
                            <?php if ($key == $edit['role']): ?>
                            <option value="<?= $key ?>" selected><?= $key ?></option>    
                            <?php endif ?>
                            <option value="<?= $key ?>"><?= ucfirst($key) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="text-right">
                    <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-refresh fa-fw"></i> Reset</button>
                    <button type="submit" name="btn-simpan" class="btn btn-success"><i class="fa fa-save fa-fw"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require'layout_footer.php';
?>