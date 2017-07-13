#!/bin/bash

mkdir -p rsa
openssl genrsa -out rsa/rsa_1024_priv.pem 1024
openssl rsa -pubout -in rsa/rsa_1024_priv.pem -out rsa/rsa_1024_pub.pem
