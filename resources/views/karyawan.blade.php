<?php
//insert.php;

if(isset($_POST["pendidikan"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=projects", "root", "");
 $id_user = uniqid();
 for($count = 0; $count < count($_POST["pendidikan"]); $count++)
 {  
  $query = "INSERT INTO pendidikan 
  (id_user, pendidikan, jurusan, masuk, lulus) 
  VALUES (:id_user, :pendidikan, :jurusan, :masuk, lulus)
  ";
  $statement = $connect->prepare($query);
  $statement->execute(
   array(
    ':id_user'   => $id_user,
    ':pendidikan'  => $_POST["pendidikan"][$count], 
    ':jurusan' => $_POST["jurusan"][$count], 
    ':masuk'  => $_POST["masuk"][$count],
    ':lulus'  => $_POST["lulus"][$count]
   )
  );
 }
 $result = $statement->fetchAll();
 if(isset($result))
 {
  echo 'ok';
 }
}
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container mt-5">

        <!-- Success message -->
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif

        <form action="" method="post" action="{{ route('karyawan.store') }}">

            <!-- CROSS Site Request Forgery Protection -->
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat">
            </div>

            <div class="form-group">
                <label>No. Ktp</label>
                <input type="text" class="form-control" name="ktp" id="ktp" required>
            </div>

            <div class="form-group">
            <label>Pendidikan</label>
            <div class="table-repsonsive">
            <span id="error"></span>
            <table class="table table-bordered" id="table_pendidikan">
            <tr>
            <th>Nama Sekolah/Universitas</th>
            <th>Jurusan</th>
            <th>Tahun Masuk</th>
            <th>Tahun Lulus</th>
            <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
            </tr>
            </table>
            </div>

            <div class="form-group">
            <label>Pengalaman Kerja</label>
            <div class="table-repsonsive">
            <span id="error"></span>
            <table class="table table-bordered" id="table_pekerjaan">
            <tr>
            <th>Perusahaan</th>
            <th>Jabatan</th>
            <th>Tahun</th>
            <th>Keterangan</th>
            <th><button type="button" name="add2" class="btn btn-success btn-sm add2"><span class="glyphicon glyphicon-plus"></span></button></th>
            </tr>
            </table>
            </div>

        <script>
        
                $(document).ready(function(){
                
                $(document).on('click', '.add', function(){
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="pendidikan[]" class="form-control pendidikan" required /></td>';
                html += '<td><input type="text" name="jurusan[]" class="form-control jurusan" required /></td>';
                html += '<td><input type="text" name="masuk[]" class="form-control masuk" required /></td>';
                html += '<td><input type="text" name="lulus[]" class="form-control lulus" required /></td>';
                html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
                $('#table_pendidikan').append(html);
                });
                
                $(document).on('click', '.remove', function(){
                $(this).closest('tr').remove();
                });
                
                $('#insert_form').on('send', function(event){
                event.preventDefault();
                var error = '';
                
                $('.pendidikan').each(function(){
                var count = 1;
                if($(this).val() == '')
                {
                    error += "<p>Enter at "+count+" Row</p>";
                    return false;
                }
                count = count + 1;
                });
                
                $('.jurusan').each(function(){
                var count = 1;
                if($(this).val() == '')
                {
                    error += "<p>Enter at "+count+" Row</p>";
                    return false;
                }
                count = count + 1;
                });
                
                $('.masuk').each(function(){
                var count = 1;
                if($(this).val() == '')
                {
                    error += "<p>Enter at "+count+" Row</p>";
                    return false;
                }
                count = count + 1;
                });

                $('.lulus').each(function(){
                var count = 1;
                if($(this).val() == '')
                {
                    error += "<p>Enter at "+count+" Row</p>";
                    return false;
                }
                count = count + 1;
                });

                var form_data = $(this).serialize();
                if(error == '')
                {
                $.ajax({
                    url:"insert.blade.php",
                    method:"POST",
                    data:form_data,
                    success:function(data)
                    {
                    if(data == 'ok')
                    {
                    $('#table_pendidikan').find("tr:gt(0)").remove();
                    $('#error').html('<div class="alert alert-success"> Details Saved</div>');
                    }
                    }
                });
                }
                else
                {
                $('#error').html('<div class="alert alert-danger">'+error+'</div>');
                }
                });
                
                });
     </script>


<script>
        
        $(document).ready(function(){
        
        $(document).on('click', '.add2', function(){
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="perusahaan[]" class="form-control perusahaan" required /></td>';
        html += '<td><input type="text" name="jabatan[]" class="form-control jabatan" required /></td>';
        html += '<td><input type="text" name="tahun[]" class="form-control tahun" required /></td>';
        html += '<td><input type="text" name="keterangan[]" class="form-control keterangan" /></td>';
        html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
        $('#table_pekerjaan').append(html);
        });
        
        $(document).on('click', '.remove', function(){
        $(this).closest('tr').remove();
        });
    
        $('#insert_form').on('send', function(event){
        event.preventDefault();
        var error = '';
        
        $('.perusahaan').each(function(){
        var count = 1;
        if($(this).val() == '')
        {
            error += "<p>Enter at "+count+" Row</p>";
            return false;
        }
        count = count + 1;
        });
        
        $('.jabatan').each(function(){
        var count = 1;
        if($(this).val() == '')
        {
            error += "<p>Enter at "+count+" Row</p>";
            return false;
        }
        count = count + 1;
        });
        
        $('.tahun').each(function(){
        var count = 1;
        if($(this).val() == '')
        {
            error += "<p>Enter at "+count+" Row</p>";
            return false;
        }
        count = count + 1;
        });

        $('.keterangan').each(function(){
        var count = 1;
        if($(this).val() == '')
        {
            error += "<p>Enter at "+count+" Row</p>";
            return false;
        }
        count = count + 1;
        });

        var form_data = $(this).serialize();
        if(error == '')
        {
        $.ajax({
            url:"insert.blade.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
            if(data == 'ok')
            {
            $('#table_pekerjaan').find("tr:gt(0)").remove();
            $('#error').html('<div class="alert alert-success"> Details Saved</div>');
            }
            }
        });
        }
        else
        {
        $('#error').html('<div class="alert alert-danger">'+error+'</div>');
        }
        });
        
        });
</script>



            <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
</body>

</html>
