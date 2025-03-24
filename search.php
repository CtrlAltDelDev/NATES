<?php include 'includes/header.php'; ?>
<?php include 'includes/nav.php'; ?>
<?php include 'includes/heroSlide.php'; ?>
<main id="event-container">
    <?php
    global$dbc;

    require_once 'db/dbconnect.php';

    $rowsPerPage = 10;

    if(isset($_POST['search'])){
        $search = $_POST['search'];
    } elseif(isset($_GET['search'])){
        $search = $_GET['search'];
    } else {
//        header("Location: index.php");
    }

    if(isset($_GET['start']))
    {
        $start = $_GET['start'];
    } else {
        $start = 0;
    }

    if(isset($_GET['numpages'])){
        $numPages = $_GET['numpages'];
        $totalRows = $_GET['totalrows'];
    } else {
        $rowCountQuery = $dbc -> prepare("SELECT COUNT(event_id) as count FROM event_table WHERE event_table.event_name LIKE :search");
        $rowCountQuery -> bindValue(':search', '%' . $search . '%');
        $rowCountQuery -> execute();
        $rowCount = $rowCountQuery -> fetch();
        $totalRows = $rowCount['count'];
        // or, don't use COUNT() in the query, and simply use $rowCount = $rowCountQuery -> rowCount();

        if($totalRows <= $rowsPerPage){
            $numPages = 1;
        } else {
            $numPages = ceil($totalRows/$rowsPerPage);
        }
    }

    $rowCountQuery = $dbc ->prepare("SELECT COUNT(event_id) as count FROM event_table WHERE event_table.event_name LIKE :search");
    $rowCountQuery -> bindValue(':search', '%' . $search . '%');
    $rowCountQuery -> execute();
    $rowCount = $rowCountQuery -> fetch();
    $totalRows = $rowCount['count'];

    if($totalRows <= $rowsPerPage){
        $numPages = 1;
    } else {
        $numPages = ceil($totalRows/$rowsPerPage);
    }

    $eventQuery = $dbc -> prepare( "SELECT
           e.event_id,
    e.event_name,
    e.event_description,
    DATE_FORMAT(e.event_start, '%m/%d/%Y %h:%i %p') AS start,
    DATE_FORMAT(e.event_end, '%m/%d/%Y %h:%i %p') AS end,
    e.location_id,
    e.event_price,
    s.speaker_id,
    s.first_name,
    s.last_name,
    s.speaker_photo,
    s.photo_alt,
    l.venue_name
FROM speaker_table s
    LEFT JOIN event_table e ON e.speaker_id = s.speaker_id
    LEFT JOIN location_table l ON e.location_id = l.location_id
	WHERE event_name LIKE :search

    ORDER BY e.event_start
    LIMIT $start, $rowsPerPage");



    $eventQuery -> bindValue(':search', '%' . $search . '%');
    $eventQuery -> execute();






    if($eventQuery->rowCount() > 0){
    echo  "<h1>Check out our upcoming events</h1>";

    }else{
    echo "<h1>Check Back Soon For Upcoming Events...</h1>";

    }
    ?>
    <ul>
        <?php
        while($event = $eventQuery->fetch()) {
            echo "<li>";
            echo "<img class='speaker-thumb' src='db/{$event['speaker_photo']}' alt='{$event['photo_alt']}'>";
            echo "<p>" . "<span style='font-weight: bold;'> " . $event["event_name"] . ": </span>"
                . "Featuring special guest " . $event["first_name"] . " " . $event['last_name'] . " at "
                . $event["venue_name"] . " on " . $event["start"] . " <a href='event.php?event=" . $event['event_id'] . "'>Get Event Details</a>" . "</p>";
            echo "</li>";

        }
        ?>
        <!--
        <li><img class="speaker-thumb" src="images/Speaker1_rounded_thumbnail.png" alt="thumbnail image of speaker"> <p>See speaker page for information on upcoming speakers</p></li>
        -->
    </ul>

    <section id="pagination">
        <p>
            <?php
            if($numPages > 1){
                $currentPage = ($start/$rowsPerPage) + 1;
                if($currentPage != 1){
                    //only show when not on first page
                    echo "<a href='search.php?start=" . ($start-$rowsPerPage) . "&search=$search&numpages=$numPages&totalrows=$totalRows'>Previous</a>";
                }


                //show numbered pages here, with current page unlinked
                for($i = 1; $i <= $numPages; $i++){
                    if($i != $currentPage){
                        echo " <a href='search.php?start=" . ($rowsPerPage * ($i - 1)) . "&search=$search&numpages=$numPages&totalrows=$totalRows'>$i</a> ";
                    } else {
                        echo " " . $i;
                    }
                }


                if($currentPage != $numPages){
                    //only show when not on last page
                    echo "<a href='search.php?start=" . ($start+$rowsPerPage) . "&search=$search&numpages=$numPages&totalrows=$totalRows'>Next</a>";
                }
            }
            ?>
        </p>
    </section>
</main>
<?php include 'includes/footer.php'; ?>
