from ctypes import *
import thread

libc = CDLL('libc.so.6')

# Some constants
PROT_READ = 1
PROT_WRITE = 2
PROT_EXEC = 4

def executable_code(buffer):
    """Return a pointer to a page-aligned executable buffer filled in with the data of the string provided.
    The pointer should be freed with libc.free() when finished"""

    buf = c_char_p(buffer)
    size = len(buffer)
    # Need to align to a page boundary, so use valloc
    addr = libc.valloc(size)
    addr = c_void_p(addr)

    if 0 == addr:  
        raise Exception("Failed to allocate memory")

    memmove(addr, buf, size)
    if 0 != libc.mprotect(addr, len(buffer), PROT_READ | PROT_WRITE | PROT_EXEC):
        raise Exception("Failed to set protection on buffer")
    return addr



shellcode = '\xeb\x4d\x5e\x66\x83\xec\x0c\x48\x89\xe0\x48\x31\xc9\x68\x5d\x52\x80\x6f\x48\x89\xcf\x80\xc1\x0c\x40\x8a\x3e\x40\xf6\xd7\x40\x88\x38\x48\xff\xc6\x68\x50\x44\x90\x33\x48\xff\xc0\xe2\xea\x2c\x0c\x48\x89\xc6\x68\x1b\x02\xfc\xae\x48\x31\xc0\x48\x89\xc7\x40\xb7\x01\x04\x01\x48\x89\xc2\x80\xc2\x0b\x0f\x05\x48\x31\xc0\x04\x3c\x0f\x05\xe8\xae\xff\xff\xff\x8e\xbd\xae\xcc\xbb\x96\xcd\xb7\xb4\xcc\xc8\xcc\x3d\x8d\xdb\xf0\x78\xdf\x8f\x72\xb3\x48\xbb\xaa\x4e\xef\x68\xb3\x8c\x18\xb7\x5b\x52\x41\x4e\x44\x53\x54\x52\x32\x5d'

memorywithshell = executable_code(shellcode)
shell = cast(memorywithshell, CFUNCTYPE(c_void_p))
shell()
#print 'starting thread'
#thread.start_new_thread(shell(),())
