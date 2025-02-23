<main>
    <form method="post" action="db/addUserAction.php">
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

            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone">

            <label for="email">Email</label>
            <input type="text" name="email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <label for="Role">User Role</label>
            <select type="" name="Role" id="Role">
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select>
            <br />
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</main>