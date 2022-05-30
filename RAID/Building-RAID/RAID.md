# Project 2

## Part 1 - Craft a RAID

- For this project, I'm using a RAID 5 device
- Pros: 
   - Increased read performance 
   - Increased write speed
   - Better data redundancy
- Cons: 
   - Can only handle a single disk failure
- `sudo mdadm --create --verbose /dev/md0 --level=5 --raid-devices=3 /dev/xvdb /dev/xvde /dev/xvdf` builds the array
 
## Part 2 - Get Info

- `sudo mdadm -D /dev/md0` checks RAID status
![RAID status](https://github.com/cybersmith22/portfolio/blob/da6f55130daec7f02cfd46d6e29b28691f8ba304/RAID/Building-RAID/images/part2.JPG)
- `State: clean` means that the RAID is working. Failing disk will be noted here and in the last section under `State`

## Part 3 - Mount to Directory 

- `sudo mkfs.ext4 -F /dev/md0` creates a filesystem
- Prior to mounting the device, create a mount point: `sudo mkdir -p /mnt/md0`
- `sudo mount /dev/md0 /mnt/md0` mounts the RAID device to a folder
- `df -h`, verifies that the RAID device is mounted to `/mnt/md0`

## Part 4 - Break It

- Note: After reboot the `/dev/md0` device is renamed `/dev/md127` 
- `sudo mdadm --fail /dev/md127 /dev/xvdf` marks the `/dev/xvdf` disk as failing 
- `sudo mdadm --remove /dev/md127 /dev/xvdf` removes the failing  `/dev/xvdf` disk
- `sudo mdadm -D /dev/md127` checks RAID status and the effect of the removed disk on RAID device
   - The RAID device still works, but is degraded and cannot suffer another disk failure
   ![Effect of Failed Disk on RAID](https://github.com/cybersmith22/portfolio/blob/da6f55130daec7f02cfd46d6e29b28691f8ba304/RAID/Building-RAID/images/part4.JPG)

## Part 5 - Rebuild It

- `sudo mdadm --add /dev/md127 /dev/xvfg` adds a new device, `/dev/xvfg` to RAID
- `sudo mdadm -D /dev/md127` verifys that the RAID device is rebuilt
    ![Rebuilt RAID Array](https://github.com/cybersmith22/portfolio/blob/da6f55130daec7f02cfd46d6e29b28691f8ba304/RAID/Building-RAID/images/part5.JPG)

## Resources

- [How To Create RAID Arrays](https://www.digitalocean.com/community/tutorials/how-to-create-raid-arrays-with-mdadm-on-ubuntu-18-04#creating-a-raid-5-array)
- [Mdadm Cheat Sheet](https://www.ducea.com/2009/03/08/mdadm-cheat-sheet/)
