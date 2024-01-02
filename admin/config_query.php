<?php
// creating class with database name

class database
{
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
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    //Get data tb_admin
    public function get_data_admin($username)
    {
        $data = mysqli_query(
            $this->connection,
            "SELECT * FROM tb_admin WHERE username='$username'"
        );
        return $data;
    }

    //Get data tb_article
    public function show_data()
    {
        $data = mysqli_query(
            $this->connection,
            "SELECT id_article, imageurl, title, content, ispublished, tba.created_at, tba.updated_at, name, tba.id_admin FROM tb_article tba JOIN tb_admin tbu on tba.id_admin = tbu.id_admin"
        );

        if ($data) {
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_array($data)) {
                    $result[] = $row;
                }
            } else {
                $result = '0';
            }
        }

        return $result;
    }
}
?>