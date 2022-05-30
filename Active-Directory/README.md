# Project 4

## Setup AD DC
Configuring a Windows Server to be a Domain Controller   
1. Configure Internet Protocol Version 4 (TCP/IPv4) Properties to match the static IP
2. Rename the server 
3. Configure the Active Directory Domain Services role and install
4. Configure Active Directory in Windows Server 2019   
	- Add a root domain name
5. Install Active Directory on the server   
- Domain Name: ad.cybersmith.com
- Domain Controller Name: DC1
- Domain DNS IP: 10.0.0.10


## AD Structure

### Create OUs   
![Screenshot of created OUs](https://github.com/cybersmith22/portfolio/blob/4861715ef9a01a22439e12dedfe6123d84e40adb/Active-Directory/images/ous.JPG)

### Joining Users   

![Screenshot of users in correct OUs](https://github.com/cybersmith22/portfolio/blob/4861715ef9a01a22439e12dedfe6123d84e40adb/Active-Directory/images/users.JPG)

### Joining Computers
Steps to join a new Windows Server instance to the domain
1. Configure Internet Protocol Version 4 (TCP/IPv4) Properties, adding the Domain Controller as the DNS Server
2. On the new Windows System, run the command `sysdm.cpl`, opening the System Properties control panel
3. Click the Change... button
4. Change the Computer name to the desired name for the Active Directory 
5. In the "Member of" menu select "Domain" and input the Domain Name, then click Ok
6. A prompt will appear for the domain controller credentials
7. After entering the credentials, they system will need to restart to take effect
8. On the Domain Controller in the Active Directory GUI, find the Domain Computers, by default the new system is added here
9. Right Click the new system, select Move..., and select the [Domain] Computers
10. The new system is now in the Domain and in the correct OU   

![Screenshot of successfully joined computer](https://github.com/cybersmith22/portfolio/blob/4861715ef9a01a22439e12dedfe6123d84e40adb/Active-Directory/images/joincomp.JPG)

### Creating Groups
Security Groups with OUs
- `project_repos_RW` in `Developers` - users who have Read / Write access to project repositories
- `finance_RW` in - `Finance` - users who have Read / Write access to finance share
- `onboarding_R` in `HR` - users who have Read access to onboarding documents
- `server_access` in `cybersmith Servers` - users who can log on to Servers
- `dev_eng_admins` in `cybersmith Users` - IT admins to handle Developer and Engineer accounts
- `hr_finance_admins` in `cybersmith Users` - IT admins to handle HR and finance accounts
- `remote_workstation` in `Workstations` - Group of workstations that allow RDP connections


## OUs & GPOs

### Applying Group Policies

How to create a Group Policy Object
1. Open the Group Policy Management Editor
2. Select the OU where the Group Policy will be applied
3. Right Click on the object, select "Create a GPO in this domain, and Link it here..."
4. Enter the name of the Group Policy, Click Ok
5. On the newly created GPO, right click then "Edit
6. On the right browse the menu and select the desired setting

GPOs
- `Lock Workstations` in `Workstations` - Lock out Workstations after 15 minutes of inactivity
- `Prevent Programs` in `Secure` - Prevent execution of programs on computers in Secure OU
- `Disable Guest` in `Secure` - Disable Guest account login to computers in Secure OU
- `Server Access` in `cybersmith Servers` - Allow server access to sign on to Servers
- `Set Background` in `Conference` - Set Desktop background for Conference computers to company logo
= `Remote Workstations` in `Developers` - Allow users in remote workstation group to RDP to Workstations

### Managing OUs
How to delagate control of an OU to a group 
1. In the Group Policy Management Editor, double-click the OU to be delegated 
2. On the right, under the Delegation tab, click the "Advanced..." button at the bottom
3. Add or select the group or users
4. Set the appropriate access permissions for the OU   

The user now delegates: `HR`, `Finance`, `Engineers`, and `Developers`   

The `hr_finance_admins` and `eng_dev_admins` group should be given the following permissions
- Read: To allow for user account configurations 
- Create and Delete all child objects: To add or remove users from the OUs
- Generate resultant set of policy (logging and planning): For future policy changes
