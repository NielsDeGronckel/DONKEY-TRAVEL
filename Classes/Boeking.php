<?php


// namespace database;


class Boeking
{
	private $id;
	private $StartDatum;
	private $pincode;
	private $FKtochtenID;
	private $FKklantID;
	private $status;
	private $tracker; 

	public function __construct($id=NULL, $StartDatum=NULL, $pincode=NULL, $FKtochtenID=NULL, $FKklantID=NULL, $status=NULL, $tracker=NULL)
	{
		$this->id = $id;
		$this->StartDatum = $StartDatum;
		$this->pincode = $pincode;
		$this->FKtochtenID = $FKtochtenID;
		$this->FKklantID = $FKklantID;
		$this->status = $status;
		$this->tracker = $tracker;
	}

	// -= Get functions =-

	public function getID()
	{
		return $this->id;
	}

	public function getStartDatum()
	{
		return $this->startDatum;
	}

	public function getEindDatum($boeking)
	{
		return date('Y-m-d', strtotime($boeking->getStartdatum() . ' + ' . $boeking->getTocht()->getAantalDagen() . ' days'));
	}

	public function getPincode()
	{
		return $this->pincode;
	}

	public function getTocht()
	{
		return $this->tocht;
	}

	public function getKlant()
	{
		return $this->klant;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getTracker()
	{
		return $this->tracker;
	}

	// -= Set functions =-
	public function setID($id)
	{
		$this->id = $id;
	}

	public function setStartDatum($startDatum)
	{
		$this->startDatum = $startDatum;
	}

	public function setPincode($pincode)
	{
		$this->pincode = $pincode;
	}

	public function setTocht($tocht)
	{
		$this->tocht = $tocht;
	}

	public function setKlant($klant)
	{
		$this->klant = $klant;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	public function setTracker($tracker)
	{
		$this->tracker = $tracker;
	}
    // CRUD

    public function createBoeking($StartDatum, $FKtochtenID, $FKklantenID) {
        require 'database.php';
        
        $sql = $conn->prepare('INSERT INTO boekingen (StartDatum, FKtochtenID, FKklantenID) VALUES (:StartDatum, :FKtochtenID, :FKklantenID)');      
        $sql->bindParam(':StartDatum', $StartDatum);
        $sql->bindParam(':FKtochtenID', $FKtochtenID);
        $sql->bindParam(':FKklantenID', $FKklantenID);
    
        $sql->execute();
    
        $_SESSION['message'] = "Boeking is aangemaakt! <br>";
        header("Location: boekingRead.php");
    }
    public function readBoeking($FKklantenID)
    {
        require "pureConnect.php";
 
        // statement maken
        $sql = $conn->prepare("
									select StartDatum, PINCode, FKtochtenID, FKstatussenID, FKtrackerID
									FROM boekingen WHERE FKklantenID = :FKklantenID
								 ");
        $sql->bindParam(':FKklantenID', $FKklantenID);
        $sql->execute();
        require 'Classes/Tocht.php';

        $newTocht = new Tocht();
        echo '<table class="table-auto">';
        echo '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">';
        echo '<tr>';
        echo '<th scope="col" class="px-6 py-3">Startdatum</th>';
        echo '<th scope="col" class="px-6 py-3">Einddatum</th>';
        echo '<th scope="col" class="px-6 py-3">PIN Code</th>';
        echo '<th scope="col" class="px-6 py-3">Tocht</th>';
        echo '<th scope="col" class="px-6 py-3">Status</th>';
        echo '<th scope="col" class="px-6 py-3">Tracker</th>';


        foreach ($sql as $boeking) {
            $FKtochtenID = $boeking['FKtochtenID'];
            $tochtenArray = $newTocht->getTochtWithId($FKtochtenID);
            // echo 'test: ' . $tochtenArray["Aantaldagen"];
            // var_dump($tochtenArray);	
            // $eindDatum = $tochtenArray['AantalDagen'] + $boeking['StartDatum'];
            $numberOfDays = $tochtenArray["Aantaldagen"];
            $startDate = strtotime($boeking['StartDatum']); // Convert the start date to a timestamp
            if ($startDate !== false) {
                $endDateTimestamp = strtotime("+$numberOfDays days", $startDate);
                if ($endDateTimestamp !== false) {
                    $eindDatum = date('Y-m-d', $endDateTimestamp);
                    // $eindDatum now contains the end date as a string in 'Y-m-d' format
                } else {
                    // Handle invalid number of days
                }
            } else {
                // Handle invalid start date
            }
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            echo '<tr>';
            // Added table row opening tag
            echo '<td class="px-6 py-4 text-white bg-slate-600">' . $boeking["StartDatum"] . " - " . '</td>';
            echo '<td class="px-6 py-4 text-white bg-slate-400">' . $eindDatum . " - " . '</td>';
            echo '<td class="px-6 py-4 text-white bg-slate-600">' . $boeking["PINCode"] . "<br/>" . '</td>';
            echo '<td class="px-6 py-4 text-white bg-slate-400">' . $tochtenArray["Omschrijving"] . "<br/>" . '</td>';
            echo '<td class="px-6 py-4 text-white bg-slate-600">' . $boeking["FKstatussenID"] . "<br/>" . '</td>';
            echo '<td class="px-6 py-4 text-white bg-slate-600">' . $boeking["FKtrackerID"] . "<br/>" . '</td>';


        }
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';

    }

}
