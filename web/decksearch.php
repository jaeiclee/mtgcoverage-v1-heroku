<? require 'common.php' ?>
<? include 'header.php' ?>

<div id="main" style="margin:auto; width:800px;">

<br><br>
<center>


<?php

$query = "SELECT deckname FROM decks ORDER BY deckname ASC";


    try
    {
        // These two statements run the query against your database table.
        $stmt = $db->prepare($query);
        $stmt->execute();
    }
    catch(PDOException $ex)
    {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $rows = $stmt->fetchAll();

?>

<b>Search by deck name:</b><br>
<form action="asearch.php" method="GET">
<select name="deck" style="width:30%;">
<?php foreach($rows as $row): ?>

<option value="<?php echo htmlentities($row['deckname'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlentities($row['deckname'], ENT_QUOTES, 'UTF-8'); ?></option>
<?php endforeach; ?>   
</select>
        <input type="submit" value="Search" />
    </form>

	<form action="asearch.php" method="GET">
        <input type="text" name="deck" style="width:30%;" />  
        <input type="submit" value="Search" />
    </form>		
	
	
	<br><br>
	
<?php

$query = "SELECT playername FROM players ORDER BY playername ASC";


    try
    {
        // These two statements run the query against your database table.
        $stmt = $db->prepare($query);
        $stmt->execute();
    }
    catch(PDOException $ex)
    {
        // Note: On a production website, you should not output $ex->getMessage().
        // It may provide an attacker with helpful information about your code.
        die("Failed to run query: " . $ex->getMessage());
    }

    // Finally, we can retrieve all of the found rows into an array using fetchAll
    $rows = $stmt->fetchAll();

?>

<b>Search by player name:</b><br>
<form action="asearch.php" method="GET">
<select name="player" style="width:30%;">
<?php foreach($rows as $row): ?>

<option value="<?php echo htmlentities($row['playername'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlentities($row['playername'], ENT_QUOTES, 'UTF-8'); ?></option>
<?php endforeach; ?>   
</select>
        <input type="submit" value="Search" />
    </form>	

	<form action="asearch.php" method="GET">
        <input type="text" name="player" style="width:30%;" />  
        <input type="submit" value="Search" />
    </form>	
	
	
</center>
</div>	
<?php include 'footer.php' ?>