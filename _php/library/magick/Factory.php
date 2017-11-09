<?php



class Magick_Factory
{
    
    
    
    
    public static function thumb($orig,$wantedWidth,$wantedHeight,$bestFit = 1,$bgColor = 'ffffff')
    {   
                
        return '/docs/_cache/img' . $orig .'_attr_'.$wantedWidth.'x'.$wantedHeight.'_'.$bgColor.'.jpg';
    }
    
    
     public static function createThumb( $wanted )
    {
            ob_start();
            
            
            $cachefile = PUBLIC_PATH . "/{$wanted}.jpg";
             
            
            $h1 = explode('_attr_',$wanted);
             $h2 = explode('_',end($h1));
            $attr = $h2[0];
            
             if( ! in_array( $attr, Project::$allowedThumbs ) )
                    throw new Exception ("Nepovoleny format");
            
                
                $file = '';    
                for ($i=0;$i<count($h1)-1;$i++) 
                    $file.=$h1[$i];
            
            
            if( count($attr) > 2 )
            {
                foreach ($attr as $key => $value)
                {
                    if($key == (count($attr)-1)||$key==0) continue;
                    $file .= '_'.$value;    
                }
            }
            
           
            
            $pathToOriginal = str_replace('docs/_cache/img', '', $file);
          
            
            $size = explode('x',$attr);
            $w =  intval($size[0]);
            $h =  explode('_',$size[1]);
            $h = intval($h[0]);
            
            
            
           self::generateThumb(PUBLIC_PATH . $pathToOriginal, $w, $h,1,$h2[1]);
              
           $output = ob_get_clean();

                
                
                $path = PUBLIC_PATH . "/". dirname($wanted);
                if( ! is_dir($path ) )
                {
                    mkdir( $path, 0777, true);
                }
                
                
                $handle = fopen($cachefile, "wb");

            fwrite($handle, $output);
            fclose($handle);
         
            return $output;
    }
    
    
    public static function generateThumb($img,$w,$h,$constrain,$bgcolor='ffffff',$percent = 0,$delete=false)
    {
            $wantedW = $w;
            $wantedH = $h;
        
            
            
          
            
            
            
            // get image size of img
            $x = getimagesize($img);
            // image width
            $sw = $x[0];
            // image height
            $sh = $x[1];
           
            if( $wantedH < $sw || $wantedH < $sh )
            {
            
                            $hx = (100 / ($sw / $w)) * .01;
                            $hx = @round ($sh * $hx);

                            $wx = (100 / ($sh / $h)) * .01;
                            $wx = @round ($sw * $wx);

                            if ($hx < $h) {
                                    $h = (100 / ($sw / $w)) * .01;
                                    $h = @round ($sh * $h);
                            } else {
                                    $w = (100 / ($sh / $h)) * .01;
                                    $w = @round ($sw * $w);
                            }
            }
            else {
                $w = $sw;
                $h = $sh;
            }
            
            $ext = explode('.', $img);
            if(strtolower(end($ext))=='jpg'||strtolower(end($ext))=='jpeg')
                $im = @ImageCreateFromJPEG ($img); // Read JPEG Image
            elseif(strtolower(end($ext))=='png')
                $im = @ImageCreateFromPNG ($img); // or PNG Image
            elseif(strtolower(end($ext))=='gif')            
                $im = @ImageCreateFromGIF ($img); // or GIF Image
            else
            $im = false; // If image is not JPEG, PNG, or GIF
            
            if (!$im) {
                    // We get errors from PHP's ImageCreate functions...
                    // So let's echo back the contents of the actual image.
                   // readfile ($img);
                throw new Exception ("cant load image");
            } else {
                    // Create the resized image destination
                    $thumb = @ImageCreateTrueColor ($wantedW, $wantedH);
                    
                        
                        $background = self::hexColorAllocate($thumb,'#'.$bgcolor);
                        imagefill($thumb, 0, 0, $background);
                    

                    $posX = 0; $posY = 0;
                    
                    if( $wantedW > $w )
                    {
                        $posX = ($wantedW - $w)/2;
                    }
                    

                    if( $wantedH > $h )
                    {
                        $posY = ($wantedH - $h)/2;
                    }
                                        
                    
                    // Copy from image source, resize it, and paste to image destination
                    @ImageCopyResampled ($thumb, $im, $posX, $posY, 0, 0, $w, $h, $sw, $sh);
                    // Output resized image
                    @ImageJPEG ($thumb);
                    
                    if($delete) unlink($img);
            }         
    }  
    
    
    public static function hexColorAllocate($im,$hex){
        $hex = ltrim($hex,'#');
        $a = hexdec(substr($hex,0,2));
        $b = hexdec(substr($hex,2,2));
        $c = hexdec(substr($hex,4,2));
        return imagecolorallocate($im, $a, $b, $c); 
    }
    
    public static function createThumbImagick( $wanted )
    {
            $cachefile = PUBLIC_PATH . "/{$wanted}.png";
            
            $exp = explode( '_attr_', $wanted );
            $folder = dirname($cachefile);
            
            if( ! is_dir( $folder ) )
            {
                mkdir($folder);
            }
            
            
            $image = PUBLIC_PATH . str_replace('cache/img', '', $exp[0]);
            $attr = explode('_',$exp[1]);
            $size = explode('x',$attr[0]);
            
            if( ! in_array( $attr[0], self::$povoleneRozmery ) )
                    throw new Exception ("Nepovoleny format");
            
            $wantedW =  intval($size[0]);
            $wantedH =  intval($size[1]);          
            
            
            
            
            
            $bestFit = $attr[1] ? 1 : 0;
                       
            $bgColor =  $attr[2] == 'transparent' ? 'transparent' : '#' . $attr[2];
            
            
            
                   /*** a new imagick object ***/
        $thumb = new Imagick();
        
        $thumb->setResourceLimit( Imagick::RESOURCETYPE_MEMORY, 8 );
        
        /*** ping the image ***/
        $thumb->pingImage($image);

        /*** read the image into the object ***/
        $thumb->readImage( $image );
    
    $config = Settings::load('project', 'cz');
    
    
        //$thumb = self::watermark($thumb, $config->url);
       
    $thumb->adaptiveResizeImage($wantedW, $wantedH, $bestFit); 
    //$thumb->resizeImage( $w, $h,$filter,$bestFit);

    $im = new Imagick();
    
        
        $w = $thumb->getImageWidth();
        $h = $thumb->getImageHeight();
                
   
    
    $im->newImage($wantedW, $wantedH, new ImagickPixel($bgColor), "png"); 
    
                        $posX = 0; $posY = 0;
                    
                    if( $wantedW > $w )
                    {
                        $posX = ($wantedW - $w)/2;
                    }
                    

                    if( $wantedH > $h )
                    {
                        $posY = ($wantedH - $h)/2;
                    }
    
    $im->compositeImage( $thumb, imagick::COMPOSITE_OVER, $posX, $posY );
    
    $im->setImageCompressionQuality(100);
        /*** write image to disk ***/
        //$im->writeImage( $cachefile );
        $im->writeImage( $cachefile );
        return $im;
    }
   
    public static function watermark($image,$text)
    {
        
/* This object will hold the font properties */
$draw = new ImagickDraw();
 
/* Setting gravity to the center changes the origo
        where annotation coordinates are relative to */
$draw->setGravity( Imagick::GRAVITY_CENTER );
 
/* Use a custom truetype font */
    $draw->setFont( APPLICATION_PATH . "/../lib/magick/fonts/Monomer.ttf" );
 
/* Set the font size */
$draw->setFontSize( 9 );
 
/* Create a new imagick object */
$im = new imagick();
 
/* Get the text properties */
$properties = $im->queryFontMetrics( $draw, $text );
 
/* Region size for the watermark.
        Add some extra space on the sides  */
$watermark['w'] = intval( $properties["textWidth"] + 5 );
$watermark['h'] = intval( $properties["textHeight"] + 5 );
 
/* Create a canvas using the font properties.
        Add some extra space on width and height */
$im->newImage( $watermark['w'], $watermark['h'],
                    new ImagickPixel( "transparent" ) );
 
/* Get a region pixel iterator to get the pixels in the watermark area */
$it = $image->getPixelRegionIterator( 0, 0, $watermark['w'], $watermark['h'] );
 
$luminosity = 0;
$i = 0;
 
/* Loop trough rows */
while( $row = $it->getNextIteratorRow() )
{
        /* Loop trough each column on the row */
        foreach ( $row as $pixel )
        {
                /* Get HSL values */
                $hsl = $pixel->getHSL();
                $luminosity += $hsl['luminosity'];
                $i++;
        }
}
 
/* If we are closer to white, then use black font and
        the other way around */
$textColor = ( ( $luminosity / $i )> 0.5 ) ?
                        new ImagickPixel( "black" ) :
                        new ImagickPixel( "white" );
 
/* Use the same color for the shadow */
$draw->setFillColor( $textColor );
 
/* Use png format */
$im->setImageFormat( "png" );
 
/* Annotate some text on the image */
$im->annotateImage( $draw, 0, 0, 0, $text );
 
/* Clone the canvas to create the shadow */
$watermark = $im->clone();
 
/* Set the image bg color to black. (The color of the shadow) */
$watermark->setImageBackgroundColor( $textColor );
 
/* Create the shadow (You can tweak the parameters
        to produce "different" kind of shadows */
$watermark->shadowImage( 80, 2, 2, 2 );
 
/* Composite the text on the background */
$watermark->compositeImage( $im, Imagick::COMPOSITE_OVER, 0, 0 );
 
/* Composite the watermark on the image to the top left corner */
$image->compositeImage( $watermark, Imagick::COMPOSITE_OVER, 0, 0 );
    
return $image;
    }
    
    public static function stroke()
    {
        $move = 30;
$image = new Imagick(); 
$image->newimage(450,130, "#cc9999");
$image->setimageformat( "png" );

# define some color objects
$none = new imagickpixel( "transparent" );
$red = new imagickpixel( "red" );
$blue = new imagickpixel( "#0000ff" );
$green = new imagickpixel( "green" );
$yellow = new imagickpixel( "yellow" );
$purple = new imagickpixel( "purple" );

# define a line
$line = new ImagickDraw;
$line->setfillcolor($blue);
$line->line( 20,20, 420, 40);

# draw the line
$image->drawimage($line);

# change the lines color
$line->setfillcolor($green);
# and the stroke color
$line->setstrokecolor($green);
# Make it wider
$line->setstrokewidth(20);
# Gve it a round end
$line->setStrokeLineCap(imagick::LINECAP_ROUND);
# Move it over
$line->line( 20,50, 420, 70);
# Draw the line
$image->drawimage($line);

# make dash array
$dash = array( 2,2,4 );
# set dash pattern
$line->setStrokeDashArray( $dash );
# make fill color transparent
$line->setfillcolor($none);
# set stroke color purple
$line->setstrokecolor($purple);
$line->setStrokeLineCap( imagick::LINECAP_BUTT );
$line->line( 20,80, 420, 100);
$image->drawimage($line);

# make a new draw object
$line_2 = new ImagickDraw;
$line_2->setfillcolor($yellow);
$line_2->setstrokecolor($yellow);
$line_2->setstrokewidth(20);
# make it simitransparent with setFillOpacity and setStrokeAlpha
$line_2->setFillOpacity(.75);
$line_2->setStrokeAlpha(.3);
$line_2->line( 400,20, 40, 100);
$image->drawimage($line_2);

# send to bowser
header("Content-type: image/png");
echo $image;
    }
    
    public static function favionIcon()
    {
        $src_img = new Imagick("src_img.png");
$icon = new Imagick();
$icon->setFormat("ico");

$geo=$src_img->getImageGeometry();

$size_w=$geo['width'];
$size_h=$geo['height'];

if (128/$size_w*$size_h>128) {
  $src_img->scaleImage(128,0);
} else {
  $src_img->scaleImage(0,128);
}

$src_img->cropImage(128, 128, 0, 0);

$clone = $src_img->clone();
$clone->scaleImage(16,0);           
$icon->addImage($clone);

$clone = $src_img->clone();
$clone->scaleImage(32,0);           
$icon->addImage($clone);

$clone = $src_img->clone();
$clone->scaleImage(64,0);           
$icon->addImage($clone);

$clone = $src_img->clone();
$clone->scaleImage(128,0);   
$icon->addImage($clone);

$icon->writeImages("favicon.ico", true);

$src_img->destroy();
$icon->destroy();
$clone->destroy(); 
    }
    
    public static function createAnimation()
    {
            $filelist = array("fileitem1.png","fileitem2.png","fileitem3.png");

    $aniGif = new Imagick();
    $aniGif->setFormat("gif");

    foreach($filelist as $frameitem){
        echo "-----------------------\n adding frame {$frameitem}\n";
        $frame = new Imagick($frameitem);       
        $aniGif->addImage($frame);
        //$delay time unit is micro second so 100 = 1s, one picture per second
        $aniGif->setImageDelay($delay = 100);
        echo "end of adding frame {$frameitem}\n";
    }
    //there more than one file, so must be using writeImages()
    $aniGif->writeImages($fileTarget = "aniGif.gif", $adjoin = true);
    }
    
    public static function mirror()
    {
        /* Read the image */
$im = new Imagick( "strawberry.png" );
 
/* Thumbnail the image */
$im->thumbnailImage( 200, null );
 
/* Create a border for the image */
$im->borderImage( "white", 5, 5 );
 
/* Clone the image and flip it */
$reflection = $im->clone();
$reflection->flipImage();
 
/* Create gradient. It will be overlayd on the reflection */
$gradient = new Imagick();
 
/* Gradient needs to be large enough for the image
and the borders */
$gradient->newPseudoImage( $reflection->getImageWidth() + 10,
                           $reflection->getImageHeight() + 10,
                           "gradient:transparent-black"
                        );
 
/* Composite the gradient on the reflection */
$reflection->compositeImage( $gradient, imagick::COMPOSITE_OVER, 0, 0 );
 
/* Add some opacity */
$reflection->setImageOpacity( 0.3 );
 
/* Create empty canvas */
$canvas = new Imagick();
 
/* Canvas needs to be large enough to hold the both images */
$width = $im->getImageWidth() + 40;
$height = ( $im->getImageHeight() * 2 ) + 30;
$canvas->newImage( $width, $height, "black", "png" );
 
/* Composite the original image and the reflection on the canvas */
$canvas->compositeImage( $im, imagick::COMPOSITE_OVER, 20, 10 );
$canvas->compositeImage( $reflection, imagick::COMPOSITE_OVER,
                        20, $im->getImageHeight() + 10 );
 
/* Output the image*/
header( "Content-Type: image/png" );
echo $canvas;

    }
    
}

