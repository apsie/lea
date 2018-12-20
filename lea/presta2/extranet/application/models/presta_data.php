<?php
class presta_data
{
	public $conn;
	public $id_presta;
	public function __construct()
	{
		global $conn;
		$this->conn = $conn; 
	}
	public function insert($data = array())
	{
		//echo'test';print_r($data);die();
		$insert=0;
		foreach ($data as $i =>$row):
		$val['id_presta'] = $this->id_presta;
		$val['clef'] = $i;
		$val['valeur'] = utf8_decode($row);
		
		$insert = $this->conn->insert('apsie_presta_data',$val);
		endforeach;
		
		return true;
		
	}
	public function update($data = array(),$id_presta)
	{
		
		foreach ($data as $i =>$row):
		/** Verifcation si existe **/
		
		$sql="SELECT id_presta_data FROM apsie_presta_data where clef='".$i."' and id_presta=".$id_presta."";
		
		$rowSet = $this->conn->fetchRow($sql);
		
		$val['clef'] = $i;
		$val['valeur'] = utf8_decode($row);
		
		
		if(is_numeric($rowSet['id_presta_data']))
		{
		
		$where = array();
		$where[] = 'id_presta='.$id_presta;
		$where[] = 'clef="'.$i.'"';
		
		$this->conn->update('apsie_presta_data',$val,$where);
		}
		else 
		{
			//print_r($val);die();
			$val['id_presta'] = $id_presta;
			$this->conn->insert('apsie_presta_data',$val);
		}
		endforeach;
		
		return true;
	}
	public function set($data = array(), $id_presta='')
	{
	
		if($id_presta!='')
		{
		$sql="SELECT id_presta_data FROM apsie_presta_data where id_presta=".$id_presta."";
		
		//var_dump($this->conn);die();
		$rowSet = $this->conn->fetchRow($sql);
		
		if(is_numeric($rowSet['id_presta_data']))
		$this->update($data,$id_presta);
		else 
		$this->insert($data);
		
		}
		else
		{
		$this->conn->insert($data);
		}
	}
	public function get($id_presta)
	{
		$sql="SELECT * FROM apsie_presta_data where id_presta=".$id_presta."";
		return $this->conn->fetchAll($sql);
	}
	public function replaceStr($str,$srtMatch=1,$strR="x")
	{
		if($str == $srtMatch)
		$str = $strR;
		else
		$str =" ";
		
		return $str;
	}
	
}