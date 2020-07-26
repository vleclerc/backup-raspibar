<?php
namespace PhpGpio;

/*
 +-----+-----+---------+------+---+---Pi 3---+---+------+---------+-----+-----+
 | BCM | wPi |   Name  | Mode | V | Physical | V | Mode | Name    | wPi | BCM |
 +-----+-----+---------+------+---+----++----+---+------+---------+-----+-----+
 |     |     |    3.3v |      |   |  1 || 2  |   |      | 5v      |     |     |
 |   2 |   8 |   SDA.1 |   IN | 1 |  3 || 4  |   |      | 5V      |     |     |
 |   3 |   9 |   SCL.1 |   IN | 1 |  5 || 6  |   |      | 0v      |     |     |
 |   4 |   7 | GPIO. 7 |   IN | 1 |  7 || 8  | 0 | IN   | TxD     | 15  | 14  |
 |     |     |      0v |      |   |  9 || 10 | 1 | IN   | RxD     | 16  | 15  |
 |  17 |   0 | GPIO. 0 |   IN | 0 | 11 || 12 | 0 | IN   | GPIO. 1 | 1   | 18  |
 |  27 |   2 | GPIO. 2 |   IN | 0 | 13 || 14 |   |      | 0v      |     |     |
 |  22 |   3 | GPIO. 3 |   IN | 0 | 15 || 16 | 0 | IN   | GPIO. 4 | 4   | 23  |
 |     |     |    3.3v |      |   | 17 || 18 | 0 | IN   | GPIO. 5 | 5   | 24  |
 |  10 |  12 |    MOSI |   IN | 0 | 19 || 20 |   |      | 0v      |     |     |
 |   9 |  13 |    MISO |   IN | 1 | 21 || 22 | 0 | IN   | GPIO. 6 | 6   | 25  |
 |  11 |  14 |    SCLK |   IN | 0 | 23 || 24 | 1 | IN   | CE0     | 10  | 8   |
 |     |     |      0v |      |   | 25 || 26 | 1 | IN   | CE1     | 11  | 7   |
 |   0 |  30 |   SDA.0 |   IN | 1 | 27 || 28 | 1 | IN   | SCL.0   | 31  | 1   |
 |   5 |  21 | GPIO.21 |   IN | 1 | 29 || 30 |   |      | 0v      |     |     |
 |   6 |  22 | GPIO.22 |   IN | 1 | 31 || 32 | 0 | IN   | GPIO.26 | 26  | 12  |
 |  13 |  23 | GPIO.23 |   IN | 0 | 33 || 34 |   |      | 0v      |     |     |
 |  19 |  24 | GPIO.24 |   IN | 0 | 35 || 36 | 0 | IN   | GPIO.27 | 27  | 16  |
 |  26 |  25 | GPIO.25 |   IN | 0 | 37 || 38 | 0 | IN   | GPIO.28 | 28  | 20  |
 |     |     |      0v |      |   | 39 || 40 | 0 | IN   | GPIO.29 | 29  | 21  |
 +-----+-----+---------+------+---+----++----+---+------+---------+-----+-----+
 | BCM | wPi |   Name  | Mode | V | Physical | V | Mode | Name    | wPi | BCM |
 +-----+-----+---------+------+---+---Pi 3---+---+------+---------+-----+-----+
 */

class Pi
{
    /**
     * 
     * Get RaspberryPi version
     * 
     * A list of Model and Pi Revision & Hardware Revision Code from '/proc/cpuinfo' is here: 
     * @link http://www.raspberrypi-spy.co.uk/2012/09/checking-your-raspberry-pi-board-version/
     * 
     * @return decimal Raspi version
     */
    public function getVersion()
    {
        $cpuinfo = preg_split ("/\n/", file_get_contents('/proc/cpuinfo'));
        foreach ($cpuinfo as $line) {
            if (preg_match('/Revision\s*:\s*([^\s]*)\s*/', $line, $matches)) {
                return hexdec($matches[1]);
            }
        }
        return 0;
    }
	
    public function getCpuLoad()
    {
        return sys_getloadavg();
    }
	
    public function getCpuTemp($fahrenheit = false)
    {
        $cputemp = floatval(file_get_contents('/sys/class/thermal/thermal_zone0/temp'))/1000;
		
		if($fahrenheit)
			$cputemp = 1.8* $cputemp+32;
		
        return $cputemp;
    }
	
    public function getGpuTemp($fahrenheit = false)
    {
        $gputemp = floatval(str_replace(array('temp=', '\'C'), '', exec('/opt/vc/bin/vcgencmd measure_temp')));
		
		if($fahrenheit)
			$gputemp = 1.8* $gputemp+32;
        return $gputemp;
    }
	
    public function getCpuFrequency()
    {
        $frequency = floatval(file_get_contents('/sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq'))/1000;
		
        return $frequency;
    }
}
