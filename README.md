
Aixeena SEO Images
===============

1.- Description
---------------------------  

**Aixeena SEO Images** is free Joomla plugin to minimize the weight of the images of your site.

With this plugin you can get better results in the performance of your website, because it creates thumbnails of your images, reducing their size and quality.

The plugin is thinked for Joomla developers who need or love to increase the perfomance of their sites.

This plugin is created by [Ciro Artigot](http://twitter/ciroartigot) to contribute to the Joomla community.

2.- Features
---------------------------
* It works with jpeg and png images, and it can minimize the image size and the image quality.
* The thumbs are stored on a local folder (images/thumbs/ by default) and replaced in the page content before rendering the page.
* The plugin only work with local images.
* You can set the default images qualities and maximum image size, and you can set the default thumb directory.
* By default you must add some classes to make it work. You can also disable this  option "A Class is mandatory" to minimize all the page images without needing to add classes.
* The plugin works also with tags with style="background-image:url(....)"

3.- Install / Configuration
--------------------------- 
- Clone the repository or [Download Zip file](https://github.com/CiroArtigot/aixeenaseoimages/archive/master.zip)
- Install it through Joomla Extension Manager 
- Go to Extensions > Plug-in manager and search a plugin called "System - Aixeena SEO Images". Click it to enable / configure the plugin.

4.- Mandatory classes
---------------------------

### IMG TAgs

If the option **"A class is mandatory"** is enabled (by default) is mandatory to add some classes to the <img> or to the element with the style.

To minimize an image you must add the "aixeena-images" class to the element.

To set the maximun size enter the "size-200" (to set the maximum size to 200px). This way you can resize by code each image in a different size. You can have different views for different displais (mobile, desktop...)

To override the default quality you can use the "quality-80" to, for example set the quality to 80%.

So, you can resize an image to 300px and 60% quality with:

```bash
<img src="images/xxxxx.jpg" class="aixeena-images size-300 quality-60" />
```

This will create a thumbnail in the images/thumbs directory and the img src attribute will be replaced with the thumb path.

### Sstyle background images

You can also minimize the images linked with the backgound-image CSS property.

Add the aixeena-background class to the item tag that have the style:

```bash
<div 
    class="aixeena-background aixeena-images size-215 quality-100" 
    style="background-image:url(images/xxxx); ">
</div>
```

5.- Important notes
---------------------------

* There is no way now to delete the thumbs by button, so if you want to replace the thumb of a image, delete it from the thumbs folder or change the image name (a new thumb will be generated)
* I'm looking an option to delete the thumbs by url, and an option to delete all too.
* This extension is on beta mode, so if you are going to use it on production sites remember that is GNU licensed and no there is no warranty.

6.- Donate
---------------------------
You can [donate](https://www.paypal.com/donate/?token=YJ_4RSeWoYiDjVYv0nqui0cvJgVJMI7Gp0NoDFs0URpD_VrWNAcwPy5bw3ZLWTcvSKEoW0&country.x=US&locale.x=US) and help my with a beer or a cup of coffe to continue developing free an opensource for Joomla!

7.- Author & License
---------------------------
Showtags was developed by [Ciro Artigot](http://twitter.com/ciroartigot).

This extension is licensed under GNU/GPL 2, http://www.gnu.org/licenses/gpl-2.0.html  

8.- Contact
---------------------------
**Email**: ciro.artigot(at)gmail.com  
**Twitter**: [http://twitter.com/ciroartigot](http://twitter.com/ciroartigot)  
**Linked-In**: [Linked In](https://www.linkedin.com/in/ciroartigot)  

9.- Changelog
---------------------------
v.1.0.0 - Development working version  
