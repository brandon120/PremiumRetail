<?php 




/*

Everything below is for working with Databases with OOP



*/

class Database 
{
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = 'PremiumAdmin120';
    private $db_name = 'premiumretail';
    private $con = 'mysqli';
	
	private function tableExists($table) 
	{
    $tablesInDb = mysqli_query($this->con, 'SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
    if($tablesInDb) {
        if(mysqli_num_rows($tablesInDb) == 1) {
            return true;
        } else {
            return false;
        }
    }
	}
    
    public function __contruct($db_host, $db_user, $db_pass, $db_name)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }
    public function connect() 
	{
		if (!$this->con) {
        $this->con = mysqli_connect($this->db_host, $this->db_user, $this->db_pass);
        if($this->con) {
            $seldb = mysqli_select_db($this->con, $this->db_name);
            if($seldb) {
                return true; 
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return true;
    }
	}
	
    public function disconnect() 
	{
		if ($this->con) {
			if (mysqli_close($this->con)) {
				$this->con = false; 
				return true;
			} else {
				return false;
			}
		}	
	}
	


    public function select($table, $rows = '*', $where = null, $order = null) 
	{
	$q = 'SELECT '.$rows.' FROM '.$table;
    if($where != null)
        $q .= ' WHERE '.$where;
    if($order != null)
        $q .= ' ORDER BY '.$order;
    if($this->tableExists($table)) {
        $result = $this->con->query($q);
        if($result) {
            $arrResult = $result->fetch_all(MYSQLI_ASSOC);
            return $arrResult;
        } else {
            return false;
        }
    } else {
        return false;
    }	
	}
    public function insert($table, $values, $rows = null) {
		if ($this->tableExists($table)) {
			$insert = 'INSERT INTO '.$table;
			if ($rows != null) {
				$insert .= ' ('.$rows.')';
			}
			for ($i = 0; $i < count($values); $i++) {
				$values[$i] = mysqli_real_escape_string($this->con, $values[$i]);
				if (is_string($values[$i])) {
					$values[$i] = '"'.$values[$i].'"';
				}
			}
			$values = implode(',', $values);
			$insert .= ' VALUES ('.$values.')';
			$ins = mysqli_query($this->con, $insert);
			if ($ins) {
				return true;
			} else {
				return false;
			}
		}	
	}
    public function delete($table, $where = null) 
	{
		if ($this->tableExists($table)) {
			if ($where == null) {
				$delete = 'DELETE '.$table; 
			} else {
				$delete = 'DELETE FROM '.$table.' WHERE '.$where; 
			}
			$del = $this->con->query($delete);
			if ($del) {
				return true; 
			} else {
			   return false; 
			}
		} else {
			return false; 
		}	
	}
    public function update($table, $rows, $where) 
	{
	if ($this->tableExists($table)) {
        // Parse the where values 
        // even values (including 0) contain the where rows 
        // odd values contain the clauses for the row 
        for ($i = 0; $i < count($where); $i++) {
            if ($i % 2 != 0) {
                if (is_string($where[$i])) {
                    if (($i + 1) != null) {
                        $where[$i] = '"' . $where[$i] . '" AND ';
                    } else {
                        $where[$i] = '"' . $where[$i] . '"';
                    }
                }
            }
        }
        $where = implode('=', $where);
        
        $update = 'UPDATE ' . $table . ' SET ';
        $keys = array_keys($rows);
        
        $setValues = [];
        foreach ($keys as $key) {
            $value = $rows[$key];
            $setValues[] = "`$key` = '" . mysqli_real_escape_string($this->con, $value)."'";
        }
        
        $update .= implode(',', $setValues);
        $update .= ' WHERE ' . $where;
        
        $query = $this->con->query($update);
        
        if ($query) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }	
	}
}










?>