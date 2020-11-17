import os
import struct
import socket
import sys


    # SHRIRAM'S MODULE FOR PROTOCOL IMPLEMENTIONS
    # MODULE FOR ALL PROTOCOLS
    # NOW TWO PROTOCOLS ARE IMPLEMENTED           DATE:11/10/2020
    # YOU CAN UPGRADE IT !!!!!


def chksum(msg):
    s = 0  # Binary Sum

    # loop taking 2 characters at a time
    for i in range(0, len(msg), 2):
        if (i + 1) < len(msg):
            a = (msg[i])
            b = (msg[i + 1])
            s = s + (a + (b << 8))
        elif (i + 1) == len(msg):
            s += ord(msg[i])
        else:
           print( "Something Wrong here")

    # One's Complement
    s = s + (s >> 16)
    s = ~s & 0xffff

    return s


def tcp_packet(source_ip,dest_ip):

    tcp_source = 12388
    tcp_dst =4444
    tcp_seq = 0
    tcp_ack_seq = 0
    tcp_doff = 5  # 4 bits allowed for tcp_heaer 4*5 =20 bytes
    tcp_fin = 0
    tcp_syn = 1
    tcp_rst = 0
    tcp_psh = 0
    tcp_ack = 0
    tcp_urg = 0
    tcp_window = socket.htons(5640)
    tcp_check = 0
    tcp_urgptr = 0
    tcp_offset_res = (tcp_doff << 4) + 0
    tcp_flag = tcp_fin + (tcp_syn << 1) + (tcp_rst << 2) + (tcp_psh << 3) + (tcp_ack << 4) + (tcp_urg << 5)
    #tcp_check = chksum(tcp_header)



    tcp_header = struct.pack('!HHLLBBHHH', tcp_source, tcp_dst, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flag,
                             tcp_window, tcp_check, tcp_urgptr)
    #pseudoheader fields!!!!

    usr_data="how are you?hope yuouo wel"

    source_address = socket.inet_aton(source_ip)
    dest_address = socket.inet_aton(dest_ip)
    placeholder = 0
    protocol = socket.IPPROTO_TCP
    tcp_length = len(tcp_header)

    psh = struct.pack('!4s4sBBH', source_address, dest_address, placeholder, protocol, tcp_length)
    psh = psh + tcp_header

    tcp_check=chksum(psh)

    #tcp_header=struct.pack('!HHLLBBH',tcp_source,tcp_dst,tcp_seq,tcp_ack_seq,tcp_offset_res,tcp_flag,tcp_window) + ('H',tcp_check) +('!H',tcp_urgptr)
    tcp_header = struct.pack('!HHLLBBHHH', tcp_source, tcp_dst, tcp_seq, tcp_ack_seq, tcp_offset_res, tcp_flag,
                             tcp_window, tcp_check,tcp_urgptr)

    return tcp_header
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


if __name__ == "__main__":
	sys.exit(tcp_packet(source_ip,dest_ip))
