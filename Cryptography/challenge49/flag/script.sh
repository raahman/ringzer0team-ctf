#!/bin/sh
openssl rsautl -decrypt -inkey private.pem -in flag.enc -out decrypted.txt
