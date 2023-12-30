<?php
// creating class with database name

class database{
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "db_emading";
    var $connection = "";

    function __construct()
    {
        $this->connection = mysqli_connect(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );
        if(mysqli_connect_errno()){
            echo "Koneksi database gagal : ". mysqli_connect_error();
        }
    }

    //Get data tb_admin
    public function get_data_admin($username) {
        $data = mysqli_query(
            $this->connection,"SELECT * FROM tb_admin WHERE username='$username'" 
        );
        return $data;
    }
}
?>