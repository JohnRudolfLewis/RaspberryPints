#!/usr/bin/python
import serial
import subprocess

#The following line is for serial over GPIO
port = '/dev/ttyS0'
#The following line is for serial over USB
#port = '/dev/ttyACM0'
arduino = serial.Serial(port,9600,timeout=2)


# Edit this line to identify which building this display is in
building = '5k'

running = True

try:
	while running:	
		msg = arduino.readline()
		if not msg:
			continue
		reading = msg.split(";")
		if ( len(reading) < 2 ):
			print "Unknown message: "+msg
			continue
		if ( reading[0] == "P" ):
			MCP_ADDR = int(reading[1])
			MCP_PIN = str(reading[2])
			PULSE_COUNT = str(reading[3])
			subprocess.call(["curl", "http://beer.scrum.guru/pour.php?building=" + building + "&pin=" + MCP_PIN + "&pulses" + PULSE_COUNT])
		elif ( reading[0] == "K" ):
			MCP_ADDR = int(reading[1])
			MCP_PIN = int(reading[2])
		else:
			print "Unknown message: "+msg
finally:
        print "Exiting"