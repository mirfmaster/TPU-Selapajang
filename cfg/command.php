<?php 
class DB
{   
    public $result;
    public $messages= array();
    public $connect=null;
    public static $allquery;
    public $query;

    public function __construct() {
        $this->connect();
    }

  	public function connect(){
    	$this->host = 'mysql.hostinger.co.id';
    	$this->Admin = 'u436601698_root';
    	$this->pass = 'dewainside1';
    	$this->db = 'u436601698_tpu';
    	$this->connect = new mysqli($this->host, $this->Admin, $this->pass, $this->db);
        return $this->connect;
	}

    public function setQuery($query)
    {
        $this->connect();
        self::$allquery[] = $query;
        $this->result=$this->connect->query($query);
    }

    public function loadObjectList()
    {
        $hasil = array();
        if($this->result){
            while($a = $this->result->fetch_object()) {
                $hasil[] = $a;
            }
        }
        return $hasil;
    }

    public function getAllAdmin(){
        $query = "SELECT * FROM admin ORDER BY auth ASC";
        $this->setQuery($query);
        $results = $this->loadObjectList();
        if(count($results) > 0){
            return $results;
        }
        return false;
    }

    public function getAdminByEmail($email){
        $query = "SELECT * FROM admin WHERE `emailadmin`='$email'";
        $this->setQuery($query);
        $result = $this->loadObject();
        return $result;
    }

    public function getKlienByEmail($email){
        $query = "SELECT * FROM klien WHERE `email`='$email'";
        $this->setQuery($query);
        $result = $this->loadObject();
        return $result;
    }

    public function loginAdmin($email)
    {
        $result=$this->getAdminByEmail($email);
        if ($result) {
            $_SESSION['emailadmin'] = $result->emailadmin;
            $_SESSION['idadmin']= $result->idadmin;
            $_SESSION['auth']=$result->auth;
        }
    }

    public function LoginKlien($email)
    {
        $result=$this->getKlienByEmail($email);
        if ($result) {
            $_SESSION['email'] = $result->email;
            $_SESSION['idklien']= $result->idklien;
            $_SESSION['nama'] = $result->nama;
            header("Location: index.php?i=home");
        }
    }

    public function logoutAdmin()
    {   
        unset($_SESSION['emailadmin']);
        unset($_SESSION['idadmin']);
        unset($_SESSION['auth']);
    }

    public function logoutKlien()
    {  
        unset($_SESSION['email']);
        unset($_SESSION['idklien']);
        unset($_SESSION['nama']);
    }

    public function loadObject()
    {
        $hasil = null;
        if($this->result){
            while($a = $this->result->fetch_object()) {
                $hasil = $a;
            }
        }
        return $hasil;
    }       

    public function Insert( $table, &$object, $keyName = NULL, $lastid = false )
    {
        $fmtsql = 'INSERT INTO '.$this->nameQuote($table).' ( %s ) VALUES ( %s ) ';
        $fields = array();
        foreach (get_object_vars( $object ) as $k => $v) {
            if (is_array($v) or is_object($v) or $v === NULL) {
                continue;
            }
            if ($k[0] == '_') {
                continue;
            }
            $fields[] = $this->nameQuote( $k );
            $values[] = $this->quote($v);
        }
        $this->setQuery( sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) );
        var_dump(sprintf( $fmtsql, implode( ",", $fields ) ,  implode( ",", $values ) ) ) ;
        if (!$this->result) {
            return false;
        }
        $id = $this->connect->insert_id;
        if ($keyName && $id) {
            $object->$keyName = $id;
        }
        if($lastid){
            $res[] = true;
            $res[] = $id;
            return $res;
        }else{
            return true;
        }
    }

    public function Upload($k,$email,$v)
    {
        $target_dir = "assets/uploads/".$email."/";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($v["name"],PATHINFO_EXTENSION));
        $target_file = $target_dir . $k."_". time().".".$imageFileType;

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if ($v["size"] > 5000000 & $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
            echo "Sorry, your file cannot uploaded<br/>";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.<br/>";
            return false;

        } else {
            if (move_uploaded_file($v["tmp_name"], $target_file)) {
                return true;
            } else {
                echo "Sorry, there was an error uploading your file.<br/>";
                return false;
            }
        }
    }

    public function nameQuote($string)
    {
        $string = '`'.$string.'`';
        return $string;
    }

    public function quote($string){
        if($string === null){return $string;}
        $this->connect();
        $string = "'".$this->connect->real_escape_string($string)."'";
        return $string;
    }

    public function Update($table, &$object, $condition, $nulls = false)
    {
        $fields = array();
        $statement = 'UPDATE ' . $this->nameQuote($table) . ' SET %s WHERE %s';
        foreach (get_object_vars($object) as $k => $v)
        {
            if (is_array($v) or is_object($v) or $k[0] == '_')
            {
                continue;
            }
            if ($v === null)
            {
                if ($nulls)
                {
                    $val = 'NULL';
                }
                else
                {
                    continue;
                }
            }
            else
            {
                $val = $this->quote($v);
            }
            $fields[] = $this->nameQuote($k) . '=' . $val;
        }
        if (empty($fields))
        {
            return true;
        }
        $this->setQuery(sprintf($statement, implode(",", $fields), $condition));
        return $this->result; 
    }   

    public function Delete($table, $condition) 
    { 
        $query = "DELETE FROM $table WHERE $condition";
        $this->setQuery($query);
    }

    public function report($judul,$headerTable, $dataTable)
    {
        require_once (ASSETS."fpdf181/fpdf.php");
        $pdf = new FPDF();
        $pdf->AddPage();
        #tampilkan judul laporan
        $pdf->SetFont('Arial','B','16');

        $pdf->Cell(0,20, $judul, '0', 1, 'C');
        #buat header tabel
        $pdf->SetFont('Arial','','10');
        $pdf->SetFillColor(255,0,0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128,0,0);
        // dnd($headerTable);
        foreach ($headerTable as $kolom) {
            $pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
        }
        $pdf->Ln();
        #tampilkan data tabelnya
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $fill=false;
        foreach ($dataTable as $baris) {
            $i = 0;
            foreach ($baris as $cell) {
                $pdf->Cell($headerTable[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
                $i++;
            }
            $fill = !$fill;
            $pdf->Ln();
        }
        #output file PDF
        $pdf->Output();
    }

}
?>