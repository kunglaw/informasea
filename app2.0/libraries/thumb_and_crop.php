<?php if(!defined("BASEPATH")) exit ("No Direct Script Access Allowed");

	class Thumb_and_crop
	{
	
		private $handleimg;
		private $original = "";
		private $handlethumb;
		private $oldoriginal;
	
		/*
			Apre l'immagine da manipolare
		*/
		function __construct()
		{
			// tentukan dahulu file type nya 
			$CI =& get_instance();
			$img_src   = $CI->input->post("img_src",true);
			$img_input = $_FILES['img_input'];
			
			if(!empty($img_input))
			{
				//echo "why";
				$ex = explode("/",$img_input['type']);
				$img_type = $ex[1];
				
			}
			else if(!empty($img_src))
			{
				//echo "ini jalan loo";
				$int_type =  exif_imagetype($img_src);
				$img_type =  image_type($int_type);
				//echo "img_src = $img_type";
			}
			
			$this->original = "cover.".$img_type;
			
			/* if(!empty($_FILES))
			{
				$this->original = $_FILES['img_input'];	
			}*/
		}
		
		public function openImg($file)
		{
			$this->original = $file;
			
			if($this->extension($file) == 'jpg' || $this->extension($file) == 'jpeg')
			{
				$this->handleimg = imagecreatefromjpeg($file);
			}
			else if($this->extension($file) == 'png')
			{
				$this->handleimg = imagecreatefrompng($file);
			}
			else if($this->extension($file) == 'gif')
			{
				$this->handleimg = imagecreatefromgif($file);
			}
			else if($this->extension($file) == 'bmp')
			{
				$this->handleimg = imagecreatefromwbmp($file);
			}
		}
		
		/*
			Ottiene la larghezza dell'immagine
		*/
		public function getWidth()
		{
			return imageSX($this->handleimg);
		}
		
		/*
			Ottiene la larghezza proporzionata all'immagine partendo da un'altezza
		*/
		public function getRightWidth($newheight)
		{
			$oldw = $this->getWidth();
			$oldh = $this->getHeight();
			
			$neww = ($oldw * $newheight) / $oldh;
			
			return $neww;
		}
		
		/*
			Ottiene l'altezza dell'immagine
		*/
		public function getHeight()
		{
			return imageSY($this->handleimg);
		}
		
		/*
			Ottiene l'altezza proporzionata all'immagine partendo da una larghezza
		*/
		public function getRightHeight($newwidth)
		{
			$oldw = $this->getWidth();
			$oldh = $this->getHeight();
			
			$newh = ($oldh * $newwidth) / $oldw;
			
			return $newh;
		}
		
		/*
			Crea una miniatura dell'immagine
		*/
		public function creaThumb($newWidth, $newHeight)
		{
			$oldw = $this->getWidth();
			$oldh = $this->getHeight();
			
			$this->handlethumb = imagecreatetruecolor($newWidth, $newHeight);
			
			return imagecopyresampled($this->handlethumb, $this->handleimg, 0, 0, 0, 0, $newWidth, $newHeight, $oldw, $oldh);
		}
		
		/*
			Ritaglia un pezzo dell'immagine
		*/
		public function cropThumb($width, $height, $x, $y)
		{
			$oldw = $this->getWidth();
			$oldh = $this->getHeight();
			
			$this->handlethumb = imagecreatetruecolor($width, $height);
			
			return imagecopy($this->handlethumb, $this->handleimg, 0, 0, $x, $y, $width, $height);
		}
		
		/*
			Salva su file la Thumbnail
		*/
		public function saveThumb($path, $qualityJpg = 100)
		{
			if($this->extension($this->original) == 'jpg' || $this->extension($this->original) == 'jpeg')
			{
				return imagejpeg($this->handlethumb, $path, $qualityJpg);
			}
			elseif($this->extension($this->original) == 'png')
			{
				return imagepng($this->handlethumb, $path);
			}
			elseif($this->extension($this->original) == 'gif')
			{
				return imagegif($this->handlethumb, $path);
			}
			elseif($this->extension($this->original) == 'bmp')
			{
				return imagewbmp($this->handlethumb, $path);
			}
		}
		
		/*
			Stampa a video la Thumbnail
		*/
		public function printThumb()
		{
			if($this->extension($this->original) == 'jpg' || $this->xtension($this->original) == 'jpeg')
			{
				header("Content-Type: image/jpeg");
				imagejpeg($this->handlethumb);
			}
			elseif($this->extension($this->original) == 'png')
			{
				header("Content-Type: image/png");
				imagepng($this->handlethumb);
			}
			elseif($this->extension($this->original) == 'gif')
			{
				header("Content-Type: image/gif");
				imagegif($this->handlethumb);
			}
			elseif($this->extension($this->original) == 'bmp')
			{
				header("Content-Type: image/bmp");
				imagewbmp($this->handlethumb);
			}
		}
		
		/*
			Distrugge le immagine per liberare le risorse
		*/
		public function closeImg()
		{
			imagedestroy($this->handleimg);
			imagedestroy($this->handlethumb);
		}
		
		/*
			Imposta la thumbnail come immagine sorgente,
			in questo modo potremo combinare la funzione crea con la funzione crop
		*/
		public function setThumbAsOriginal()
		{
			$this->oldoriginal = $this->handleimg;
			$this->handleimg = $this->handlethumb;
		}
		
		/*
			Resetta l'immagine originale
		*/
		public function resetOriginal()
		{
			$this->handleimg = $this->oldoriginal;
		}
		
		/*
			Estrae l'estensione da un file o un percorso
		*/
		private function extension($percorso)
		{
			if(eregi("[\|\\]", $percorso))
			{
				// da percorso
				$nome = $this->nomefile($percorso);
				
				$spezzo = explode(".", $nome);
				//echo strtolower(trim(array_pop($spezzo)));
				return strtolower(trim(array_pop($spezzo)));
			}
			else
			{
				//da file
				$spezzo = explode(".", $percorso);
				//echo strtolower(trim(array_pop($spezzo)));
				return strtolower(trim(array_pop($spezzo)));
			}
			// tentukan dahulu file type nya 
			/* $img_src   = $CI->input->post("img_src",true);
			$img_input = $_FILES['img_input'];
			
			if(!empty($img_input))
			{
				$ex = explode("/",$img_input['type']);
				$img_type = $ex[1];
				
			}
			else if(!empty($img_src))
			{
				echo $img_src;
				$int_type =  exif_imagetype($img_src);
				$img_type =  image_type($int_type);
				//echo "img_src = $img_type";
			}
			echo "function extension() = $img_type ";
			return $img_type;*/
		}
		
		/*
			Estrae il nome del file da un percorso
		*/
		private function nomefile($path, $ext = true)
		{
			$diviso = spliti("[/|\\]", $path);
			
			if($ext)
			{
				return trim(array_pop($diviso));
			}
			else
			{
				$nome = explode(".", trim(array_pop($diviso)));
				
				array_pop($nome);
				
				return trim(implode(".", $nome));
			}
		}
	}
?>