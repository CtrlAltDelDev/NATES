<main>
    <form method="post" action="db/addLocationAction.php">
        <fieldset>
            <legend>
                <a href="admin.php">Add Speaker</a>
                <a href="adminEvent.php">Add Event</a>
                <a href="adminLocation.php">Add New Location</a>
                <a href="adminUser.php">Add User</a>
            </legend>
            <label for="venueName">Enter Venue Name</label>
            <input type="text" name="venueName" id="venueName">

            <label for="state">Enter State Abbreviation</label>
            <input type="text" name="state" id="state">

            <label for="city">Enter City Name</label>
            <input type="text" name="city" id="city">

            <label for="streetNumber">Enter Street Number</label>
            <input type="text" name="streetNumber" id="streetNumber">

            <label for="streetName">Enter Street Name</label>
            <input type="text" name="streetName" id="streetName">

            <label for="suite">Enter Suite Number</label>
            <input type="text" name="suite" id="suite">

            <label for="zipcode">Enter Zip Code</label>
            <input type="text" name="zipcode" id="zipcode">

            <label for=“phone">Location Phone Number</label>
            <input type="text" name="phone" id="phone">

            <input type="submit" value="Submit">
        </fieldset>
    </form>
</main>