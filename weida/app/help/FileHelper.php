<?php
	namespace WZApp\Help;
	use Phalcon\Http\Response;
	// require APP_PATH . '/plugins/PHPExcel/Classes/';
	/**
	 * 
	 */
	class FileHelper 
	{
		
	
		public function Upload($request){
 			try{
 				//检查用户是否上传了文件
 				//var_dump($request,$request->getHeaders(),$request->hasFiles(),$request->getUploadedFiles());die;
		        if($request->hasFiles()){
		 			$files = [];
	                foreach ($request->getUploadedFiles() as $file){
	                    //打印出文件的文件名和文件大小
	                    //echo "文件名：".$file->getName()." <br>"."文件大小：".$file->getSize();

	                    $path = $file->getExtension().'/'.date('Ymd').'/';
	                    //var_dump(file_exists(UPLOAD_PATH.$path));die;
	                    if (!file_exists(UPLOAD_PATH.$path)){
						    mkdir (UPLOAD_PATH.$path,0777,true);
						}

						$filename = md5(time().$file->getName()).'.'.$file->getExtension();

	                    $file->moveTo(UPLOAD_PATH.$path.$filename);
	                    
	                    $files[$file->getKey()]= ['showpath'=>'/uploads/'.$path.$filename,'savepath'=>UPLOAD_PATH.$path.$filename];
	                }
	                return $files;
		        }
		        
 			}
 			catch (\Exception $e){
			    echo get_class($e), ": ", $e->getMessage(), "\n";
			    echo " File=", $e->getFile(), "\n";
			    echo " Line=", $e->getLine(), "\n";
			    echo $e->getTraceAsString();
			    die;
 			}
            
 		}


 		public function getExcelInfo($path)
 		{
 			$PHPReader = new PHPExcel_Reader_Excel2007();
 			if(!$PHPReader->canRead($path)){

				$PHPReader = new PHPExcel_Reader_Excel5();

			if(!$PHPReader->canRead($path)){

				echo 'no Excel';
				exit;
			}

			}else{
				echo 'can read';exit;
			}
			$PHPExcel = $PHPReader->load($path);
			echo is_object($PHPExcel).'mmm';exit;
 			return ;
 		}

 		/**
			$data = [
						"key"=>[$filepath1,$filepath2],
					]
 		*/
 		public function ZipforDownLoad($data){
 			$file = md5(time());
 			$zippath = 'zip/'.date('Ymd').'/';
 			$path = 'zip/'.date('Ymd').'/'.$file .'/';
	        
	        if (!file_exists(UPLOAD_PATH.$path)){
				mkdir (UPLOAD_PATH.$path,0777,true);
			}	

			foreach ($data as $key => $value) {
				mkdir (UPLOAD_PATH.$path.$key.'/',0777,true);
				foreach ($value as $filepath) {
					preg_match('/\/([^\/]+\.[a-z]+)[^\/]*$/',$filepath,$match); 
					copy(PUBLIC_PATH.$filepath , UPLOAD_PATH.$path.$key.'/'.$match[1]);
				}
			}

			$zip = new \ZipArchive();
			$zipfilepath = UPLOAD_PATH.$zippath.$file.'.zip';
			//var_dump($zipfilepath) ;die;
			if ($zip->open($zipfilepath, \ZipArchive::CREATE) === TRUE) {

				$this->addFileToZip('./uploads/'.$path, $zip, $file.'/'); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法
				$zip->close(); //关闭处理的zip文件
			}else{
				return "打包zip报错";
			}	

			return '/uploads/'.$zippath.$file.'.zip';
		}


		public function addstrTofile($str){
			$path = 'jpg/'.date('Ymd').'/';
			if (!file_exists(UPLOAD_PATH.$path)){
			    mkdir (UPLOAD_PATH.$path,0777,true);
			}

			$filename = md5(time()).'.jpg';

            //$file->moveTo(UPLOAD_PATH.$path.$filename);
            $file = fopen(UPLOAD_PATH.$path.$filename, "a+");
            fwrite($file, $str);
            fclose($file);
            //$files[]= ['showpath'=>'/uploads/'.$path.$filename,'savepath'=>UPLOAD_PATH.$path.$filename];
			return ['showpath'=>'/uploads/'.$path.$filename,'savepath'=>UPLOAD_PATH.$path.$filename];
			
		}

 		public function addFileToZip($path, $zip, $subdir='' ) {
			$handler = opendir($path); //打开当前文件夹由$path指定。

			while (($filename = readdir($handler)) !== false) {
				if ($filename != "." && $filename != "..") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
					if (is_dir($path . "/" . $filename)) {// 如果读取的某个对象是文件夹，则递归
						$localPath = $subdir.$filename.'/';
						$this->addFileToZip($path . "/" . $filename, $zip,$localPath);
					} else { //将文件加入zip对象
						$zip->addFile($path . "/" . $filename , $subdir.$filename);
					}
				}
			}
			@closedir($path);
		}

		public function downFile($file_url){
			$filepath = PUBLIC_PATH.trim($file_url,'/');
			if(!file_exists($filepath)){
				exit;
			}
			$fp=fopen($filepath,"r");
			$filesize=filesize($filepath);
			header("Content-type:application/octet-stream");
			header("Accept-Ranges:bytes");
			header("Accept-Length:".$filesize);
			header("Content-Disposition: attachment; filename=".basename($filepath));
			$buffer=1024;
			$buffer_count=0;
			while(!feof($fp)&&$filesize-$buffer_count>0){
				$data=fread($fp,$buffer);
				$buffer_count+=$buffer;
				echo $data;
			}
			fclose($fp);
			die;
		}


	}