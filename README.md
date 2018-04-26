# simle-gallery

single php file image gallery - NO javascript

### Requirements
These requirements are for the upload client.  

Imagemagick  
Rsync  

### Usage

To use put the image in "images/" in numerical order 1,2,3,4,5.jpg... etc largest being the latest image, keep the exif data when posting as this will show the date on the site next to the image.  

You can also use the upload-photos.py as well to automaticly resize and rename the file to the correct number and upload to the server.  

### Todo

Instead of using count.txt use the latest image on the site that way you can use the upload across different devices and not worry about the naming of files being wrong.  

Consider using PIL to process the images instead of ImageMagick  
