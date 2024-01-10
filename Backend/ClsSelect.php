<?php
	require_once("DBConnect.php");
	

	//Get all Information
	class GetAll
	{
	    public function GetBusStnCount()
	    {
	        $conn = dbconnection();

	        $sql = "SELECT COUNT(`StnId`) as CountStnId FROM BusStopData";
	        $result = $conn->query($sql);

	        return $result;
	 	}

	 	public function GetBusCount()
	    {
	        $conn = dbconnection();

	        $sql = "SELECT COUNT(`BusId`) as CountBusId FROM Bus";
	        $result = $conn->query($sql);

	        return $result;
	 	}

	 	public function GetBus()
	    {
	        $conn = dbconnection();

	        $sql = "SELECT * FROM `Bus` WHERE 1";
	        $result = $conn->query($sql);

	        return $result;
	 	}

	 	public $BusId;
	 	public function GetBusStn()
	    {
	        $conn = dbconnection();

	        $sql = "SELECT `StnId`, `StnName`, `StnLat`, `StnLng`, `BusId`, `BusCat`, `StnSeq` FROM `BusStopData` WHERE `BusId`=$this->BusId";
	        $result = $conn->query($sql);

	        return $result;
	 	}

	 	public function GetBusStnUd()
	    {
	        $conn = dbconnection();

	        $sql = "SELECT DISTINCT `StnName` FROM `BusStopData` WHERE 1";
	        $result = $conn->query($sql);

	        return $result;
	 	}

	 	public $StnName;
	 	public function CheckDestination()
	    {
	        $conn = dbconnection();

	        $sql = "SELECT * FROM `BusStopData` WHERE `StnName`='$this->StnName'";
	        $result = $conn->query($sql);

	        return $result;
	 	}

	 	public function GetBusStnAll()
	    {
	        $conn = dbconnection();

	        $sql = "SELECT `StnId`, `StnName`, `StnLat`, `StnLng`, `BusId`, `BusCat`, `StnSeq` FROM `BusStopData` WHERE 1";
	        $result = $conn->query($sql);

	        return $result;
	 	}


	 	public $StrStnLat;
	 	public $StrStnLng;
	 	public $EndStnLat;
	 	public $EndStnLng;
	 	public function GetBusStnOfSameBus()
	    {
	        $conn = dbconnection();

	        $sql = "SELECT * FROM BusStopData WHERE `StnLat` IN ('$this->StrStnLat', '$this->EndStnLat') && `StnLng` IN ('$this->StrStnLng', '$this->EndStnLng') && BusId=$this->BusId";
	        $result = $conn->query($sql);

	        return $result;
	 	}

	 	public $Latitude;
	 	public $Longitude;
	 	public function GetStnBus()
	    {
	        $conn = dbconnection();

	        $sql = "SELECT * FROM BusStopData WHERE `StnLat`='$this->Latitude' && `StnLng`='$this->Longitude'";
	        $result = $conn->query($sql);

	        return $result;
	 	}

	 	public $StrBusStn;
	 	public $EndBusStn;
	 	public function GetBusStnOfSameBusInBetween()
	    {
	    	if(isset($_SESSION['ASC'])==True){
	    		$temp='ASC';
			}	
			elseif(isset($_SESSION['DESC'])==True){
				$temp='DESC';
			}
			elseif(isset($_SESSION['ASC_MAP'])==True){
	    		$temp='ASC';
			}	
			elseif(isset($_SESSION['DESC_MAP'])==True){
				$temp='DESC';
			}
	        $conn = dbconnection();

	        $sql = "SELECT * FROM BusStopData WHERE `StnSeq` BETWEEN $this->StrBusStn AND $this->EndBusStn && `BusId`=$this->BusId ORDER BY `StnId` $temp";
	        $result = $conn->query($sql);

	        return $result;
	 	}

	 	public $TempLat;
	 	public $TempLng;
	 	public $TempBusId;
	 	public function CheckSeqTemp()
	    {	
	        $conn = dbconnection();

	        $sql = "SELECT * FROM `BusStopData` WHERE `StnLat`=$this->TempLat AND `StnLng`=$this->TempLng AND `BusId`=$this->TempBusId";
	       	
	        $result = $conn->query($sql);

	        return $result;
	 	}


	 	public $StrBusId;
	 	public $EndBusId;
	 	public function GetBusStnOfDiffBus()
	    {
	        $conn = dbconnection();

	        $sql = "SELECT
					    bd1.StnId,
					    bd1.StnLat,
					    bd1.StnLng,
					    bd1.StnSeq AS StrStnSeq,
					    bd1.BusId AS StrStnBus,
					    bd2.StnSeq AS EndStnSeq,
					    bd2.BusId AS EndStnBus
					FROM
					    BusStopData bd1
					JOIN BusStopData bd2 ON
					    bd1.StnLat = bd2.StnLat AND bd1.StnLng = bd2.StnLng
					WHERE
					    bd1.BusId = $this->StrBusId AND bd2.BusId = $this->EndBusId";
	        $result = $conn->query($sql);

	        return $result;
	 	}
	 }
?>