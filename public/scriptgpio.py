#!/usr/bin/python
 
import sys, time, ntpath
import RPi.GPIO as GPIO

class colors:
    SUCCESS = '\033[92m'
    WARNING = '\033[93m'
    ERROR = '\033[91m'
    RESET = '\033[0m'

class GpioException(Exception): pass

try:
   scriptName = ntpath.basename(sys.argv[0])

   #if len(sys.argv) != 3:
   #   raise GpioException(colors.ERROR + 'Error : missing args\n' + colors.WARNING + 'Usage: python {} gpio_bcm_id execution_time_in_second '+ colors.SUCCESS +'\nex: "python {} 17 4"'.format(scriptName,scriptName))


   # disable warnings
   GPIO.setwarnings(False)

   # set gpio mode to BCM
   GPIO.setmode(GPIO.BCM)

   i = 0
   parametersStr = sys.argv[1]
   parameters = parametersStr.split(',')
   print(len(parameters))

   while i < len(parameters):
      
      tmpStr = parameters[i]
      # print(tmpStr)
      
      tmpObj = tmpStr.split(':')
      gpioId = int(tmpObj[0])
      during = int(tmpObj[1])
      
      # print(gpioId)
      # print(during)
      
      # set the gpio to an output
      GPIO.setup(gpioId, GPIO.OUT)
      
      # set the gpio status to 0 (for safety, It is not mandatory)
      GPIO.output(gpioId, GPIO.LOW)
      
      # set the gpio status to 1
      GPIO.output(gpioId, GPIO.HIGH)
      
      # delay
      time.sleep(during)
      
      # set the gpio status to 0
      GPIO.output(gpioId, GPIO.LOW)
      
      i += 1


   # reset the gpio parameters to prevent electrical damage that could happened
   GPIO.cleanup()

except GpioException as e:
   print(e)
