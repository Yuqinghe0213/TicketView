<?php
 echo "Welcome to Viewer system\n";
 echo "Please input email: ";
 $name = fgets(STDIN);
 $name = str_replace(PHP_EOL, '', $name);
// echo sprintf("username: %s\n", $name);
 echo "Please input password: ";
 $password = fgets(STDIN);
 $password = str_replace(PHP_EOL, '', $password);
 echo "Please wait for verification... ...\n";
// echo sprintf("password: %s\n", $password);
 $namepass = $name.":".$password;


    function CallAPI($url,$napass)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, "$napass");
        //curl_setopt($ch, CURLOPT_USERPWD, "heyuqing0213@gmail.com:heyuqing");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    $resu = CallAPI("https://bluesky979.zendesk.com/api/v2/tickets.json",$namepass);
    $content = json_decode($resu, true);
    if ($content["error"]!= null)
    {
        echo "Couldn't authenticate you.\nWrong email or password.\n";
        exit(0);
    }
    else
    {
        $tickets = $content["tickets"];
        $nextpage = $content["next_page"];
        $previous_page = $content["previous_page"];
        $count = $content["count"];
        $total_number = count($tickets);
        main_menu($total_number,$tickets);
    }



//    $ticket = var_dump($tickets[(int)$id]);

    function read_ticket_detail($id,$tickets)
    {
        $ticket = $tickets[$id -1];
       // var_dump($ticket);
        echo"-------------------------------------------------------------------------------------------------\n";
        echo "Ticket Detail:\n";
        $turl = $ticket["url"];
        echo sprintf("url: %s\n", $turl);
        $tid = $ticket["id"];
        echo sprintf("Ticket_id: %d\n", $tid);
        $tex_id = $ticket["external_id"];
        echo sprintf("external_id: %s\n", $tex_id);
        $tvia = $ticket["via"];
        echo "via:\n";
        $tchannel = $tvia["channel"];
        echo sprintf("\tchannel: %s\n", $tchannel);
        $source = $tvia["source"];
        echo "\tsource:\n";
        $from = $source["from"]; //array
        if (count($from) == 0)
            echo "\t\tfrom:\n";
        else{
            echo "\t\tfrom: ";
            for ($x = 0; $x < count($from); $x++)
            {
                echo $from[$x]." ";
            }
            echo "\n";
        }
        $to = $source["to"];//array
        if (count($to) == 0)
            echo "\t\tto:\n";
        else{
            echo "\t\tto: ";
            for ($x = 0; $x < count($to); $x++)
            {
                echo $to[$x]." ";
            }
            echo "\n";
        }
        $rel = $source["rel"];
        echo sprintf("\t\trel: %s\n", $rel);
        $create = $ticket["created_at"];
        echo sprintf("created_at: %s\n", $create);
        $update = $ticket["updated_at"];
        echo sprintf("updated_at: %s\n", $update);
        $type = $ticket["type"];
        echo sprintf("type: %s\n", $type);
        $subject = $ticket["subject"];
        echo sprintf("subject: %s\n", $subject);
        $raw_subject =$ticket["raw_subject"];
        echo sprintf("sraw_subject: %s\n", $raw_subject);
        $description = $ticket["description"];
        echo sprintf("description: %s\n", $description);
        $priority = $ticket["priority"];
        echo sprintf("priority: %s\n", $priority);
        $status = $ticket["status"];
        echo sprintf("status: %s\n", $status);
        $recipient = $ticket["recipient"];
        echo sprintf("recipient: %s\n", $recipient);
        $requester_id = $ticket["requester_id"];
        echo sprintf("requester_id: %d\n", $requester_id);
        $submitter_id = $ticket["submitter_id"];
        echo sprintf("submitter_id: %d\n", $submitter_id);
        $assignee_id = $ticket["assignee_id"];
        echo sprintf("assignee_id: %d\n", $assignee_id);
        $organization_id = $ticket["organization_id"];
        echo sprintf("organization_id: %d\n", $organization_id);
        $group_id = $ticket["group_id"];
        echo sprintf("group_id: %d\n", $group_id);
        $collaborator_ids = $ticket["collaborator_ids"];//array
        if (count($collaborator_ids) == 0)
            echo "collaborator_ids:\n";
        else{
            echo "collaborator_ids: ";
            for ($x = 0; $x < count($collaborator_ids); $x++)
            {
                echo $collaborator_ids[$x]." ";
            }
            echo "\n";
        }
        $follower_ids = $ticket["follower_ids"]; //array
        if (count($follower_ids) == 0)
            echo "follower_ids:\n";
        else{
            echo "follower_ids: ";
            for ($x = 0; $x < count($follower_ids); $x++)
            {
                echo $follower_ids[$x]." ";
            }
            echo "\n";
        }
        $email_cc_ids = $ticket["email_cc_ids"]; //array
        if (count($email_cc_ids) == 0)
            echo "femail_cc_ids:\n";
        else{
            echo "email_cc_ids: ";
            for ($x = 0; $x < count($email_cc_ids); $x++)
            {
                echo $email_cc_ids[$x]." ";
            }
            echo "\n";
        }
        $forum_topic_id = $ticket["forum_topic_id"];
        echo sprintf("forum_topic_id: %d\n", $forum_topic_id);
        $problem_id = $ticket["problem_id"];
        echo sprintf("problem_id: %d\n", $problem_id);
        $has_incidents = $ticket["has_incidents"];
        echo "has_incidents: ".$has_incidents."\n";
        $is_public = $ticket["is_public"];
        echo "is_public: ".$is_public."\n";
        $due_at = $ticket["due_at"];
        if (count($due_at) == 0)
            echo "due_at:\n";
        else{
            echo "due_at: ";
            for ($x = 0; $x < count($due_at); $x++)
            {
                echo $due_at[$x]." ";
            }
            echo "\n";
        }
        $tags = $ticket["tags"]; //array
        if (count($tags) == 0)
            echo "tags:\n";
        else{
            echo "tags: ";
            for ($x = 0; $x < count($tags); $x++)
            {
                echo $tags[$x]." ";
            }
            echo "\n";
        }
        $custom_fields = $ticket["custom_fields"]; //array
        if (count($custom_fields) == 0)
            echo "custom_fields:\n";
        else{
            echo "custom_fields: ";
            for ($x = 0; $x < count($custom_fields); $x++)
            {
                echo $custom_fields[$x]." ";
            }
            echo "\n";
        }
        $satisfaction_rating = (string)$ticket["satisfaction_rating"];
        echo sprintf("satisfaction_rating: %s\n", $satisfaction_rating );
        $sharing_agreement_ids = $ticket["sharing_agreement_ids"];//array
        if (count($sharing_agreement_ids) == 0)
            echo "sharing_agreement_ids:\n";
        else{
            echo "sharing_agreement_ids: ";
            for ($x = 0; $x < count($sharing_agreement_ids); $x++)
            {
                echo $sharing_agreement_ids[$x]." ";
            }
            echo "\n";
        }
        $fields = $ticket["fields"];//array
        if (count($fields) == 0)
            echo "fields:\n";
        else{
            echo "fields: ";
            for ($x = 0; $x < count($fields); $x++)
            {
                echo $fields[$x]." ";
            }
            echo "\n";
        }
        $followup_ids = $ticket["followup_ids"];//array
        if (count($followup_ids) == 0)
            echo "followup_ids:\n";
        else{
            echo "followup_ids: ";
            for ($x = 0; $x < count($followup_ids); $x++)
            {
                echo $followup_ids[$x]." ";
            }
            echo "\n";
        }
        $brand_id = $ticket["brand_id"];
        echo sprintf("brand_id: %d\n", $brand_id);
        $allow_channelback = $ticket["allow_channelback"];
        echo "allow_channelback: ".$allow_channelback."\n";
        $allow_attachments = $ticket['allow_attachments'];
        echo "allow_attachments : ".$allow_attachments."\n";
        echo"-------------------------------------------------------------------------------------------------\n";
    }

    function ticket_abstruct($sbtickets)
    {
        echo"-------------------------------------------------------------------------------------\n";
        echo "id    |type        |subject                                           |tag\n";
        for ($x = 0; $x < count($sbtickets); $x++)
        {
            $sbticket = $sbtickets[$x];
            $sbid = $sbticket["id"];
            $sbype = $sbticket["type"];
            $sbsubject = $sbticket["subject"];
            echo sprintf("%6d|%-12s|%-50s|", $sbid,$sbype,$sbsubject);
            $sbtags = $sbticket["tags"];
            if (count($sbtags) == 0)
                echo "NULL\n";
            else{
                echo "tags: ";
                for ($y = 0; $y < count($sbtags); $y++)
                {
                    echo $sbtags[$y]." ";
                }
                echo "\n";
            }
        }
        echo"-------------------------------------------------------------------------------------\n";

    }
    function main_menu($total_number,$tickets)
    {
        echo "Type 'menu' to view options or 'quit' to exit:\n";
        $in = fgets(STDIN);
        $in = str_replace(PHP_EOL, '', $in);
        if (strcmp($in,"quit")==0)
        {
            exit(0);
        }
        else if (strcmp($in,"menu")==0)
        {

            while(True)
            {
                echo "\nSelect view options:\n";
                echo "Press 1 to view all tickets\n";
                echo "Press 2 to view a ticket\n";
                echo "Type 'quit' to exit\n";
                $option = fgets(STDIN);
                $option = str_replace(PHP_EOL, '', $option);
                switch ($option)
                {
                    case "1":
                        echo "Total ".$total_number." tickets\n";
                        if($total_number <= 25)
                        {//id type subject tag
                            ticket_abstruct($tickets);
                        }
                        else
                        {
                            $returned = true;
                            $show = true;
                            $page = 1;
                            while($returned)
                            {
                                if ($total_number % 25 == 0 )
                                    $endpage = $total_number / 25;
                                else
                                    $endpage = $total_number / 25 + 1;
                                $pageticket = array_slice($tickets, 25*($page - 1), 25);
                                if ($show) {
                                    ticket_abstruct($pageticket);
                                }
                                echo "\nPress 'n' for next page\n";
                                echo "Press 'p' for previous page\n";
                                echo "Press 1 to return main menu\n";
                                echo "Press 2 to view a ticket\n";
                                echo "Type 'quit' to exit\n";

                                $suboption = fgets(STDIN);
                                $suboption = str_replace(PHP_EOL, '', $suboption);
                                switch ($suboption)
                                {
                                    case "n":
                                        if($page == $endpage)
                                        {
                                            echo "This is the last page.\n";
                                            $show = false;
                                        }
                                        else
                                        {
                                            $page = $page + 1;
                                            $show = true;
                                        }
                                        break;

                                    case "p":
                                        if($page == 1)
                                        {
                                            echo "This is the first page.\n";
                                            $show = false;
                                        }
                                        else
                                        {
                                            $page = $page - 1;
                                            $show = true;
                                        }
                                        break;

                                    case "1":
                                        $returned = false;
                                        break;

                                    case "2":
                                        echo "Enter ticket id:";
                                        $id = fgets(STDIN);
                                        while ((int)$id <= 0)
                                        {
                                            echo "Ticket ID is from 1 to ".$total_number."\n";
                                            echo "Enter ticket id:";
                                            $id = fgets(STDIN);
                                        }
                                        read_ticket_detail($id,$tickets);
                                        $returned = false;
                                        break;

                                    case "quit":
                                        exit(0);
                                        break;

                                    default:
                                        echo "Wrong input\n";

                                }
                            }
                        }
                        break;

                    case "2":
                        echo "Enter ticket id:";
                        $id = fgets(STDIN);
                        while ((int)$id <= 0)
                        {
                            echo "Ticket ID is from 1 to ".$total_number."\n";
                            echo "Enter ticket id:";
                            $id = fgets(STDIN);
                        }
                        read_ticket_detail($id,$tickets);
                        break;

                    case "quit":
                        exit(0);
                        break;

                    default:
                        echo "Wrong input\n";
                }
            }
        }
        else
        {
            echo "Wrong input.";
        }
    }

?>