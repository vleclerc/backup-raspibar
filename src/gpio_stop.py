#!/usr/bin/python

import os, sys, time, ntpath 
import RPi.GPIO as GPIO

out = os.system('ps -ef | grep scriptgpio')
print out

#GPIO.setwarnings(False)
#GPIO.setmode(GPIO.BCM)

#gpios = [17,18,27,22,23,24,25,26]
#for gpioId in gpios:
#   GPIO.setup(gpioId, GPIO.OUT)
#   GPIO.output(gpioId, GPIO.LOW)
#   print "stop {}".format(gpioId) 

#GPIO.cleanup()
