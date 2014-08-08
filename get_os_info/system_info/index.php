<html>
<body>

<?php
	
	class Uptime
	{
		private $hours;
		private $users;
		private $load_average;
		
		function __construct()
		{	
			$segments = preg_split('/,\s{2,2}/', exec('uptime'));
			
			$this->init_hours($segments[0], $segments[1]);
			$this->init_users($segments[2]);
			$this->init_load_average($segments[3]);	
		}
		
		private function init_hours($segment1, $segment2)
		{
			$hours = 0;
			
			if(preg_match('/(\d)\s*days/', $segment1, $matches))
			{
				$hours = 24 * (int) $matches[1];
			}
			
			list($h, $m) = explode(':', $segment2);
			
			$this->hours = $hours + $h + $m/60;
		}
		
		private function init_load_average($segment)
		{
			if(preg_match('/load average:(.*)/', $segment, $matches))
			{
				$this->load_average = $matches[1];
			}
		}
		
		private function init_users($segment)
		{
			$this->users = (int) $segment;
		}
		
		/********************************************************/
		
		public function hours() { return $this->hours; }
		public function users() { return $this->users; }
		public function load_average() { return $this->load_average; }
	}
	
	$uptime = new Uptime;
	
	$sysinfo = array(
		'System' => php_uname('s'),
		'Host' => php_uname('n'),
		'Release' => php_uname('r'),
		'Version' => php_uname('v'),
		'Architecture' => php_uname('m'),
		'Current time' => exec("date +'%d %b %Y<br />%T %Z'"),
		'Reboot time' => exec('uptime -s'),
		'Uptime (hours)' => $uptime->hours(),
		'Logged in users' => $uptime->users(),
		'Load average' => $uptime->load_average(),
		/*'Frequency' => exec("cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq") / 1000,*/
		
		/* this requires root access since the file permissions of cpuinfo_cur_freq are 400 */
		'CPU frequency' => exec("cat /sys/devices/system/cpu/cpu0/cpufreq/cpuinfo_cur_freq") / 1000,
		
		'CPU cores' => 1 + @exec('tac /proc/cpuinfo | egrep processor | head -n 1 | egrep -o "[[:digit:]]+"'),
		/*'CPU' => str_replace("-compatible processor", "", explode(": ", exec("cat /proc/cpuinfo | grep Processor"))[1]),*/
		'CPU temperature' => round(exec("cat /sys/class/thermal/thermal_zone0/temp ") / 1000, 1),
	);

	$template = "<tr><td>{key}</td><td>{val}</td></tr>";

	$rows = "";

	foreach($sysinfo as $key => $val)
	{
		$rows .= str_replace(
			array('{key}', '{val}'),
			array($key, $val), 
			$template
		);
	}
	
	echo "<table>$rows</table>";
?>

</body>
</html>