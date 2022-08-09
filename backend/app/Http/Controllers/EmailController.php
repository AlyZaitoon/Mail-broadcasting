<?php

namespace App\Http\Controllers;
use mysqli;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function getEmail($status, $subject, $content){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "broadcast";
        $status = 'Exp';
        $result = null;

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        if($status == 'Exp'){
            $sql = "SELECT email.address FROM proposal
                    JOIN review ON proposal.id = review.proposal_id
                    JOIN collaborator ON proposal.project_id = collaborator.project_id
                    JOIN email ON collaborator.email_id = email.id
                    WHERE DATEDIFF(CURDATE(), review.created_at) > proposal.duration * 30 AND review.response = 'accepted';";
            $result = $conn->query($sql);
        }
        else{
            $sql = "SELECT email.address FROM proposal
                    JOIN review ON proposal.id = review.proposal_id
                    JOIN collaborator ON proposal.project_id = collaborator.project_id
                    JOIN email ON collaborator.email_id = email.id
                    WHERE DATEDIFF(CURDATE(), review.created_at) < proposal.duration * 30 AND review.response = 'accepted';";
            $result = $conn->query($sql);
        }
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "email: " . $row["address"].  "<br>";
            }
            } else {
            echo "0 results";
            }
        $conn->close();
    }
}
