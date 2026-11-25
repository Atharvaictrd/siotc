<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AppModel;
use CodeIgniter\I18n\Time;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class cronController extends Controller
{
    public function cron_todays_collection()
    {
        
        $db = \Config\Database::connect();
        $date = date('Y-m-d');
        $query1= $db->query("SELECT * FROM `other_fees` WHERE date='$date'");
        $total1 = 0;
        
        
        $query2= $db->query("SELECT * FROM `fees_collection_detail` WHERE date='$date'");
        $total = 0;
        if ($query2->getNumRows() > 0 || $query1->getNumRows() > 0 ) {
            // Iterate through the results to sum up the total fees
            foreach ($query2->getResult() as $row) {
                // Assuming the amount is stored in a column called 'amount'
                $total += $row->amount; // Adjust the column name as per your table structure
            }
            
            foreach ($query1->getResult() as $row1) {
                // Assuming the amount is stored in a column called 'amount'
                $total += $row1->c_amount; // Adjust the column name as per your table structure
            }
            
            // Echo the total amount collected
            // echo "Total Fees Collected Today: " . $total . " INR";
            
        $email = \Config\Services::email();

        $email->setFrom('contact@eduwings.in', 'Somayya Institute of Technology, Chandrapur');
        $email->setTo('somayyamspm@gmail.com'); 
        // $email->setTo('mrunali.indiaactive@gmail.com'); 
        // $email->setBCC('mrunali.indiaactive@gmail.com');
        $email->setBCC('khushboo.ictrd@gmail.com');
        $email->setSubject('Today\'s Fees Collection for Somayya Institute of Technology, Chandrapur');

        $email->setMessage('<!DOCTYPE html><html><head>
    <title></title><link rel="stylesheet" type="text/css" href="'.base_url().'assets/assets/plugins/bootstrap/css/bootstrap.min.css"></head>
<body>
    <div class="container" style="background: #fff;border-radius: 10px;margin: 0 auto;max-width: 500px;padding: 15px 20px;box-shadow: -4px 3px 0px 0px rgba(0, 0, 0, 0.2); border: 1px solid rgba(0, 0, 0, 0.2);">
        <div class="row">
            <div class="col-md-12">
                <a href="'.base_url().'"><center><img src="https://siotc.eduwings.in/assets/img/somya_tech_logo.png" style="max-width: 100%;" class="logo_main" alt=""></center></a>
            </div>
        </div>
        <div style="background-color:#000;width: 100%;height: 0.4em;border-radius: 4px;box-shadow: -4px 3px 0px 0px rgba(0, 0, 0, 0.2);margin-top: 10px;"></div>
        <div class="row">
            <div class="col-md-12" style="padding: 20px 15px;">
                <h3>Dear Sir/Madam,</h3>
                <p>I hope this email finds you well.</p>
                <p>We are pleased to provide you with the <strong>fees collection for today</strong> at Somayya Institute of Technology, Chandrapur:</p>
                <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
                    <tr>
                        <th>College Name</th>
                        <td>Somayya Institute of Technology, Chandrapur</td>
                    </tr>
                    <tr>
                        <th>Fees Collected Today</th>
                        <td>'.number_format($total,2).' INR</td>
                    </tr>
                </table>
                <br>
                <p>If you have any questions or require further details, feel free to reach out to us.</p>
                <p>Regards,<br>
                IndiaActive Team</p>
                <hr/>
            </div>
        </div>
    </div>
</body>
</html>');

    if ($email->send()) {
        echo 'Email sent successfully!';
    } else {
        echo 'Failed to send email. Error: ' . $email->printDebugger();
    }
            
        }else {
            echo "No fees collected today.";
        }
    }
    
    
    
    public function cron_todays_enquiry()
    {
        $db = \Config\Database::connect();
        $date = date('Y-m-d');
        
        // Set current session (adjust if stored dynamically in DB)
        $currentSession = "2026-2027";
    
        // get today's enquiries
        $enquiryToday = $db->query("SELECT class FROM marketing_enquiry WHERE enquiry_date = '$date'");
        
        // Fetch all programs
        $programs = $db->query("SELECT class_id, class FROM class")->getResult();
        
        $rows = '';
        $grandTotalToday = 0;
        $grandTotalSession = 0;
        
        foreach ($programs as $program){
            $class_id = $program->class_id;
        
            // Today's count for this program
            $todayCount = 0;
            foreach($enquiryToday->getResult() as $row){
                $classes = explode(', ',$row->class);
                if(in_array($class_id, $classes)){
                    $todayCount++;
                }
            }
            
            // Total enquiriews for current session
            $sessionCountQuery = $db->query("
                SELECT COUNT(*) as total FROM marketing_enquiry WHERE FIND_IN_SET('$class_id', class)
                AND session = '$currentSession'
            ");
            
            $sessionCount = $sessionCountQuery->getRow()->total;
            
            // Add row to table
            $rows .= "
            <tr>
                <td>{$program->class}</td>
                <td>{$todayCount}</td>
                <td>{$sessionCount}</td>
            </tr>";
            
            // Update Grand totals
            $grandTotalToday += $todayCount;
            $grandTotalSession += $sessionCount;
        }
    
        // Add total row
        $rows .= "
        <tr style='background:#f9f9f9;font-weight:bold;'>
            <td>Total</td>
            <td>{$grandTotalToday}</td>
            <td>{$grandTotalSession}</td>
        </tr>";
        
    
        // send email
        $email = \Config\Services::email();
    
        $email->setFrom('contact@eduwings.in', 'Somayya Institute of Technology');
        $email->setTo('psambatkar@gmail.com');    
        // $email->setTo('somayyamspm@gmail.com');    
        $email->setBCC('khushboo.ictrd@gmail.com');
    
        $email->setSubject("Enquiry Report for Today – Somayya Institute of Technology, Chandrapur");
    
        $email->setMessage('<!DOCTYPE html><html><head>
            <title>Enquiry Report</title>
            <link rel="stylesheet" type="text/css" href="'.base_url().'assets/assets/plugins/bootstrap/css/bootstrap.min.css">
            </head>
        <body>
            <div class="container" style="background: #fff;border-radius: 10px;margin: 0 auto;max-width: 500px;padding: 15px 20px;box-shadow: -4px 3px 0px 0px rgba(0, 0, 0, 0.2); border: 1px solid rgba(0, 0, 0, 0.2);">
                <div class="row">
                    <div class="col-md-12">
                        <a href="'.base_url().'"><center><img src="https://siotc.eduwings.in/assets/img/somya_tech_logo.png" style="max-width: 100%;" class="logo_main" alt=""></center></a>
                    </div>
                </div>
                <div style="background-color:#000;width: 100%;height: 0.4em;border-radius: 4px;box-shadow: -4px 3px 0px 0px rgba(0, 0, 0, 0.2);margin-top: 10px;"></div>
                <div class="row">
                    <div class="col-md-12" style="padding: 20px 15px;">
                        <h3>Dear Sir/Madam,</h3>
                        <p>I hope this email finds you well.</p>
                        <p>We are pleased to provide you with the enquiry report at Somayya Institute of Technology, Chandrapur:</p>
                        <table border="1" cellpadding="10" cellspacing="0" width="100%" style="border-collapse:collapse;">
                            <tr style="background:#f2f2f2;">
                                <th>Program</th>
                                <th>Todays Enquiry</th>
                                <th>Total Enquiry (Session: '.$currentSession.')</th>
                            </tr>
                            '.$rows.'
                        </table>
                        <br>
                        <p>If you have any questions or require further details, feel free to reach out to us.</p>
                        <p>Regards,<br>IndiaActive Team</p>
                        <hr/>
                    </div>
                </div>
            </div>
        </body>
        </html>');
    
        if ($email->send()) {
            echo "Enquiry report sent successfully.";
        } else {
            echo $email->printDebugger();
        }
    }
    
}


