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

    // Insert Data tb_article
    public function insert_data($imageurl, $title, $content, $ispublished, $id_admin)
    {

        $datetime = date("Y-m-d H:i:s");
        $insert = mysqli_query(
            $this->connection,
            "INSERT INTO tb_article (imageurl, title, content, ispublished, id_admin, created_at) 
            VALUES('$imageurl', '$title', '$content', '$ispublished', '$id_admin', '$datetime')"
        );

        return $insert;
    }

    public function get_by_id($id_article) {
        $query = mysqli_query(
            $this->connection,
            "SELECT id_article, imageurl, title, content, ispublished, tba.created_at, tba.updated_at, name, tba.id_admin FROM tb_article tba JOIN tb_admin tbu on tba.id_admin = tbu.id_admin"
        );
    }

    public function update_data($imageurl, $title, $content, $ispublished, $id_article, $id_admin)
    {
        $datetime = date("Y-m-d H:i:s");
        if ($imageurl == 'not_set') {
            $query = mysqli_query(
                $this->connection,
                "UPDATE tb_article SET title = '$title', content = '$content', ispublished = '$ispublished' WHERE id_article = '$id_article'"
            );
            return $query;
        } else {
            $query = mysqli_query(
                $this->connection,
                "UPDATE tb_article SET imageurl = '$imageurl', content = '$content', ispublished = '$ispublished' WHERE id_article = '$id_article'"
            );
            return $query;
        }
    }

    public function delete_data($id_article) {
        $query = mysqli_query(
            $this->connection,
            "DELETE FROM tb_article WHERE id_article = '$id_article'") or 
            die(mysqli_error($this->connection)
        );
        return $query;
    }

}
?>