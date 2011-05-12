---
layout: post
title: hello world
description:
categories:
- developer

---

My friend wanted to know how to change or convert DHCP network configuration to static configuration. After initial installation, he wanted to change network settings. Further, his system is w/o GUI system aka X Windows. Here is quick way to accomplish the same:

Your main network configuration file is <span style="color: rgb(102, 51, 0);">/etc/network/interfaces</span>

Desired new sample settings:
=> Host IP address 192.168.1.100
=> Netmask: 255.255.255.0
=> Network ID: 192.168.1.0
=> Broadcast IP: 192.168.1.255
=> Gateway/Router IP: 192.168.1.254
=> DNS Server: 192.168.1.254

Open network configuration file

<pre>$ sudo vi /etc/network/interfaces</pre>

OR

<pre>$ sudo nano /etc/network/interfaces</pre>

Find and remove dhcp entry:

<pre>iface eth0 inet dhcp</pre>

Append new network settings:

<pre>iface eth0 inet static
address 192.168.1.100
netmask 255.255.255.0
network 192.168.1.0
broadcast 192.168.1.255
gateway 192.168.1.254</pre>

Save and close the file. Restart the network:

<pre>$ sudo /etc/init.d/networking restart</pre>

<strong>Task: Define new DNS servers
</strong>
Open /etc/resolv.conf file

<pre>$ sudo vi /etc/resolv.conf </pre>

You need to remove old DNS server assigned by DHCP server:

<pre>search myisp.com
nameserver 192.168.1.254
nameserver 202.54.1.20
nameserver 202.54.1.30</pre>

Save and close the file.

<strong>Task: Test DNS server</strong>

<pre>$ host mariusv.com</pre>

<strong>Network command line cheat sheet</strong>

You can also use commands to change settings. Please note that these settings are temporary and not the permanent. Use above method to make network changes permanent or GUI tool as described below.

<strong>Task: Display network interface information</strong>

<pre>$ ifconfig</pre>

<strong>Take down network interface eth0 / take a network interface down</strong>

<pre>$ sudo ifconfig eth0 down</pre>

OR

<pre>$ sudo ifdown eth0 </pre>

<strong>Bring a network interface eth0 up </strong>

<pre>$ sudo ifconfig eth0 up</pre>

OR

<pre>$ sudo ifup eth0 </pre>

<strong>Change IP address and netmask from command line</strong>

Activate network interface eth0 with a new IP (192.168.1.50) / netmask:

<pre>$ sudo ifconfig eth0 192.168.1.50 netmask 255.255.255.0 up</pre>

<strong>Display the routing table</strong>

<pre>$ /sbin/route </pre>

OR

<pre>$ /sbin/route -n</pre>

Output:

<pre>Kernel IP routing table
Destination     Gateway         Genmask         Flags Metric Ref    Use Iface
localnet        *               255.255.255.0   U     0      0        0 ra0
172.16.114.0    *               255.255.255.0   U     0      0        0 eth0
172.16.236.0    *               255.255.255.0   U     0      0        0 eth1
default         192.168.1.254   0.0.0.0         UG    0      0        0 ra0
</pre>

<strong>Add a new gateway</strong>

<pre>$ sudo route add default gw 172.16.236.0</pre>

<strong>Display current active Internet connections (servers and established connection)</strong>

<pre>$ netstat -nat</pre>

<strong>Display open ports</strong>

<pre>$ sudo netstat -tulp</pre>

OR

<pre>$ sudo netstat -tulpn</pre>

<strong>Display network interfaces stats (RX/TX etc)</strong> 

<pre>$ netstat -i</pre>

<strong>Display output for active/established connections only</strong>

<pre>$ netstat -e
$ netstat -te
$ netstat -tue</pre>

<p>Where,</p>
<ul>
<li>-t : TCP connections </li>
<li>-u : UDP connections</li>
<li>-e : Established </li>
<strong>Test network connectivity</strong>

Send ICMP ECHO_REQUEST to network hosts, routers, servers etc with ping command. This verifies connectivity exists between local host and remote network system:



<pre>$ ping router
$ ping 192.168.1.254
$ ping mariusv.com</pre>
</ul>
