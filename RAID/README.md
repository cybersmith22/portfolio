# RAID Disks

## Overview 
RAID systems are used to improve performance and prevent data loss from hard drive failures. RAID stands for Redundant Array of Independent Disks. RAID levels provide a different balance among the key goals: reliability, availability, performance, and capacity. 

## RAID Levels

- Level 0: Striping   
  RAID 0 has the best performance and cost but lacks reliablity. All data is split amoung the disks, there is no redundancy. While read and write speeds increase drastically, there will be data lost if a disk fails. 
  ![level0](https://user-images.githubusercontent.com/32077767/171248364-b39d1ac6-a40e-48dc-b825-4c6538d0b9cb.png)   

- Level 1: Mirroring
  RAID 1 is best for minimal risk of data loss. Data is mirrored / duplicated amoung disks, providing fault tolerance. Increase in read operation, but slow write performance. 
  ![level1](https://user-images.githubusercontent.com/32077767/171252228-9c04f4c7-1474-4684-be78-de58a74d1e17.png)   

- Level 5: Striping with Parity
  RAID 5 is the most common solution with high read and write performance, capacity, and reliability. This level can handle a single disk failure with no data loss. 
  ![level5](https://user-images.githubusercontent.com/32077767/171253263-5ff40595-c68d-471d-a307-fb0177321992.png)   

- Level 6: Striping with Double Parity
  RAID 6 is very similar to RAID 5, but with two parity blocks on each disk. Fast read performance, but with slower write performance. This level can handle two disks failing. 
  ![level6](https://user-images.githubusercontent.com/32077767/171254013-016e959a-3851-4a56-b0b6-cd91b963b741.png)   


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

