# TEST CASE 1.1: Register with extra information
User wants to register.

### Input
* Enter a valid username (e.g Admin).
* Enter a valid password (e.g Password).
* Enter a name (e.g Emil).
* Enter contact information (e.g emil@mail.dk).
* Press 'Register' button.

### Output
* Redirected to login page.  
![tc1_1](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc1_1.png)

***

# TEST CASE 1.2: Test case 1.1 success

### Input
* Test case 1.1.
* Login with the same credentials used for test case 1.1.

### Output
![tc1_2](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc1_2.png)

***

# TEST CASE 2.1: Register without extra information
User wants to register, without enter additional information.

### Input
* Enter a valid username (e.g Admin1).
* Enter a valid password (e.g Password1).
* Press 'Register' button.

### Output
* Redirected to login page.  
![tc2_1](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc2_1.png);

***

# TEST CASE 2.2: Test case 2.1 success

### Input
* Test case 2.1.
* Login with the same credentials used for test case 2.1.

### Output
![tc2_2](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc2_2.png)

***

# TEST CASE 3.1: My profile 1

### Input
* Test case 1.2.
* Press 'My profile' button.

### Output
Same as test case 1.2 output.

***

# TEST CASE 3.2: My profile 2

### Input
* Test case 2.1.
* Press 'My profile' button.

### Output
Same as test case 2.2 output.

***

# TEST CASE 4.1: Search (user exists)

### Input
* Test case 1.1.
* Enter 'Admin' in search box.
* Press 'Search' button.

### Output
* Redirected to user 'Admin' profile.  
![tc4_1](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc4_1.png)

***

# TEST CASE 4.2: Search (user does not exist, and no similar)

### Input
* Enter 'a0w9du89a0wyd' in search box (or something you are sure not has been used to register).
* Press 'Search' button.

### Output
* The message 'No results found' is shown.  
![tc4_2](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc4_2.png)

***

# TEST CASE 4.3: Search (user does not exists, but similar username does)

### Input
* Test case 1.1.
* Test case 2.1.
* Enter 'adm' in search box.
* Press 'Search' button.

### Output
![tc4_3](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc4_3.png)

# TEST CASE 4.4 Search (with empty text field)

### Input
* Press 'Search' button with a empty text field.

### Output
* The message 'Username missing' is shown.  
![tc4_4](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc4_4.png)

***

# TEST CASE 5.1: Go to settings page

### Input
* Test case 1.1 or Test case 2.1.
* Log in.
* Press 'Settings' button.

### Output
* If test case 1.1:  
![tc5_111](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc5_1_1_1.png)

* If test case 2.1:  
![tc5_121](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc5_1_2_1.png)

***

# TEST CASE 5.2: Edit user information

### Input
* Test case 5.1
* Enter a new name and/or contact information.
* Press 'Save' button.

### Output
* User is redirected to 'My profile'.
* The new information is saved and displayed.  
![tc5_2](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc5_2.png)

***

# TEST CASE 5.3: Remove user information

### Input
* Test case 5.1 using test case 2.1.
* Clear 'name' and/or 'contact' text box(es).
* Press 'Save' button.

### Output
* User is redirected to 'My profile'.
* The new information is saved and displayed.  
![tc5_3](https://raw.githubusercontent.com/ea222pu/1DV608-Project/master/images/tc5_3.png)