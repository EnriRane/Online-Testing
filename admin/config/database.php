<?php 
    include('constants.php');
    
    Class Database
    {
        public function lidhuMeDatabazen()
        {
            $conn=mysqli_connect(LOCALHOST,USERNAME,PASSWORD) or die(mysqli_error());
            return $conn;
        }
        
        public function selektoDatabazen($conn)
        {
            $selektoDatabazen=mysqli_select_db($conn,DBNAME) or die(mysqli_error());
            return $selektoDatabazen;
        }
        public function selektoTeDhenat($tbl_name,$where="",$other="")
        {
            $query="SELECT * FROM $tbl_name";
            if($where!="")
            {
                $query.=" WHERE $where";
            }
            if($other!="")
            {
                $query.=' '.$other;
            }
            return $query;
        }
        public function selektoRreshtCfardo($tbl_name,$where,$limit)
        {
            $query="SELECT * FROM $tbl_name";
            if($where!="")
            {
                $query.=" WHERE $where  ORDER BY RAND()";
            }
            if($limit!="")
            {
                $query.=' LIMIT '.$limit;
            }
            return $query;
        }
        public function insertoTeDhena($tbl_name,$data)
        {
            $query="INSERT INTO $tbl_name SET $data";
            return $query;
        }
        public function perditesoTeDhena($tbl_name,$data,$where="")
        {
            $query="UPDATE $tbl_name SET $data WHERE $where";
            return $query;
        }
        public function fshiTeDhena($tbl_name,$where)
        {
            $query="DELETE FROM $tbl_name WHERE $where";
            return $query;
        }
        public function ekzekutoQuery($conn,$query)
        {
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            return $res;
        }
        public function numriRreshtave($res)
        {
            $numriRreshtave=mysqli_num_rows($res);
            return $numriRreshtave;
        }
        public function fetch_data($res)
        {
            $row=mysqli_fetch_assoc($res);
            return $row;
        }
        public function kontrolloTipinImazhit($ext)
        {
            $valid=array('jpg','png','gif','JPG','PNG','GIF','JPEG');
            if(in_array($ext,$valid))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function kontrolloTipinFile($ext)
        {
            $valid=array('pdf','docx','ppt','txt');
            if(in_array($ext,$valid))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        public function upload_file($source,$destination)
        {
            $upload=move_uploaded_file($source,$destination);
            return $upload;
        }
        public function remove_file($path)
        {
            $remove=unlink($path);
            return $remove;
        }
        public function merrNumrinTotalRreshtave($tbl_name,$conn)
        {
            $query="SELECT * FROM $tbl_name";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $rows=mysqli_num_rows($res);
            return $rows;
        }
        public function merrUserID($tbl_name,$username,$conn)
        {
            $query="SELECT id_student FROM $tbl_name WHERE username='$username'";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $id_student=$row['id_student'];
            return $id_student;
        }
        public function merrFakultetin($tbl_name,$id_student,$conn)
        {
            $query="SELECT fakultet FROM $tbl_name WHERE id_student='$id_student'";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $fakultet=$row['fakultet'];
            return $fakultet;
        }
        public function merrEmrinPlote($tbl_name,$id_student,$conn)
        {
            $query="SELECT emer,mbiemer FROM $tbl_name WHERE id_student='$id_student'";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $emer=$row['emer'];
            $mbiemer=$row['mbiemer'];
            $full_name=$emer.' '.$mbiemer;
            return $full_name;
        }
        public function merrEmrinFakultetit($tbl_name,$id_fakultet,$conn)
        {
            $query="SELECT emri_fakultetit FROM $tbl_name WHERE id_fakultet='$id_fakultet'";
            $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
            $row=mysqli_fetch_assoc($res);
            $emri_fakultetit=$row['emri_fakultetit'];
            return $emri_fakultetit;
        }
    }
?>