<main>
    <form method="post" action="db/addEventAction.php">
        <fieldset>
            <legend>
                <a href="admin.php">Add Speaker</a>
                <a href="adminEvent.php">Add Event</a>
                <a href="adminLocation.php">Add New Location</a>
                <a href="adminUser.php">Add User</a>
            </legend>
            <label for="eventName">Event Name</label>
            <input type="text" name="eventName" id="eventName">

            <label for="speakerId">Select Speaker</label>
            <select name="speakerId" id="speakerId">
                <option value="1">Default</option>
                <option value="2">Speaker 2</option>

            </select>

            <label for="locationId">Event Location</label>
            <select name="locationId" id="locationId">
                <option value="1">Sacramento Convention Center</option>
                <option value="2">Sacramento City Hall</option>

            </select>

            <label for="eventStart">Event Date</label>
            <input type="datetime-local" name="eventStart" id="eventStart">

            <label for="eventEnd">Event Ends At</label>
            <input type="datetime-local" name="eventEnd" id="eventEnd">

            <label for="eventPrice">Admission Price</label>
            <input type="text" name="eventPrice" id="eventPrice">

            <label for=“eventDescription">Event Details</label>
            <textarea name="eventDescription" id="eventDescription"></textarea>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</main>