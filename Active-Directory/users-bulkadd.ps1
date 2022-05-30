# Sample from Active Directory Management in a Month of Lunches
# Prompt for password for all accounts
$secpass = Read-Host "Enter Default Password for Accounts" -AsSecureString

# Pipe names.csv file to foreach loop
Import-Csv users.csv |
foreach {
  $name = "$($_.FirstName) $($_.LastName)"

 New-ADUser -GivenName $($_.FirstName) -Surname $($_.LastName) `
 -Name $name -SamAccountName $($_.SamAccountName) `
 -UserPrincipalName "$($_.SamAccountName)@ad.cybersmith.com" `
 -AccountPassword $secpass -Path "ou=$($_.OU2),ou=$($_.OU1),dc=ad,dc=cybersmith,dc=com" `
 -Enabled:$true
}