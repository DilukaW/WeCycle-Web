<?php
    $qryRecentRides = "SELECT * FROM tbl_rides WHERE DATE(date_time) = CURDATE()";
    $resRecentRides = mysqli_query($conn, $qryRecentRides);
    if(mysqli_num_rows($resRecentRides)>0)
    {
        while($rows = mysqli_fetch_assoc($resRecentRides))
        {
            $bookingid = $rows['id'];
            $datetimeValue = $rows['date_time'];
            $datetime = new DateTime($datetimeValue);
            $date = $datetime->format('Y-m-d');
            $time = $datetime->format('H:i:s');
            $location = $rows['start_location'];
            $status = $rows['status'];
        ?>
        <tr>
            <td><?php echo $bookingid ?></td>
            <td><?php echo $date ?></td>
            <td><?php echo $time ?></td>
            <td><?php echo $location ?></td>
            <?php 
                if($status == "On-going")
                {
                    ?>
                    <td><span style="background:#d4d700; border-radius:50px; color: #FFF; padding: 1px 5px;"> <b><?php echo $status ?></b> </span></td>
                    <?php
                }
                elseif($status == "Upcoming")
                {
                    ?>
                    <td><span style="background:#ff9c1a; border-radius:50px; color: #FFF; padding: 1px 5px;"> <b><?php echo $status ?></b> </span></td>
                    <?php
                }
                elseif($status == "Completed")
                {
                    ?>
                    <td><span style="background:#39B54A; border-radius:50px; color: #FFF; padding: 1px 5px;"> <b><?php echo $status ?></b> </span></td>
                    <?php
                }
                else{
                    ?>
                    <td><span style="background:#ff0000; border-radius:50px; color: #FFF; padding: 1px 5px;"> <b><?php echo $status ?></b> </span></td>
                    <?php
                }
            ?>
            <td><a class="btn btn-sm btn-primary" href="rides-details.php?rideId=<?php echo $bookingid ?>">Details</a></td>
        </tr>

        <?php
        }
    }
?>