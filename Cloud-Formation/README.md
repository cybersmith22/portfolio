# Project 2

## Part 1 - Build a VPC

### Create VPC   
Building an VPC enables resources to be launched in an isolated virtual network. 
![SMITH-VPC created](https://github.com/WSU-kduncan/ceg3120-cybersmith-22/blob/main/Projects/Project2/images/vpc.JPG)

### Create Subnet   
A subnet is used to segment large networks into smaller networks. 
![SMITH-Subnet created](https://github.com/WSU-kduncan/ceg3120-cybersmith-22/blob/main/Projects/Project2/images/subnet.JPG)

### Create Internet Gateway   
Internet Gateways provide a target in VPC route tables.
![SMITH-gw created](https://github.com/WSU-kduncan/ceg3120-cybersmith-22/blob/main/Projects/Project2/images/gw.JPG)

### Create Route Table   
Route Tables are used to determine where network traffic is directed. 
![SMITH-routetable created](https://github.com/WSU-kduncan/ceg3120-cybersmith-22/blob/main/Projects/Project2/images/rt.JPG)

### Create Security Group   
Security Groups hold inbound and outbound rules for allowed traffic. 
![SMITH-sg created](https://github.com/WSU-kduncan/ceg3120-cybersmith-22/blob/main/Projects/Project2/images/sg_full.JPG)


## Part 2 - EC2 Instances
### Instance Details  
- AMI Selected: Ubuntu Server 18.04 LTS 
  - Default Username: ubuntu
- Instance type: t2.micro 
![instance details](https://github.com/WSU-kduncan/ceg3120-cybersmith-22/blob/main/Projects/Project2/images/instance.JPG)

### Attach Instance to VPC   
- On step 3, under the network tab, select the instance's desired VPC.  
  - For my instance, I attached my VPC I created in Part 1, SMITH-VPC.

### Public IP Auto-Assign   
Opted not to auto-assign a public ip address because I felt the elastic ip was sufficent. I also didn't want to go back a fix things later on if the address changed.  

### Storage Volume   
- On step 4, there is an option to adjust the instance's storage. 
  - For my instance, I assigned it 16 GB. Up to 30 GB of SSD storage is available for free.  

### Tag Instance   
- On step 5, there is the option to add tags to the instance like the name. 
  - For my instance, I entered "Name" under the Key column, then added "SMITH-instance" in the Value column.  

### VPC Security Group   
- On step 6, to add the instance to an already created security group, choose "Select an ***existing*** security group", then select the instance's desired security group. 
  - For my instance, I selected the security group that I created in Part 1, SMITH-sg.  

### Elastic IP   
- To create an Elastic IP for the instance:   
    1.  Under "Network & Security", select "Elastic IPs".  
    2.  Click the orange "Allocate Elastic IP address" button in the top right.   
    3. Keep the default settings and add a name tag.   
        - For my instance, under Key I added, "Name" and under Value, "SMITH-EIP".   
    4. Click the orange "Allocate" button in the bottom right. The allocated Elastic IP has been created! 
- To associate that Elastic IP to an instance: 
    1. Under the "Actions" drop down, select "Associate Elastic IP address".  
    2. Under "Instance" select the instance that will be associated with the Elastic IP.   
    3. Under "Private IP address" select select the given address. This is the IP address that is already associated with the instance.  
    4. Click the orange "Associate" button in the bottom right. The allocated Elastic IP address is now associated with the instance!

### Hostname   
- To change the hostname for the instance through the command line:   
    1. SSH into the instance
    2. It is a good idea to copy the original config files before changing hostname.   
        - `cp /etc/hostname /etc/hostname.old`
    3. Using `sudo`, edit the hostname file. Delete the old name and replace it with the new host name.   
        - `sudo vim /etc/hostname`   
        - For my instance, I changed it to SMITH-Ubuntu.   
    4. If necessary, edit the /etc/hosts file using `sudo`.   
        - `sudo vim /etc/hosts`   
        - In my case, the old hostname was not mentioned, so I did not have to edit this file. 
    5. Reboot the system and SSH back in. 
        - `sudo reboot` 

9. Successful SSH   
![successful SSH](https://github.com/WSU-kduncan/ceg3120-cybersmith-22/blob/main/Projects/Project2/images/ssh_hostname.JPG)