<?php 
	if(!function_exists('root')){
		function root($path=''){
			$path=trim($path,'/');
			$docPath=dirname(dirname(__FILE__)).'/'.$path;
			return $docPath;
			
		}
	}

if(!function_exists('base_url')){
    function base_url($path=''){
        $path=trim($path,'/');
        $http=$_SERVER['REQUEST_SCHEME'];
        $serverName=$_SERVER['HTTP_HOST'];
        return $http.'://'.$serverName.'/vrs/admin/'.$path;
      }
    }

    if(!function_exists('file_url')){
      function file_url($path=''){
          $path=trim($path,'/');
          $http=$_SERVER['REQUEST_SCHEME'];
          $serverName=$_SERVER['HTTP_HOST'];
          return $http.'://'.$serverName.'/vrs/uploads/'.$path;
        }
      }



    if(!function_exists('exit_url')){
      function exit_url($path=''){
          $path=trim($path,'/');
          $http=$_SERVER['REQUEST_SCHEME'];
          $serverName=$_SERVER['HTTP_HOST'];
          return $http.'://'.$serverName.'/vrs/'.$path;
        }
      }
  

    
	if(!function_exists('file_provider')){
		function file_provider($path=''){
				$path=trim($path,'/');
				$http=$_SERVER['REQUEST_SCHEME'];
				$serverName=$_SERVER['HTTP_HOST'];
				return $http.'://'.$serverName.'/nbm/provider-panel/uploads/'.$path;
			}
	
		}

		if(!function_exists('file_provider_url')){
			function file_provider_url($path=''){
					$path=trim($path,'/');
					$http=$_SERVER['REQUEST_SCHEME'];
					$serverName=$_SERVER['HTTP_HOST'];
					return $http.'://'.$serverName.'/nbm/provider-panel/uploads/'.$path;
				}
		
			}
			

      if(!function_exists('service_thumb')){
        function service_thumb($path=''){
            $path=trim($path,'/');
            $http=$_SERVER['REQUEST_SCHEME'];
            $serverName=$_SERVER['HTTP_HOST'];
            return $http.'://'.$serverName.'/nbm/admin-panel/uploads/'.$path;
          }

        }

        
      if(!function_exists('file_user_url')){
        function file_user_url($path=''){
            $path=trim($path,'/');
            $http=$_SERVER['REQUEST_SCHEME'];
            $serverName=$_SERVER['HTTP_HOST'];
            return $http.'://'.$serverName.'/vrs/user/uploads/'.$path;
          }

        }

?>

<?php
//convert date time to ago 
date_default_timezone_set('Asia/Kathmandu');
function time_Ago($time)
{
  $diff = time() - strtotime($time);
  $sec = $diff;
  $min = round($diff / 60);
  $hrs = round($diff / 3600);
  $days = round($diff / 86400);
  $weeks = round($diff / 604800);
  $mnths = round($diff / 2600640);
  $yrs = round($diff / 31207680);

  if ($sec <= 60) {
    echo "Just now";
  } else if ($hrs <= 24) {
    if ($min == 1) {
      echo "today";
    } else {
		echo "today";
    }
  } else if ($mnths <= 12) {
    if ($mnths == 1) {
      echo "1 month of experience";
    } else {
      echo "$mnths + month of experience";
    }
  } else {
    if ($yrs == 1) {
      echo "+1 year of experience";
    } else {
      echo "$yrs years of experience";
    }
  }
}