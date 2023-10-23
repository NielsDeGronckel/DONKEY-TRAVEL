<?php


// namespace database;


class Boeking
{
	private $ID;
	private $StartDatum;
	private $pincode;
	private $FKtochtenID;
	private $FKklantID;
	private $status;
	private $tracker; 

	public function __construct($ID=NULL, $StartDatum=NULL, $pincode=NULL, $FKtochtenID=NULL, $FKklantID=NULL, $status=NULL, $tracker=NULL)
	{
		$this->ID = $ID;
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
	public function setID($ID)
	{
		$this->id = $ID;
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
        require 'database/pureConnect.php';
        
        $sql = $conn->prepare('INSERT INTO boekingen (StartDatum, FKtochtenID, FKklantenID) VALUES (:StartDatum, :FKtochtenID, :FKklantenID)');      
        $sql->bindParam(':StartDatum', $StartDatum);
        $sql->bindParam(':FKtochtenID', $FKtochtenID);
        $sql->bindParam(':FKklantenID', $FKklantenID);
    
        $sql->execute();
    
        $_SESSION['message'] = "Boeking is aangemaakt! <br>";
        header("Location: boekingRead.php");
    }

    // read boekingen using klantID getting tocht omschrijving and duration
    public function readBoeking($FKklantenID)
    {
        require 'database/pureConnect.php';
    
        // statement maken
        $sql = $conn->prepare("SELECT ID, StartDatum, PINCode, FKtochtenID, FKstatussenID, FKtrackerID FROM boekingen WHERE FKklantenID = :FKklantenID");
        $sql->bindParam(':FKklantenID', $FKklantenID);
        $sql->execute();
        require 'Classes/Tocht.php';
        require 'Classes/Status.php';

        $newTocht = new Tocht();
        $statussen = new Status();
        // $s instead of echo
        $s = '<table class="table-auto" border="1">';
        $s .= '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">';
        $s .= '<tr>';
        $s .= '<th scope="col" class="px-6 py-3">Startdatum</th>';
        $s .= '<th scope="col" class="px-6 py-3">Einddatum</th>';
        $s .= '<th scope="col" class="px-6 py-3">PIN Code</th>';
        $s .= '<th scope="col" class="px-6 py-3">Tocht</th>';
        $s .= '<th scope="col" class="px-6 py-3">Status</th>';
        $s .= '<th scope="col" class="px-6 py-3">Tracker</th>';
        $s .= '<th scope="col" class="px-6 py-3">CMD</th>';
    
        foreach ($sql as $boeking) {
            $FKtochtenID = $boeking['FKtochtenID'];
            $tochtenArray = $newTocht->getTochtWithId($FKtochtenID);
            $statusIdArray = $statussen->getStatusWithId($boeking['FKstatussenID']);
            $selectedStatus = $statusIdArray['Status'];
            $numberOfDays = $tochtenArray["Aantaldagen"];
            $startDate = strtotime($boeking['StartDatum']); // Convert the start date to a timestamp
            if ($startDate !== false) {
                $endDateTimestamp = strtotime("+$numberOfDays days", $startDate);
                if ($endDateTimestamp !== false) {
                    $eindDatum = date('Y-m-d', $endDateTimestamp);
                } else {
                    // Handle invalid number of days
                    echo 'Invalid number of days';
                }
            } else {
                // Handle invalid start date
                echo 'Invalid start date';

            }
            $s .= '</tr>';
            $s .= '</thead>';
            $s .= '<tbody>';
            $s .= '<tr>';
            $s .= '<td class="px-6 py-4 text-white bg-slate-600">' . $boeking["StartDatum"] . '</td>';
            $s .= '<td class="px-6 py-4 text-white bg-slate-400">' . $eindDatum . '</td>';
            $s .= '<td class="px-6 py-4 text-white bg-slate-600">' . $boeking["PINCode"] . "<br/>" . '</td>';
            $s .= '<td class="px-6 py-4 text-white bg-slate-400">';
            $s .= '<button type="button" class="readButton">' . $tochtenArray["Omschrijving"] . ' ('. $numberOfDays .' dagen)</button>';
            $s .= '</td>';
            $s .= '<td class="px-6 py-4 text-white bg-slate-600">' . $selectedStatus . "<br/>" . '</td>';
            $s .= '<td class="px-6 py-4 text-white bg-slate-600">' . $boeking["FKtrackerID"] . "<br/>" . '</td>';
            $s .= '<td><a href="boekingUpdateForm.php?action=update&tbl=boekingen&ID=' . $boeking["ID"] . '" class="updateButton"><i class="bx bxs-edit-alt"></i></a>';
            $s .= '<a href="boekingDelete.php?action=delete&tbl=boekingen&ID=' . $boeking["ID"] . '" class="deleteButton" onclick="return confirm(\'Are you sure you want to delete this row?\')"><i class="bx bxs-trash"></i></a></td>';
        }
        $s .= '</tr>';
        $s .= '</tbody>';
        $s .= '</table>';
    
        echo $s; // Return the HTML content as a string
    }

        // read boekingen using klantID getting tocht omschrijving and duration
        public function readBoekingAdmin()
        {
            require 'database/pureConnect.php';
        
            // statement maken
            $sql = $conn->prepare("SELECT ID, StartDatum, PINCode, FKtochtenID, FKklantenID, FKstatussenID, FKtrackerID FROM boekingen");
            $sql->execute();
            require 'Classes/Tocht.php';
            require 'Classes/Klant.php';
            require 'Classes/Status.php';

            $newTocht = new Tocht();
            $newKlant = new Klant();
            $statussen = new Status();

            
            // $s instead of echo
            $s = '<table class="table-auto" border="1">';
            $s .= '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">';
            $s .= '<tr>';
            $s .= '<th scope="col" class="px-6 py-3">Startdatum</th>';
            $s .= '<th scope="col" class="px-6 py-3">Einddatum</th>';
            $s .= '<th scope="col" class="px-6 py-3">Status</th>';
            $s .= '<th scope="col" class="px-6 py-3">PIN Code</th>';
            $s .= '<th scope="col" class="px-6 py-3">Klantnaam</th>';
            $s .= '<th scope="col" class="px-6 py-3">Tocht</th>';
            $s .= '<th scope="col" class="px-6 py-3">E-mail</th>';
            $s .= '<th scope="col" class="px-6 py-3">Telefoon</th>';
            $s .= '<th scope="col" class="px-6 py-3">CMD</th>';
        
            foreach ($sql as $boeking) {
                $FKtochtenID = $boeking['FKtochtenID'];
                $FKklantenID = $boeking['FKklantenID'];
                $tochtenArray = $newTocht->getTochtWithId($FKtochtenID);
                $numberOfDays = $tochtenArray["Aantaldagen"];
                $klantenArray = $newKlant->getKlantenWithId($FKklantenID);
                $statusIdArray = $statussen->getStatusWithId($boeking['FKstatussenID']);
                $selectedStatus = $statusIdArray['Status'];
                $startDate = strtotime($boeking['StartDatum']); // Convert the start date to a timestamp
                if ($startDate !== false) {
                    $endDateTimestamp = strtotime("+$numberOfDays days", $startDate);
                    if ($endDateTimestamp !== false) {
                        $eindDatum = date('Y-m-d', $endDateTimestamp);
                    } else {
                        // Handle invalid number of days
                        echo 'Invalid number of days';
                    }
                } else {
                    // Handle invalid start date
                    echo 'Invalid start date';
    
                }
                $s .= '</tr>';
                $s .= '</thead>';
                $s .= '<tbody>';
                $s .= '<tr>';
                $s .= '<td class="px-6 py-4 text-white bg-slate-600">' . $boeking["StartDatum"] . '</td>';
                $s .= '<td class="px-6 py-4 text-white bg-slate-400">' . $eindDatum . '</td>';
                $s .= '<td class="px-6 py-4 text-white bg-slate-600">' . $selectedStatus . "<br/>" . '</td>';
                $s .= '<td class="px-6 py-4 text-white bg-slate-600">' . $boeking["PINCode"] . "<br/>" . '</td>';
                $s .= '<td class="px-6 py-4 text-white bg-slate-600">' . $klantenArray["username"] . "<br/>" . '</td>';
                $s .= '<td class="px-6 py-4 text-white bg-slate-400">';
                $s .= '<button type="button" class="readButton">' . $tochtenArray["Omschrijving"] . ' ('. $numberOfDays .' dagen)</button>';
                $s .= '</td>';
                $s .= '<td class="px-6 py-4 text-white bg-slate-600">' . $klantenArray["email"] . "<br/>" . '</td>';
                $s .= '<td class="px-6 py-4 text-white bg-slate-600">' . $klantenArray["telefoon"] . "<br/>" . '</td>';
                $s .= '<td><a href="boekingUpdateFormManagement.php?action=update&tbl=boekingen&ID=' . $boeking["ID"] . '" class="updateButton"><i class="bx bxs-edit-alt"></i></a>';
                $s .= '<a href="boekingDelete.php?action=delete&tbl=boekingen&ID=' . $boeking["ID"] . '" class="deleteButton" onclick="return confirm(\'Are you sure you want to delete this row?\')"><i class="bx bxs-trash"></i></a></td>';
            }
            $s .= '</tr>';
            $s .= '</tbody>';
            $s .= '</table>';
        
            echo $s; // Return the HTML content as a string
        }
    // update boeking using ID
    public function updateBoeking($ID, $StartDatum, $FKtochtenID) {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('UPDATE boekingen SET StartDatum = :StartDatum, FKtochtenID = :FKtochtenID WHERE ID = :ID');
        $sql->bindParam(':ID', $ID);
        $sql->bindParam(':StartDatum', $StartDatum);
        $sql->bindParam(':FKtochtenID', $FKtochtenID);
        $sql->execute();
    
        $_SESSION['message'] = 'Boeking is bijgewerkt! <br>';
        header("Location: boekingRead.php");
    }
    public function updateBoekingManagement($ID, $StartDatum, $FKstatussenID, $FKklantenID, $FKtochtenID) {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('UPDATE boekingen SET StartDatum = :StartDatum, FKstatussenID = :FKstatussenID, FKklantenID = :FKklantenID, FKtochtenID = :FKtochtenID WHERE ID = :ID');
        $sql->bindParam(':ID', $ID);
        $sql->bindParam(':StartDatum', $StartDatum);
        $sql->bindParam(':FKstatussenID', $FKstatussenID);
        $sql->bindParam(':FKklantenID', $FKklantenID);
        $sql->bindParam(':FKtochtenID', $FKtochtenID);

        $sql->execute();
    
        $_SESSION['message'] = 'Boeking is bijgewerkt! <br>';
        header("Location: boekingReadManagement.php");
    }

    //delete boeking using boeking ID
    public function deleteBoeking($ID) {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('DELETE FROM boekingen WHERE ID = :ID');
        $sql->bindParam(':ID', $ID);
        $sql->execute();
    
        //melding
        $_SESSION['message'] = 'Uw boeking is verwijderd. <br>';
        header("Location: boekingRead.php");
    }

     //find boeking using boeking Id for the update form
     public function findBoeking($ID) {
        require 'database/pureConnect.php';
        $sql = $conn->prepare('SELECT * FROM boekingen WHERE ID = :ID');
        $sql->bindParam(':ID', $ID);
        $sql->execute();

        $boeking = $sql->fetch();
        return $boeking;
    }


    // Get pincode details using pincode ID for the boeking read
    public function getPincodeWithId($id) {
        require 'database/pureConnect.php';
        
        $sql = $conn->prepare("SELECT Pincode FROM boekingen WHERE ID = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        
        // Fetch a single row
        $pincode = $sql->fetch(PDO::FETCH_ASSOC);
        return $pincode;
    }



}
