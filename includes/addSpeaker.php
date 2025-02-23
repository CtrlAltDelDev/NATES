<main>
    <form method="post" enctype="multipart/form-data" action="db/addSpeakerAction.php">
        <fieldset>
            <legend>
                <a href="admin.php">Add Speaker</a>
                <a href="adminEvent.php">Add Event</a>
                <a href="adminLocation.php">Add New Location</a>
                <a href="adminUser.php">Add User</a>
            </legend>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName">
            <label for="email">Email Address</label>
            <input type="text" name="email" id="email">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone">
            <label for="speakerLinks">Links</label>
            <input type="text" name="speakerLinks" id="speakerLinks">
            <label for="speakerBio">Speaker Bio</label>
            <textarea name="speakerBio" id="speakerBio"></textarea>
            <label for="speakerDetails">Additional speaker Details</label>
            <textarea name="speakerDetails" id="speakerDetails"></textarea>
            <label for="speakerPhoto">Select an Image</label>
            <input type="file" name="speakerPhoto" id="speakerPhoto">
            <label for="photoAltText">Photo Description</label>
            <input type="text" name="photoAltText" id="photoAltText">
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</main>