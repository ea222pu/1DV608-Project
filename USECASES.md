# USE CASE 1: Registration
### Preconditions
None

### Main scenario
1. Starts when user wants to register.
2. User enter information (username, password, name, contact).
3. Press 'Register' button.

### Alternate scenario
2b. User does not want to enter name and contact.
  1. User enter information (username, password).
  2. Press 'Register' button.

# USE CASE 2: Search
### Preconditions
None

### Main scenario
1. Starts when a user wants to find a registered user.
2. User provides with a search term.
3. The system finds a registered user with a username that is the same as the search term, and redirects to this users profile page.

### Alternate scenarios
2a. User does not enter a search term.  
3a. The system does not find a registered user with a username that is the same as the search term, but presents a list of registered usernames similar to the search term.  
3b. The system does not find a registered user with a username that is the same as the search term, nor any registered usernames that are similar to the search term. Presents an error message.

# USE CASE 3: View profile
### Preconditions
Use case 1.3, or registered and logged in.

### Main scenario
1a. After use case 1.3, the user will be directed to the profile.  
1b. User wants to view own profile.
  1. User press 'My profile' button.
  2. User is directed to own profile

# USE CASE 4: Edit user information
### Preconditions
Registered and logged in.

### Main scenario
1. Starts when user wants to edit user information.  
2. Press 'Settings' button.  
3. Enter new information.  
4. Press 'Save' button.  

### Alternate scenario
3b. User wants to remove information.
  1. Remove information.
  2. Press 'Save' button.