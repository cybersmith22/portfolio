# Project 1

## What the Script Does

- Prompts the user with a menu   
  ![user menu](https://github.com/cybersmith22/portfolio/blob/d1e50bd67882c60be8b65f16dbd3c55a4dd7b50c/User-Management-Scripts/images/menu.JPG)
- Function 1: Add-Single
  - Prompts the user to enter a username 
  - Creates the user account with a randomly generated password
  - If the username already exists, informs the user and does not create an account
  - Adds the user to the group, org
  - Gives the user's home directory the group permissions
  - Places account details (username and password) in an output file  
  ![function 1](https://github.com/cybersmith22/portfolio/blob/d1e50bd67882c60be8b65f16dbd3c55a4dd7b50c/User-Management-Scripts/images/add-single.JPG)
- Function 2: Remove-Single
  - Prompts the user to enter a username
  - Deletes the user account and home directory, which removes the user from org  
  ![function 2](https://github.com/cybersmith22/portfolio/blob/d1e50bd67882c60be8b65f16dbd3c55a4dd7b50c/User-Management-Scripts/images/remove-single.JPG)
- Function 3: Add-Bulk
  - Prompts the user to enter a filename containing user names
  - For each user in the file:
    - Creates the user account with a randomly generated password
    - If the username already exists, informs the user and skips to the next user
    - Adds the user to the group, org
    - Gives the user's home directory the group permissions
    - Places account details (username and password) in an output file  
  ![function 3](https://github.com/cybersmith22/portfolio/blob/d1e50bd67882c60be8b65f16dbd3c55a4dd7b50c/User-Management-Scripts/images/add-bulk.JPG) 
- Function 4: Remove-Bulk
  - Prompts the user to enter a filename containing user names
  - For each user in the file:
    - Deletes the user account and home directory, which removes the user from org  
  ![function 4](https://github.com/cybersmith22/portfolio/blob/d1e50bd67882c60be8b65f16dbd3c55a4dd7b50c/User-Management-Scripts/images/remove-bulk.JPG)

## How to Run the Script

- `bash project_1` starts the program
- When prompted with the menu
  - `1` or `Add Single User` will call Function 1: Add-Single
  - `2` or `Remove Single User` will call Function 2: Remove-Single
  - `3` or `Bulk Add Users` will call Function 3: Add-Bulk
  - `4` or `Bulk Remove Users` will call Function 4: Remove-Bulk
  - `5` or `Quit` will exit the program

## Expected File Contents (for Add-Bulk & Remove-Bulk)

These files should have only the desired usernames, listed one per line
For Example: 
  ```
  alice
  aaron
  amber
  ...
  ``` 
