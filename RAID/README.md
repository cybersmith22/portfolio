# RAID Disks

## Overview 
RAID systems are used to improve performance and prevent data loss from hard drive failures. RAID stands for Redundant Array of Independent Disks. RAID levels provide a different balance among the key goals: reliability, availability, performance, and capacity. 

## RAID Levels

- Level 0: Striping      
  RAID 0 has the best performance and cost but lacks reliablity. All data is split amoung the disks, there is no redundancy. While read and write speeds increase drastically, there will be data lost if a disk fails.   
  ![level0](https://user-images.githubusercontent.com/32077767/171258752-41cba559-8c3a-4366-9178-b732f208f4b2.png)

- Level 1: Mirroring   
  RAID 1 is best for minimal risk of data loss. Data is mirrored / duplicated amoung disks, providing fault tolerance. Increase in read operation, but slow write performance.   
  ![level1](https://user-images.githubusercontent.com/32077767/171258805-22cb0a6a-98e6-4b70-99fd-d65b5ec0b74a.png)   

- Level 5: Striping with Parity   
  RAID 5 is the most common solution with high read and write performance, capacity, and reliability. This level can handle a single disk failure with no data loss.   
  ![level5](https://user-images.githubusercontent.com/32077767/171258870-00ad2148-3cbe-4913-81a3-117041aa61f4.png)

- Level 6: Striping with Double Parity   
  RAID 6 is very similar to RAID 5, but with two parity blocks on each disk. Fast read performance, but with slower write performance. This level can handle two disks failing.    
  ![level6](https://user-images.githubusercontent.com/32077767/171258908-78935777-3ae2-4a88-aca2-8de97cfadda3.png)  


## Hardware RAID v. Software RAID

**Hardware RAID**: Drives are plugged into a hardware device, the device manages the RAID configuration    
Advantages:
  - Higher read and write performance
  - Fewer system resources used
  - Battery backup
  - Not vulnerable to viruses
  - Encryption availablity    
Disadvantages: 
  - Cost
  - Replacing failed RAID disk with compatible one   

**Software RAID**: Drives are plugged into a PC's motherboard, a program running on the system maintains the RAID   
Advantages:
  - Cost
  - Supports more drives   
Disadvantages:
  - Speed
  - OS compatibility 
  - Complicated replacement

## My Projects

- **Building-RAID**: This file explains the process of configuring a RAID system and how to rebuild the RAID after a disk failure. 

- **RAID-Disk-Failure**: This file explains how to handle a dying RAID disk and recover the data.

