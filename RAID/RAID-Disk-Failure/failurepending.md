# Pending Disk Failure

## Additional Details

- `mdadm --detail /dev/md0 | grep faulty` checks which RAID array is faulty.
	- For this example, the failed disk will be `/dev/xvdc`

## Remove the Failing Disk

To remove the failing disk from the RAID array:   
`sudo mdadm --manage /dev/md0 --remove /dev/xvdc`
	
## Parition the New Disk

To replicate the partition schema of a working disk, `/dev/xvdb`, to the new disk, `/dev/xvde`:   
`sudo sgdisk -R /dev/xvde /dev/xvdb` 

To prevent issues with GUID, we’ll need to randomize the GUID of the new drive:   
`sudo sgdisk -G /dev/xvde`

## Getting Data from Dying Disk

Clone the old disk to the new disk:   
`sudo ddrescue -f -n /dev/xvdc /dev/xvde /root/recovery.log`

## Moving Data to New System

To add the new disk to the RAID array:   
`sudo mdadm --manage /dev/md0 --add /dev/xvde`
