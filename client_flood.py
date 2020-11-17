import socket
import struct

import sys
import Medussa2 as M

SOCKET_LIST=[sys.stdin]
RECIEVE_BUFF=4096
print ("hello worl top")

def chksum(msg):
    s = 0  # Binary Sum

    # loop taking 2 characters at a time
    for i in range(0, len(msg), 2):
        if (i + 1) < len(msg):
            a = ord(msg[i])
            b = ord(msg[i + 1])
            s = s + (a + (b << 8))
        elif (i + 1) == len(msg):
            s += ord(msg[i])
        else:
           print ("Something Wrong here")

    # One's Complement
    s = s + (s >> 16)
    s = ~s & 0xffff

    return s


def IPPacket(src, dst):
    
    
    ip_vhl = 5
    ip_ver1 = 4
    ip_ver = (ip_ver1 <<4 )+ ip_vhl
    ip_dfc = 0
    ip_tol = 20+20
    ip_idf =9999
    ip_frag_offset = 0
    ip_ttl = 64
    ip_proto = 6# [*ip_daddr,*ip_chk]]
    ip_chk = 10
    ip_saddr = socket.inet_aton(src)  # "192.168.43.98"
    ip_daddr = socket.inet_aton(dst)  # "192.168.43.160"

   #ip_chk = chksum(ipheader)
    # ip_chk=bytes(str(ip_chk,'utf-8'))
    ##ip_chk=ip_chk.to_bytes(1,'big')

    ipheader = struct.pack('!BBHHHBBH4s4s', ip_ver, ip_dfc, ip_tol, ip_idf, ip_frag_offset, ip_ttl, ip_proto, ip_chk,
                          ip_saddr, ip_daddr)  # right format mind this
    #ip_chk = chksum(ipheader)
    #ipheader = struct.pack('!BBHHHBBH4s4s', ip_ver, ip_dfc, ip_tol, ip_idf, ip_frag_offset, ip_ttl, ip_proto, ip_chk,
     #                     ip_saddr, ip_daddr)  # right format mind this

    return ipheader



#b=a.to_bytes(1,'big')

host="192.168.43.160"
#port=4444
srcc="192.168.43.98"
print ("hello world")
s=socket.socket(socket.AF_INET,socket.SOCK_RAW,socket.IPPROTO_RAW)
s.setsockopt(socket.IPPROTO_IP,socket.IP_HDRINCL,True)



packet=IPPacket(srcc,host) +M.tcp_packet(srcc,host)

while True:


	try:
 		s.sendto(packet,(host,0))
   		
	except socket.error as e:
    		print(e)
    		sys.exit(-1)
    		print ( "errorr")


