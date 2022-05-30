# HAProxy

HAProxy is a load balancer for TCP and HTTP services the spreads requests across multiple servers.

## Configuring Web Servers and HAProxy

1. In `/etc/hosts` add the the private IP then the desired hostname, `10.0.1.10 srv1` and `10.0.1.20 srv2`
2. Download PEM for AWS on each system, `chmod 600` to change the permission for the key, use that to ssh into the systems using the private IPs
    - `ssh -i ceg3120-aws-vm.pem ubuntu@10.0.1.10` to ssh into serv1
	- `ssh -i ceg3120-aws-vm.pem ubuntu@10.0.1.20` to ssh into serv2
3. HAProxy Configuration
	- `/etc/haproxy/haproxy.cfg` the HAproxy configuation file
	- frontend
		- `frontend 3.228.164.229` sets the public IP of the proxy for the domain
		- `bind 10.0.0.10:80` sets the IP address and port to listen on
		- `default_backend web_servers` sets the backend servers to the ones configured in the next section
	- backend
		- `backend web_servers` labels the backend server `web_servers`
		- `balance roundrobin` sets how the HAProxy selects the servers
		- `option httpchk HEAD /` sets the HAProxy to send HTTP health checks to the backend servers
		- `server srv1 10.0.1.10:80` sets the first server to srv1 at 10.0.1.10 at port 80
		- `server srv2 10.0.1.20:80` sets the second server to srv2 at 10.0.1.20 at port 80
    - `sudo systemctl restart haproxy` restarts the HAProxy service
    - using `3.228.164.229` as my resources
4. Webserver 1 & 2 Configuration
    - On both srv1 and srv2 `/var/www/html/index.html` was modified to name the server where the file is located.
    - No configurations were set
    - Apache looks for files at `/var/www/html` so that is where the site content files are located
    - `sudo systemctl restart apache2` to restart the apache2 service
    - using `index.srv1.html` and `index.srv2.html` as my resources
5. Screenshots for srv1 & srv2   
      ![server 1](https://github.com/WSU-kduncan/ceg3120-cybersmith-22/blob/d456124bee60da900fcd1d4f0f49180695886fd7/Projects/Project4/images/srv1.JPG)
      ![server 2](https://github.com/WSU-kduncan/ceg3120-cybersmith-22/blob/d456124bee60da900fcd1d4f0f49180695886fd7/Projects/Project4/images/srv2.JPG)
6. [Link to Proxy](http://3.228.164.229)
