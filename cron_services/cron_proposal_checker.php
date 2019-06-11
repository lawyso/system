<?php
include_once '../includes/conn.inc';
include_once '../includes/func.php';

//////////______all Proposals Pending Approval
$pending_approvals = fetchtable('d_proposals',"status=1 AND proposal_upload is not null AND system_action='0'","uid","desc","100000000");
while($p = mysqli_fetch_array($pending_approvals))
     {
        
        $pid = $p['uid'];    
        $date_modified = $p['date_modified'];
        $user = $p['user'];
        $comments = $p['comments'];
        $supervisor_1 = $p['supervisor_1'];
        $supervisor_2 = $p['supervisor_2'];
        $supervisor_3 = $p['supervisor_3'];

        $hourdiff = round((strtotime($fulldate) - strtotime($date_modified))/3600, 1);
        $new_proposal_comments = "Proposal Pushed to The respective Supervisors for Review by [System] on [$fulldate].";
        if ($hourdiff >2) 
        {
            $upd = updatedb('d_proposals', "system_action='1',comments='$new_proposal_comments'","uid='$pid'");
            $update = updatedb('d_users_primary', "proposal_status='1',supervisor_1='$supervisor_1',supervisor_2='$supervisor_2',supervisor_3='$supervisor_3'","uid='$user'");
            echo "Proposal Pushed by system.student can not edit it now";
        }
        else
        {
           echo "No Proposal Pushed by system.student can still edit it.";
        } 
     }
?>